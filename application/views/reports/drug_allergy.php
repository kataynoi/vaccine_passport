
<html>

<body>
    <br>

    <div class="row">
        <div class="panel panel-info ">
            <div class="panel-heading w3-theme">
                <form action="#" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="เลขบัตรประชาชน" name="cid" id="cid">
                        <div class="input-group-append">
                            <button class="btn btn-info" id="btn_drug_allergy_check" type="button">ค้นหา</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-body">
                <table id="tbl_list" class="table table-responsive" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>ชื่อ สกุล</th>
                            <th>หน่วยบริการ</th>
                            <th>ชื่อยา</th>
                            <th>รหัสยา 24 หลัก</th>
                            <th>วันบันทึกข้อมูล</th>
                            <th>ประเภทวินิจฉัย</th>
                            <th>ระดับความรุนแรง</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($drug_allergy as $r) {

                            echo "<tr><td>".$r->NAME . " " . $r->LNAME."</td>";
                            echo "<td>".get_hospital_name($r->HOSPCODE) ."</td>";
                            echo "<td>".$r->DNAME ."</td>";
                            echo "<td>".$r->DRUGALLERGY ."</td>";
                            echo "<td>".$r->DATERECORD ."</td>";
                            echo "<td>".get_typedx($r->TYPEDX) ."</td>";
                            echo "<td>".get_alevel($r->ALEVEL) ."</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>

                </table>
            </div>

        </div>

    </div>
    <script src="<?php echo base_url() ?>assets/apps/js/drug_allergy.js"></script>