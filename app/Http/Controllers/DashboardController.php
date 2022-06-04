<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user.home');
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function training()
    {
        return view('user.list-training');
    }

    public function certificate()
    {
        return view('user.list-certificate');
    }

    public function test()
    {
        // user bussiness
        // $request= Http::get('https://api.eversign.com/api/business?access_key=b703c86aaa5c672435ed9e5a7734ed79');

        $request= Http::get('https://api.eversign.com/api/document?access_key=b703c86aaa5c672435ed9e5a7734ed79&business_id=559770&type=all');


        $dd = $request->json();

        return $dd;

    }

    // public function test()
    // {

    //     $request= Http::withHeaders([
    //     'Content-Type' => 'application/json',
    //     'Authorization' => 'Basic ODZiZjEwZTc3ZDk1NmJmMGRjZDkwMTJhNjQxZmIzMTc6YjFjZmFmNjg0YjU4MWVhZTQ3N2U4NWVhYzhiMDA5NjQ=',
    //     'Content-type' => 'application/json'
    //     ])->post('https://api.signnow.com/oauth2/token', [
    //         'username' => 'kelompok4ims@gmail.com',
    //         'password' => 'darmawan14045',
    //         'grant_type' => 'password',
    //         "scope" => "*"
    //     ]);

    //     $dd = $request->json();

    //     $request_2= Http::withHeaders([
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . $dd['access_token'],
    //         'Content-type' => 'application/json'
    //         ])->get('https://api.signnow.com/user/documents');
    
    //     $dd2 = $request_2->json();

    //     return $dd2;

    // }
}
