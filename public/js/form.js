//所有表单提交js
$.validator.setDefaults({
    highlight: function (e) {
        $(e).closest(".form-group").removeClass("has-success").addClass("has-error")
    }, success: function (e) {
        e.closest(".form-group").removeClass("has-error").addClass("has-success")
    }, errorElement: "span", errorPlacement: function (e, r) {
        e.appendTo(r.is(":radio") || r.is(":checkbox") ? r.parent().parent().parent() : r.parent())
    }, errorClass: "help-block m-b-none", validClass: "help-block m-b-none"
}), $().ready(function () {
    $("#commentForm").validate();
    var e = "<i class='fa fa-times-circle'></i> ";
    //配置任务
    $("#signupForm").validate({
        rules: {
            complete_type: "required",
            start_time: "required",
            endtime: "required",
            title: {required: !0, minlength: 2},
            reg_day_start: "required",

            password: {required: !0, minlength: 5},
            confirm_password: {required: !0, minlength: 5, equalTo: "#password"},
            email: {required: !0, email: !0},
            topic: {required: "#newsletter:checked", minlength: 2},
            agree: "required"
        },
        messages: {
            complete_type: e + "请选择应用",
            start_time: e + "请设置任务开始日期",
            endtime: e + "请设置任务结束日期",
            title: {required: e + "请输入标题", minlength: e + "标题必须两个字符以上"},
            reg_day_start: e + "请设置注册日期",

            password: {required: e + "请输入您的密码", minlength: e + "密码必须5个字符以上"},
            confirm_password: {required: e + "请再次输入密码", minlength: e + "密码必须5个字符以上", equalTo: e + "两次输入的密码不一致"},
            email: e + "请输入您的E-mail",
            agree: {required: e + "必须同意协议后才能注册", element: "#agree-error"}
        },
        submitHandler: function(form)
        {
            $.ajax({
                type: "post",
                url: "/post_task",
                data: $(form).serialize(),
                dataType: "json",
                success: function(data){
                    if(data.code == 1){
                        swal({title:"任务配置",text:data.msg,type:"success"});
                    }else{
                        swal({title:"任务配置",text:data.msg,type:"error"});
                    }
                },
                error:function(data){
                    swal({title:"任务配置",text:data,type:"error"});
                }
            });
        }
    }), $("#username").focus(function () {
        var e = $("#firstname").val(), r = $("#lastname").val();
        e && r && !this.value && (this.value = e + "." + r)
    })
});
