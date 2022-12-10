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
		$tab1 = $tab2 = [];
		foreach (range(1, 12) as $m) {
			$d = $this->db->where('month(dateajout)', $m)->get('marchandise')->result();
			$d2 = $this->db->where('month(date)', $m)->join('declaration', 'declaration.idmarchandise=marchandise.idmarchandise')->get('marchandise')->result();
			array_push($tab1, count($d));
			array_push($tab2, count($d2));
		}
		$data['tab1'] = json_encode($tab1);
		$data['tab2'] = json_encode($tab2);

		$this->load->view('admin/index', $data);
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

	function notification() {
		$this->load->view('admin/notification');

	}
}
