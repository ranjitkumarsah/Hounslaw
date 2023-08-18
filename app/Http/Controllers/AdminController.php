<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\DocumentType;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index() {
        
        $countries = Country::all();

        return view('Admin.index',compact('countries'));
    }
}
