<?php

namespace App\Models\Boilerplate;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    //
    protected $fillable = ['status','institute_type','institute_name', 'city'];
    protected $table = 'institutes';

}
