<?php

namespace App\Http\Controllers;

use App\Teams;
use Illuminate\Http\Request;

class TeamsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api',
            ['except' => [
                'All',
                'GetOne'
            ]]
        );
    }

    public function All()
    {
        $listTeam = Teams::all();
        return response()->json(['teams' => $listTeam], 200);
    }

    public function Get()
    {
        $account = auth()->user();
        if ($account->role == 1) {
            return response()->json([
                'error' => 'You aren\'t a teacher'
            ], 400);
        }
        $listTeam = Teams::where('teacher', $account->username)->get();
        return response()->json([
            'teams' => $listTeam,
            'username' => $account->username
        ], 200);
    }

    public function GetOne(Request $request)
    {
       
        $listTeam = Teams::where(['code_team' => $request->code_team])
            ->first(); 
        return response()->json([
            'team' => $listTeam
        ], 200);
    }

    public function Add(Request $request)
    {
        $account = auth()->user();
        if ($account->role == 1) {
            return response()->json([
                'error' => 'You aren\'t a teacher or administrator'
            ], 400);
        }
		$request->merge([
                'teacher' => $account->username
            ]);
        Teams::create($request->all());
        return response()->json([
            'message' => 'Add new team successfully',
            'data' => $request->all()
        ]);
    }
	
	public function Update(Request $request)
    {
        $account = auth()->user();
        if ($account->role == 1) {
            return response()->json(['error' => 'You aren\'t a teacher'], 400);
        }
        try {
            Teams::find($request->code_team)->update($request->all());
            return response()->json([
                'message' => 'Update team '.$request->name.' successfully' ,
                'team' => $request->all()
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e,
                'team' => $request->all()
                ], 500);

        }
    }
}
