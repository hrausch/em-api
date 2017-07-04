<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Segundachamada extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array("form", "url"));
        $this->load->library("form_validation");
        $this->load->library("parser");
        $this->load->library("session");
        $this->load->model("Usuarios");
        $this->load->model("SegChamada");
        $this->load->model("Aluno");
        $this->url = base_url();
    }

    public function index() {
        $dados = array(
            "url" => $this->url
        );
        $section = $this->parser->parse("usercomum/painel", $dados, true);
        $entrada = array(
            "url" => $this->url,
            "title" => "Inicio",
            "section" => $section,
            "usuario" => $this->session->userdata("usuario")
        );
        $this->parser->parse("usercomum/inicio", $entrada);
    }
    public function loadStatusForm() {
        $dados = array(
            "url" => $this->url
        );
        $section = $this->parser->parse("usercomum/status-form", $dados, true);
        $entrada = array(
            "url" => $this->url,
            "title" => "Inicio",
            "section" => $section,
            "usuario" => $this->session->userdata("usuario")
        );
        $this->parser->parse("usercomum/inicio", $entrada);
    }
    public function verifcaStatus() {
        $info = array("url" => $this->url, "titulo" => "Usuários");
        $matricula=$this->input->post('matricula');
        if ($matricula != ""){
          $aluno = $this->SegChamada->pegaAluno($matricula);
          if($aluno !=NULL){
            foreach ($aluno as $a) {
              if($aluno !=NULL){
                $id_aluno = $a->id_aluno;
              }
            }
          }else{
            echo '<script>alert("Não foi possivel encontrar o aluno informado, verifique se a matricula foi digitada corretamente!!!");
            location.href="http://localhost/Estagio/workflow-issues-master/index.php/usercomum/Segundachamada/loadStatusForm";</script>';
            $this->index();
          }
          $info['info_recebida'] = $this->listaStatus($this->SegChamada->pegaPedidosPorIdAluno($id_aluno));
          $this->section = $this->parser->parse("usercomum/status-info", $info, true);
          $entrada = array(
              "url" => $this->url,
              "title" => "Segunda Chamada",
              "section" => $this->section,
              "usuario" => $this->session->userdata("usuario")
          );
          $this->parser->parse("usercomum/inicio", $entrada);
      }else{
        echo '<script>alert("O Campo matricula está em branco!!!");
        location.href="http://localhost/Estagio/workflow-issues-master/index.php/usercomum/Segundachamada/loadStatusForm";</script>';
        $this->index();
      }
    }
    public function listaStatus($info) {
      $resultado = "";
        foreach ($info as $linha) {
             $disciplina = $this->SegChamada->disciplina_segchamada($linha['id_disciplina']);
            $aluno  = $this->SegChamada->aluno_segchamada($linha['id_aluno']);
                if ($linha['situacao'] == "Encaminhada") {
                    $resultado = $resultado . '<tr bgcolor="#FFFFD5">';
                } elseif ($linha['situacao'] == "Deferida") {
                    $resultado = $resultado . '<tr bgcolor="#E2FFD5">';
                }elseif ($linha['situacao'] == "Indeferida") {
                    $resultado = $resultado . '<tr bgcolor="#f9caca">';
                }
                $resultado = $resultado . '<td>' . $aluno[0]["nome"]. '</td>';
                $resultado = $resultado . '<td>' . $disciplina[0]["nome_disciplina"] . '</td>';
                $resultado = $resultado . '<td>' . date("d/m/Y", strtotime($linha['data_inic_periodo'])) . '</td>';
                $resultado = $resultado . '<td>' . date("d/m/Y", strtotime($linha['data_fim_periodo'])) . '</td>';
                $resultado = $resultado . '<td>' . date("d/m/Y", strtotime($linha['data_pedido'])) . '</td>';
                $resultado = $resultado . '<td>' . $linha['situacao'] . '</td>';
                $resultado = $resultado . '</tr>';

        }

      return $resultado;
        }

    public function loadFormSegundaChamada() {
        $dados = array(
            "url" => $this->url
        );
        $section = $this->parser->parse("usercomum/form-segunda-chamada", $dados, true);
        $entrada = array(
            "url" => $this->url,
            "title" => "Inicio",
            "section" => $section,
            "usuario" => $this->session->userdata("usuario")
        );
        $this->parser->parse("usercomum/inicio", $entrada);
    }
    public function geraHtmlTabelaSegundaChamada($pedidos) {
        $resultado = "";
        foreach ($pedidos as $linha) {
            $disciplina = $this->SegChamada->disciplina_segchamada($linha['id_disciplina']);
            $aluno  = $this->SegChamada->aluno_segchamada($linha['id_aluno']);

            if($this->session->userdata("curso")==$aluno[0]['id_curso']){
                if ($linha['situacao'] == "Encaminhada") {
                    $resultado = $resultado . '<tr bgcolor="#FFFFD5">';
                } elseif ($linha['situacao'] == "Deferida") {
                    $resultado = $resultado . '<tr bgcolor="#E2FFD5">';
                }elseif ($linha['situacao'] == "Indeferida") {
                    $resultado = $resultado . '<tr bgcolor="#f9caca">';
                }
                $resultado = $resultado . '<td>' . $aluno[0]['nome']. '</td>';
                $resultado = $resultado . '<td>' . $disciplina[0]["nome_disciplina"] . '</td>';
                $resultado = $resultado . '<td>' . date("d/m/Y", strtotime($linha['data_inic_periodo'])) . '</td>';
                $resultado = $resultado . '<td>' . date("d/m/Y", strtotime($linha['data_fim_periodo'])) . '</td>';
                $resultado = $resultado . '<td>' . date("d/m/Y", strtotime($linha['data_pedido'])) . '</td>';
                $resultado = $resultado . '<td>' . $linha['situacao'] . '</td>';
                $resultado = $resultado . '<td><a href="{url}index.php/usercomum/Segundachamada/detalhes/' . $linha['id_segunda_chamada'] . '" class="btn btn-default"><i class="fa fa-info-circle"></i></a></button></td>';
                $resultado = $resultado . '</tr>';
             }
        }
        return $resultado;
    }
    public function listaSegundaChamada() {
      if ($this->session->userdata("id")) {
        $info = array("url" => $this->url, "titulo" => "Usuários");
        $info['pedido_recebido'] = $this->geraHtmlTabelaSegundaChamada($this->SegChamada->pegaPedidos());

        $info['tipo']=$this->SegChamada->pegaTipoUsuario($this->session->userdata("id"));
        $this->section = $this->parser->parse("segundachamada", $info, true);
        $entrada = array(
            "url" => $this->url,
            "title" => "Segunda Chamada",
            "section" => $this->section,
            "usuario" => $this->session->userdata("usuario")
        );
        $this->parser->parse("home", $entrada);
      } else {
          redirect(base_url());
      }
    }
    public function geraHtmlDetalhes($dados) {

        $pedido = $this->SegChamada->pegaPedidos();

        $aluno = $this->SegChamada->aluno_segchamada($dados['dados'][0]['id_aluno']);
        $disciplina = $this->SegChamada->disciplina_segchamada($dados['dados'][0]['id_disciplina']);
        $tipo=$this->SegChamada->pegaTipoUsuario($this->session->userdata("id"));
        $id = $dados['dados'][0]['id_segunda_chamada'];
        $resultado = "";
        $resultado = $resultado . '<tr><th scope="row" width="18%">Aluno:</th><td align=left>' .$aluno[0]["nome"].'</td></tr>';
        $resultado = $resultado . '<tr><th scope="row" width="18%">Disciplina:</th><td align=left>' .$disciplina[0]["nome_disciplina"]. '</td></tr>';
        $resultado = $resultado . '<tr><th scope="row" width="18%">Aluno ausente do dia:</th><td align=left>' . date("d-m-Y", strtotime($dados['dados'][0]['data_inic_periodo'])) .'</td></tr>';
        $resultado = $resultado . '<tr><th scope="row" width="18%">Ao dia:</th><td align=left>' . date("d-m-Y", strtotime($dados['dados'][0]['data_fim_periodo']))  .'</td></tr>';
        $resultado = $resultado . '<tr><th scope="row" width="18%">Motivo:</th><td align=left>' . $dados['dados'][0]["motivo"]  . '</td></tr>';
        $resultado = $resultado . '<tr><th scope="row" width="18%">Data do Pedido:</th><td align=left>' .date("d-m-Y", strtotime($dados['dados'][0]["data_pedido"])) . '</td></tr>';
        $resultado = $resultado . '<tr><th scope="row" width="18%">Situação:</th><td align=left>' . $dados['dados'][0]["situacao"] . '</td></tr>';



        if ($dados['dados'][0]["anexo"] != NULL) {
          $nome = $dados['dados'][0]["anexo"];
          $resultado = $resultado .   "<tr><th scope='row' width='18%''>Arquivo anexo:</th><td><a href='$this->url"."uploads/segchamada/$nome' target='_blank'>Clique aqui para baixar o arquivo anexado</a></td></tr>";
        }
        $resultado = $resultado . '<th><td><a class="btn btn-success" href="{url}index.php/usercomum/Segundachamada/deferirPedido/'.$id .'" style="display:block;color:#fff;"> DEFERIR</a></td></th>';
        $resultado = $resultado . '<th><td><a class="btn btn-danger" href="{url}index.php/usercomum/Segundachamada/indeferirPedido/'.$id .'" style="display:block;color:#fff;"> INDEFERIR</a></td></th>';
        $resultado = $resultado . '<th><td><a class="btn btn-primary" href="{url}index.php/usercomum/Segundachamada/listaSegundaChamada" style="display:block; color:#fff;background-color:#17578c;">Voltar</a></td></th>';
        $resultado = $resultado . '<tr><th scope="row"">HISTÓRICO DE PEDIDOS ANTERIORES DO ALUNO</th></tr>';

  foreach ($pedido as $linha) {
    if ($id!=$linha['id_segunda_chamada']){
     if($aluno[0]["id_aluno"]==$linha['id_aluno']){
            $resultado = $resultado . '<tr><th>Nome:</th><td>' . $aluno[0]['nome']. '</td></tr>';
            $resultado = $resultado . '<tr><th>disciplina:</th><td>' . $disciplina[0]["nome_disciplina"] . '</td></tr>';
            $resultado = $resultado . '<tr><th>Data do Pedido:</th><td>' . date("d/m/Y", strtotime($linha['data_pedido'])) . '</td></tr>';
            $resultado = $resultado . '<tr><th>Status:</th><td>' . $linha['situacao'] . '</td>';
            $resultado = $resultado . '<tr><th>INFO:</th><td><a href="{url}index.php/usercomum/Segundachamada/detalhes/' . $linha['id_segunda_chamada'] . '" class="btn btn-default"><i class="fa fa-info-circle"></i></a></button></td></tr>';
            $resultado = $resultado . '<tr></tr>';
         }
       }
     }
        $resultado = $resultado . '</tbody></table>';

        return $resultado;

  }

  public function deferirPedido($id=null){
    $status = "Deferida";
    $this->SegChamada->mudaStatus($status, $id);
		$this->listaSegundaChamada();
  }
  public function indeferirPedido($id=null){
    $status = "Indeferida";
    $this->SegChamada->mudaStatus($status, $id);
    $this->listaSegundaChamada();
  }


    public function detalhes($id_demanda) {
        if ($this->session->userdata("id")) {
            $dados = array(
                "url" => $this->url
            );
           $info['dados'] = $this->SegChamada->getPedidoPorId($id_demanda);
            $dados['detalhes'] = $this->geraHtmlDetalhes($info);
            $section = $this->parser->parse("detalhes-segunda-chamada", $dados, true);
            $entrada = array(
                "url" => $this->url,
                "title" => "Detalhes",
                "section" => $section,
                "usuario" => $this->session->userdata("usuario")
            );
            $this->parser->parse("home", $entrada);
        } else {
            redirect(base_url());
        }
    }
    public function inserirSegundaChamada() {
      $ids = $this->input->post('disciplina[]');
      $pieces = explode("-", $this->input->post("data"));
      $pieces2 = explode("-", $this->input->post("data-fim"));

      $validaArq = $this->input->post('validacaoArquivo');
        if($validaArq==1){
          $arq = $_FILES['anexo'];
          $configuracao = array(
            'upload_path'   => './uploads/segchamada/',
           'allowed_types' => 'pdf',
           'file_name'     => date('Y-m-d-H:i:s').'segunda_chamada_anexo'.'.pdf',
          );
          $this->load->library('upload');
          $dados['anexo'] = $configuracao['file_name'];

           $this->upload->initialize($configuracao);
           if ($this->upload->do_upload('anexo')){
          }else{
              echo $this->upload->display_errors();
          }
        }else {
            $dados['anexo']="";
        }

      $resultado=false;
      $valida = 0;
      $anexo = NULL;
      $aluno=NULL;
      $matricula=$this->input->post('matricula');
      $aluno = $this->SegChamada->pegaAluno($matricula);
      foreach ($ids as $id) {
        $data = $pieces[0] . "-" . $pieces[1] . "-" . $pieces[2];
        $datafim = $pieces2[0] . "-" . $pieces2[1] . "-" . $pieces2[2];

        foreach ($aluno as $a) {
          if($aluno !=NULL){
            $dados['id_aluno'] = $a->id_aluno;
            $dados['data_inic_periodo'] = $data;
            $dados['data_fim_periodo'] = $datafim;
            $dados['data_pedido'] = date('Y-m-d');
            $dados['id_disciplina'] = $id;
            $dados['motivo'] =$this->input->post('motivo');
            $dados['situacao'] = "Encaminhada";
            $resultado = $this->SegChamada->insertSegundaChamada($dados);
          }else{
            $valida = 1;
          }
        }
    }

      if($resultado) {
        echo '<script>alert("O PEDIDO DE SEGUNDA CHAMADA FOI ENCAMINHADO COM SUCESSO!!!");
        location.href="http://localhost/Estagio/workflow-issues-master/index.php/usercomum/Segundachamada/";</script>';
        $this->index();
      }else {
        echo '<script>alert("Não foi possivel encontrar o aluno informado, verifique se a matricula foi digitada corretamente!!!");
        location.href="http://localhost/Estagio/workflow-issues-master/index.php/usercomum/Segundachamada/loadFormSegundaChamada";</script>';
        $this->index();

      }

    }

    public function buscarTurmas($id_curso) {
        $resultado = $this->SegChamada->pegaTurmas($id_curso);
          $html = '<select class="form-control" name="turma" id="turma_select" onchange="mudouTurma($(this).val());"><option selected disabled>Turma</option>';
          foreach($resultado as $linha){
            $html = $html.'<option value="'.$linha["id_turma"].'">'.$linha["turma"].'</option>';
          }
          $html = $html."</select>";
          echo $html;

    }
    public function buscarDisciplina($id_turma) {
            $resultado = $this->SegChamada->pegaDisciplina($id_turma);
            $html = "<option selected disabled>Disciplina</option>";
            foreach ($resultado as $linha) {
                $html = $html . '<option value="' . $linha["id_disciplina"] . '">' . $linha["nome_disciplina"] . '</option>';
            }
            $html = $html . "</select>";
            echo $html;

    }


}
