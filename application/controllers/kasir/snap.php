<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-pQW7s2MPyL2NH9oRO7JiGRal', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');	
        $this->load->model('Kasir_Model');
    }

    public function index()
    {
    	$this->load->view('kasir/checkout_snap');
    }

    public function token()
    {
		$transaction_number = $this->input->post('transaksiID');
		$grandtotal = $this->input->post('grandtotal');
        $keranjang = $this->Kasir_Model->getDataByTransactionID($transaction_number);
        $id = $this->input->post('id');


		$customer = $this->Kasir_Model->customerbyid($id);
		// Required
		$transaction_details = array(
		  'order_id' => rand(),
		  'gross_amount' => $grandtotal, // no decimal allowed for creditcard
		);

		//v2
		$items = array(); // Array untuk menyimpan detail item

		foreach ($keranjang as $item) {
			$produk =  $this->Kasir_Model->produkbyid($item->ProdukID);
			// Membuat detail item
			$item_details = array(
				'id' => $item->ProdukID, // Ganti dengan kolom yang sesuai dari hasil model
				'price' => $produk->HargaJual, // Ganti dengan kolom yang sesuai dari hasil model
				'quantity' => $item->JumlahProduk, // Ganti dengan kolom yang sesuai dari hasil model
				'name' => $produk->NamaProduk // Ganti dengan kolom yang sesuai dari hasil model
			);
		
			// Menambahkan detail item ke dalam array items
			$items[] = $item_details;
		}
		
		// Optional
		$item_details = $items;
		// Optional
		// $item1_details = array(
		//   'id' => 'a1',
		//   'price' => 18000,
		//   'quantity' => 3,
		//   'name' => "Apple"
		// );

		// Optional
		// $item2_details = array(
		//   'id' => 'a2',
		//   'price' => 20000,
		//   'quantity' => 2,
		//   'name' => "Orange"
		// );

		// Optional
		//$item_details = array ($item1_details, $item2_details);

		// Optional
		$billing_address = array(
		  'first_name'    => $customer->NamaPelanggan,
		  'address'       => $customer->AlamatJalan . ' , ' . $customer->AlamatKabupatenKota . ' , '. $customer->AlamatProvinsi . ' , ' . $customer->AlamatKodePos ,
		  'country_code'  => 'IDN'
		);

		// Optional
		$shipping_address = array(
		  'first_name'    => "Obet",
		  'last_name'     => "Supriadi",
		  'address'       => "Manggis 90",
		  'city'          => "Jakarta",
		  'postal_code'   => "16601",
		  'phone'         => "08113366345",
		  'country_code'  => 'IDN'
		);

		// Optional
		$customer_details = array(
		  'first_name'    => $customer->NamaPelanggan,
		  'phone'         => $customer->NomorTelepon,
		  'billing_address'  => $billing_address,
		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'minute', 
            'duration'  => 3
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
    }

    public function finish()
    {
    	$result = json_decode($this->input->post('result_data'));
    	echo 'RESULT <br><pre>';
    	var_dump($result);
    	echo '</pre>' ;
		
        $transaction_number = $this->input->post('transactionNumber2');
        $penjualanid = str_replace('POS-', '', $transaction_number);
        $data = [
            'PenjualanID' => $penjualanid,
            'TanggalPenjualan' => $this->input->post('transactionDate2'),
            'TotalPengeluaran' => $this->input->post('totalpengeluaran'),
            'NamaKasir' => $this->input->post('namakasir'),
            'TotalHarga' => $this->input->post('grandTotal'),
            'PelangganID' => $this->input->post('idpelanggan2')
        ];
		
        $this->Kasir_Model->tambahtransaksi($data);
		
        // $data['data_toko'] = $this->Kasir_Model->profil_toko();
        // $data['data_laporan'] = $this->Kasir_Model->getdetaillaporanbyid($id);
        // //info kasir
        // $data['data_kasir'] = $this->Kasir_Model->datakasir($id);
        // $this->load->view('kasir/struk',$data);

        $data['data_toko'] = $this->Kasir_Model->profil_toko();
		$id_penjualan = $transaction_number;
        $data['data_laporan'] = $this->Kasir_Model->getdetaillaporanbynomor($transaction_number);
   		// Tampilkan view modal dengan struk
   		$this->load->view('kasir/struk', $data);

   		// Tambahkan skrip JavaScript untuk menampilkan modal saat halaman dimuat
   		echo '<script>
   		          // Tunggu sampai halaman dimuat sepenuhnya
   		          document.addEventListener("DOMContentLoaded", function() {
   		              // Tampilkan modal di sini
   		              // Misalnya, Anda dapat menggunakan JavaScript murni untuk menampilkan modal
					  $("#strukModal").html(response).css("display", "flex");
   		              // Gantilah #myModal dengan ID modal Anda

   		              // Delay sebelum redirect (misalnya 3 detik)
   		              setTimeout(function() {
   		                  // Lakukan redirect
   		                  window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";
   		              }, 3000); // Waktu dalam milidetik (3000 milidetik = 3 detik)
   		          });
   		      </script>';
    }
}
