p$(document).ready(function(){
    $("#btn_login").removeAttr("disabled");
    //User namespace
    var users = {};
    users.ajax = {
        get_user: function (status, cb) {
            var url = '/users/get_message',
                params = {
                    items: status
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },
        get_user: function (status, cb) {
            var url = '/users/get_message',
                params = {
                    items: status
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },save_edit_user: function (items, cb) {
            var url = '/user/do_auth',
                params = {
                    items: items,
                }
            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        }

    };



    users.save_edit_user = function(items){
        console.log(items);
        users.ajax.save_edit_user(items, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                alert('แก้ไขข้อมูล เรียบร้อยแล้ว กรุณาเข้าสู่ระบบ อีคกรั้ง');
            }
        });
    }



    $('#btn_login').on('click',function(e){
        e.preventDefault();
        console.log('click');
        var username = $('#username').val();
        var password = $('#password').val();

        users.ajax.do_auth(username,password).then(function(err, data){
           if(err){
               $.alertable.alert(err);
           }else{
               if(data.success){
                   window.location.replace(base_url);
               }else{
                   $.alertable.alert('Username  Password ไม่ถูกต้อง');
               }
           }
        });

    });
    $('#txt_password').bind('keypress', function(e) {
        if(e.keyCode==13){
            users.check_login();
        }
    });
    $('#username').bind('change', function() {
        var username=$(this).val(),id=$('#id').val();
        users.ajax.get_duplicate_user(id,username, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                var tt =data.total;
                if(tt >0){
                    app.alert('ท่านไม่สามารถใช้ Username นี้ได้');
                    $('#btn_save_edit_user').prop('disabled', true);
                    $('#btn_save_register').prop('disabled', true);
                    $('#check_user').empty().removeClass('text-success').addClass('text-danger').html('ท่านไม่สามารถใช้ Username นี้ได้');
                }else{
                    $('#btn_save_edit_user').prop('disabled',false);
                    $('#btn_save_register').prop('disabled',false);
                    $('#check_user').empty().removeClass('text-danger').addClass('text-success').html('สามารถใช้ Username นี้ได้');
                }

            }
        });
    });

    //ตรวจสอบ Email ซ้ำ
    $('#email').bind('change', function() {
        var email=$(this).val(),id=$('#id').val();
        users.ajax.get_duplicate_email(id,email, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                var tt =data.total;
                if(tt >0){
                    app.alert('มีผู้ใช้ Email นี้แล้วในระบบ');
                    $('#btn_save_edit_user','#btn_save_register').prop('disabled', true);
                    $('#check_email').empty().removeClass('text-success').addClass('text-danger').html('ท่านไม่สามารถใช้ Email นี้ได้');
                }else{
                    $('#btn_save_edit_user','#btn_save_register').prop('disabled',false);
                    $('#check_email').empty().removeClass('text-danger').addClass('text-success');
                }

            }
        });
    });

$('#btn_forget_pass').on('click',function(){
    $('#frm_login').hide();
    $('#frm_forgot_pass').show();

});

    $('#send_mail_forget_pass').on('click',function(e){
        e.preventDefault();
        var email=$('#txt_repass_email').val();
        if(!email){
            app.alert('กรุณากรอกรหัสผ่าน');
            email.focus();
        }else{


        users.ajax.send_mail_forget_pass(email, function (err, data) {
            //console.log(data);
            if (err) {
                    app.alert(err);
            }
            else {

                if(data.success){
                    app.alert('ส่งข้อมูลไป ที่'+ email +' แล้ว กรุณาตรวจสอบ ');
                }else{
                    app.alert('Email นี้ไม่มีอยู่ในระบบ');
                }
            }
        });
    }
});
$('#btn_back').on('click',function(){
    $('#frm_login').show();
    $('#frm_forgot_pass').hide();
});
    $('#frm_login').on('submit', function(e) {
        return users.check_login();
    });

    $('#btn_save_pass').on('click',function(){
        var items={};
        items.user_id=$('#user_id').val();
        items.password = $('#newPass').val();
        items.repassword=$('#rePass').val();
        if (!items.password) {
            app.alert('กรุณาระบุ หรัสผ่าน');
            $('#newPass').focus();
        } else if (items.password.length<4) {
            app.alert('กรุณาระบุการรหัสผ่าน มากกว่า 4 ตัวอักษร');
            $('#newPass').focus();
        } else if (!items.repassword) {
            app.alert('กรุณาระบุการยืนยันรหัสผ่าน');
            $('#rePass').focus();
        } else if (items.repassword.length<4) {
            app.alert('กรุณาระบุการรหัสผ่าน มากกว่า 4 ตัวอักษร');
            $('#rePass').focus();
        }else if(items.password != items.repassword){
            app.alert('การยืนยันรหัสผ่านไม่ตรงกัน');
            $('#rePass').focus();
        }
        else{
            users.save_password(items.user_id,items.password);
        }
    });

    $('#btn_save_edit_user').on('click',function(){
        var items={};
        items.id=$('#id').val();
        items.name = $('#name').val();
        items.cid=$('#cid').val();
        items.email=$('#email').val();
        items.user_mobile=$('#user_mobile').val();
        items.username=$('#username').val();

        items.nickname=$('#nickname').val();
        items.office=$('#office').val();
        items.position=$('#position').val();
        if (!items.name) {
            app.alert('กรุณาระบุ ชื่อสกุล');
            $('#name').focus();
        } else if (items.cid.length<13) {
            app.alert('กรุณาระบุ เลขบัตรประชาชนให้ถูกต้อง');
            $('#newPass').focus();
        }else if (!items.email) {
            app.alert('กรุณาระบุ email');
            $('#email').focus();
        }else if(!items.username){
            app.alert('กรุณาระบุ Username');
            $('#username').focus();
        }else{
            users.save_edit_user(items);
        }
    });

    $('#btn_save_register').on('click',function(){
        var items={};
        items.id=$('#id').val();
        items.name = $('#name').val();
        items.email=$('#email').val();
        items.user_mobile=$('#user_mobile').val();
        items.username=$('#username').val();
        items.password=$('#password').val();
        items.nickname=$('#nickname').val();
        items.office=$('#office').val();
        items.sys_id=$('#sys_id').val();
        if (!items.name) {
            app.alert('กรุณาระบุ หน่วยบริการ');
            $('#name').focus();
        }else if (!items.email) {
            app.alert('กรุณาระบุ email');
            $('#email').focus();
        }else if(!items.username){
            app.alert('กรุณาระบุ Username');
            $('#username').focus();
        }else if(!items.password){
            app.alert('กรุณาระบุ Password');
            $('#password').focus();
        }else if(items.password.length < 4){
            app.alert('กรุณาระบุ Password มากกว่า 4 ตัวอักษร');
            $('#password').focus();
        }
        else{
            users.save_register(items);
        }
    });
 $('#btn_request').on('click',function(){
    // app.alert('Request');
     var items = {};
     items.username = $('#txt_username').val();
     items.password = $('#txt_password').val();

     if(!items.username) {

         alert('กรุณาระบุชื่อผู้ใช้งาน');
         //app.alert('กรุณาระบุชื่อผู้ใช้งาน');
         $("#btn_login").removeProp("disabled");
         return false;

     }else if(!items.password) {

         alert('กรุณาระบุรหัสผ่าน');
         //app.alert('กรุณาระบุรหัสผ่าน');
         $("#btn_login").removeProp("disabled");
         return false;

     }else{
         users.ajax.request_use_system(items.password,items.username,sys_id, function (err, data) {
             //console.log(data);
             if (err) {
                 app.alert('การร้องขอใช้งาน ไม่สำเร็จ อาจเนื่องมาจาก    Username Password ไม่ถูกต้อง หรือ ท่านมีชื่ออยู่ในระบบนี้แล้ว ');
                 //app.alert(err);
             }
             else {
                     app.alert('ทำการร้องขอใช้ ระบบ เรียบร้อยแล้ว จะส่งผลการอนุมัติการใช้ระบบไปทาง Email ');
             }
         });
     }
 });


    $('#btn_edit_profiles').on('click',function(){
        console.log('Test');
        $('#modalEditProfiles').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })

    });

    $('#btn_edit_password').on('click',function(){
        console.log('Test');
        $('#modalEditPassword').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })

    });
    $('#btn_save_profiles').on('click',function(){

        var items={};
        items.id=$('#id').val();
        items.prename = $('#prename').val();
        items.username=$('#username').val();
        items.name = $('#name').val();
        items.cid=$('#cid').val();
        items.hospcode=$('#hospcode').val();
        items.email=$('#email').val();
        items.user_mobile=$('#user_mobile').val();
        items.position=$('#position').val();
        items.action=$='update';
        if (!items.name) {
            app.alert('กรุณาระบุ ชื่อสกุล');
            $('#name').focus();
        } else if (items.cid.length<13) {
            app.alert('กรุณาระบุ เลขบัตรประชาชนให้ถูกต้อง');
            $('#newPass').focus();
        }else if (!items.email) {
            app.alert('กรุณาระบุ email');
            $('#email').focus();
        }else if(!items.username){
            app.alert('กรุณาระบุ Username');
            $('#username').focus();
        }else{
            console.log(items);
            console.log('Test save Profiles');
            users.save_edit_user(items);
        }
    });

});