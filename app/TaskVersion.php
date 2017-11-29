<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskVersion extends Model
{
    protected $connection  = 'sqlsrv_public';
    protected $table = 'group';

    /**
     * 获取第一条版本
     */
    public static function getFirstVersion(){
        return TaskVersion::query()->where(array("state"=>0))->orderBy("id")->first()->toArray();
    }

    public static function getVersion(){
        return TaskVersion::query()->where("group_status",1)->orderBy("group_id")->get()->toArray();
    }
}
