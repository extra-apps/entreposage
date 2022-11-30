<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->view('login');
	}

	public function connexion()
	{
		$login = $this->input->post('login');
		$pass = $this->input->post('pass');

		if (!count($this->db->get('admin')->result())) {
			$this->db->insert('admin', ['nom' => 'Admin', 'email' => 'admin@admin.admin', 'mdp' => 'admin']);
		}

		$data['mdp'] = $pass;
		// valid_email($login) ? $data['email'] = $login : $data['telephone'] = $login;
		$data['email'] = $login;
		$r = $this->db->where($data)->get('admin')->result();
		if (count($r)) {
			$this->session->set_userdata([
				'idadmin' => $r[0]->idadmin
			]);
			redirect('admin');
		} else if (count($r = $this->db->where($data)->get('declarant')->result())) {
			$this->session->set_userdata([
				'iddeclarant' => $r[0]->iddeclarant
			]);
			redirect('declarant');
		} else if (count($r = $this->db->where($data)->get('verificateur')->result())) {
			$this->session->set_userdata([
				'idverificateur' => $r[0]->idverificateur
			]);
			redirect('verificateur');
		}
		else if (count($r = $this->db->where($data)->get('client')->result())) {
			$this->session->set_userdata([
				'idclient' => $r[0]->idclient
			]);
			redirect('client');
		}
		$this->session->set_flashdata([
			'message' => "Echec de connexion, login ou mot de passe incorrect."
		]);
		redirect();
	}

	function deconnexion()
	{
		$this->session->sess_destroy();
		redirect();
	}
}
