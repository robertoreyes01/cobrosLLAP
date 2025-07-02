<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PaymentController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:usuario');
    // }

    public function show()
    {
        return view('payments.principal');
    }   
}
