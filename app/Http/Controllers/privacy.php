<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class privacy extends Controller
{
    public function privacy() {
        return view ('about.privacy');
        
    }
}
