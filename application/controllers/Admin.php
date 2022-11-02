<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if (!$this->session->idadmin) {
			$this->session->set_flashdata('message', 'Veuillez vous reconnecter.');
			redirect();
		}

		if (!count($u = $this->db->where('idadmin', $this->session->idadmin)->get('admin')->result())) {
			redirect();
		}
		$this->user = $u[0];
	}
	public function index()
	{
		$this->load->view('admin/index');
	}

	function declarants()
	{
		$this->load->view('admin/declarants');
	}

	function verificateurs()
	{
		$this->load->view('admin/verificateurs');
	}

	function clients()
	{
		$this->load->view('admin/clients');
	}

	function marchandises()
	{
		$this->load->view('admin/marchandises');
	}
}
