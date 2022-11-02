<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Declarant extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if (!$this->session->iddeclarant) {
			$this->session->set_flashdata('message', 'Veuillez vous reconnecter.');
			redirect();
		}

		if (!count($u = $this->db->where('iddeclarant', $this->session->iddeclarant)->get('declarant')->result())) {
			redirect();
		}
		$this->user = $u[0];
	}
	public function index()
	{
		$this->load->view('declarant/index');
	}
}
