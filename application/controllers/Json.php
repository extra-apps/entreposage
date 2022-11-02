<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Json extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        header('Content-Type: Application/json');
    }

    function declarant()
    {
        $rep['success'] = false;
        $data = [
            'nomdeclarant' => $nd = $this->input->post('nomdeclarant'),
            'codedeclarant' => $this->input->post('codedeclarant'),
            'email' => $em = $this->input->post('email'),
            'mdp' => $this->input->post('mdp')
        ];

        if (count($this->db->where('nomdeclarant', $nd)->get('declarant')->result())) {
            $rep['message'] = "Le déclarant $nd existe déjà.";
            echo json_encode($rep);
            exit;
        }

        if (count($this->db->where('email', $em)->get('declarant')->result())) {
            $rep['message'] = "L'email $em existe déjà.";
            echo json_encode($rep);
            exit;
        }

        $this->db->insert('declarant', $data);
        $rep['message'] = "Le compte du déclarant  $nd a été créé.";
        $rep['success'] = true;
        echo json_encode($rep);
    }

    function declarant_get()
    {
        $r = $this->db->order_by('iddeclarant', 'desc')->get('declarant')->result();
        echo json_encode($r);
    }

    function verificateur_get()
    {
        $r = $this->db->order_by('idverificateur', 'desc')->get('verificateur')->result();
        echo json_encode($r);
    }

    function verificateur()
    {
        $rep['success'] = false;
        $data = [
            'nomverif' => $nd = $this->input->post('nomverif'),
            'codeverif' => $this->input->post('codeverif'),
            'email' => $em = $this->input->post('email'),
            'mdp' => $this->input->post('mdp')
        ];

        if (count($this->db->where('nomverif', $nd)->get('verificateur')->result())) {
            $rep['message'] = "Le vérificateur $nd existe déjà.";
            echo json_encode($rep);
            exit;
        }

        if (count($this->db->where('email', $em)->get('verificateur')->result())) {
            $rep['message'] = "L'email $em existe déjà.";
            echo json_encode($rep);
            exit;
        }

        $this->db->insert('verificateur', $data);
        $rep['message'] = "Le compte du vérificateur  $nd a été créé.";
        $rep['success'] = true;
        echo json_encode($rep);
    }

    function client()
    {
        $rep['success'] = false;
        $data = [
            'nomclient' => $nd = $this->input->post('nomclient'),
            'telephone' => $tel = $this->input->post('telephone'),
            'email' => $em = $this->input->post('email'),
            'mdp' => $this->input->post('mdp')
        ];

        if (count($this->db->where('nomclient', $nd)->get('client')->result())) {
            $rep['message'] = "Le client $nd existe déjà.";
            echo json_encode($rep);
            exit;
        }

        if (count($this->db->where('email', $em)->get('client')->result())) {
            $rep['message'] = "L'email $em existe déjà.";
            echo json_encode($rep);
            exit;
        }

        $tel = str_replace(['(', ')', '_'], '', $tel);
        if (strlen($tel) != 12) {
            $rep['message'] = "Numéro non valide : $tel";
            echo json_encode($rep);
            exit;
        }
        $data['telephone'] = "+$tel";

        $this->db->insert('client', $data);
        $rep['message'] = "Le compte du client  $nd a été créé.";
        $rep['success'] = true;
        echo json_encode($rep);
    }

    function client_get()
    {
        $r = $this->db->order_by('idclient', 'desc')->get('client')->result();
        echo json_encode($r);
    }
}
