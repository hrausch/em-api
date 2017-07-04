<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Imprimir extends CI_Controller {

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
        $this->load->library('pdf');
        $this->url = base_url();
        $this->load->helper("form");
        $this->load->library("form_validation");
    }

    public function imprimir() {
        $valores = $this->input->post("imprimir[]");
        $html = "<!DOCTYPE html>
<html id='imprimir'>
    <head>
        <meta http-equiv='content-type' content='text/html; charset=UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>

        <!-- Bootstrap Css -->
        <link href='$this->url" . "assets/bootstrap/css/bootstrap.min.css' rel='stylesheet'>

        <!-- jQuery -->
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>

        <!-- Style -->
        <link href='$this->url" . "assets/css/main.css' rel='stylesheet'>
        <!-- Icons Font -->
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>

    </head><body id='imprimir'>";
        foreach ($valores as $id) {
            $adv = $this->montar_advertencia($id);
            $comentario = $this->Advertencia->getComentario($id);
            $i = 0;
            foreach ($comentario as $c) {
                $usuario = $this->Usuarios->getById($c["id_usuario"]);
                foreach ($usuario as $u) {
                    $c["usuario"] = $u["nome"];
                }
                if ($c["arquivo"] != "") {
                    $nome = $c["arquivo"];
                    $c["arquivo"] = "<tr>
                    <th scope='row'>Arquivo:</th>
                    <td>$this->url" . "files/$nome</td>
                </tr>";
                } else {
                    $c["arquivo"] = "";
                }
                $novaData = explode(" ", $c["data_criacao"]);
                $novaData2 = explode("-", $novaData[0]);
                $c["data_criacao"] = $novaData2[2] . "/" . $novaData2[1] . "/" . $novaData2[0] . " às " . $novaData[1];
                $comentario[$i] = $c;
                $i++;
            }
            if ($adv[0]["arquivo"] != "") {
                $nome = $adv[0]["arquivo"];
                $adv[0]["arquivo"] = "<tr>
                    <th scope='row'>Arquivo:</th>
                    <td>$this->url" . "files/$nome</td>
                </tr>";
            } else {
                $adv[0]["arquivo"] = "";
            }
            $it = $this->Item->getItemAdvertencia($id);
            if ($it) {
                $adv[0]["item"] = null;
                $con = 0;
                $guardar = null;
                foreach ($it as $i) {
                    $item = $this->Item->getItem($i["id_item"]);
                    if ($con == 0) {
                        $guardar = "1. " . $item[0]["item"];
                        $con += 1;
                    } else {
                        $guardar .= "<br>";
                        $guardar .= $con + 1 . ". " . $item[0]["item"];
                        $con += 1;
                    }
                }
            }
            $adv[0]["item"] = $guardar;
            $novaData = explode("-", $adv[0]["data"]);
            $adv[0]["data"] = $novaData[2] . "/" . $novaData[1] . "/" . $novaData[0];
            $data = array(
                "adv" => $adv,
                "id" => $id,
                "entrada" => $comentario,
                "url" => $this->url
            );
            if (end($valores) === $id) {
                $html .= $this->parser->parse("imprimir", $data, true);
            } else {
                $html .= $this->parser->parse("imprimir", $data, true) . "<pagebreak type='NEXT-ODD' resetpagenum='1' pagenumstyle='i' suppress='off' />";
            }
        }
        $html .= "<script src='$this->url" . "assets/bootstrap/js/bootstrap.min.js'></script></body></html>";
        $pdfFilePath = "advertencias.pdf";
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output($pdfFilePath, "D");
    }

    function montar_advertencia($id = NULL) {
        if ($id == NULL) {
            $adv = $this->Advertencia->getByUsuario($this->session->userdata("id"));
        } else {
            $adv = $this->Advertencia->get($id);
        }
        $i = 0;
        foreach ($adv as $a) {
            $aluno = $this->Aluno->get($a["id_aluno"]);
            foreach ($aluno as $an) {
                $a["aluno"] = $an["nome"];
                $curso = $this->Aluno->get_curso($an["id_curso"]);
                $turma = $this->Aluno->get_turma($an["id_turma"]);
                foreach ($turma as $t) {
                    $a["curso"] = $t["turma"];
                }
                foreach ($curso as $c) {
                    $a["curso"] = $a["curso"] . " - " . $c["curso"];
                }
            }
            $tipo = $this->Item->get_tipo($a["tipo"]);
            $a["tipo"] = $tipo[0]["tipo"];
            $a["url"] = $this->url;
            $adv[$i] = $a;
            $i++;
        }
        return $adv;
    }

}
