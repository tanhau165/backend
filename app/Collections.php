<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collections extends Model
{

    protected $fillable = [
        'code_collection', 'name', 'code_team', 'status'
    ];

    protected $table = 'collections';
    protected $primaryKey = 'code_collection';
    public $timestamps = false;
    public $incrementing = false;

    public function team()
    {
        return $this->belongsTo('App\\Teams', 'code_team');
    }

}
