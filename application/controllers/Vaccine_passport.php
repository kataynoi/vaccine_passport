<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @author  Mr.Dechachit Kaewmaung 
 * @copyright   MKHO <http://mkho.moph.go.th>
 */
class Vaccine_passport extends CI_Controller
{
    public $user_id;
    public $id;


    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("user_login"))
        redirect(site_url("user/login"));
        $this->load->model('Basic_model', 'basic');
        $this->load->model('Reports_model', 'crud');
        $this->id = $this->session->userdata('id');
    }

    public function index()
    {
        //$data['report_items'] = $this->crud->get_report_items();
        $data[]='';
        $this->layout->view('vaccine_passport/index', $data);
    }

    public function  drug_allergy($cid='')
    {
        $url = $this->config->item('web_api') . "/reports/drug_allergy";


        $data = array("cid" => $cid);
        $data['drug_allergy'] = (array)json_decode($this->CallAPI($url, $data));
       
        $this->layout->view('reports/drug_allergy', $data);
    }

    public function  CallAPI($url, $data)
    {

        $url = sprintf("%s?%s", $url, http_build_query($data));
        $key = "X-API-Key:" . $this->config->item('key_api');
        $user = $this->config->item('user_api');
        $pass = $this->config->item('pass_api');

        $ch =  curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $user . ":" . $pass);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($key, "Content-Type:application/json", 'Accept: application/json'));
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        $result = curl_exec($ch);
        //print_r($result);
        curl_close($ch);
        return $result;
    }
}
