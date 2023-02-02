<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Report model
 * @author  Mr.Dechachit Kaewmaung <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 */
class Api_model extends CI_Model
{


    public function death_home($year)
    {
        $rs = $this->db
            ->where('DYEAR', $year)
            ->get('death_home')
            ->result();
        return $rs;
    }
    public function death_home_count($year)
    {
        $rs = $this->db
            ->where('DYEAR', $year)
            ->get('death_home')
            ->num_rows();
        return $rs;
    }
    public function death_hos($year)
    {
        $rs = $this->db
            ->where('DYEAR', $year)
            ->get('death_hos')
            ->result();
        return $rs;
    }
    public function death_hos_count($year)
    {
        $rs = $this->db
            ->where('DYEAR', $year)
            ->get('death_hos')
            ->num_rows();
        return $rs;
    }
    public function birth($year)
    {
        $rs = $this->db
            ->where('BYEAR', $year)
            ->get('birth')
            ->result();
        return $rs;
    }
    public function birth_count($year)
    {
        $rs = $this->db
            ->where('BYEAR', $year)
            ->get('birth')
            ->num_rows();
        return $rs;
    }
    public function s_pop_sex($year)
    {
        $rs = $this->db
            ->where('b_year', $year)
            ->get('s_pop_sex_age_moph')
            ->result();
        return $rs;
    }
}
/* End of file basic_model.php */
/* Location: ./application/models/basic_model.php */