<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $table = 'exercises';
    protected $primaryKey = 'exercise_code';
    public $timestamps = false;
    public $incrementing = false;




    protected $fillable = [
        'exercise_code',
        'question',
        'name',
        'time_limit',
        'memory_limit',
        'best_score',
        'input1',
        'input2',
        'input3',
        'input4',
        'input5',
        'input6',
        'input7',
        'input8',
        'input9',
        'input10',
        'output1',
        'output2',
        'output3',
        'output4',
        'output5',
        'output6',
        'output7',
        'output8',
        'output9',
        'output10',
        'code_team',
        'username'
    ];
}
