<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GenderController extends Controller
{
    public function index()
    {
        
        return view("pegawais.index")->with('genders', $genders);


    }
}
