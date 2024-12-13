<?php
class mSatuan extends CI_model{

    function getData(){
    	$data=$this->db->get('tbl_m_satuan')->result();
		return $data;
  	}	
}