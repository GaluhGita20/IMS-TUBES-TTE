<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class FilePDFController extends Controller
{
    //
    public function index()
    {
        return view('user.dashboard');
    }
}
