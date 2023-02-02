<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Report model
 * @author  Mr.Dechachit Kaewmaung <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 */
class Reports_model extends CI_Model
{

    public function get_sql_report_disease($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->get('sql_report_disease')
            ->row_array();
        return $rs;
    }
    public function get_report_items()
    {
        $rs = $this->db
            ->get('sql_report_disease')
            ->result();
        return $rs;
    }

    public function death_disease($ampur = '', $disease, $year)
    {

        $provcode = $this->config->item('prov_code');
        $table = "death_home";

        if ($ampur == '') {
            $where = " ";
            $group = " LEFT(a.lccaattmm,4)";
            $select = "d.ampurname as name,e.all_sex as person_all,e.male as person_male,e.female as person_female";
            $join = " LEFT JOIN (SELECT * FROM pop_ampur WHERE n_year= " . $year . " AND provcode=" . $provcode . ") e ON  d.ampurcodefull = e.ampurcode";
        } else if ($ampur != '') {
            $where = "AND d.ampurcodefull= '" . $ampur . "' ";
            $group = " a.hospcode";
            $select = "c.hosname as name,null as person_all,null as person_male,null as person_female";
            $join = "";
        }

        $sql = "SELECT " . $select . ",count(a.PID) death_total
        ,SUM(IF(a.sex=1,1,0)) as male 
        ,SUM(IF(a.sex=2,1,0)) as female  
        FROM " . $table . " a 
        LEFT JOIN chospital c ON a.HOSPCODE = c.hoscode
        LEFT JOIN (SELECT * FROM campur WHERE changwatcode=44) d ON LEFT(a.lccaattmm,4) = d.ampurcodefull
        " . $join . " 
        WHERE 1=1 " . $where . "  AND LEFT(a.lccaattmm,2) ='" . $this->config->item('prov_code') . "'
        AND YEAR_NGOB =" . $year . " " . $disease . " 
        GROUP BY " . $group . ";
        ";
        echo $sql;
        $rs = $this->db->query($sql)->result();
        echo $this->db->last_query();

        return $rs;
    }

    public function birth($ampur = '', $year)
    {

        $provcode = $this->config->item('prov_code');
        $table = "birth";

        if ($ampur == '') {
            $where = " ";
            $group = " a.ampur";
            $select = "d.ampurname as name,e.all_sex as person_all,e.male as person_male,e.female as person_female";
            $join = " LEFT JOIN (SELECT * FROM pop_ampur WHERE n_year= " . $year . " AND provcode=" . $provcode . ") e ON  d.ampurcodefull = e.ampurcode";
        } else if ($ampur != '') {
            $where = "AND d.ampurcodefull= '" . $ampur . "' ";
            $group = " a.hospcode";
            $select = "c.hosname as name,null as person_all,null as person_male,null as person_female";
            $join = "";
        }

        $sql = "SELECT " . $select . ",count(a.PROV) death_total
        ,SUM(IF(a.sex=1,1,0)) as male 
        ,SUM(IF(a.sex=2,1,0)) as female  
        FROM " . $table . " a 
        LEFT JOIN (SELECT * FROM campur WHERE changwatcode=" . $provcode . ") d ON a.ampur = d.ampurcodefull
        " . $join . " 
        WHERE 1=1 " . $where . "  AND LEFT(a.ampur,2) ='" . $this->config->item('prov_code') . "'
        AND BYEAR =" . $year . "
        GROUP BY " . $group . ";
        ";
        //echo $sql;
        $rs = $this->db->query($sql)->result();
        //echo $this->db->last_query();

        return $rs;
    }


    public function le7($sex = 0)
    {

        if ($sex == 1) {
            $sql_sex = "AND sex = '1'";
        } else if ($sex == 2) {
            $sql_sex = "AND sex = '2'";
        } else {
            $sql_sex = "AND sex = '3'";
        }

        $provcode = $this->config->item('prov_code');
        $sql = "SELECT
        rp_le_home_r7.prov,
        rp_le_home_r7.`no`,
        rp_le_home_r7.age_gr,
        rp_le_home_r7.sex,
        rp_le_home_r7.y2016,
        rp_le_home_r7.y2017,
        rp_le_home_r7.y2018,
        rp_le_home_r7.y2019,
        rp_le_home_r7.y2020
        FROM
        rp_le_home_r7
        WHERE 
        # 4 = 'เขตสุขภาพที่  7 ,   40  = ขอนแก่น  ,  44  =  มหาสารคาม ,  45  = ร้อยเอ็ด ,  46  = กาฬสินธุ์  
        #Prov = '4' AND 
        # no = อายุเมื่อแรกเกิด
        no = '1' 
        # เพศ   1  = ชาย   2  = หญิง   3  = รวม
        " . $sql_sex;
        //echo $sql;
        $rs = $this->db->query($sql)->result();
        //echo $this->db->last_query();
        return $rs;
    }

    public function hale7($sex = 0)
    {

        if ($sex == 1) {
            $sql_sex = "AND sex = '1'";
        } else if ($sex == 2) {
            $sql_sex = "AND sex = '2'";
        } else {
            $sql_sex = "AND sex = '3'";
        }

        $provcode = $this->config->item('prov_code');
        $sql = "SELECT
        rp_hale_home_r7.prov,
        rp_hale_home_r7.`no`,
        rp_hale_home_r7.age_gr,
        rp_hale_home_r7.sex,
        rp_hale_home_r7.y2016,
        rp_hale_home_r7.y2017,
        rp_hale_home_r7.y2018,
        rp_hale_home_r7.y2019,
        rp_hale_home_r7.y2020
        FROM
        rp_hale_home_r7
        WHERE 
        # 4 = 'เขตสุขภาพที่  7 ,   40  = ขอนแก่น  ,  44  =  มหาสารคาม ,  45  = ร้อยเอ็ด ,  46  = กาฬสินธุ์  
        #Prov = '4' AND 
        # no = อายุเมื่อแรกเกิด
        no = '1' 
        # เพศ   1  = ชาย   2  = หญิง   3  = รวม
        " . $sql_sex;
        //echo $sql;
        $rs = $this->db->query($sql)->result();
        //echo $this->db->last_query();
        return $rs;
    }

    public function yll7($sex = 0, $provcode)
    {

        if ($sex == 1) {
            $sql_sex = "M";
        } else if ($sex == 2) {
            $sql_sex = "F";
        } else {
            $sql_sex = "B";
        }


        $sql = "SELECT
        z5_rp_yll_home2.n,
        z5_rp_yll_home2.prov,
        z5_rp_yll_home2.SEX,
        z5_rp_yll_home2.gr_disease,
        z5_rp_yll_home2.gr_diseaseTH,
        z5_rp_yll_home2.y2018,
        z5_rp_yll_home2.y2019,
        z5_rp_yll_home2.y2020
        FROM
        z5_rp_yll_home2
        WHERE
        #prov  4 = เขต   40 ขอนแก่น    44มหาสารคาม   45ร้อยเอ็ด  46กาฬสินธุ์
        z5_rp_yll_home2.prov = '" . $provcode . "' AND
        # Sex B = ทั้งหมด,   F = หญิง  ,   M = ชาย
        z5_rp_yll_home2.SEX = '" . $sql_sex . "'
        ORDER BY
        z5_rp_yll_home2.y2020 DESC
        LIMIT 20 ";

        $rs = $this->db->query($sql)->result();
        //echo $this->db->last_query();
        return $rs;
    }
    public function year_death_home($year)
    {
        $rs = $this->db
            ->where('DYEAR', $year)
            ->get('death_home')
            ->result();
    }
}
/* End of file basic_model.php */
/* Location: ./application/models/basic_model.php */