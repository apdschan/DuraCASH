<?php

class Kasir_Model extends CI_Model
{
	public function datakasir($id){
		$this->db->where('UserID',$id);
		$this->db->where('Role','2');
		return $this->db->get('tbl_user')->row();
	}

	public function datatoko($id){
		$this->db->where('TokoID',$id);
		return $this->db->get('tbl_toko')->row();
	}

	public function jumlah_barang() {
        return $this->db->count_all('tbl_produk');
    }

	public function jumlah_kasir() {
        return $this->db->count_all('tbl_pelanggan');
    }

	public function jumlah_toko() {
        return $this->db->count_all('tbl_toko');
    }

    public function calculate_total_stock() {
        $this->db->select_sum('Stok', 'total_stock');
        $query = $this->db->get('tbl_produk');

        // Return the total stock
        return $query->row()->total_stock;
    }

	//akun
	public function editakunbyid($data){
        $this->db->where('UserID', $data['UserID']);
		$this->db->update('tbl_user',$data);
	}

    //customer
	public function list_customer(){
		return $this->db->get('tbl_pelanggan')->result();
	}
    
	public function tambahcustomer($data){
		$this->db->insert('tbl_pelanggan',$data);
	}

	public function editcustomerbyid($data){
        $this->db->where('PelangganID', $data['PelangganID']);
		$this->db->update('tbl_pelanggan',$data);
	}

	public function editokobyid($data){
        $this->db->where('TokoID', $data['TokoID']);
		$this->db->update('tbl_toko',$data);
	}

	public function customerbyid($id){
		$this->db->where('PelangganID',$id);
        $query = $this->db->get('tbl_pelanggan');
        return $query->row();
	}

	public function deleteCustomer($customerId) {
        // Implement your database delete logic here
        $this->db->delete('tbl_pelanggan', array('PelangganID' => $customerId));
        
        // For demonstration purposes, let's assume the deletion is successful
        return true;
    }

	//produk
	public function list_produk(){
		return $this->db->get('tbl_produk')->result();
	}

	public function tambahproduct($data){
		$this->db->insert('tbl_produk',$data);
	}

	public function produkbyid($id){
		$this->db->where('ProdukID',$id);
        $query = $this->db->get('tbl_produk');
        return $query->row();
	}

	public function editprodukbyid($data){
        $this->db->where('ProdukID', $data['ProdukID']);
		$this->db->update('tbl_produk',$data);
	}

	public function deleteProduk($produkId) {
        // Implement your database delete logic here
        $this->db->delete('tbl_produk', array('ProdukID' => $produkId));
        
        // For demonstration purposes, let's assume the deletion is successful
        return true;
    }

	public function kurangiJumlahProduk($produkID, $jumlahProdukLama,$jumlahProdukBaru) {
		$this->db->where('ProdukID',$produkID);
        $query = $this->db->get('tbl_produk');
        $produk = $query->row();
        // Kurangi jumlah produk dengan jumlah yang diterima dari permintaan POST
        $newJumlah = $produk->Stok - $jumlahProdukBaru + $jumlahProdukLama;
        
        // Perbarui jumlah produk di tabel produk
        $this->db->where('ProdukID', $produkID);
        $this->db->update('tbl_produk', array('Stok' => $newJumlah));
    }
	
	public function KembalikanStokProduk($produkID,$stok) {
        
		$this->db->where('ProdukID',$produkID);
        $query = $this->db->get('tbl_produk');
        $produk = $query->row();
        // Kurangi jumlah produk dengan jumlah yang diterima dari permintaan POST
        $newJumlah = $produk->Stok + $stok;

        // Perbarui jumlah produk di tabel produk
        $this->db->where('ProdukID', $produkID);
        $this->db->update('tbl_produk', array('Stok' => $newJumlah));
    }

    public function calculate_sold_product() {
        $this->db->select_sum('JumlahProduk', 'total_terjual');
        $query = $this->db->get('tbl_keranjang');

        // Return the total stock
        return $query->row()->total_terjual;
    }
	
	//kategori
	public function list_category(){
		return $this->db->get('tbl_kategori')->result();
	}

	public function kategoribyidkategori($id){
		$this->db->where('KategoriID',$id);
        $query = $this->db->get('tbl_kategori');
        return $query->row();
	}

	public function tambahcategory($data){
		$this->db->insert('tbl_kategori',$data);
	}
	public function editkategoribyid($data){
        $this->db->where('KategoriID', $data['KategoriID']);
		$this->db->update('tbl_kategori',$data);
	}
	public function deleteKategori($kategoriID) {
        // Implement your database delete logic here
        $this->db->delete('tbl_kategori', array('KategoriID' => $kategoriID));
        
        // For demonstration purposes, let's assume the deletion is successful
        return true;
    }

	//toko
	public function profil_toko(){
		return $this->db->get('tbl_toko')->row();
	}

	//laporan
	public function list_laporan(){
		return $this->db->get('tbl_keranjang')->result();
	}

	public function getdetaillaporanbyid($id){
		$this->db->where('PenjualanID',$id);
        $query = $this->db->get('tbl_transaksi');
        return $query->row();
	}
	
	public function getdetaillaporanbynomor($transaction_number){
		$this->db->where('PenjualanID',$transaction_number);
        $query = $this->db->get('tbl_transaksi');
        return $query->row();
	}

    public function get_total_harga_per_bulan() {
        // Mengambil total harga transaksi berdasarkan bulan
        $this->db->select("DATE_FORMAT(TanggalPenjualan,'%Y-%m') AS bulan, SUM(TotalHarga) AS total_harga");
        $this->db->group_by("DATE_FORMAT(TanggalPenjualan,'%Y-%m')");
        $query = $this->db->get('tbl_transaksi');
        return $query->result_array();
    }

	//keranjang 
	public function keranjangpelanggan($data){
		$this->db->insert('tbl_keranjang',$data);
	}
	
    public function getDataForEdit($detailID) {
        // Lakukan query ke database atau logika lainnya untuk mendapatkan data
        // Gantilah dengan logika sesuai dengan struktur database Anda
        $query = $this->db->get_where('tbl_keranjang', array('DetailID' => $detailID));

        // Kembalikan hasil query
        return $query->row();
    }

	public function updateKeranjang($detailID, $jumlahProdukBaru, $totalHarga) {
		// Lakukan query ke database atau logika lainnya untuk menyimpan perubahan
		// Gantilah dengan logika sesuai dengan struktur database Anda
		$data = array(
			'JumlahProduk' => $jumlahProdukBaru,
			'Subtotal' => $totalHarga
		);
	
		$this->db->where('DetailID', $detailID);
		$this->db->update('tbl_keranjang', $data);
	}

	public function getDataByTransactionID($transaction_number) {
        // Lakukan query ke database atau logika lainnya untuk mendapatkan data
        // Gantilah dengan logika sesuai dengan struktur database Anda
        $query = $this->db->get_where('tbl_keranjang', array('PenjualanID' => $transaction_number));

        // Kembalikan hasil query dalam bentuk array
        return $query->result();
    }

	public function getKeranjangByID($keranjangID) {
        // Lakukan query ke database atau logika lainnya untuk mendapatkan data
        // Gantilah dengan logika sesuai dengan struktur database Anda
        $query = $this->db->get_where('tbl_keranjang', array('DetailID' => $keranjangID));

        // Kembalikan hasil query dalam bentuk array
        return $query->row();
    }

	public function deletekeranjang($keranjangID) {
        // Implement your database delete logic here
        $this->db->delete('tbl_keranjang', array('DetailID' => $keranjangID));
        
        // For demonstration purposes, let's assume the deletion is successful
        return true;
    }

	//riwayat transaksi
	public function list_transaksi(){
		return $this->db->get('tbl_transaksi')->result();
	}
	
	public function tambahtransaksi($data){
		$this->db->insert('tbl_transaksi',$data);
	}
}