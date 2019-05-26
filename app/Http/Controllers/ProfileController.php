<?php

namespace App\Http\Controllers;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    public function profile()
    {
        return view('profile.profile');

    }

    public function addprofile(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'designation' => 'required',


        ]);
        $profile = new Profile();
        $profile->user_id = auth()->user()->id;
        $profile->name = $request->input('name');
        $profile->designation = $request->input('designation');

        if(input::hasFile('profile_pic')){
            $file = input::file('profile_pic');
            $file->move(public_path().'/uploads/',$file->
            getClientOriginalName());
            $url = URL::to("/") .'/uploads/'. $file->
                getClientOriginalName();

        }
        $profile->profile_pic = $url;


        $profile->save();
        return redirect()->to('/home')->with('response','Profile Added Successfully');


    }
}
