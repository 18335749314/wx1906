<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Xinwen extends Model
{ 
    protected $fillable = ['x_bt','x_nr','x_zz','x_time','x_fwl'];

    public $primaryKey = 'x_id';
    public $timestamps = false;
    public $table = 'xinwen';

}
