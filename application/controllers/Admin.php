<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$this->load->view('admin/index');
	}

	public function home()
	{
		if($this->session->userdata('status') != "login"){
			redirect('Admin');
		}
		$this->load->view('admin/home');
	}

	public function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
		$this->load->model('m_admin');
		$cek = $this->m_admin->cek_login("admin",$where);
		if($cek->num_rows() > 0){

			$data_session = array(
				'nama' => $username,
				'status' => "login"
				);



			$this->session->set_userdata($data_session);

			redirect('Admin/home');

		}

		else{
			$this->session->set_flashdata('fail_login','username/pwd salah');
			redirect('Admin');
		}
	}
}
