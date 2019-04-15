<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    /**
     * 
     * Handles Registration Request
     * 
     * @param Request $_REQUEST
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> bcrypt($request->password),
        ]);
        $user->type = 'userr';
        $user->save();

        $token = $user->createToken('quiz_system')->accessToken;
        return response()->json(['token'=>$token],200,[]);
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password'=>$request->password
        ];
        if(auth()->attempt($credentials)){
            $token = auth()->user()->createToken('quiz_system')->accessToken;
            return response()->json(['token'=>$token],200,[]);
        }else{
            return response()->json(['message'=>'invalid login'],401,[]);
        }
    }


    public function administratorsRegister(Request $request){
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> bcrypt($request->password),
            'type'=>"adm",
        ]);

        $token = $user->createToken('quiz_system',['*'] )->accessToken;
        return response()->json(['token'=>$token],200,[]);
    }

    public function administratorsLogin(Request $request){
        $credentials = [
            'email' => $request->email,
            'password'=>$request->password
        ];
        if(auth()->attempt($credentials) ){
            if(auth()->user()->type == 'adm'){
                $token = auth()->user()->createToken('quiz_system',['*'])->accessToken;
                return response()->json(['token'=>$token],200,[]);
            }else{
                return response()->json(['message'=>'invslid user:unauthorised attempt'],401,[]);
            }

        }else{
            return response()->json(['message'=>'invalid login'],401,[]);
        }
    }

    
}
