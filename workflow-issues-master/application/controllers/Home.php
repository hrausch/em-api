<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    private $section;
    private $data;
    private $url;

    public function __construct() {
        parent::__construct();
        $this->load->library("parser");
        $this->load->helper("url");
        $this->load->database();
        $this->load->model("Advertencia");
        $this->load->model("Aluno");
        $this->load->model("Usuarios");
        $this->load->model("Item");
        $this->load->library("session");
        $this->url = base_url();
        $this->load->helper("form");
        $this->load->library("form_validation");
        if (!$this->session->userdata("id")) {
            $this->data = array("url" => $this->url);
        } else {
            $data = array("url" => $this->url);
            $this->section = $this->parser->parse("principal", $data, true);
        }
    }

    public function index() {
        if ($this->session->userdata("id")) {

            $entrada = array(
                "url" => $this->url,
                "title" => "Home",
                "section" => $this->section,
                "usuario" => $this->session->userdata("usuario")
            );

            $this->parser->parse("home", $entrada);
        } else {
            $this->parser->parse('login', $this->data);
        }
    }

}
