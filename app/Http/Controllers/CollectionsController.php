<?php

namespace App\Http\Controllers;

use App\Collections;
use Illuminate\Http\Request;

class CollectionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api',
            ['except' => [
                'GetByTeam',
                'GetAll',
                'GetOne'
            ]]
        );
    }

    public function GetAll()
    {
        try {
            $collection = Collections::all();
            return response()->json(['message' => 'Get all collection successfully', 'collections' => $collection], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Get all collection incorrect', 'data' => $e], 500);
        }
    }

    public function GetByTeam(Request $request)
    {
        $code_team = $request->code_team;

        try {
            $collection = Collections::where('code_team', $code_team)->get();
            return response()->json([
                'message' => 'Get collection by team successfully',
                'collections' => $collection
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Get collection by team incorrect',
                'data' => $e
            ], 500);
        }
    }

    public function GetOne(Request $request)
    {
        $code_collection = $request->code_collection;

        try {
            $collection = Collections::where('code_collection', $code_collection)
                ->first();

            return response()->json([
                'message' => 'Get collection with code ' . $code_collection . 'successfully',
                'collection' => $collection
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Collection not found',
                'data' => $e
            ], 404);
        }
    }

    public function Add(Request $request)
    {
        $account = auth()->user();
        if ($account->role == 1) {
            return response()->json([
                'error' => 'You aren\'t a teacher'
            ], 400);
        }

        try {
            Collections::create($request->all());
            return response()->json([
                'message' => 'Add new collection successfully',
                'data' => $request->all()
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Can\'t not create new collection. If duplicate code of collection. You must change now.',
                'data' => $request->all()
            ], 500);
        }

    }

    public function Update(Request $request)
    {
        $account = auth()->user();
        if ($account->role == 1) {
            return response()->json([
                'error' => 'You aren\'t a teacher'
            ], 400);
        }

        try {
            Collections::find($request->code_collection)->update($request->all());
            return response()->json([
                'message' => 'Update collection successfully',
                'data' => $request->all()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Update collection incorrect',
                'data' => $e
            ], 500);
        }
    }

    public function Hide(Request $request)
    {
        $account = auth()->user();
        if ($account->role == 1) {
            return response()->json([
                'error' => 'You aren\'t a teacher'
            ], 400);
        }
        $code_collection = $request->code_collection;

        try {
            Collections::where('code_collection', $code_collection)
                ->update([
                    'status' => 0
                ]);
            $collection = Collections::where('code_collection', $code_collection)
                ->first();
            return response()->json([
                'message' => 'Hide ' . $code_collection . 'successfully',
                'data' => $collection
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Hide collection ' . $code_collection . 'error.',
                'data' => $e
            ], 500);
        }
    }

    public function Show(Request $request)
    {
        $account = auth()->user();
        if ($account->role == 1) {
            return response()->json([
                'error' => 'You aren\'t a teacher'
            ], 400);
        }
        $code_collection = $request->code_collection;

        try {
            Collections::where('code_collection', $code_collection)
                ->update([
                    'status' => 1
                ]);
            $collection = Collections::where('code_collection', $code_collection)
                ->first();
            return response()->json([
                'message' => 'Show collection successfully',
                'data' => $collection
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Show collection is error',
                'data' => $e
            ], 500);
        }
    }


}
