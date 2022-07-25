<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Models\Title;
use App\Models\Comment;
use App\Models\Profile;
use Illuminate\Http\Request;
use Hash;
use Validator;

class BlogController extends Controller
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
    public function register(Request $request)
    {
        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });
        $validator = Validator::make($request->all(), [
           'name' => 'required',
           'email' => 'required|email|unique:registers||without_spaces',
           'password' => 'required|min:6|max:12',
           'number' => 'required|integer',
           'state' => 'required',
           'city' => 'required',
           'address' => 'required',
           ]);
       if ($validator->fails()) {
               return response()->json([
                 'message' => 'Invalid params passed', // the ,message you want to show |alpha_dash
                   'errors' => $validator->errors()
               ], 422);
           }

        $res=new register;
        if ($res) {
            if (($res->name=$request->input('name'))&&
            ($res->email=$request->input('email'))&&
            ($res->password = Hash::make($request->input('password')))&&
            ($res->number=$request->input('number'))&&
            ($res->state=$request->input('state'))&&
            ($res->city=$request->input('city'))&&
            ($res->address=$request->input('address'))
            ) {
                echo "Registration Successfully";
            }
            else {
                echo "Registration Not Successfully";
            }
            // if ($res->password = Hash::make($request->input('password'))) {
            //     echo "Registration Successfully";
            // }
            $res->save();
        }
        else {
            echo "Registration Not Successfully";
        }

        
        // $request->validate([
        //     'email'=>'required|email|unique:registers',
        //     'password'=>'required|min:5|max:12',
        //     'number'=>'required',
        //     'state'=>'required',
        //     'city'=>'required',
        //     'address'=>'required',
        // ]);

        // $res=new register;
        // // $res->username=$request->input('username');
        // if ($res) {
        //     if (($res->name=$request->input('name'))&&
        //     ($res->email=$request->input('email'))&&
        //     ($res->password = Hash::make($request->input('password')))&&
        //     ($res->number=$request->input('number'))&&
        //     ($res->state=$request->input('state'))&&
        //     ($res->city=$request->input('city'))&&
        //     ($res->address=$request->input('address'))
        //     ) {
        //         echo "Registration Successfully";
        //     }
        //     else {
        //         echo "Registration Not Successfully";
        //     }
        //     // if ($res->password = Hash::make($request->input('password'))) {
        //     //     echo "Registration Successfully";
        //     // }
        //     $res->save();
        // }
        // else {
        //     echo "Registration Not Successfully";
        // }
        
    }

    public function login(Request $request)
    {


        $res = register::where('email', '=', $request->email)->first();
        if ($res){
            if (Hash::check($request->password, $res->password)){
                echo "Login Successfully";
            }else{
                echo "Fail ' Password not matches.";
            }
        }
        else{
            echo "Fail ' email not matches.";
        }
    }

    public function title(Request $request)
    {
        $res=new title;
        $res->title=$request->input('title');
        $res->category=$request->input('category');
        $res->content=$request->input('content');
        $res->save();
    }

    public function comment($blogid, Request $request)
    {
        $res=new comment;
        // $res->username=$request->input('username');
        if ($res) {
            if (($res->comment=$request->input('comment'))) {
                echo "Commented";
            }
            else {
                echo "You Can't Comment";
            }
            // if ($res->password = Hash::make($request->input('password'))) {
            //     echo "Registration Successfully";
            // }
            $res->save();
        }
        else {
            echo "You Can't Comment";
        }
        
    }

    public function profile(Request $request)
    {
        $res=new profile;
        // $res->username=$request->input('username');
        if ($res) {
            if (($res->firstname=$request->input('firstname')) &&
            ($res->lastname=$request->input('lastname')) &&
            ($res->email=$request->input('email')) &&
            ($res->phone=$request->input('phone')) &&
            ($res->image=$request->input('image'))
            ) {
                echo "Profile Updated";
            }
            else {
                echo "Sorry Profile Not Updated";
            }
            $res->save();
        }
        else {
            echo "Sorry Profile Not Updated";
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
