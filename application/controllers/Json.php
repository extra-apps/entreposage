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

    function marchandise_get()
    {

        $idclient = $this->input->get('idclient');

        $this->db->select('marchandise.*,client.idclient, declaration.valide, declaration.date, declaration.quittance, nomdeclarant declarant, numero_declaration, numero_liquidation, client.nomclient client');
        $this->db->join('declaration', 'declaration.idmarchandise=marchandise.idmarchandise', 'left');
        $this->db->join('client', 'client.idclient=marchandise.idclient');
        $this->db->join('declarant', 'declarant.iddeclarant=marchandise.iddeclarant');
        $r = $this->db->order_by('idmarchandise', 'desc')->get('marchandise')->result();

        $t = [];
        foreach ($r as $e) {
            $earlier = new DateTime();
            $later = new DateTime($e->dateexpiration);
            $pos_diff = $earlier->diff($later)->format("%r%a");
            $e->expirein = $pos_diff + 1;
            if ($e->date) {
                $e->declare = 1;
            } else {
                $e->declare = 0;
            }
            $e->quittance = empty($e->quittance) ? null : base_url($e->quittance);
            if ($idclient) {
                if ($idclient == $e->idclient) {
                    array_push($t, $e);
                }
            } else {
                array_push($t, $e);
            }
        }
        echo json_encode($t);
    }

    function marchandise()
    {
        $rep['success'] = false;
        $data = [
            'nommarchandise' => $nd = $this->input->post('nommarchandise'),
            'code' => $tel = $this->input->post('code'),
            'typemarchandise' => $em = $this->input->post('typemarchandise'),
            'dateexpiration'  => $this->input->post('dateexpiration'),
            'idclient'  => $this->input->post('idclient'),
        ];

        // if (count($this->db->where('nommarchandise', $nd)->get('marchandise')->result())) {
        //     $rep['message'] = "La nommarchandise $nd existe déjà.";
        //     echo json_encode($rep);
        //     exit;
        // }
        $data['iddeclarant'] = $this->session->iddeclarant;

        $this->db->insert('marchandise', $data);
        $rep['message'] = "La marchandise $nd a été ajoutée.";
        $rep['success'] = true;
        echo json_encode($rep);
    }

    function marchandise_declare()
    {
        $rep['success'] = false;
        $data = [
            'numero_liquidation' => $nl = $this->input->post('numero_liquidation'),
            'numero_declaration' => $nd = $this->input->post('numero_declaration'),
            'qte' => $q = $this->input->post('qte'),
            'idmarchandise' => $im = $this->input->post('idmarchandise'),
        ];
        $data['iddeclarant'] = $this->session->iddeclarant;

        if (count($this->db->where('idmarchandise', $im)->get('declaration')->result())) {
            $rep['message'] = "La marchandise est déja déclarée.";
            echo json_encode($rep);
            exit;
        }

        $path =  "upload/quittance/";
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $f = $_FILES['file']['name'] ?? '';
        $f = explode('.', $f);
        if (count($f) >= 2) {
            $exe = end($f);
            $f = time() . rand(1, 1000) . '.' . $exe;
        } else {
            $f = '';
        }
        $config = array(
            'upload_path' => $path,
            'overwrite' => TRUE,
            'allowed_types' => "jpg|jpeg|png",
            'file_name' => $f,
            'max_size' => 500 // Ko
        );
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')) {
            $d = $this->upload->data();
            $nomFichier = $path . $d['file_name'];
            $data['quittance'] = $nomFichier;
            $this->db->insert('declaration', $data);

            $mar = $this->db->where('idmarchandise', $im)->get('marchandise')->result()[0];
            $cl = $this->db->where('idclient', $mar->idclient)->get('client')->result()[0];
            $ag = $this->db->where('iddeclarant', $this->session->iddeclarant)->get('declarant')->result()[0];
            $this->db->insert('notification', [
                'idclient' => $cl->idclient,
                'contenu' => "Cher(e) " . ucfirst($cl->nomclient) . ", votre marchandise $mar->nommarchandise a été déclarée par le déclarant $ag->nomdeclarant : Numéro declaration : $nd, Numéro liquidation : $nl, Qte : $q",
            ]);

            $rep['message'] = "La marchandise a été déclarée.";
            $rep['success'] = true;
        } else {
            $rep['success'] = false;
            $rep['message'] = 'Echec, vérifiez le fichier séléctionné : ' . @$this->upload->error_msg[0];
        }

        echo json_encode($rep);
    }

    function marchandise_valider()
    {
        $idm = $this->input->post('idmarchandise');
        $rep['success'] = false;

        if (count($this->db->where('idmarchandise', $idm)->get('declaration')->result())) {
            $this->db->where('idmarchandise', $idm)->update('declaration', ['valide' => 1]);
            $mar = $this->db->where('idmarchandise', $idm)->get('marchandise')->result()[0];
            $cl = $this->db->where('idclient', $mar->idclient)->get('client')->result()[0];
            $ag = $this->db->where('idverificateur', $this->session->idverificateur)->get('verificateur')->result()[0];

            $this->db->insert('notification', [
                'idclient' => $cl->idclient,
                'contenu' => "Cher(e) " . ucfirst($cl->nomclient) . ", la quittance de votre marchandise $mar->nommarchandise a été validée par le vérificateur $ag->nomverif.",
            ]);
            $rep['success'] = true;
            $rep['message'] = "Quittance validée";
        } else {
            $rep['message'] = "La marchandise doit etre déclarée avant de valider la quittance";
        }
        echo json_encode($rep);
    }

    function entree()
    {
        $rep['success'] = false;
        $data = [
            'idmarchandise' => $id = $this->input->post('idmarchandise'),
            'numeroentree' => $this->input->post('numeroentree'),
            'immat' => $this->input->post('immat'),
            'nomchauffeur' => $this->input->post('nomchauffeur'),
        ];
        $data['qte'] = $this->db->where('idmarchandise', $id)->get('marchandise')->row('qte');
        $data['idverificateur'] = $this->session->idverificateur;


        if (count($this->db->where('idmarchandise', $id)->get('entree')->result())) {
            $rep['message'] = "Le bon d'entrée de cette marchandise est déja enregistré.";
            echo json_encode($rep);
            exit;
        }

        $this->db->insert('entree', $data);
        $rep['message'] = "Le bon d'entrée de la marchandise a été créé.";
        $rep['success'] = true;
        echo json_encode($rep);
    }

    function sortie()
    {
        $rep['success'] = false;
        $data = [
            'idmarchandise' => $id = $this->input->post('idmarchandise'),
            'numerosortie' => $this->input->post('numerosortie'),
            'immat' => $this->input->post('immat'),
            'qte' => $qte = $this->input->post('qte'),
            'nomchauffeur' => $this->input->post('nomchauffeur'),
        ];

        $this->db->join('declaration', 'declaration.idmarchandise=marchandise.idmarchandise');
        $qtem = @$this->db->where('marchandise.idmarchandise', $id)->get('marchandise')->result()[0]->qte;
        $stot = 0;

        $this->db->select('sum(qte) qte');
        $r = $this->db->where('idmarchandise', $id)->get('sortie')->result();
        $stot = $r[0]->qte;
        $rest = $qtem - $stot;

        if ($qte  > $rest) {
            if ($stot > 0) {
                $rep['message'] = "Vous avez déjà enregistré la sortie  d'une quantité de $stot pour cette marchandise, la quanté restant pour la sortie est de : " . $rest;
            } else {
                $rep['message'] = "Quantité non valide, veuillez entrer une quantité <= $qtem";
            }
            echo json_encode($rep);
            exit;
        }

        $data['qte'] = $qte;
        $data['idverificateur'] = $this->session->idverificateur;

        $this->db->insert('sortie', $data);
        $rep['message'] = "Le bon de sortie de la marchandise a été créé.";
        $rep['success'] = true;
        echo json_encode($rep);
    }
}
