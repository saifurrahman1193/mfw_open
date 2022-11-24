<?php
namespace App\Http\Controllers;
use Auth;
use DB;


class TestingController extends Controller
{

    public function testing()
    {
        return DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray();
    }



}
