<?php 
class Loginc extends CI_Controller{
 public function __construct(){
 	parent:: __construct();
 	$this->load->helper("url");
 	$this->load->database();
 	$this->load->model("Login_mod");
    $this->load->library('session');
 	}

public function index(){
    $this->load->view("login");
      $this->session->set_flashdata("msg","");
}
public function logincheck(){
    $username=$this->input->post("username");
$password=$this->input->post("password");

$res=$this->Login_mod->loginm($username,$password);
if(count($res)>0){
     $this->session->set_userdata("admin_id",$res[0]->id);
     $this->session->set_userdata("admin_username",$res[0]->username);
       redirect(base_url()."dashboard");

}else{
    $this->session->set_flashdata("msg","Invalid Login");
    redirect(base_url());
}


}
public function logout(){
 $this->session->unset_userdata("admin_id");
     $this->session->unset_userdata("admin_username");
     redirect(base_url());
}



 }