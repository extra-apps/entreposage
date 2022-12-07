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

	function bon_sortie()
	{
		$this->db->join('marchandise', 'marchandise.idmarchandise=sortie.idmarchandise');
		$data['sortie'] = $this->db->order_by('idsortie', 'desc')->get('sortie')->result();

		$this->db->join('marchandise', 'marchandise.idmarchandise=entree.idmarchandise');
		$this->db->join('declaration', 'declaration.idmarchandise=marchandise.idmarchandise');
		$data['marchandises'] = $this->db->get('entree')->result();
		$this->load->view('declarant/bon-sortie', $data);
	}
}
