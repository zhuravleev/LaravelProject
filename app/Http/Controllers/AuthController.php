<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    public function index(){
        return view('auth.registration');
    }

    public function indexlogin(){
        return view('auth.login');
    }

    public function customRegistration(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:App\Models\User,email',
            'password'=>'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        // return response($response, 201);
        return view('main'); 
    }

    public function login(Request $request){
        
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        $credantials = $request->only('email', 'password');
        if (Auth::attempt($credantials)){
            $user = User::where('email', $request->input('email'))->first();
            $token = $user->createToken('myapptoken')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];
            
            // return response($response, 201); 
            return redirect('/');           
        }

        return response([
            'message' => 'В доступе отказано'
        ], 401);
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
