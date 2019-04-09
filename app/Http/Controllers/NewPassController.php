<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewPassController extends Controller
{
    private function changePassword($request)
    {

        $credentials = request(['username', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Email or password does\'t exist'], 401);
        }

        $user = User::where('email',$request->email)->first();
        $user->update(['password'=>$request->password]);
        $this->getPasswordResetTableRow($request)->delete();
        return response()->json(['message'=>'Password Successfully Changed'],Response::HTTP_CREATED);
    }
}
