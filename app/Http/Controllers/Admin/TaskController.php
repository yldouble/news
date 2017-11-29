<?php

namespace App\Http\Controllers\Admin;

use App\Room;
use App\Task;
use App\TaskVersion;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\Exception;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        return view("admin.task.index",[
            "version"=>TaskVersion::getVersion(),
        ]);
    }



    public function TaskList(Request $request)
    {
        $paramData          = $request->all();
        $page               = isset($paramData['page']) ?(intval($paramData['page']) > 1 ? intval($paramData['page']) - 1:0):0;
        $number             = isset($paramData['number'])?intval($paramData['number']):10;
        $taskVId             = isset($paramData['version']) ? intval($paramData['version']) : 1;
        $type             = isset($paramData['type']) ? intval($paramData['type']) : 1;
        $condition =array(
            "state"=>0,"version_id"=>$taskVId,"type"=>$type
        );
        $count = Task::query()->where($condition)->groupBy("complete_type","reg_day_start","version_id","type")->count();
        $new_data2 = array();
        if($count > 0)
        {
            $_data = Task::query()->where($condition)->orderBy("tid")
                ->groupBy("complete_type","reg_day_start","version_id","type")->get()->toArray();
            $new_data = array();
            foreach($_data as $k=>$val){
                $new_data[$val["complete_type"]][$val["reg_day_start"]] = array("tid"=>$val["tid"],"title"=>$val["task_content"]);
            }
            foreach($new_data as $k=>$v){
                $temp = array("app"=>Task::app()[$k]);
                foreach($v as $key=>$vv){
                    $temp[$key] = $vv;
                }
                $new_data2[] = $temp;
            }
        }
        $data['page']       = isset($paramData['page'])?intval($paramData['page']):1;
        $data['total']      = ($count%$number) > 0 ?  intval($count/$number) + 1: intval($count/$number);
        $data['number']     = $number;
        $data['records']    = $count;
        $data['rows']       = $new_data2;
        echo json_encode($data);
        exit;
    }

    public function add(Request $request)
    {
        return view('task.create',[
            "version"=>TaskVersion::getVersion(),
            "app"=>Task::app(),
            "reg_time"=>Task::reg_time(),
            "reg_start_date"=>isset($request->all()["reg_start_date"]) ? $request->all()["reg_start_date"]:"",
        ]);
    }
    public function detail($tid){
        return view('task.edit',[
            "task"=>Task::getTaskById($tid),
            "version"=>TaskVersion::getVersion(),
            "app"=>Task::app(),
            "reg_time"=>Task::reg_time()
        ]);
    }

    public function post_task(Request $request){
        try{
            $paramData = $request->all();
            $error = $this->check_field($request);
            if($error){
                return $error;
            }
            $taskArr = array(
                "version_id"=>$paramData["version_id"],
                "reg_day_start"=>$paramData["reg_day_start"],
                "title"=>$paramData["title"],
                "type"=>$paramData["type"],
                "task_content"=>$paramData["task_content"],
                "direct_url"=>$paramData["direct_url"],
                "complete_type"=>$paramData["complete_type"],
                "complete_num"=>$paramData["complete_num"],
                "endtime"=>isset($paramData["endtime"]) ? $paramData["endtime"] : "",
                "start_time"=>isset($paramData["start_time"]) ? $paramData["start_time"] : ""
            );
            if(isset($paramData["task_id"])){
                $result = Task::query()->where(array("tid"=>$paramData["task_id"]))->update($taskArr);
            }else{
                $result = Task::query()->insert($taskArr);
            }
            if($result){
                return array("code"=>1,"msg"=>"添加成功");
            }else{
                return array("code"=>0,"msg"=>"添加失败");
            }
        }catch (Exception $e){
            return array("code"=>0,"msg"=>"错误");
        }
    }

    public function check_field($request){
        $validator = Validator::make($request->all(),[
            'version_id'=>'required|integer',
            'reg_day_start'=>'required|integer',
            'endtime'=>'required|Date',
            'start_time'=>'required|Date',
            'title'=>'required',
            'task_content'=>'required',
            'direct_url'=>'active_url',
        ]);
        if($validator->fails()){
            return array("code"=>0,"msg"=>trans($validator->messages()->first()));
        }
        return "";
    }

}
