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
		$data['declarants'] = $this->db->order_by('iddeclarant', 'desc')->get('declarant')->result();
		$this->load->view('admin/declarants', $data);
	}

	function verificateurs()
	{
		$data['verificateurs'] = $this->db->order_by('idverificateur', 'desc')->get('verificateur')->result();
		$this->load->view('admin/verificateurs', $data);
	}

	function clients()
	{
		$data['clients'] = $this->db->order_by('idclient', 'desc')->get('client')->result();
		$this->load->view('admin/clients', $data);
	}
}
