<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TaskinatorApiResult;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class ApiAuthController extends Controller
{

    public $successStatus = 200;
    public $errorMessage  = [ 'Unable to log you in.' ];
    public $appName = 'Taskinator';

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(new TaskinatorApiResult('', $this->errorMessage), 401);
        }

        $input = $request->all();

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $token = $user->createToken($this->appName)->accessToken;
        return response()->json(new TaskinatorApiResult($token, false), $this->successStatus);
    }

    public function login(){
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user  = Auth::user();
            $token = $user->createToken($this->appName)->accessToken;

            return response()->json(new TaskinatorApiResult($token, false), $this->successStatus);
        } else{
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage), 401);
        }
    }

    public function getUser() {
        $user = Auth::user();
        return response()->json(['data' => $user, 'errors' => false], $this->successStatus);
    }
}
