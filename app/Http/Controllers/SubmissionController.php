<?php

namespace App\Http\Controllers;

use App\Exercise;
use App\Submission;
use App\User;
use Illuminate\Http\Request;

class SubmissionController extends Controller
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
        $submissions = Submission::all();
        return response()->json([
            'submissions' => $submissions
        ], 200);
    }


    public function GetOne(Request $request)
    {
        $submission = Submission::where('code_submission', $request->code_submission)->first();
        if ($submission == null) {
            return response()->json([
                'error' => 'Submission with code ' . $request->code_submission . ' not found'
            ], 404);
        }
        return response()->json([
            'submission' => $submission
        ], 200);
    }

    public function GetByUsername(Request $request)
    {
        $username = $request->username;
        $submissions = Submission::where('username', $username)->get();
        return response()->json([
            'submissions' => $submissions
        ], 200);
    }


    public function GetOfMe()
    {
        $account = auth()->user();
        $username = $account->username;
        $submissions = Submission::where('username', $username)->get();
        return response()->json([
            'submissions' => $submissions
        ], 200);
    }


    public function Add(Request $request)
    {
        $account = auth()->user();
        $c = round(microtime(true) * 1000);
        $code = $c . rand_string(20);
        if ($account->role == 1) {
            return response()->json([
                'error' => 'You aren\'t a teacher or administrator'
            ], 400);
        }

        $request->merge([
            'username' => $account->username,
            'code_submission' => $code
        ]);

        // lay diem cao nhat
        $sub = Submission::where('username', $account->username)
            ->where('exercise_code', $request->exercise_code)
            ->orderby('score', 'desc')
            ->first();

        // lay diem cao nhat cua exercise
        $exersiceBest = Submission::where('exercise_code', $request->exercise_code)
            ->orderby('score', 'desc')
            ->first();

        if($exersiceBest == null){ // chua ai làm bài này lần nào
            Exercise::where('exercise_code', $request->exercise_code)
                ->update([
                    'best_score' => ($request->score)
                ]);
        }else{
            if($exersiceBest->score < $request->score){
                Exercise::where('exercise_code', $request->exercise_code)
                    ->update([
                        'best_score' => ($request->score)
                    ]);
            }

        }

        if ($sub != null) { // da lam roi bai nay
            $bestScore = $sub->score;
            Submission::create($request->all());
            if ($bestScore < $request->score) {
                User::where('username', $account->username)
                    ->update([
                        'score' => ($account->score - $bestScore + $request->score)
                    ]);
                return response()->json([
                    'message' => 'You are submission successfully with score ' . $request->score . ' Score for you: ' . $request->score . 'Updated your score: ' . ($account->score - $bestScore + $request->score),
                    'report_examination' => $request->all()
                ], 200);
            } else {
                return response()->json([
                    'message' => 'You are submission successfully with score ' . $request->score . 'No update your score because score of submission not equals score of before submission',
                    'submission' => $request->all()
                ], 201);
            }
        } else {
            Submission::create($request->all());
            User::where('username', $account->username)
                ->update([
                    'score' => ($account->score + $request->score)
                ]);
            return response()->json([
                'message' => 'You are submission successfully with score ' . $request->score . ' Score for you: ' . $request->score . 'Updated your score: ' . ($account->score + $request->score),
                'report_examination' => $request->all()
            ], 200);
        }
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

