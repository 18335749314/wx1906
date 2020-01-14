<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WechatUser extends Model
{
    public $primaryKey = 'u_id';
    protected $guarded = [];//黑名单
    public $timestamps = false;
    public $table = 'wechat_user';
}
