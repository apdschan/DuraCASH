<?php

class Login_Model extends CI_Model
{
    public function autentifikasiuser($username,$password)
    {  
		// Check in tbl_admin table
		$query = $this->db->get_where('tbl_user', array('NamaUser' => $username, 'Password' => $password));
		return $query->row();

		// Jika data ditemukan dalam salah satu dari kedua tabel
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
    }

	public function register_user($data)
	{
		$this->db->insert('tbl_user',$data);
	}

}