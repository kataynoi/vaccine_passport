$(document).ready(function () {
  var dataTable = $("#table_data").DataTable({
    createdRow: function (row, data, dataIndex) {
      $(row).attr("name", "row" + dataIndex);
    },
    scrollX: true,
    processing: true,
    serverSide: true,
    order: [],

    pageLength: 10,
    ajax: {
      url: site_url + "/asm/fetch_asm",
      data: {
        csrf_token: csrf_token,
      },
      type: "POST",
    },
    columnDefs: [
      {
        targets: [2, 3],
        orderable: true,
      },
    ],
  });
});

var crud = {};

crud.ajax = {
  del_data: function (id, cb) {
    var url = "/asm/del_invite",
      params = {
        id: id,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  save: function (items, cb) {
    var url = "/asm/save_asm",
      params = {
        items: items,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  get_update: function (id, cb) {
    var url = "/asm/get_person_vaccine",
      params = {
        id: id,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  set_vaccine_status: function (cid, cb) {
    var url = "/asm/set_vaccine_status",
      params = {
        cid: cid,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  set_asm_cancle: function (cid, cb) {
    var url = "/asm/set_asm_cancle",
      params = {
        cid: cid,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
};

crud.del_asm = function (cid) {
  crud.ajax.set_asm_cancle(cid, function (err, data) {
    if (err) {
      swal(err);
    } else {
      swal('ลบข้อมูลเรียบร้อย')
    }
  });
};

crud.save = function (items) {
  crud.ajax.save(items, function (err, data) {
    if (err) {
      //app.alert(err);
      swal(err);
    } else {
      swal("บันทึกข้อมูลเรียบร้อยแล้ว ");
      window.location.href = site_url + "/asm";
    }
  });
};

crud.get_update = function (id, row_id) {
  crud.ajax.get_update(id, function (err, data) {
    if (err) {
      //app.alert(err);
      swal(err);
    } else {
      //swal('แก้ไขข้อมูลเรียบร้อยแล้ว ');

      crud.set_update(data, row_id);
    }
  });
};

$("#btn_save_asm").on("click", function (e) {
  e.preventDefault();
  var action;
  var items = {};
  // items.brand_name = $("#brand option:selected").text();

  items.cid = $("#cid").val();
  items.invite = $("#invite").val();
  items.mobile = $("#mobile").val();
  items.weight = $("#weight").val();
  items.height = $("#height").val();
  items.bib = $("#bib").val();
  items.asm_type = $("#asm_type").val();

  if (validate(items)) {
    crud.save(items);
  }
});

$("#add_data").on("click", function (e) {
  e.preventDefault();
  $("#frmModal input").prop("disabled", false);
  $("#frmModal select").prop("disabled", false);
  $("#frmModal textarea").prop("disabled", false);
  $("#frmModal .btn").prop("disabled", false);
  $("#action").val("insert");
  app.clear_form();
});

$(document).on("click", 'button[data-btn="btn_del_asm"]', function (e) {
  e.preventDefault();
  var id = $(this).data("cid");
  var x = $(this);
  var td = $(this).parent().parent().parent();

  swal({
    title: "คำเตือน?",
    text: "คุณต้องการลบข้อมูล อสม.",
    icon: "warning",
    buttons: ["cancel !", "Yes !"],
    dangerMode: true,
  }).then(function (isConfirm) {
    if (isConfirm) {
      crud.del_asm(id);
      x.parent().parent().parent().hide();
    }
  });
});

$(document).on("click", 'button[data-btn="btn_edit"]', function (e) {
  e.preventDefault();
  var id = $(this).data("id");
  $("#action").val("update");
  $("#id").val(id);
  var row_id = $(this).parent().parent().parent().attr("name");
  $("#frmModal input").prop("disabled", false);
  $("#frmModal select").prop("disabled", false);
  $("#frmModal textarea").prop("disabled", false);
  $("#frmModal .btn").prop("disabled", false);

  crud.get_update(id, row_id);
  $("#frmModal").modal("show");
});

function validate(items) {
  if (!items.mobile) {
    swal("กรุณาระบุเบอร์โทร");
    $("#HOSPCODE").focus();
  } else if (!items.weight) {
    swal("กรุณาระบุน้ำหนัก");
    $("#weight").focus();
  } else if (!items.height) {
    swal("กรุณาระบุส่วนสูง");
    $("#height").focus();
  } else if (!items.asm_type) {
    swal("กรุณาระบุประเภท");
    $("#asm_type").focus();
  } else {
    return true;
  }
}

crud.set_vaccine_needle3 = function (cid) {
  crud.ajax.set_vaccine_status(cid, function (err, data) {
    if (err) {
      $r = false;
    } else {
      $r = true;
    }
  });
  return true;
};

crud.set_asm_cancle = function (cid) {
  crud.ajax.set_asm_cancle(cid, function (err, data) {
    if (err) {
      $r = false;
    } else {
      $r = true;
    }
  });
  return true;
};





