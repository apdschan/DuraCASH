<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_Model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        //$this->Login_Model->autenthuification();
        $this->load->view('user/login');
    }

    public function register()
    {
        $this->load->view('user/register');
    }
    public function register_user_baru()
    {
        $data = [
            'NamaUser' => $this->input->post('username'),
            'Email' => $this->input->post('email'),
            'Telepon' => $this->input->post('phone'),
            'Password' => $this->input->post('password'),
        ];
        $this->Login_Model->register_user($data);
        $this->load->view('user/login');
    }

    public function autentifikasi() {   
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->Login_Model->autentifikasiuser($username, $password);

        if ($this->Login_Model->autentifikasiuser($username, $password)) {
            // Authentication successful, redirect to dashboard or desired page
			    // Set session logged_in sebagai tanda bahwa pengguna sudah login
                if ($user->Role == 1){
                    $this->session->set_userdata('logged_in', true);
                    redirect("admin/dashboard/$user->UserID");
                }else {
                    $this->session->set_userdata('logged_in', true);
                    redirect("kasir/dashboard/$user->UserID");
                };
			// echo "benar";
        } else {
            // Authentication failed, redirect back to login page with an error message
            // $data['error'] = 'Invalid username or password';
            // $this->load->view('login_form', $data);
			$this->session->set_flashdata('error', 'Mohon Masukkan Username dan Password Yang Benar');
			redirect('user/login/');
			// echo "salah";
        }
    }

    public function logout() {
        // Destroy user session
        $this->session->sess_destroy();

        // Redirect to the login page or any other desired page
        redirect(base_url("user/login"));
    }
    
}