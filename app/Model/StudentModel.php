<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    public $primaryKey = 's_id';
    public $timestamps = false;
    public $table = 'student';
}
