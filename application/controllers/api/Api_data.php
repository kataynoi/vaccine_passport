<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 * @author  Mr.Dechachit Kaewmaung 
 * @copyright   MKHO <http://mkho.moph.go.th>
 *
 */
require(APPPATH.'/libraries/REST_Controller.php');
class Api_data extends REST_Controller
{

    public function __construct() {
        parent::__construct();
        $this->load->model('api_model','api');

    }
    public function death_home_post(){
        
        $year_death= $this->input->get('year');
        $r = $this->api->death_home($year_death);
        $this->response($r);
    }
    public function death_home_count_post(){
        
        $year_death= $this->input->get('year');
        $r = $this->api->death_home_count($year_death);
        $this->response($r);
    }
    public function death_hos_post(){
        
        $year_death= $this->input->get('year');
        $r = $this->api->death_hos($year_death);
        $this->response($r);
    }
    public function death_hos_count_post(){
        
        $year_death= $this->input->get('year');
        $r = $this->api->death_hos_count($year_death);
        $this->response($r);
    }
    public function birth_post(){
        
        $year_death= $this->input->get('year');
        $r = $this->api->birth($year_death);
        $this->response($r);
    }
    public function birth_count_post(){
        
        $year_death= $this->input->get('year');
        $r = $this->api->birth_count($year_death);
        $this->response($r);
    }
    public function s_pop_sex_post(){
        
        $year= $this->input->get('year');
        $r = $this->api->s_pop_sex($year);
        $this->response($r);
    }
}