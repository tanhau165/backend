<?php

namespace App\Http\Controllers;

use App\Examinations;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api',
            ['except' => [
                'GetByCollection',
                'GetOne'
            ]]
        );
    }

    public function GetAll()
    {
        $listExam = Examinations::all();
        return response()->json(['examinations' => $listExam], 200);
    }


    public function GetOne(Request $request)
    {
        $code_examination = $request->code_examination;
        $exam = Examinations::where('code_examination', $code_examination)->first();
        return response()->json([
            'examination' => $exam
        ], 200);
    }


    public function GetByCollection(Request $request)
    {
        $code_collection = $request->code_collection;
        $listExam = Examinations::where('code_collection', $code_collection)->get();
        return response()->json([
            'examinations' => $listExam
        ], 200);
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
            Examinations::create($request->all());

            return response()->json([
                'message' => 'Create new examination successfully',
                'data' => $request->all()
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Examination code already',
                'data' => $request->all()
            ], 400);

        }
    }

    public function Update(Request $request)
    {
        $account = auth()->user();
        if ($account->role == 1) {
            return response()->json(['error' => 'You aren\'t a teacher'], 400);
        }
        try {
            Examinations::find($request->code_examination)->update($request->all());
            return response()->json([
                'message' => 'Update examination ' . $request->code_examination . ' successfully',
                'examination' => $request->all()
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e,
                'examination' => $request->all()
            ], 500);

        }
    }

    public function Hide(Request $request)
    {
        $code_examination = $request->code_examination;
        $account = auth()->user();
        if ($account->role == 1) {
            return response()->json([
                'error' => 'You aren\'t a teacher'
            ], 400);
        }
        try {
            Examinations::where('code_examination', $code_examination)
                ->update([
                    'status' => 0
                ]);
            $examination = Examinations::where('code_examination', $code_examination)
                ->first();

            return response()->json([
                'message' => 'Hide examination ' . $code_examination . ' successfully.',
                'examination' => $examination
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Hide examination ' . $code_examination . 'incorrect',
                'examination' => $request->all()
            ], 500);

        }

    }


    public function Show(Request $request)
    {
        $code_examination = $request->code_examination;
        $account = auth()->user();
        if ($account->role == 1) {
            return response()->json([
                'error' => 'You aren\'t a teacher.'
            ], 400);
        }
        try {
            Examinations::where('code_examination', $code_examination)
                ->update([
                    'status' => 1
                ]);
            $examination = Examinations::where('code_examination', $code_examination)->first();
            return response()->json([
                'message' => 'Show examination ' . $code_examination . 'successfully.',
                'examination' => $examination
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Show examination ' . $code_examination . 'incorrect.',
                'examination' => $request->all()
            ], 500);

        }
    }
}
