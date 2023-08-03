<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    function view()
    {
        $data['title'] = "Profile";
        $data['profile'] = DB::table('users')->where('id', request()->user()->id)->first();
        return view('backend.profile.view', $data);
    }
}
