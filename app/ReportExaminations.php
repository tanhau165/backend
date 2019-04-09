<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportExaminations extends Model
{
    protected $table = 'report_examinations';
    protected $primaryKey = 'code';
    public $timestamps = false;
    public $incrementing = false;


    protected $fillable = [
        'code',
        'score',
        'code_collection',
        'list_examination',
        'time_submit',
        'username',
        'times_submit'
    ];
}
