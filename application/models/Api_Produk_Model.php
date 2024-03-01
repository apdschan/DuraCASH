<?php

class Api_Produk_Model extends CI_Model
{
    public function get_produk()
    {
        $query = $this->db->get('tbl_produk');
        return $query->result();
    }

    public function get_produk_byid($id)
    {
        $this->db->where('ProdukID',$id);
        $query = $this->db->get('tbl_produk');
        return $query->row();
    }

    public function update_produk_byid($id,$data)
    {
        $this->db->where('ProdukID',$id);
        return $this->db->update('tbl_produk',$data);
    }

    public function add_produk($data)
    {
        return $this->db->insert('tbl_produk',$data);
    }

    public function delete_produk_byid($id)
    {
        return $this->db->delete('tbl_produk',['ProdukID' => $id]);
    }
}