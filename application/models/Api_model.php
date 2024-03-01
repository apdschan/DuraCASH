<?php

class Api_model extends CI_Model
{
    public function get_produk()
    {
        $this->db->get('tbl_produk')->result();
    }

    public function create_task($data)
    {
        return $this->db->insert('tbl_produk', $data);
    }

    public function update_task($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tbl_produk', $data);
    }

    public function delete_task($id)
    {
        return $this->db->delete('tbl_produk', array('id' => $id));
    }
}