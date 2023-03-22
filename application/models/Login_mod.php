<?php 
class Login_mod extends CI_Model{


public function loginm($u,$p){
	$this->db->where("username",$u);
$this->db->where("password",$p);
$q=$this->db->get("login");
$rs=$q->result();
return $rs;

}
}


?>