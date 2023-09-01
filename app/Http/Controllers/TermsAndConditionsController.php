<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsAndConditionsController extends Controller
{
    public function index()
    {
        // Add your logic to display the terms and conditions page here
        return view('terms-and-conditions.index'); // Replace 'terms-and-conditions' with your actual blade view name
    }
}
