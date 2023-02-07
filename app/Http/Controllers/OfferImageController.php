<?php

namespace App\Http\Controllers;

use App\Models\OfferImage;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreOfferImageRequest;

class OfferImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOfferImageRequest $request, $offer_id)
    {
        if($request->file('offer_image')){
            $file = $request->file('offer_image');
            $filename = date('YmdHi').'-'.$file->getClientOriginalName();
           
            $offer_image_id = $request->input('offer_image_id');

            // Deleting current file from folder:
            $image = OfferImage::findOrFail($offer_image_id);

            File::delete(public_path('images/offers/'.$image->image));

            // Change the current picture to the new one:
            $image->image = $filename;
            $image->save();

            // Save the new file into folder:
            $file->move(public_path('images/offers'), $filename);
            
        }else{
            abort(500);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $image_name = OfferImage::findOrFail(request()->input('image_id'))->image;
        $offer_id = request()->input('offer_id');

        Offer::findOrFail($offer_id)->images->where('offer_id', $offer_id)->where('image', $image_name)->first()->delete();
        File::delete(public_path('images/offers/'.$image_name));

        // $offer_images = Offer::findOrFail($offer_id)->images;
        // return response()->json($offer_images);
    }
}
