<?php

namespace App\Http\Controllers;

use App\ReportError;
use Illuminate\Http\Request;

class ReportErrorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api',
            ['except' => [
                'GetAll',
                'GetOne',
                'GetByUsername'
            ]]
        );
    }

    public function GetAll()
    {
        $erros = ReportError::all();
        return response()->json([
            'rp_errors' => $erros
        ], 200);
    }

    public function GetOne(Request $request)
    {
        $error = ReportError::where('code_error', $request->code_error)->first();
        return response()->json([
            'rp_error' => $error
        ], 200);
    }

    public function GetByUsername(Request $request)
    {
        $errors = ReportError::where('username', $request->username)->get();
        return response()->json([
            'rp_errors' => $errors
        ], 200);
    }

    public function GetOfMe()
    {
        $account = auth()->user();
        $errors = ReportError::where('username', $account->username)->get();
        return response()->json([
            'rp_errors' => $errors
        ], 200);
    }

    public function Add(Request $request)
    {
        $c = round(microtime(true) * 1000);
        $code = $c . rand_string(20);
        $account = auth()->user();
        $request->merge([
            'code_error' => $code,
            'username' => $account->username
        ]);
        ReportError::create($request->all());
        return response()->json([
            'message' => 'Report successfully'
        ], 200);
    }
}

function rand_string($length)
{
    $str = "";
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen($chars);
    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[rand(0, $size - 1)];
    }
    $str = substr(str_shuffle($chars), 0, $length);
    return $str;
}
