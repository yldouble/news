<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $table = 'task_info';

    public static function app(){
        return array(
            "sem"=>"云搜索",
            "news"=>"云新闻",
            "qiwen"=>"特价企闻",
            "firm"=>"推视频",
            "b2b"=>"云广告",
            "wiki"=>"百科",
            "ask"=>"企业问答",
        );
    }
    public static function reg_time(){
        return array(
            array("value"=>"30"),
            array("value"=>"90"),
            array("value"=>"180"),
        );
    }

    public function rules(){

    }

    public static function getTaskById($tid){
        return Task::query()->where('tid',$tid)->first();
    }
}
