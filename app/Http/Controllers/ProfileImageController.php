<?php

namespace App\Http\Controllers;

use App\Models\ProfileImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreProfileImageRequest;

class ProfileImageController extends Controller
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
    public function store(StoreProfileImageRequest $request, $user_id)
    {
        if($request->file('profile_image')){
            $file = $request->file('profile_image');
            $filename = date('YmdHi').'-'.$file->getClientOriginalName();
            $file->move(public_path('images/users'), $filename);

            $profile_image = new ProfileImage();
            $profile_image->image = $filename;
            $profile_image->user_id = $user_id;
            $profile_image->save();
        }
        return redirect()->back()->with('success', __('Imagen añadida correctamente.'));
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
    public function update(StoreProfileImageRequest $request, $user_id)
    {
        if($request->file('profile_image')){
            $file = $request->file('profile_image');
            $filename = date('YmdHi').'-'.$file->getClientOriginalName();

            $profile_image = ProfileImage::where('user_id', $user_id)->first();

            File::delete(public_path('images/users/'.$profile_image->image));

            $file->move(public_path('images/users'), $filename);

            $profile_image->image = $filename;
            $profile_image->save();
        }
        return redirect()->back()->with('success', __('Imagen actualizada correctamente.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile_image = ProfileImage::where('user_id', $id)->get()->first();

        File::delete(public_path('images/users/'.$profile_image->image));

        $profile_image->delete();

        return redirect()->back()->with('success', __('Imagen eliminada correctamente.'));
    }
}
