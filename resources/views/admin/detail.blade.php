<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/form_validate.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:15 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="favicon.ico"> <link href="../css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="../css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="../css/animate.min.css" rel="stylesheet">
    <link href="../css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="../css/plugins/datapicker/datepicker3.css" rel="stylesheet">
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
            @foreach ($RoomData as $value)
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>房间编号：{{$value['room_num']}}</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" >
                            <input id="RoomId_{{$value['id']}}" type="hidden" name="RoomId_{{$value['id']}}" value="{{$value['id']}}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">当前入住人名称：</label>
                                <div class="col-sm-8">
                                    <input id="ResidentPerson_{{$value['id']}}" name="ResidentPerson_{{$value['id']}}" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">当前入住人数：</label>
                                <div class="col-sm-8">
                                    <input id="ResidentNumber_{{$value['id']}}" name="ResidentNumber_{{$value['id']}}" class="form-control" type="number" max="4" min="1" aria-required="true" aria-invalid="false" class="valid">
                                </div>
                            </div>
                            <div class="form-group" id="data_5">
                                <label class="col-sm-3 control-label">入住时间</label>
                                <div class="col-sm-8">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="input-sm form-control" readonly name="start_{{$value['id']}}" id="StartResidentTime_{{$value['id']}}" value="" data-date-format="yyyy-mm-dd" />
                                    <span class="input-group-addon">到</span>
                                    <input type="text" class="input-sm form-control" readonly name="end_{{$value['id']}}" id="EndResidentTime_{{$value['id']}}" value=""  data-date-format="yyyy-mm-dd" />
                                </div>
                                </div>
                            </div>
                            {{--<div class="form-group">
                                <label class="col-sm-3 control-label">选择消费列表：</label>
                                <div class="col-sm-8">
                                    <div class="checkbox i-checks">
                                        <label> <input type="checkbox" value=""> <i></i> 选项1</label>
                                    </div>
                                    <div class="checkbox i-checks">
                                        <label> <input type="checkbox" value="" > <i></i> 选项2（选中）</label>
                                    </div>
                                    <div class="checkbox i-checks">
                                        <label> <input type="checkbox" value="" > <i></i> 选项3（选中并禁用）</label>
                                    </div>
                                    <div class="checkbox i-checks">
                                        <label> <input type="checkbox" value="" > <i></i> 选项4（禁用）</label>
                                    </div>
                                </div>
                            </div>--}}
                            <div class="form-group">
                                <label class="col-sm-3 control-label">消费金额：</label>
                                <div class="col-sm-8">
                                    <input id="ConsumptionAmount_{{$value['id']}}" name="ConsumptionAmount_{{$value['id']}}" class="form-control" type="number">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-3">
                                    <input class="btn btn-primary" type="button" onclick="post_order({{$value['id']}})" value="提交">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script src="../js/jquery.min.js?v=2.1.4"></script>
<script src="../js/bootstrap.min.js?v=3.3.6"></script>
<script src="../js/content.min.js?v=1.0.0"></script>
<script src="../js/plugins/validate/jquery.validate.min.js"></script>
<script src="../js/plugins/validate/messages_zh.min.js"></script>
<script src="../js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#data_5 .input-daterange").datepicker(
                {
                    keyboardNavigation: !1,
                    forceParse: !1,
                    autoclose: !0
                }
        );
    });
    function post_order(id)
    {
        $.ajax({
            type: "post",
            url: "../post_order",
            data: {
                _token:$("#_token").val(),RoomId:$("#RoomId_"+id).val(),
                ResidentPerson:$("#ResidentPerson_"+id).val(), ResidentNumber:$("#ResidentNumber_"+id).val(),
                StartResidentTime:$("#StartResidentTime_"+id).val(),EndResidentTime:$("#EndResidentTime_"+id).val(),
                ConsumptionAmount:$("#ConsumptionAmount_"+id).val(),
            },
            dataType: "json",
            success: function(data){

            }
        });
    }
</script>
</body>
</html>
