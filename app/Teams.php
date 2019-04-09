<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $table = 'teams';
    protected $primaryKey = 'code_team';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'code_team', 'name', 'information', 'teacher', 'location'
    ];

    public function teacher()
    {
        return $this->belongsTo('App\\User', 'teacher');
    }
}
