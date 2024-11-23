<?php

namespace App\Http\Controllers;


class TestController extends Controller
{
    public function zaid(){
        return view('index');
    }
    public function printName($name = 'User'){
        dd("Hello $name from printName method");
    }
}
