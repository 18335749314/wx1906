<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public $primaryKey = 'c_id';
    protected $fillable = ['channel_name', 'channel_status','ticket'];
    public $timestamps = false;
    public $table = 'Channel';
}
