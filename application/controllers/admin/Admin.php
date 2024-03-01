<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_Model');
        $this->load->library('session');
        $this->load->helper('url');
        // Periksa apakah pengguna sudah login
        if (!$this->session->userdata('logged_in')) {
            // Jika belum login, redirect ke halaman login
            redirect('user/login/');
        }
    }
    public function index($id)
    {
        // Ambil data harga dari model Transaksi_model
        $data_transaksi = $this->Admin_Model->get_total_harga_per_bulan();

        // Mendefinisikan array untuk menyimpan data label dan data harga
        $labels = array();
        $data = array();

        // Memproses data transaksi untuk dimasukkan ke dalam array label dan data
        foreach ($data_transaksi as $transaksi) {
            $labels[] = date('F Y', strtotime($transaksi['bulan'])); // Mengubah format bulan
            $data[] = $transaksi['total_harga'];
        }

        // Kirim data ke view
        $data['chartData'] = array(
            'labels' => $labels,
            'data' => $data
        );

        //info admin
        $data['data_admin'] = $this->Admin_Model->dataadmin($id);
        //year
        $data['current_year'] = date('Y');
        //jumlah toko
        $data['total_toko'] = $this->Admin_Model->jumlah_toko();
        //jumlah barang
        $data['total_barang'] = $this->Admin_Model->jumlah_barang();
        //jumlah kasir
        $data['total_kasir'] = $this->Admin_Model->jumlah_kasir();
        //jumlah kasir
        $data['total_pelanggan'] = $this->Admin_Model->jumlah_pelanggan();
        // jumlah stok
        $data['total_stock'] = $this->Admin_Model->calculate_total_stock();
        // jumlah terjual barang
        $data['total_terjual'] = $this->Admin_Model->calculate_sold_product();

        $this->load->view('admin/dashboard',$data);
    }

    //akun
    public function akun($id)
    {
        //year
        $data['current_year'] = date('Y');
        //info admin
        $data['data_admin'] = $this->Admin_Model->dataadmin($id);
        $this->load->view('admin/akun',$data);
    }

    public function editmodalakun($id){
        $data['data_admin']= $this->Admin_Model->dataadmin($id);
        $this->load->view('admin/modal/editmodalakun',$data);
    }

    public function editmodalakuntoko($id){
        $data['data_toko']= $this->Admin_Model->datatoko($id);
        $this->load->view('admin/modal/editmodalakuntoko',$data);
    }

    public function editakun()
    {
        $data = [
            'UserID' => $this->input->post('id'),
            'NamaUser' => $this->input->post('nama'),
            'Email' => $this->input->post('email'),
            'AlamatJalan' => $this->input->post('jalan'),
            'AlamatKelurahan' => $this->input->post('kelurahan'),
            'AlamatKecamatan' => $this->input->post('kecamatan'),
            'AlamatKabupatenKota' => $this->input->post('kabupatenkota'),
            'AlamatProvinsi' => $this->input->post('provinsi'),
            'AlamatKodePos' => $this->input->post('kodepos'),
            'NomorTelepon' => $this->input->post('telp')
        ];
        $this->Admin_Model->editakunbyid($data);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function editakuntoko()
    {
        $data = [
            'TokoID' => $this->input->post('id'),
            'NamaToko' => $this->input->post('nama'),
            'DeskripsiToko' => $this->input->post('deskripsi'),
            'AlamatJalan' => $this->input->post('jalan'),
            'AlamatKelurahan' => $this->input->post('kelurahan'),
            'AlamatKecamatan' => $this->input->post('kecamatan'),
            'AlamatKabupatenKota' => $this->input->post('kabupatenkota'),
            'AlamatProvinsi' => $this->input->post('provinsi'),
            'AlamatKodePos' => $this->input->post('kodepos'),
            'NomorTelepon' => $this->input->post('telp')
        ];
        $this->Admin_Model->editokobyid($data);
        redirect($_SERVER['HTTP_REFERER']);
    }

    //customer
    public function kasirpelanggan($id)
    {
        //info admin
        $data['data_admin'] = $this->Admin_Model->dataadmin($id);
        $data['list_pelanggan'] = $this->Admin_Model->list_customer();
        $data['list_kasir'] = $this->Admin_Model->list_kasir();
        //year
        $data['current_year'] = date('Y');
        $this->load->view('admin/kasirpelanggan',$data);
    }

    public function tambahpelanggan()
    {
        $data = [
            'PelangganID' => $this->input->post('id'),
            'NamaPelanggan' => $this->input->post('namacustomer'),
            'AlamatJalan' => $this->input->post('jalan'),
            'AlamatKelurahan' => $this->input->post('kelurahan'),
            'AlamatKecamatan' => $this->input->post('kecamatan'),
            'AlamatKabupatenKota' => $this->input->post('kabupatenkota'),
            'AlamatProvinsi' => $this->input->post('provinsi'),
            'AlamatKodePos' => $this->input->post('kodepos'),
            'NomorTelepon' => $this->input->post('nomortelepon')
        ];
        $this->Admin_Model->tambahcustomer($data);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function editmodal($id){
        $data['datacustomerbyid']= $this->Admin_Model->customerbyid($id);
        $this->load->view('admin/modal/editmodal',$data);
    }

    public function editcustomer()
    {
        $data = [
            'PelangganID' => $this->input->post('id'),
            'NamaPelanggan' => $this->input->post('namapelanggan'),
            'AlamatJalan' => $this->input->post('jalan'),
            'AlamatKelurahan' => $this->input->post('kelurahan'),
            'AlamatKecamatan' => $this->input->post('kecamatan'),
            'AlamatKabupatenKota' => $this->input->post('kabupatenkota'),
            'AlamatProvinsi' => $this->input->post('provinsi'),
            'AlamatKodePos' => $this->input->post('kodepos'),
            'NomorTelepon' => $this->input->post('nomortelepon')
        ];
        $this->Admin_Model->editcustomerbyid($data);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function deleteCustomer() 
    {
        // Check if the request is an AJAX request
        if ($this->input->is_ajax_request()) {
            
            // Get the customer ID from the AJAX POST data
            $customerId = $this->input->post('id');
            
            // Attempt to delete the customer
            $deleted = $this->Admin_Model->deleteCustomer($customerId);

            // Return a JSON response based on the deletion result
            if ($deleted) {
                $response = array('success' => true, 'message' => 'Customer deleted successfully');
            } else {
                $response = array('success' => false, 'message' => 'Error deleting customer');
            }

            // Send the JSON response back to the client
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
        } else {
            // Handle non-AJAX requests
            show_404();
        }
    }

    //kasir
    public function tambahkasir()
    {
        $data = [
            'NamaUser' => $this->input->post('namakasir'),
            'Email' => $this->input->post('email'),
            'Role' => $this->input->post('role'),
            'Password' => $this->input->post('sandi'),
            'AlamatJalan' => $this->input->post('jalan'),
            'AlamatKelurahan' => $this->input->post('kelurahan'),
            'AlamatKecamatan' => $this->input->post('kecamatan'),
            'AlamatKabupatenKota' => $this->input->post('kabupatenkota'),
            'AlamatProvinsi' => $this->input->post('provinsi'),
            'AlamatKodePos' => $this->input->post('kodepos'),
            'NomorTelepon' => $this->input->post('nomortelepon')
        ];
        $this->Admin_Model->tambahkasir($data);
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function editmodalkasir($id){
        $data['datakasirbyid']= $this->Admin_Model->kasirbyid($id);
        $this->load->view('admin/modal/editmodalkasir',$data);
    }

    public function editkasir()
    {
        $data = [
            'NamaUser' => $this->input->post('namakasir'),
            'UserID' => $this->input->post('id'),
            'AlamatJalan' => $this->input->post('jalan'),
            'AlamatKelurahan' => $this->input->post('kelurahan'),
            'AlamatKecamatan' => $this->input->post('kecamatan'),
            'AlamatKabupatenKota' => $this->input->post('kabupatenkota'),
            'AlamatProvinsi' => $this->input->post('provinsi'),
            'AlamatKodePos' => $this->input->post('kodepos'),
            'NomorTelepon' => $this->input->post('nomortelepon')
        ];
        $this->Admin_Model->editkasirbyid($data);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function deleteKasir() 
    {
        // Check if the request is an AJAX request
        if ($this->input->is_ajax_request()) {
            
            // Get the customer ID from the AJAX POST data
            $id = $this->input->post('id');
            
            // Attempt to delete the customer
            $deleted = $this->Admin_Model->deleteKasir($id);

            // Return a JSON response based on the deletion result
            if ($deleted) {
                $response = array('success' => true, 'message' => 'Customer deleted successfully');
            } else {
                $response = array('success' => false, 'message' => 'Error deleting customer');
            }

            // Send the JSON response back to the client
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
        } else {
            // Handle non-AJAX requests
            show_404();
        }
    }
    //produk
    public function produk($id)
    {
        $data['list_produk'] = $this->Admin_Model->list_produk();
        //info admin
        $data['data_admin'] = $this->Admin_Model->dataadmin($id);
        //year
        $data['current_year'] = date('Y');
        $data['list_kategori'] = $this->Admin_Model->list_category();
        $this->load->view('admin/items.php',$data);
    }
    
    public function tambahproduk()
    {
        $data = [
            'NamaProduk' => $this->input->post('namaproduk'),
            'KategoriID' => $this->input->post('kategori'),
            'Stok' => $this->input->post('stok'),
            'HargaBeli' => $this->input->post('hargabeli'),
            'Diskon' => $this->input->post('diskon'),
            'TanggalAktifDiskon' => $this->input->post('tglaktif'),
            'TanggalExpiredDiskon' => $this->input->post('tglexprd'),
            'HargaJual' => $this->input->post('hargajual')
        ];
        $this->Admin_Model->tambahproduct($data);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function editmodalproduk($id)
    {
        $data['dataprodukbyid'] = $this->Admin_Model->produkbyid($id);
        $data['list_kategori'] = $this->Admin_Model->list_category();
        $this->load->view('admin/modal/editmodalproduk',$data);
    }

    public function editproduk()
    {
        $stoksekarang = $this->input->post('stok');
        $stoktambah = $this->input->post('stoktambahan');
        
        // Periksa apakah $stoktambah adalah 0 atau kosong
        if ($stoktambah !== null && $stoktambah !== '') {
            $finalstok = $stoksekarang + $stoktambah;
        } else {
            $finalstok = $stoksekarang;
        }
        
        $data = [
            'ProdukID' => $this->input->post('id'),
            'KategoriID' => $this->input->post('kategori'),
            'NamaProduk' => $this->input->post('namaproduk'),
            'Stok' => $finalstok,
            'HargaBeli' => $this->input->post('hargabeli'),
            'Diskon' => $this->input->post('diskon'),
            'TanggalAktifDiskon' => $this->input->post('tglaktif'),
            'TanggalExpiredDiskon' => $this->input->post('tglexprd'),
            'HargaJual' => $this->input->post('hargajual')
        ];
        $this->Admin_Model->editprodukbyid($data);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function deleteproduk()
    {
        // Check if the request is an AJAX request
        if ($this->input->is_ajax_request()) {
            
            // Get the customer ID from the AJAX POST data
            $produkId = $this->input->post('id');
            
            // Attempt to delete the customer
            $deleted = $this->Admin_Model->deleteProduk($produkId);

            // Return a JSON response based on the deletion result
            if ($deleted) {
                $response = array('success' => true, 'message' => 'Customer deleted successfully');
            } else {
                $response = array('success' => false, 'message' => 'Error deleting customer');
            }

            // Send the JSON response back to the client
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
        } else {
            // Handle non-AJAX requests
            show_404();
        }
    }

    //kategori
    public function kategori($id)
    {
        //info admin
        $data['data_admin'] = $this->Admin_Model->dataadmin($id);
        //year
        $data['current_year'] = date('Y');
        $data['list_kategori'] = $this->Admin_Model->list_category();
        $this->load->view('admin/kategori.php',$data);
    }

    public function tambahkategori()
    {
        $data = [
            'NamaKategori' => $this->input->post('nama'),
            'DeskripsiKategori' => $this->input->post('deskripsi')
        ];
        $this->Admin_Model->tambahcategory($data);
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function editmodalkategori($id){
        $data['data_kategori']= $this->Admin_Model->kategoribyidkategori($id);
        $this->load->view('admin/modal/editmodalkategori',$data);
    }

    public function editkategori()
    {
        $data = [
            'KategoriID' => $this->input->post('id'),
            'NamaKategori' => $this->input->post('nama'),
            'DeskripsiKategori' => $this->input->post('deskripsi')
        ];
        $this->Admin_Model->editkategoribyid($data);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function deletekategori()
    {
        // Check if the request is an AJAX request
        if ($this->input->is_ajax_request()) {
            
            // Get the customer ID from the AJAX POST data
            $kategoriID = $this->input->post('id');
            
            // Attempt to delete the customer
            $deleted = $this->Admin_Model->deleteKategori($kategoriID);

            // Return a JSON response based on the deletion result
            if ($deleted) {
                $response = array('success' => true, 'message' => 'Customer deleted successfully');
            } else {
                $response = array('success' => false, 'message' => 'Error deleting customer');
            }

            // Send the JSON response back to the client
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
        } else {
            // Handle non-AJAX requests
            show_404();
        }
    }
    
    //Toko
    public function toko($id)
    {
        $data['data_toko'] = $this->Admin_Model->profil_toko();
        //info admin
        $data['data_admin'] = $this->Admin_Model->dataadmin($id);
        //year
        $data['current_year'] = date('Y');
        $this->load->view('admin/toko',$data);
    }

    //Laporan Penjualan
    public function penjualan($id)
    {
        // Ambil data harga dari model Transaksi_model
        $data_transaksi = $this->Admin_Model->get_total_harga_per_bulan();

        // Mendefinisikan array untuk menyimpan data label dan data harga
        $labels = array();
        $data = array();

        // Memproses data transaksi untuk dimasukkan ke dalam array label dan data
        foreach ($data_transaksi as $transaksi) {
            $labels[] = date('F Y', strtotime($transaksi['bulan'])); // Mengubah format bulan
            $data[] = $transaksi['total_harga'];
        }

        // Kirim data ke view
        $data['chartData'] = array(
            'labels' => $labels,
            'data' => $data
        );
        $data['data_laporan'] = $this->Admin_Model->list_laporan();
        //info admin
        $data['data_admin'] = $this->Admin_Model->dataadmin($id);
        //year
        $data['current_year'] = date('Y');
        $this->load->view('admin/laporan',$data);
    }

    //Riwayat Transaksi
    public function riwayatTransaksi($id)
    {
        $data['data_laporan'] = $this->Admin_Model->list_transaksi();
        //info kasir
        $data['data_admin'] = $this->Admin_Model->dataadmin($id);
        //year
        $data['current_year'] = date('Y');
        $this->load->view('admin/riwayat',$data);
    }

    public function editTransaksi($id)
    {
        $data['list_pelanggan'] = $this->Admin_Model->list_customer();
        $data['list_produk'] = $this->Admin_Model->list_produk();
        $data['data_laporan'] = $this->Admin_Model->getdetaillaporanbyid($id);
        $data['detail'] = $this->Admin_Model->getDataByTransactionID($id);
        $this->load->view('admin/edittransaksi',$data);
    }
    
    public function deletetransaksi()
    {
        // Check if the request is an AJAX request
        if ($this->input->is_ajax_request()) {
            
            // Get the customer ID from the AJAX POST data
            $transaksiID = $this->input->post('id');
            
            // Attempt to delete the customer
            $deleted = $this->Admin_Model->deleteTransaksi($transaksiID);

            // Return a JSON response based on the deletion result
            if ($deleted) {
                $response = array('success' => true, 'message' => 'Customer deleted successfully');
            } else {
                $response = array('success' => false, 'message' => 'Error deleting customer');
            }

            // Send the JSON response back to the client
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
        } else {
            // Handle non-AJAX requests
            show_404();
        }
    }
    //struk
    public function struk($id)
    {
        $data['data_toko'] = $this->Admin_Model->profil_toko();
        $data['data_laporan'] = $this->Admin_Model->getdetaillaporanbyid($id);
        //info kasir
        $data['data_admin'] = $this->Admin_Model->dataadmin($id);
        //year
        $data['current_year'] = date('Y');
        $this->load->view('admin/struk',$data);
    }
}