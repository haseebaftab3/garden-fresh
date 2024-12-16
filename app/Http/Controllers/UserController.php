<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function demo(Request $request)
    {
        $val1 = 2;
        $val2 = 3;
        return $val1 + $val2;
    }
}
