<?php

namespace App\Models\Boilerplate;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['institute_id','camp','activity','sr_no','regiment_no', 'name','rank', 'contact_no'];
    protected $table = 'candidates';

    public function institute()
    {
        return $this->belongsTo('App\Models\Boilerplate\Institute', 'institute_id', 'id');
    }
}

