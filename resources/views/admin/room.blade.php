<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/file_manager.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:44 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="shortcut icon" href="favicon.ico"> <link href="css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">

    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/style.min862f.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="file-manager">
                        <form class="form-horizontal m-t" >
                            <input id="_token" name="_token" class="form-control" type="hidden" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">房间编号：</label>
                                <div class="col-sm-8">
                                    <input id="room_number" name="room_number" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group draggable">
                                <label class="col-sm-3 control-label">房间状态：</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status">
                                        <option value="0" selected>未住满</option>
                                        <option value="1">已住满</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button class="btn btn-primary" onclick="searchRoom()" >查询</button>
                                </div>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9 animated fadeInRight">
            <div class="row">
                <div class="col-sm-12" id="show_content">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery.min.js?v=2.1.4"></script>
<script src="js/bootstrap.min.js?v=3.3.6"></script>
<script src="js/content.min.js?v=1.0.0"></script>
<script>
    $(document).ready(
        function(){
            searchRoom();
        }
    );
    function searchRoom()
    {
        $.ajax({
            type: "post",
            url: "rlist",
            data: {_token:$("#_token").val(),room_number:$("#room_number").val(), status:$("#status").val()},
            dataType: "json",
            success: function(data){
                $('#show_content').html("");   //清空resText里面的所有内容

                $.each(data.rows, function(commentIndex, comment){
                    if(comment.status == 1)
                    {
                        var msg = '未住满'
                        var styleClass = 'alert-success';
                    }else if(comment.status == 0)
                    {
                        var msg = '已住满'
                        var styleClass = 'alert-danger';
                    }else
                    {
                        var msg = '维修中'
                        var styleClass = 'alert-warning';
                    }
                    var html = "";
                    html    +=         '<div class="file-box">';
                    html    +=         '<div class="file">';
                    html    +=         '<a href="file_manager.html#">';
                    html    +=         '<span class="corner"></span>';
                    html    +=         '<div class="icon">';
                    html    +=         '<i class="img-responsive fa fa-film"></i>';
                    html    +=         '</div>';
                    html    +=         '<div class="file-name"><div class="alert '+styleClass+' alert-dismissable">';
                    html    +=         msg+'&nbsp;&nbsp;'+comment.number+'/'+comment.max+'</div>';
                    html    +=         '<small>房间编号：'+comment.room_num+'</small>&nbsp;&nbsp;<a href="rdetail/'+comment.id+'">查看详情</a>';
                    html    +=         '</div>';
                    html    +=         '</a>';
                    html    +=         '</div>';
                    html    +=         '</div>';

                    $('#show_content').append(html);
                });
            }
        })
    }
</script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
</body>

</html>
