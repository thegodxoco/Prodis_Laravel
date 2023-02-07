<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\OfferImage;
use App\Models\Offer;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Mail\OfferSubscription;
use App\Mail\OfferUnSubscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Controllers\OfferController;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{   
    /**
     * Display a listing of the offers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category = null)
    {       
        if (!is_null($category)) {

            $validator = Validator::make(['category' => $category], [
                'category' => 'alpha'
            ]);
            
            if ($validator->fails()) {
                abort(404);
            }else {
                $offers = Offer::whereHas('categories', function($q) use($category){
                    $q->where('name', '=', $category);})->paginate(10);
            }
        }else{ 
            $offers = Offer::paginate(10);
        }

        // $categories = Category::all();

        return view('offers.index',[
                'offers' => $offers
            ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locale = App::currentLocale();
        // Caching the array of provinces of EACH locale for optimization:
        // $provinces = cache()->remember("provinces.{$locale}", now()->addDay(), function(){
        //     return trans("provinces");
        // });

        // if (Cache::has('provinces.es')) {
        //     $provinces = Cache::get('province.es');
        // }else if(Cache::has('provinces.ca')){
        //     $provinces = Cache::get('province.ca');
        // }

        $provinces = trans('provinces');

        $categories = Category::all();

        return view('offers.create', [
            'provinces' => $provinces,
            'categories' => $categories

        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOfferRequest $request)
    {
        $assigned_categories = $request['selected_categories'];

        $validated = $request->validated();

        $offer = Offer::create($validated);

        // dd($request->file('image'));

        if($request->file('image')){
            foreach ($request->file('image') as $key => $value) {
                $file = $value;
                $filename = date('YmdHi').'-'.$file->getClientOriginalName();
                $file->move(public_path('images/offers'), $filename);

                $image = new OfferImage();
                $image->image = $filename;
                $image->offer_id = $offer->id;
                $image->save();
            }
        }

        if ($assigned_categories != null) {
            foreach ($assigned_categories as $category) {

                $cat = DB::table('categories')->where('name', '=', $category)->first();
    
                $offer->categories()->attach($cat->id);
            }
        }
        return redirect('/offers')->with('success', __('Oferta creada correctamente.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        if (Offer::find($id)) {
            if (Auth::check()) {
                // QueryBuilder or Eloquent ???
                 return view('offers.show', [
                     'offer' => Offer::where('id', $id)->first(),
                     'isSubscribed' => $this->isSubscribed($id)
                 ]);
             }else{
                 return view('offers.show', [
                     'offer' => Offer::where('id', $id)->first(),
                     'isSubscribed' => false
                 ]);
             }
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provinces = trans('provinces');

        $categories = Category::all();

        $offer = Offer::find($id);

        $off_cat = [];
        $offer_categories = Offer::find($id)->categories;

        for ($index=0; $index < count($offer_categories); $index++) { 
            array_push( $off_cat, $offer_categories[$index]->name );
        }
        return view('offers.edit')->with('provinces', $provinces)
                                  ->with('categories', $categories )
                                  ->with('offer', $offer)
                                  ->with('off_cat',  $off_cat );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOfferRequest $request, $id)
    {
        // Validation:
        $validated = $request->validated();
        $offer = Offer::find($id);
        $offer->update($validated);

        if($request->file('image')){
            foreach ($request->file('image') as $key => $value) {
                $file = $value;
                $filename = date('YmdHi').'-'.$file->getClientOriginalName();
                $file->move(public_path('images/offers'), $filename);

                $image = new OfferImage();
                $image->image = $filename;
                $image->offer_id = $offer->id;
                $image->save();
            }
        }

        $assigned_categories = $request['selected_categories'];

        // For every category selected in the select menu, it adds it to the offer.
        if ($assigned_categories != null) {
            foreach ($assigned_categories as $category) {

                $cat = DB::table('categories')->where('name', '=', $category)->first();
    
                if( !$offer->categories()->where('name', $category)->first() ){
                    $offer->categories()->attach($cat->id);
                }
            }
        }
        // For every category of the offer, if the category is not selected in the select menu, it 
        // removes it from the offer. If none of the categories is selected, it removes all categories that the offer has.
        foreach ($offer->categories as $key => $category) {
            if ($assigned_categories != null) {
                if (!in_array($category->name, $assigned_categories)) {
                    $offer->categories()->detach($category->id);
                }
            }
            else{
                $offer->categories()->detach($category->id);
            }
        } 
        return back()->with('success', __('Oferta actualizada correctamente.'));
    }

    /**
     * Remove the specified offer and its images from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        if($offer){
            for ( $index = 0; $index < count($offer->images); $index++){
                File::delete(public_path('images/offers/'.$offer->images[$index]['image']));
            }
            $destroy = Offer::destroy($id);
        }
        return redirect('/offers')->with('success',__('Oferta eliminada correctamente.'));
    }

    /**
     * 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function subscribe($id){

        $offer = Offer::find($id);

        if ($offer->subscribable) {
            $offer->users()->attach(Auth::user()->id);
            Mail::to('joanamartinezlopezjml@gmail.com')->send(new OfferSubscription( Auth::user(), $offer ));
            
            
        }else{
            abort(403);
        }
        return back()->with('success',__('Te has suscrito correctamente.'));
    }

    /**
     * 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe($id){

        $offer = Offer::find($id);

        $offer->users()->detach(Auth::user()->id);

        Mail::to('joanamartinezlopezjml@gmail.com')->send(new OfferUnSubscription( Auth::user(), $offer ));
        
        return back()->with('success',__('Te has dado de baja correctamente.'));
    }

    /** NOT DONE
     * Checks if an user is subscribed to a specific offer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function isSubscribed($offer_id){

        foreach (Auth::user()->offers as $offer) {
            if ($offer->id == $offer_id) {
                return true;
            }
        }
        return false;
        
    }

    /** NOT DONE
     * Generates a PDF report of the volunteers of said offer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generateOfferVolunteerReport($offer_id){

        $pdf = PDF::loadView('reports.offer_volunteers', [
            'volunteers' => Offer::where('id', $offer_id)->first()->users, 
            'offer' => Offer::find($offer_id)
        ]);
        
        return $pdf->stream();
        
    }

}