/**
 * Main application script
 */
var app = {
  show_loading: function () {
    $.blockUI({
      css: {
        border: "none",
        padding: "15px",
        backgroundColor: "#000",
        "-webkit-border-radius": "10px",
        "-moz-border-radius": "10px",
        opacity: 1,
        color: "#fff",
      },
      message: "<h4>Loading </h4>",
    });
  },

  hide_loading: function () {
    $.unblockUI();
  },
  show_block: function (obj) {
    $(obj).block({
      css: {
        border: "none",
        padding: "15px",
        backgroundColor: "#000",
        "-webkit-border-radius": "10px",
        "-moz-border-radius": "10px",
        opacity: 1,
        color: "#fff",
      },
      message: "<h4> Loading...</h4>",
    });
  },
  hide_block: function (obj) {
    $(obj).unblock();
  },

  mysql_to_thai_date: function (d) {
    if (!d) {
      return "-";
    } else {
      var date = d.split("-");

      var dd = date[2],
        mm = date[1],
        yyyy = parseInt(date[0]) + 543;

      return dd + "/" + mm + "/" + yyyy;
    }
  },

  count_age: function (d) {
    if (!d) {
      return 0;
    } else {
      var d = d.split("-");
      var year_birth = d[0];
      var year_current = new Date();
      var year_current2 = year_current.getFullYear();

      var age = year_current2 - parseInt(year_birth);

      return age;
    }
  },
  count_age_date_thai: function (d) {
    if (!d) {
      return 0;
    } else {
      var d = d.split("/");
      var year_birth = d[2];
      var year_current = new Date();
      var year_current2 = year_current.getFullYear();

      var age = year_current2 + 543 - parseInt(year_birth);

      return age;
    }
  },

  go_to_url: function (url) {
    location.href = site_url + url;
  },
  /**
   * Ajax
   *
   * @param url
   * @param params
   * @param cb
   */
  ajax: function (url, params, cb) {
    params.csrf_token = csrf_token;

    app.show_loading();

    try {
      $.ajax({
        url: site_url + url,
        type: "POST",
        dataType: "json",

        data: params,

        success: function (data) {
          if (data.success) {
            if (data) {
              cb(null, data);
            } else {
              cb("Record not found.", null);
            }

            app.hide_loading();
          } else {
            cb(data.msg, null);
            app.hide_loading();
          }
        },

        error: function (xhr, status) {
          cb("Error:  [" + xhr.status + "] " + xhr.statusText, null);
          app.hide_loading();
        },
      });
    } catch (err) {
      cb(err, null);
    }
  },
  ajax_cross: function (url, params, cb) {
    params.csrf_token = csrf_token;

    app.show_loading();

    try {
      $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: params,
        success: function (data) {
          cb(data);
          app.hide_loading();
        },
        error: function (xhr, status) {
          cb("Error:  [" + xhr.status + "] " + xhr.statusText, null);
          app.hide_loading();
        },
      });
    } catch (err) {
      cb(err, null);
    }
  },

  alert: function (msg, title) {
    if (!title) {
      title = "Messages";
    }

    $("#freeow").freeow(title, msg, {
      //classes: ["gray", "error"],
      classes: ["gray"],
      prepend: false,
      autoHide: true,
    });
  },

  set_first_selected: function (obj) {
    $(obj).find("option").first().attr("selected", "selected");
  },

  trim: function (string) {
    return $.trim(string);
  },

  add_commars: function (str) {
    var my_number = numeral(str).format("0,0.00");

    return my_number;
  },

  add_commars_with_out_decimal: function (str) {
    var my_number = numeral(str).format("0,0");

    return my_number;
  },

  clear_null: function (v) {
    return v == null ? "-" : v;
  },

  set_cookie: function (k, v) {
    $.cookie(k, v);
  },
  clear_form: function () {
    $("input[type=text],input[type=password], textarea").val("");
    $("option:first").attr("selected", "selected");
    //$("select").val($("#target option:first").val());
    //$("select").val($("#target option:first").val());
  },
  get_cookie: function (k) {
    $.cookie(k);
  },

  strip: function (str, len) {
    if (!str) {
      return "-";
    } else {
      if (str.length <= len) {
        return str;
      } else {
        return str.substr(0, len) + "...";
      }
    }
  },
  intVal: function (i) {
    return typeof i === "string"
      ? i.replace(/[\$,]/g, "") * 1
      : typeof i === "number"
      ? i
      : 0;
  },
};

//Record pre page
app.record_per_page = 25;

app.set_runtime = function () {
  $('input[data-type="date"]').mask("99/99/9999");
  $('input[data-type="time"]').mask("99:99");
  $('input[data-type="year"]').mask("9999");
  $('input[data-type="number"]').numeric();
  $("input[disabled]").css("background-color", "white");
  $("select[disabled]").css("background-color", "white");
  $("textarea[disabled]").css("background-color", "white");

  $('[data-rel="tooltip"]').tooltip();
};

app.disable_form = function (target) {
  $("input").prop("disabled", true);
  $("select").prop("disabled", true);
  $("textarea").prop("disabled", true);
  $(".btn").prop("disabled", true);
};
app.to_string_date = function (s) {
  var d = s.split("/");
  var str = d[2] + d[1] + d[0];
  return str;
};
app.to_string_date_mysql = function (s) {
  var d = s.split("/");
  var str = d[2] - 543 + "-" + d[1] + "-" + d[0];
  return str;
};
app.string_to_date = function (s) {
  var parts = s.split("-");
  var mydate = new Date(parts[0], parts[1] - 1, parts[2]);
  return mydate;
};

app.daysInMonth = function (year) {
  var array = year.split("-");
  console.log(array[0] + array[1]);
  return new Date(array[0], array[1], 0).getDate();
};

$(function () {
  app.set_runtime();
});

app.date_now_thai = function () {
  var today = new Date();
  var dd = today.getDate();

  var mm = today.getMonth() + 1;
  var yyyy = today.getFullYear() + 543;
  if (dd < 10) {
    dd = "0" + dd;
  }

  if (mm < 10) {
    mm = "0" + mm;
  }
  today = mm + "-" + dd + "-" + yyyy;
  //console.log(today);
  today = mm + "/" + dd + "/" + yyyy;
  //console.log(today);
  today = dd + "-" + mm + "-" + yyyy;
 // console.log(today);
  today = dd + "/" + mm + "/" + yyyy;
  return today;
};
