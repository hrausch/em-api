<?php

class Historicodealuno extends CI_Controller {

    private $section;
    private $data;
    private $url;

    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->database();
        $this->load->model("Historicos");
        $this->load->model("Aluno");
        $this->load->model("SegChamada");
        $this->load->model("GraficosNotas");



        $this->load->library("parser");
        $this->url = base_url();
        $this->load->library("session");
        if (!$this->session->userdata("id")) {
            $this->data = array("url" => $this->url);
        } else {
            $data = array("url" => $this->url);
            $this->section = $this->parser->parse("principal", $data, true);
        }
    }

    public function index() {
        if ($this->session->userdata("id")) {
            $dados = array(
                "url" => $this->url,
                "ad" => "",
                "sg" => "",
                "nt" => ""


            );
            $section = $this->parser->parse("hist-text", $dados, true);
            $entrada = array(
                "url" => $this->url,
                "title" => "Histórico",
                "section" => $section,
                "usuario" => $this->session->userdata("usuario")
            );
            $this->parser->parse("home", $entrada);
        } else {
            redirect(base_url());
        }
    }
    public function gerarInfo() {
   				if ($this->session->userdata("id")) {
   				$id_aluno = $this->input->post('aluno_select');

              $dados = array(
                "url" => $this->url
              );
             $dados["ad"] = $this->gerar($id_aluno);
             $dados["sg"] = $this->gerarseg($id_aluno);
          //   $dados["nt"] = $this->gerarnota($id_aluno);


              $section = $this->parser->parse("hist-text", $dados, true);
              $entrada = array(
                  "url" => $this->url,
                  "title" => "Histórico",
                  "section" => $section,
                  "usuario" => $this->session->userdata("usuario")
              );
              $this->parser->parse("home", $entrada);
          } else {
              redirect(base_url());
          }
   	}
    public function gerar($id_aluno) {
      $aluno = $this->Aluno->get($id_aluno);
      $adv = $this->Historicos->pegaAdvertencias($id_aluno);
      $resultado = "";
      $resultado = $resultado . '<h3><center>'.$aluno[0]['nome'].'</h3></center>';
      $resultado = $resultado . '<center>' . $aluno[0]['foto'] . '</center><br><br>';
      $resultado = $resultado . '<h3><center>ADVERTÊNCIA</h3></center>';

      foreach ($adv as $advert) {
          $resultado = $resultado . '  <table class="table"  id="tabela><tbody>';
          $resultado = $resultado . '<tr><th scope="row" width="18%"></th><td align=left></td>';
          $resultado = $resultado . '<tr>
                                        <th>Disciplina</th>
                                        <th>Status</th>
                                        <th>Descição</th>
                                        <th>Data</th>
                                    </tr>';


          $resultado = $resultado . '<td align=left>' .$advert["disciplina"].'</td>';
          $resultado = $resultado . '<td align=left>' .$advert["status"].'</td>';
          $resultado = $resultado . '<td align=left>' .$advert["descricao"].'</td>';
          $resultado = $resultado . '<td align=left>' .date("d-m-Y", strtotime($advert['descricao'])).'</td></tr>';


          $resultado = $resultado . '  </table></tbody>';

    }
      return $resultado;

    }

    public function gerarseg($id_aluno) {

      $aluno = $this->Aluno->get($id_aluno);
      $seg = $this->SegChamada->pegaPedidosPorIdAluno($id_aluno);
      $resultado = "";
      $resultado = $resultado . '<h3><center></h3></center>';
      $resultado = $resultado . '<center></center><br><br>';
    $resultado = $resultado . '<br><br><h3><center>SEGUNDA CHAMADA</h3></center>';

    foreach ($seg as $s) {
      $disciplina = $this->SegChamada->disciplina_segchamada($s['id_disciplina']);

      $resultado = $resultado . '  <table class="table"  id="tabela><tbody>';

        $resultado = $resultado . '<tr><th scope="row" width="18%"></th><td align=left></td>';
        $resultado = $resultado . '<tr>
                                      <th>Disciplina</th>
                                      <th>Situação</th>
                                      <th>Ausente do dia</th>
                                      <th>Ao dia</th>
                                      <th>Motivo</th>

                                  </tr>';
        $resultado = $resultado . '<td align=left>' .$disciplina[0]["nome_disciplina"].'</td>';
        $resultado = $resultado . '<td align=left>' .$s["situacao"].'</td>';
        $resultado = $resultado . '<td align=left>' .date("d-m-Y", strtotime($s['data_inic_periodo'])).'</td>';
        $resultado = $resultado . '<td align=left>' .date("d-m-Y", strtotime($s['data_fim_periodo'])).'</td>';
        $resultado = $resultado . '<td align=left>' .$s["motivo"].'</td></tr>';


        $resultado = $resultado . '  </table></tbody>';

  }
      return $resultado;

    }

  /*  public function gerarnota($id_aluno) {

      $aluno = $this->Aluno->get($id_aluno);
      $nota = $this->GraficosNotas->notas($id_aluno);

      $resultado = "";
      $resultado = $resultado . '<h3><center></h3></center>';
      $resultado = $resultado . '<center></center><br><br>';
    $resultado = $resultado . '<br><br><h3><center>Notas</h3></center>';

    //var_dump($nota);
    $resultado = $resultado . '  <table class="table"  id="tabela><tbody>';

      $resultado = $resultado . '<tr><th scope="row" width="18%"></th><td align=left></td></tr>';
      $resultado = $resultado . '<tr>
                                    <th>Disciplina</th>
                                    <th>1B</th>
                                    <th>2B</th>
                                    <th>3B</th>
                                    <th>4B</th>
                                    <th>TOTAL</th>
                                </tr>';
   foreach ($nota as $n) {
     $disciplina = $this->GraficosNotas->disciplina_notas($n['id_disciplina']);
        $resultado = $resultado . '<tr><td align=left>' .$disciplina[0]["nome_disciplina"].'</td>';
       $resultado = $resultado . '<td align=left>' .$n["nota"].'</td>';
      /*  $resultado = $resultado . '<td align=left>' .date("d-m-Y", strtotime($s['data_inic_periodo'])).'</td>';
        $resultado = $resultado . '<td align=left>' .date("d-m-Y", strtotime($s['data_fim_periodo'])).'</td>';
        $resultado = $resultado . '<td align=left>' .$s["motivo"].'</td></tr>';


        $resultado = $resultado . '  </tbody></table>';

  }
      return $resultado;


    }*/
  }
