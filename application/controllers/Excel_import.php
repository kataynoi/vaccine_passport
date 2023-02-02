<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Excel_import extends CI_Controller
{
    public $prov_code;
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("user_level") != 'admin')
            redirect(site_url("user/login"));
        $this->load->model('excel_import_model');
        $this->load->library('excel');
        $this->prov_code = $this->session->userdata('prov') ;
    }

    function death_home()
    {
        $this->layout->view('excel_import/excel_import_death_home');
    }
    function death_hos()
    {
        $this->layout->view('excel_import/excel_import_death_hos');
    }

    function birth()
    {
        $this->layout->view('excel_import/excel_import_birth');
    }
    function call_fn()
    {
        $this->excel_import_model->update_d_death_home();
    }

    function import_death_home()
    {
        if (isset($_FILES["file_death"]["name"])) {
            $path = $_FILES["file_death"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            $data = array();
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {

                    $pid = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $sex = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $age = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $ddate = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $dmon = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $dyear = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $drcode = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $hos_id = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $lccaattmm = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $ncause = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $bdate = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $bmon = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $byear = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    $dplace = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                    $ghos = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                    $codepro = $worksheet->getCellByColumnAndRow(15, $row)->getValue();

                    $data[] = array(
                        'DATE_IMPORT' => date("Y-m-d H:i:s"),
                        'PID' => $pid,
                        'SEX' => $sex,
                        'AGE' => $age,
                        'DDATE' => $ddate,
                        'DMON' => $dmon,
                        'DYEAR' => $dyear,
                        'DRCODE' => $drcode,
                        'HOS_ID' => $hos_id,
                        'LCCAATTMM' => $lccaattmm,
                        'NCAUSE' => $ncause,
                        'BDATE' => $bdate,
                        'BMON' => $bmon,
                        'BYEAR' => $byear,
                        'DPLACE' => $dplace,
                        'GHOS' => $ghos,
                        'CODEPRO' => $codepro,
                        'PROV' => $this->prov_code
                    );
                }
            }
            if (count($data) > 0) {
                $rs = $this->excel_import_model->insert_death_home($data, $this->prov_code);
            } else {
                $rs = 0;
            }
            echo $rs ? $rs : '0';
        }
    }

    function import_death_hos()
    {
        if (isset($_FILES["file_death"]["name"])) {
            $path = $_FILES["file_death"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            $data = array();
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {

                    $pid = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $sex = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $age = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $ddate = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $dmon = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $dyear = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $drcode = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $hos_id = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $lccaattmm = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $ncause = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $bdate = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $bmon = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $byear = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    $dplace = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                    $ghos = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                    $codepro = $worksheet->getCellByColumnAndRow(15, $row)->getValue();

                    $data[] = array(
                        'DATE_IMPORT' => date("Y-m-d H:i:s"),
                        'PID' => $pid,
                        'SEX' => $sex,
                        'AGE' => $age,
                        'DDATE' => $ddate,
                        'DMON' => $dmon,
                        'DYEAR' => $dyear,
                        'DRCODE' => $drcode,
                        'HOS_ID' => $hos_id,
                        'LCCAATTMM' => $lccaattmm,
                        'NCAUSE' => $ncause,
                        'BDATE' => $bdate,
                        'BMON' => $bmon,
                        'BYEAR' => $byear,
                        'DPLACE' => $dplace,
                        'GHOS' => $ghos,
                        'CODEPRO' => $codepro,
                        'PROV' => $this->prov_code
                    );
                }
            }
            if (count($data) > 0) {
                $rs = $this->excel_import_model->insert_death_hos($data, $this->prov_code);
            } else {
                $rs = 0;
            }
            echo $rs ? $rs : '0';
        }
    }



    function import_birth()
    {
        if (isset($_FILES["file_birth"]["name"])) {
            $path = $_FILES["file_birth"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            $data = array();
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $import_year = 0;
                for ($row = 2; $row <= $highestRow; $row++) {

                    $prov = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $amp = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $tb = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $sex = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $byear = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $bmon = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $bdate = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $nat = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $no = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $weight = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $mage = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $ket = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $yptell = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    $mptell = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                    $dptell = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                    $maddr = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                    if ($row == 2) {
                        $import_year = $byear;
                    }
                    $data[] = array(
                        'DATE_IMPORT' => date("Y-m-d H:i:s"),
                        'PROV' => $prov,
                        'AMP' => $sex,
                        'TB' => $tb,
                        'SEX' => $sex,
                        'BDATE' => $bdate,
                        'BMON' => $bmon,
                        'BYEAR' => $byear,
                        'NAT' => $nat,
                        'NO' => $no,
                        'WEIGHT' => $weight,
                        'MAGE' => $mage,
                        'KET' => $ket,
                        'YPTELL' => $yptell,
                        'MPTELL' => $mptell,
                        'DPTELL' => $dptell,
                        'MADDR' => $maddr

                    );
                }
            }
            //console_log($data);
            if (count($data) > 0) {
                $rs = $this->excel_import_model->insert_birth($data, $this->prov_code, $import_year);
            } else {
                $rs = 0;
            }
            echo $rs ? $rs : '0';
        }
    }

    
}
