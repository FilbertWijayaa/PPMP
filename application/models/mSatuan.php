<?php
class mSatuan extends CI_model{

    function getData(){
        $result = $this->db->get('tbl_m_satuan');
        return $result;
    }
}