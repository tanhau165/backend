<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examinations extends Model
{

    protected $table = 'examinations';
    protected $primaryKey = 'code_examination';
    public $timestamps = false;
    public $incrementing = false;


    protected $fillable = [
        'code_examination',
        'question',
        'code_collection',
        'answer_a',
        'answer_b',
        'answer_c',
        'answer_d',
        'answer_correct',
        'type_of_language',
        'explain_question',
        'status'
    ];

}
