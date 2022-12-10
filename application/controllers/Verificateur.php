<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verificateur extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if (!$this->session->idverificateur) {
			$this->session->set_flashdata('message', 'Veuillez vous reconnecter.');
			redirect();
		}

		if (!count($u = $this->db->where('idverificateur', $this->session->idverificateur)->get('verificateur')->result())) {
			redirect();
		}
		$this->user = $u[0];
	}

	function index() {
		redirect('verificateur/bon-entree');
	}

	public function marchandise()
	{
		$this->load->view('verificateur/index');
	}

	function bon_entree()
	{
		$this->db->join('marchandise', 'marchandise.idmarchandise=entree.idmarchandise');
		$data['entree'] = $this->db->order_by('identree', 'desc')->get('entree')->result();

		$this->db->where('marchandise.idmarchandise NOT IN (SELECT idmarchandise from entree)');
		// $this->db->where('declaration.valide', 1);
		// $this->db->join('declaration', 'declaration.idmarchandise=marchandise.idmarchandise');
		$data['marchandises'] = $this->db->get('marchandise')->result();
		$this->load->view('verificateur/bon-entree', $data);
	}

	function bon_sortie()
	{
		$this->db->join('marchandise', 'marchandise.idmarchandise=sortie.idmarchandise');
		$data['sortie'] = $this->db->order_by('idsortie', 'desc')->get('sortie')->result();

		$this->db->join('marchandise', 'marchandise.idmarchandise=entree.idmarchandise');
		$this->db->join('declaration', 'declaration.idmarchandise=marchandise.idmarchandise');
		$data['marchandises'] = $this->db->get('entree')->result();
		$this->load->view('verificateur/bon-sortie', $data);
	}

	public function valider_quittance()
	{
		$this->load->view('verificateur/valider_quittance');
	}
}
