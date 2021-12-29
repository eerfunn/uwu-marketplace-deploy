<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;


class RegisterController extends Controller
{
    public function success(){
        return view('auth.success');
    }
    public function index(){
        $categories = Category::all();
        return view('auth.register', 
        ['categories'=> $categories]);
    }
    public function check(Request $request){
        return User::where('email', $request->email)->count() > 0 ? 'Not Available' : 'Available';    
    }
}
