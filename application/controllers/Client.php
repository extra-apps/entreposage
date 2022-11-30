<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if (!$this->session->idclient) {
			$this->session->set_flashdata('message', 'Veuillez vous reconnecter.');
			redirect();
		}

		if (!count($u = $this->db->where('idclient', $this->session->idclient)->get('client')->result())) {
			redirect();
		}
		$this->user = $u[0];
	}
	public function index()
	{
		$this->load->view('client/index');
	}
}
