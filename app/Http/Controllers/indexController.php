<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function agreement()
    {
        return view('home/agreement');
    }
    public function policy()
    {
        return view('home/policy');
    }
    public function tokutei()
    {
        return view('home/tokutei');
    }
}
