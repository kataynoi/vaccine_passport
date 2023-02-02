$(document).ready(function () {
  $("#btn_login").removeAttr("disabled");
  //User namespace
  var users = {};
  users.ajax = {
    do_auth: function (username, password, cb) {
      var url = "/user/do_auth",
        params = {
          username: username,
          password: password,
        };
      app.ajax(url, params, function (err, data) {
        err ? cb(err) : cb(null, data);
      });
    },
  };

  users.do_auth = function (username, password) {
    users.ajax.do_auth(username, password, function (err, data) {
      if (err) {
        swal(err);
        //window.location = site_url + "/";
      } else {
        if (data.success) {
          swal('Login Success');
          window.location = site_url + "/";
        }
      }
    });
  };

  $("#btn_login").on("click", function (e) {
    e.preventDefault();
    var username = $("#username").val();
    var password = $("#password").val();

    if (!username || !password) {
      swal("ระบุ Username Password ให้ครบถ้วน");
      return false;
    }
    users.do_auth(username, password);
  });

  $("#btn_save_pass").on("click", function () {
    var items = {};
    items.user_id = $("#user_id").val();
    items.password = $("#newPass").val();
    items.repassword = $("#rePass").val();
    if (!items.password) {
      app.alert("กรุณาระบุ หรัสผ่าน");
      $("#newPass").focus();
    } else if (items.password.length < 4) {
      app.alert("กรุณาระบุการรหัสผ่าน มากกว่า 4 ตัวอักษร");
      $("#newPass").focus();
    } else if (!items.repassword) {
      app.alert("กรุณาระบุการยืนยันรหัสผ่าน");
      $("#rePass").focus();
    } else if (items.repassword.length < 4) {
      app.alert("กรุณาระบุการรหัสผ่าน มากกว่า 4 ตัวอักษร");
      $("#rePass").focus();
    } else if (items.password != items.repassword) {
      app.alert("การยืนยันรหัสผ่านไม่ตรงกัน");
      $("#rePass").focus();
    } else {
      users.save_password(items.user_id, items.password);
    }
  });

  $("#btn_save_edit_user").on("click", function () {
    var items = {};
    items.id = $("#id").val();
    items.name = $("#name").val();
    items.cid = $("#cid").val();
    items.email = $("#email").val();
    items.user_mobile = $("#user_mobile").val();
    items.username = $("#username").val();

    items.nickname = $("#nickname").val();
    items.office = $("#office").val();
    items.position = $("#position").val();
    if (!items.name) {
      app.alert("กรุณาระบุ ชื่อสกุล");
      $("#name").focus();
    } else if (items.cid.length < 13) {
      app.alert("กรุณาระบุ เลขบัตรประชาชนให้ถูกต้อง");
      $("#newPass").focus();
    } else if (!items.email) {
      app.alert("กรุณาระบุ email");
      $("#email").focus();
    } else if (!items.username) {
      app.alert("กรุณาระบุ Username");
      $("#username").focus();
    } else {
      users.save_edit_user(items);
    }
  });

  $("#btn_save_register").on("click", function () {
    var items = {};
    items.id = $("#id").val();
    items.name = $("#name").val();
    items.email = $("#email").val();
    items.user_mobile = $("#user_mobile").val();
    items.username = $("#username").val();
    items.password = $("#password").val();
    items.nickname = $("#nickname").val();
    items.office = $("#office").val();
    items.sys_id = $("#sys_id").val();
    if (!items.name) {
      app.alert("กรุณาระบุ หน่วยบริการ");
      $("#name").focus();
    } else if (!items.email) {
      app.alert("กรุณาระบุ email");
      $("#email").focus();
    } else if (!items.username) {
      app.alert("กรุณาระบุ Username");
      $("#username").focus();
    } else if (!items.password) {
      app.alert("กรุณาระบุ Password");
      $("#password").focus();
    } else if (items.password.length < 4) {
      app.alert("กรุณาระบุ Password มากกว่า 4 ตัวอักษร");
      $("#password").focus();
    } else {
      users.save_register(items);
    }
  });
});
