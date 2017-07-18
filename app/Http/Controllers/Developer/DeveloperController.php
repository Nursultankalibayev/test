<?php

namespace App\Http\Controllers\Developer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeveloperController extends Controller
{
    public function index()
    {
        return view('developer.index');
    }


}
