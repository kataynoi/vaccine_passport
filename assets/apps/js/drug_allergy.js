$(document).ready(function () {
  var crud = {};
  $("#btn_drug_allergy_check").on("click", function () {
    //alert('OK');
    $cid = $("#cid").val();
    if (cidCheck($cid)) {
      window.location.href = site_url + "/report/drug_allergy/" + $cid;
    }
    exit(0);
  });

  $(document).on("keypress", function (e) {
    if (e.which == 13) {
      $cid = $(this).val();
      if (cidCheck($cid)) {
        window.location.href = site_url + "/report/drug_allergy/" + $cid;
      }
    }
  });
});

function cidCheck(cid) {
  if (cid.length < 13) {
    swal("เลขบัตรประชาชนไม่ถูกต้อง");
    return false;
  } else {
    return true;
  }
}
