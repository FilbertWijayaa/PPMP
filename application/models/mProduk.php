<?php
class mProduk extends CI_model{

    function getData(){
        // Start building the query
        $this->db->select('p.*, k.nama_kategori, s.nama_satuan');
        $this->db->from('tbl_m_produk p'); // Specify the base table
        $this->db->join('tbl_m_kategori k', 'p.id_kategori = k.id_kategori', 'left'); // Use left join if you want all products
        $this->db->join('tbl_m_satuan s', 'p.id_satuan = s.id_satuan', 'left'); // Use left join if you want all products
    
        // Execute the query and get the result
        $data = $this->db->get()->result();
    
        return $data; // Return the result
    }
    

    function getRowData(){
    	return $this->db->get('tbl_m_produk');
  	}	
  	//Menambahkan data (Create)
  	function insertData($data){
		return $this->db->insert('tbl_m_produk',$data);
	}

	//Untuk Menampilkan Data berdasarkan ID (Read)
  	function getDataById($id){
		$this->db->where('id_produk',$id);
		return $this->db->get('tbl_m_produk')->row();
	}

  	//Update Data berdasarkan ID (Update)
	function updateData($id,$data){
		$this->db->where('id_produk',$id);
		return $this->db->update('tbl_m_produk',$data);
	}
  
  	//Menghapus data berdasarkan ID (Delete)
	function deleteData($id){
		$this->db->where('id_produk',$id);
		return $this->db->delete('tbl_m_produk');
	}

	//Validasi Data Duplikat
	function cekDuplicate($kategori) {
        $this->db->where('nama_produk',$kategori);
        $query = $this->db->get('tbl_m_produk');
        return $query->num_rows();
    }

    //Membuat Kode barang otomatis berdasarkan Kategori
    function getKode($id_kategori){
        $query = $this->db->query("SELECT MAX(RIGHT(id_produk,6)) AS kd_max FROM tbl_m_produk WHERE id_kategori = '$id_kategori'");
        $isCode = '';
        if($query->rum_rows()>0){
            foreach($query->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $isCode = sprintf("50Gs", $tmp);
            }
        }else{
            $isCode= "000001";
        }
        return $id_kategori.$isCode;
    }
}