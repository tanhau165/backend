<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'submissions';
    protected $primaryKey = 'code_submission';
    public $timestamps = false;
    public $incrementing = false;


    protected $fillable = [
        'code_submission',
        'score',
        'exercise_code',
        'time_submit',
        'time_limit',
        'username',
        'source_code',
        'language_of_source'
    ];
}
