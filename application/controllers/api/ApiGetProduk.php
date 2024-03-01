<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/RestController.php';
use  chriskacerguis\RestServer\RestController;

class ApiGetProduk extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Api_Produk_Model');
    }

    public function index_get()
    {
       $Api_Produk_Model = new Api_Produk_Model;

       $result_produk = $Api_Produk_Model->get_produk();
         // Load the view and pass the API data
        //$data['api_data'] = $result_produk;  // Load the view and pass the API data
        $this->response($result_produk,200);
        $this->load->view('produk', ['api_data' => $result_produk]);
    }

    public function postproduk_post()
    {
        $Api_Produk_Model = new Api_Produk_Model;
        $data = [
            'NamaProduk' => $this->input->post('NamaProduk'),
            'KategoriID' => $this->input->post('KategoriID'),
            'HargaProduk' => $this->input->post('HargaProduk'),
            'Stok' => $this->input->post('Stok'),
        ];

       $result_add = $Api_Produk_Model->add_produk($data);
       $this->response($data,200);
       if($result_add > 0)
       {
            $this->response(
                [
                    'status' => true,
                    'message' => 'Porduk Baru Telah Ditambahkan'
                ], RestController:HTTP_OK
                );
       }else{
            $this->response(
                [
                    'status' => false,
                    'message' => 'Porduk Baru Gagal Ditambahkan'
                ], RestController:HTTP_BAD_REQUEST
                );
       }
    }

    public function getupdateproduk_get($id)
    {
        
       $Api_Produk_Model = new Api_Produk_Model;

       $result_produk = $Api_Produk_Model->get_produk_byid($id);
       $this->response($result_produk,200);
    }
    
    public function updateproduk_put($id)
    {
        $Api_Produk_Model = new Api_Produk_Model;
        $data = [
            'NamaProduk' => $this->put('NamaProduk'),
            'KategoriID' => $this->put('KategoriID'),
            'HargaProduk' => $this->put('HargaProduk'),
            'Stok' => $this->put('Stok'),
        ];

       $result_update = $Api_Produk_Model->update_produk_byid($id,$data);
       $this->response($data,200);
       if($result_update > 0)
       {
            $this->response(
                [
                    'status' => true,
                    'message' => 'Porduk Baru Telah Diupdate'
                ], RestController:HTTP_OK
                );
       }else{
            $this->response(
                [
                    'status' => false,
                    'message' => 'Porduk Baru Gagal Diupdate'
                ], RestController:HTTP_BAD_REQUEST
                );
       }
    }

    public function deleteproduk_delete($id)
    {
        $Api_Produk_Model = new Api_Produk_Model;

        $result_delete = $Api_Produk_Model->delete_produk_byid($id);
        $this->response($result_delete,200);
    }

    // public function listproduk()
    // {
    //     $result_produk = $Api_Produk_Model->get_produk();
    //      // Load the view and pass the API data
    //     $data['api_data'] = $result_produk;
    //     $this->load->view('produk',$data);
    // }

}