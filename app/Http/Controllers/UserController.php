<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function test(int $id)
    {
        $user = Cache::get('user' . $id);


    }
}
