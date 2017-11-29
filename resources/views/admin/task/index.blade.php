<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/file_manager.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:44 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>任务配置</title>
    <link rel="shortcut icon" href="favicon.ico">


    <link href="{{asset('css/font-awesome.min93e3.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.min14ed.css?v=3.3.6')}}" rel="stylesheet">
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.min862f.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/jqgrid/ui.jqgridffe4.css?0820')}}" rel="stylesheet">


</head>

<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>任务管理</h5>
                    <div class="ibox-tools">

                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="table_basic.html#">选项1</a>
                            </li>
                            <li><a href="table_basic.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-1 m-b-xs">
                            <select class="input-sm form-control input-s-sm inline" id="selectVersion" >
                                @foreach ($version as $k=>$v)
                                    <option value="{{$v["group_id"]}}">
                                        {{$v["group_name"]}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-1 m-b-xs">
                            <select class="input-sm form-control input-s-sm inline" id="selectType" >
                                    <option value="1" selected>日常任务</option>
                                    <option value="2">成长任务</option>
                            </select>
                        </div>
                        {{--<div class="col-sm-4 m-b-xs">--}}
                            {{--<div data-toggle="buttons" class="btn-group">--}}
                                {{--<label class="btn btn-sm btn-white">--}}
                                    {{--<input type="radio" id="option1" name="options">天</label>--}}
                                {{--<label class="btn btn-sm btn-white active">--}}
                                    {{--<input type="radio" id="option2" name="options">周</label>--}}
                                {{--<label class="btn btn-sm btn-white">--}}
                                    {{--<input type="radio" id="option3" name="options">月</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-3">--}}
                            {{--<div class="input-group">--}}
                                {{--<input type="text" placeholder="请输入关键词" class="input-sm form-control"> <span class="input-group-btn">--}}
                                        {{--<button type="button" class="btn btn-sm btn-primary"> 搜索</button> </span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <a type="button" href="/tadd" class="btn btn-w-m btn-primary">添加任务</a>
                    </div>
                    <div class="table-responsive">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                        <table id="table_list_2"></table>
                        <div id="pager_list_2"></div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@include('admin.footer');

<script type="text/javascript">
    function getJson(url,func){
        $.ajax({
            type:'get',
            url:url,
            dataType: 'json',
            success: function(data){
                func(data);
            },
            error: function(data){
                //alert(JSON.stringify(data));
            }
        });
    }

    $(document).ready(function(){
        $.jgrid.defaults.styleUI="Bootstrap";
        taskList();

    });
    //选择版本搜索
    $("#selectVersion,#selectType").change(function(){
        $("#table_list_2").jqGrid('setGridParam',{
            postData:{
                _token: $("#_token").val(),
                version:$("#selectVersion").val(),
                type:$("#selectType").val(),
            }
        }).trigger("reloadGrid");

    });
    function taskList()
    {
        $("#table_list_2").jqGrid({
            url : 'tlist',
            datatype : "json",
            height:450,
            autowidth:true,
            mtype: 'POST',
            postData: {
                _token: $("#_token").val(),
                version:$("#selectVersion").val()
            },
            shrinkToFit:true,
            rowNum:10,
            rowList:[10,20,30],
            colNames:["应用","30天内","90天内","180天内"],
            colModel:[
                {name:"app",index:"key",editable:true,width:60,sorttype:"int"},
                {name:"30",index:"title",editable:false,width:90,search:true,formatter:function(cellvalue){
                    if(cellvalue){
                        return '<a href="/tdetail/'+cellvalue.tid+'" >'+cellvalue.title+'</a>';
                    }else{
                        return '<a href="/tadd?reg_day_start=30" >去配置</a>';
                    }
                }},
                {name:"90",index:"title",editable:false,width:90,search:true,formatter:function(cellvalue){
                    if(cellvalue){
                        return '<a href="/tdetail/'+cellvalue.tid+'" >'+cellvalue.title+'</a>';
                    }else{
                        return '<a href="/tadd?reg_day_start=90" >去配置</a>';
                    }
                }},
                {name:"180",index:"title",editable:false,width:90,search:true,formatter:function(cellvalue){
                    if(cellvalue){
                        return '<a href="/tdetail/'+cellvalue.tid+'" >'+cellvalue.title+'</a>';
                    }else{
                        return '<a href="/tadd?reg_day_start=180" >去配置</a>';
                    }
                }},

            ],
            pager:"#pager_list_2",
            viewrecords:true,
            caption:"任务管理",
            hidegrid:false
        });
        $("#table_list_2").setSelection(4,true);
        $("#table_list_2").jqGrid(
                "navGrid","#pager_list_2",
                {edit : false,add : false,search:false},
                {height:200,reloadAfterSubmit:true}
        );
        $(window).bind(
                "resize",
                function(){
                    var width=$(".jqGrid_wrapper").width();
                    $("#table_list_2").setGridWidth(width)
                }
        )
    }
</script>
</body>

</html>
