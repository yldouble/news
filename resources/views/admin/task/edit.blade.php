<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/form_validate.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:15 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>H+ 后台主题UI框架 - 表单验证 jQuery Validation</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico">
    <link href="{{asset('css/bootstrap.min14ed.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min93e3.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.min862f.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>配置任务</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                            <a class="btn-sm" href="/task">返回</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="signupForm" action="/post_task" method="post" onsubmit="return false" >
                            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="task_id" value="{{$task['tid']}}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">版本：</label>
                                <div class="col-sm-8">
                                    <select class="input-sm form-control input-s-sm inline" name="version_id">
                                        @foreach ($version as $k=>$v)
                                        <option value="{{$v['group_id']}}" @if($v['group_id'] == $task['version_id']) selected @endif >
                                            {{$v["group_name"]}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请选择版本</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">应用：</label>
                                <div class="col-sm-8">
                                    <select class="input-sm form-control input-s-sm inline" name="complete_type">
                                        <option value="0">请选择应用</option>
                                        @foreach ($app as $k=>$v)
                                            <option value="{{$k}}" @if($k == $task['complete_type']) selected @endif >
                                                {{$v}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请选择应用</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">任务类型：</label>
                                <div class="col-sm-8">
                                    <div class="col-sm-4 m-b-xs">
                                        <div data-toggle="buttons" class="btn-group">
                                            <label class="btn btn-sm btn-white @if(1 == $task['type']) active @endif">
                                                <input type="radio" id="option1" name="type" value="1" @if(1 == $task['type']) checked @endif >日常</label>
                                            <label class="btn btn-sm btn-white @if(2 == $task['type']) active @endif">
                                                <input type="radio" id="option2" name="type" value="2" @if(2 == $task['type']) checked @endif>成长</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">有效日期：</label>
                                <div class="col-sm-8">
                                    <input placeholder="开始日期" name="start_time" value="{{$task['start_time']}}" class="form-control layer-date laydate-icon" id="start">
                                    <input placeholder="结束日期" name="endtime" value="{{$task['endtime']}}" class="form-control layer-date laydate-icon" id="end">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">用户注册日期
                                </label>
                                <div class="col-sm-8">
                                    <div class="radio i-checks">
                                        @foreach ($reg_time as $k=>$v)
                                            <label class="">
                                                <div class="iradio_square-green" style="position: relative;">
                                                    <input type="radio" value="{{$v['value']}}" name="reg_day_start" @if($v['value'] == $task['reg_day_start'])checked @endif style="position: absolute; opacity: 0;">
                                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                </div>
                                                <i></i> {{$v['value']}}天
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">标题：</label>
                                <div class="col-sm-8">
                                    <input id="firstname" value="{{$task['title']}}" name="title" class="form-control" type="text">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 这里写点提示的内容</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">内容：</label>
                                <div class="col-sm-8">
                                    <textarea id="ccomment" name="task_content" class="form-control" required="" aria-required="true">{{$task['task_content']}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">链接地址：</label>
                                <div class="col-sm-8">
                                    <input id="direct_url" value="{{$task['direct_url']}}" name="direct_url" class="form-control" type="text" aria-required="true" aria-invalid="false" class="valid">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">数量：</label>
                                <div class="col-sm-8">
                                    <input id="complete_num" value="{{$task['complete_num']}}" name="complete_num" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    {{--<a class="btn btn-primary" type="submit" v-on:click="submit">提交</a>--}}
                                    <button class="btn btn-primary" type="submit">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('js/jquery.min.js?v=2.1.4')}}"></script>
    <script src="{{asset('js/bootstrap.min.js?v=3.3.6')}}"></script>
    <script src="{{asset('js/content.min.js?v=1.0.0')}}"></script>
    <script src="{{asset('js/plugins/iCheck/icheck.js')}}"></script>

    <script src="{{asset('js/plugins/validate/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/plugins/validate/messages_zh.min.js')}}"></script>
    <script src="{{asset('js/form.js')}}"></script>
    {{--<script src="{{asset('js/vue.js')}}"></script>--}}
    <script src="{{asset('js/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('js/plugins/layer/laydate/laydate.js')}}"></script>
    <script type="text/javascript">

        $(".i-checks").iCheck({radioClass: "iradio_square-green",});
        laydate({elem:"#start",event:"focus"});
        laydate({elem:"#end",event:"focus"});

    </script>
</body>

</html>
