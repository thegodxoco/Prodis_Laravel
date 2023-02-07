<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\AdminEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SendAdminEmailRequest;

class AdminController extends Controller
{
    function index(){
        
        return view('users.index')->with('users', User::all());
    }

    function showEmailForm(){

        return view('emails.create');
    }

    function sendEmail(SendAdminEmailRequest $request){

        $from = $request->input('from');
        $subject = $request->input('subject');
        $content = $request->input('content');

        if ($request->has('all_volunteers')) {
    
            $volunteers = User::select('email')->get();
            $test = [];
            foreach ($volunteers as $key => $value) {
                array_push($test, $value['email']); 
                Mail::to($value['email'])->send(new AdminEmail( $from, $subject, $content ));
            }
            // Mail::to($value['email'])->bcc($test)->send(new AdminEmail( $from, $subject, $content ));
        }
        else{
            $for = $request->input('for');
            Mail::to($for)->send(new AdminEmail( $from, $subject, $content ));
        }

        return redirect()->back()->with('success', __('Email enviado correctamente.') ) ;
    }
}
