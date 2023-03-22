<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Payment extends CI_Model {
        
        private $student_table = "student_admission";


        public function get_students($id = NULL) {
            if($id) {
                return $this->db->where("student_id", $id)->get($this->student_table)->row_array();
            }
            else {
                return $this->db->get($this->student_table)->result_array();
            }
        }
    }