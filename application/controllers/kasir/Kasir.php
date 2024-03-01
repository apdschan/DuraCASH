<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kasir_Model');
        $params = array('server_key' => 'SB-Mid-server-pQW7s2MPyL2NH9oRO7JiGRal', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
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
        $data_transaksi = $this->Kasir_Model->get_total_harga_per_bulan();

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
        //info kasir
        $data['data_kasir'] = $this->Kasir_Model->datakasir($id);
        //year
        $data['current_year'] = date('Y');
        //jumlah toko
        $data['total_toko'] = $this->Kasir_Model->jumlah_toko();
        //jumlah barang
        $data['total_barang'] = $this->Kasir_Model->jumlah_barang();
        //jumlah kasir
        $data['total_kasir'] = $this->Kasir_Model->jumlah_kasir();
        // jumlah stok
        $data['total_stock'] = $this->Kasir_Model->calculate_total_stock();
        // jumlah terjual barang
        $data['total_terjual'] = $this->Kasir_Model->calculate_sold_product();

        $this->load->view('kasir/dashboard',$data);
    }
    
    //akun
    public function akun($id)
    {
        //year
        $data['current_year'] = date('Y');
        //info admin
        $data['data_kasir'] = $this->Kasir_Model->datakasir($id);
        $this->load->view('kasir/akun',$data);
    }

    public function editmodalakun($id){
        $data['data_kasir'] = $this->Kasir_Model->datakasir($id);
        $this->load->view('kasir/modal/editmodalakun',$data);
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
        $this->Kasir_Model->editakunbyid($data);
        redirect($_SERVER['HTTP_REFERER']);
    }

    //customer
    public function customer($id)
    {
        //info kasir
        $data['data_kasir'] = $this->Kasir_Model->datakasir($id);
        $data['list_pelanggan'] = $this->Kasir_Model->list_customer();
        $this->load->view('kasir/customer',$data);
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
        $this->Kasir_Model->tambahcustomer($data);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function editmodal($id){
        $data['datacustomerbyid']= $this->Kasir_Model->customerbyid($id);
        $this->load->view('kasir/modal/editmodal',$data);
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
        $this->Kasir_Model->editcustomerbyid($data);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function deleteCustomer() 
    {
        // Check if the request is an AJAX request
        if ($this->input->is_ajax_request()) {
            
            // Get the customer ID from the AJAX POST data
            $customerId = $this->input->post('id');
            
            // Attempt to delete the customer
            $deleted = $this->Kasir_Model->deleteCustomer($customerId);

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
        $data['list_produk'] = $this->Kasir_Model->list_produk();
        //info kasir
        $data['data_kasir'] = $this->Kasir_Model->datakasir($id);
        //year
        $data['current_year'] = date('Y');
        $data['list_kategori'] = $this->Kasir_Model->list_category();
        $this->load->view('kasir/items.php',$data);
    }
    
    public function list_produk_js()
    {
        // Mendapatkan semua produk dari model
        $product = $this->Kasir_Model->list_produk();

        // Mengirimkan data produk dalam format JSON sebagai respons
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($product));
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
        $this->Kasir_Model->tambahproduct($data);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function editmodalproduk($id)
    {
        $data['dataprodukbyid'] = $this->Kasir_Model->produkbyid($id);
        $data['list_kategori'] = $this->Kasir_Model->list_category();
        $this->load->view('kasir/modal/editmodalproduk',$data);
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
        $this->Kasir_Model->editprodukbyid($data);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function deleteproduk()
    {
        // Check if the request is an AJAX request
        if ($this->input->is_ajax_request()) {
            
            // Get the customer ID from the AJAX POST data
            $produkId = $this->input->post('id');
            
            // Attempt to delete the customer
            $deleted = $this->Kasir_Model->deleteProduk($produkId);

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
        //info kasir
        $data['data_kasir'] = $this->Kasir_Model->datakasir($id);
        //year
        $data['current_year'] = date('Y');
        $data['list_kategori'] = $this->Kasir_Model->list_category();
        $this->load->view('kasir/kategori.php',$data);
    }

    public function tambahkategori()
    {
        $data = [
            'NamaKategori' => $this->input->post('nama'),
            'DeskripsiKategori' => $this->input->post('deskripsi')
        ];
        $this->Kasir_Model->tambahcategory($data);
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function editmodalkategori($id){
        $data['data_kategori']= $this->Kasir_Model->kategoribyidkategori($id);
        $this->load->view('kasir/modal/editmodalkategori',$data);
    }

    public function editkategori()
    {
        $data = [
            'KategoriID' => $this->input->post('id'),
            'NamaKategori' => $this->input->post('nama'),
            'DeskripsiKategori' => $this->input->post('deskripsi')
        ];
        $this->Kasir_Model->editkategoribyid($data);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function deletekategori()
    {
        // Check if the request is an AJAX request
        if ($this->input->is_ajax_request()) {
            
            // Get the customer ID from the AJAX POST data
            $kategoriID = $this->input->post('id');
            
            // Attempt to delete the customer
            $deleted = $this->Kasir_Model->deleteKategori($kategoriID);

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
        $data['data_toko'] = $this->Kasir_Model->profil_toko();
        //info kasir
        $data['data_kasir'] = $this->Kasir_Model->datakasir($id);
        //year
        $data['current_year'] = date('Y');
        $this->load->view('kasir/toko',$data);
    }

    //Laporan Penjualan
    public function penjualan($id)
    {
        // Ambil data harga dari model Transaksi_model
        $data_transaksi = $this->Kasir_Model->get_total_harga_per_bulan();

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

        $data['data_laporan'] = $this->Kasir_Model->list_laporan();
        //info kasir
        $data['data_kasir'] = $this->Kasir_Model->datakasir($id);
        //year
        $data['current_year'] = date('Y');
        $this->load->view('kasir/laporan',$data);
    }
    
    //transaksi
    public function transaksi($id)
    {
        $data['list_pelanggan'] = $this->Kasir_Model->list_customer();
        $data['list_produk'] = $this->Kasir_Model->list_produk();
        //info kasir
        $data['data_kasir'] = $this->Kasir_Model->datakasir($id);
        //year
        $data['current_year'] = date('Y');
        $this->load->view('kasir/transaksi',$data);
    }
    
    public function tambahkeranjang() 
    {
        $detailID = $this->input->post('detailID');
        $pelangganID = $this->input->post('pelangganID');
        $transactionID = $this->input->post('transactionID');
        $this->session->set_userdata('pelangganID', $pelangganID);
        $produkID = $this->input->post('produkID');
        $this->session->set_userdata('pelangganID', $produkID);
    
        // Cek apakah pelangganID dan produkID sudah ada
        if (!empty($pelangganID) && !empty($produkID)) {
            // Data lengkap, lanjutkan dengan penambahan ke keranjang
            $data = [
                'DetailID' => $detailID,
                'PelangganID' => $pelangganID,
                'ProdukID' => $produkID,
                'PenjualanID' => $transactionID
            ];
    
            $this->Kasir_Model->keranjangpelanggan($data);
    
            // Tambahkan respons atau pengembalian sesuai kebutuhan
            echo "Data berhasil ditambahkan ke keranjang";
        } else {
            // Data tidak lengkap, berikan pesan atau lakukan tindakan lainnya
            echo "PelangganID dan/atau ProdukID tidak lengkap";
        }
    }

    public function editmodalkeranjang($detailID) 
    {
        $data['datakeranjang'] = $this->Kasir_Model->getDataForEdit($detailID);

        // Tampilkan view untuk modal edit
        $this->load->view('kasir/modal/editkeranjang', $data);
    }

    public function updatekeranjang() 
    {
        // Ambil data dari POST request
        $detailID = $this->input->post('detailID');
        $produkID = $this->input->post('produkID');
        $jumlahProdukLama = $this->input->post('jumlahProdukLama');
        $jumlahProdukBaru = $this->input->post('jumlahProdukBaru');
        $totalHarga = $this->input->post('totalHarga');
    
        // Panggil model untuk menyimpan perubahan
        $this->Kasir_Model->updateKeranjang($detailID, $jumlahProdukBaru, $totalHarga);
        $this->Kasir_Model->kurangiJumlahProduk($produkID, $jumlahProdukLama,$jumlahProdukBaru);
    
        // Respon sukses atau gagal sesuai kebutuhan
        // Misalnya, bisa mengembalikan JSON response
        $response = array('success' => true);
        echo json_encode($response);
    }

    
    public function updatejumlahproduk() 
    {
        $produkID = $this->input->post('produkID');
        $jumlahProduk = $this->input->post('jumlahProduk');
        $this->Kasir_Model->kurangiJumlahProduk($produkID, $jumlahProduk);
    
        // Respon sukses atau gagal sesuai kebutuhan
        // Misalnya, bisa mengembalikan JSON response
        $response = array('success' => true);
        echo json_encode($response);
    }
    
    public function getdatabytransactionid() 
    {
        // Ambil ID transaksi dari input
        $transaction_number = $this->input->get('transaction_number');
        $transaction_number = str_replace('POS-', '', $transaction_number);
        $data = $this->Kasir_Model->getDataByTransactionID($transaction_number);
        echo json_encode($data);
    }

    public function deleteKeranjang()
    {
        // Check if the request is an AJAX request
        if ($this->input->is_ajax_request()) {
            
            // Get the customer ID from the AJAX POST data
            $keranjangID = $this->input->post('id');
            
            $keranjang = $this->Kasir_Model->getKeranjangByID($keranjangID);
            $produkID = $keranjang->ProdukID;
            $stok = $keranjang->JumlahProduk;
            $this->Kasir_Model->KembalikanStokProduk($produkID,$stok);

            // Attempt to delete the customer
            $deleted = $this->Kasir_Model->deletekeranjang($keranjangID);
            
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

    //Riwayat Transaksi
    public function riwayatTransaksi($id)
    {
        $data['data_laporan'] = $this->Kasir_Model->list_transaksi();
        //info kasir
        $data['data_kasir'] = $this->Kasir_Model->datakasir($id);
        //year
        $data['current_year'] = date('Y');
        $this->load->view('kasir/riwayat',$data);
    }

    //struk
    public function struk($id)
    {
        $data['data_toko'] = $this->Kasir_Model->profil_toko();
        $data['data_laporan'] = $this->Kasir_Model->getdetaillaporanbyid($id);
        //info kasir
        $data['data_kasir'] = $this->Kasir_Model->datakasir($id);
        //year
        $data['current_year'] = date('Y');
        $this->load->view('kasir/struk',$data);
    }
}