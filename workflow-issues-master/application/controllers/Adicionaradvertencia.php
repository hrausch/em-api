<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Adicionaradvertencia extends CI_Controller {

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
            $this->section = $this->parser->parse("adicionaradvertencia", $data, true);
        }
    }

    public function index() {
        if ($this->session->userdata("id")) {
          $resultado['prof'] = $this->Advertencia->pegaProfessor();

            $this->section = $this->parser->parse("adicionaradvertencia", $resultado, true);

            $entrada = array(
                "url" => $this->url,
                "title" => "Nova Advertência",
                "section" => $this->section,
                "usuario" => $this->session->userdata("usuario")
            );

            $this->parser->parse("home", $entrada);
        } else {
            $this->parser->parse('login', $this->data);
        }
    }

    public function advertencias() {
        $adv = $this->montar_advertencia();
        $data = array(
            "entrada" => $adv,
            "url" => $this->url,
            "titulo" => "Suas Advertências"
        );
        $this->section = $this->parser->parse("advertencias", $data, true);
        $entrada = array(
            "url" => $this->url,
            "title" => "Advertências",
            "section" => $this->section,
            "usuario" => $this->session->userdata("usuario")
        );

        $this->parser->parse("home", $entrada);
    }

    public function detalhes($id) {
        if ($id) {
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
                    <td><a href='$this->url" . "uploads/adv/coment/$nome' target='_blank'>$nome</a></td>
                </tr>";
                } else {
                    $c["arquivo"] = "";
                }
                $novaData = explode(" ", $c["data_criacao"]);
                $novaData2 = explode("-", $novaData[0]);
                $c["data_criacao"] = $novaData2[2]."/".$novaData2[1]."/".$novaData2[0]." às ".$novaData[1];
                $comentario[$i] = $c;
                $i++;
            }
            if ($adv[0]["arquivo"] != "") {
                $nome = $adv[0]["arquivo"];
                $adv[0]["arquivo"] = "<tr>
                    <th scope='row'>Arquivo:</th>
                    <td><a href='$this->url" . "uploads/adv/$nome' target='_blank'>$nome</a></td>
                </tr>";
            } else {
                $adv[0]["arquivo"] = "";
            }

          $u = $this->session->userdata("id");
          $u=$this->Advertencia->pegaTipoUsuario($u);

          foreach ($u as $us) {
            $tipo_user = $us->id_tipo_usuario;
          }


            if ( $tipo_user == "2" || $tipo_user == "1" || $tipo_user == "3") {
                $adv[0]["cordenacao"] = "<tr>
                    <th scope='row' class='no-print'>Cordenação:</th>
                     <td><button type='button' data-toggle='modal' data-target='#modalEdita' class='btn btn-info btn-xs no-print'><i class='fa fa-pencil'></i> Editar</button></td>
                </tr>";
                $modal = "<div class='modal fade' id='modalEdita'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <h4 class='modal-title'>Editar advertência</h4>
                    </div>
                    <form class='form-horizontal' id='formEdita' method='POST' action='http://localhost/Estagio/workflow-issues-master/index.php/Adicionaradvertencia/mudaStatus/".$id."' enctype='multipart/form-data'>
                    <div class='modal-body'>
                            <div class='form-group'>
                                <label for='status' class='col-sm-2 control-label'>Status</label>
                                <div class='col-sm-10'>
                                    <select class='form-control' name='status' id='status'>
                                        <option value='Encaminhada'>Encaminhada</option>
                                        <option value='Ciência dos responsáveis'>Ciência dos responsáveis</option>
                                        <option value='Análise da comissão'>Análise da comissão</option>
                                        <option value='Finalizado'>Finalizado</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' class='btn btn-success'><i class='fa fa-check'></i> Ok</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>";


            } else {
                $adv[0]["cordenacao"] = "";
                $modal = "";
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
            $adv[0]["data"] = $novaData[2]."/".$novaData[1]."/".$novaData[0];
            $data = array(
                "adv" => $adv,
                "modal" => $modal,
                "id" => $id,
                "entrada" => $comentario,
                "url" => $this->url
            );
            $this->section = $this->parser->parse("detalhes", $data, true);
            $entrada = array(
                "url" => $this->url,
                "title" => "Detalhe - Advertência",
                "section" => $this->section,
                "usuario" => $this->session->userdata("usuario")
            );
            $this->parser->parse("home", $entrada);
        }
    }
    public function mudaStatus($id=null){
		$status = $this->input->post("status");
		$this->Advertencia->mudaStatus($status, $id);
		$this->advertencias();
    }
    public function registrarComentario($id) {
        $this->form_validation->set_rules("id_advertencia", "Id_advertencia", "required");
        $this->form_validation->set_rules("comentario", "Comentario", "required");
        $dados = array_filter($this->input->post());
        $dados["id_usuario"] = $this->session->userdata("id");
        if ($this->form_validation->run() == FALSE) {
            $retorno["erro"] = true;
            $retorno["validacao"] = false;
            $retorno["msg"] = "Preencha todos os campos ou verifique os campos digitados!";
        } else {

            if ($this->input->post("validacaoArquivo") == "1") {
                $config['upload_path'] = './uploads/adv/coment';
                $config['allowed_types'] = 'gif|jpg|png|pdf';
                $config['max_size'] = '0';
                $this->load->library('upload', $config);
                $file_element_name = 'arquivo';
                if (!$this->upload->do_upload($file_element_name)) {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                    echo "Erro! Entre em pânico!";
                    $arquivo = "";
                } else {
                    $data = $this->upload->data();
                    $arquivo = $data['file_name'];
                }
            } else {
                $arquivo = "";
            }
            $dados["arquivo"] = $arquivo;
            unset($dados["validacaoArquivo"]);
            $this->Advertencia->insertComentario($dados);
        }

       redirect(base_url(index_page() . "/Adicionaradvertencia/detalhes/". $id));
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

    public function registrarAdvertencia() {
      if ($this->session->userdata("id")) {
        $pieces = explode("-", $this->input->post("data"));
        $ids = $this->input->post('alunos[]');
        $validaArq = $this->input->post('validacaoArquivo');
          if($validaArq==1){
            $arq = $_FILES['arquivo'];
            $configuracao = array(
              'upload_path'   => './uploads/adv/',
             'allowed_types' => 'pdf',
             'file_name'     => date('Y-m-d-H:i:s').'anexo_advertencia'.'.pdf',
            );
            $this->load->library('upload');
            $dados['arquivo'] = $configuracao['file_name'];

             $this->upload->initialize($configuracao);
             if ($this->upload->do_upload('arquivo')){
            }else{
                echo $this->upload->display_errors();
            }
          }else {
              $dados['arquivo']="";
          }
      foreach ($ids as $id) {
        $arquivo = NULL;
        $data = $pieces[0] . "-" . $pieces[1] . "-" . $pieces[2];
        $dados['id_professor'] = $this->input->post('id_professor');
        $dados['id_aluno'] = $id;
        $dados['data'] = $data;
        $dados['disciplina'] = $this->input->post('disciplina');
        $dados['tipo'] = $this->input->post('tipo');
        $dados['descricao'] =$this->input->post('descricao');
        $dados['status'] = "Encaminhada";

        $resultado[] = $this->Advertencia->insert($dados);
        $id_adv =$this->db->insert_id();
        foreach ($this->input->post("item[]") as $item) {
              $dados2["id_advertencia"] = $id_adv;
              $dados2["id_item"] = $item;
              $dados2["id_tipo"] = $this->input->post('tipo');
              $this->Item->insertItemAdvertencia($dados2);
        }

      }
        if($resultado) {
          echo '<script>alert("NOVA Advertencia ADICIONADA COM SUCESSO!!!");
          location.href="http://localhost/Estagio/workflow-issues-master/index.php/Adicionaradvertencia";</script>';
          $this->index();
        }else {
          echo "<center><strong>Ocorreu algum erro ao adicionar os dados no banco!!! Retorne e tente novamente.</strong></center>";
        }
      }else {
        redirect(base_url());
      }

    }

    public function editarAdvertencia($id) {
        $this->form_validation->set_rules("status", "Status", "required");
        if ($this->form_validation->run() == FALSE) {
            $retorno["erro"] = true;
            $retorno["validacao"] = false;
            $retorno["msg"] = "Preencha todos os campos ou verifique se foi selecionado pelo menos um aluno!";
        } else {
            if ($this->Advertencia->updateAdvertencia($this->input->post(), $id)) {
                $retorno = array(
                    "erro" => false,
                    "validacao" => true
                );
            } else {
                $retorno = array(
                    "erro" => false,
                    "validacao" => true,
                    "msg" => "Erro na operação!"
                );
            }
        }
        echo json_encode($retorno);
    }
    public function buscarTurmas($id_curso) {
    		if ($this->session->userdata("id")) {
  			$resultado = $this->Advertencia->pegaTurmas($id_curso);
    			$html = '<select class="form-control" name="turma" id="turma_select" onchange="mudouTurma($(this).val());"><option selected disabled>Turma</option>';
    			foreach($resultado as $linha){
    				$html = $html.'<option value="'.$linha["id_turma"].'">'.$linha["turma"].'</option>';
    			}
    			$html = $html."</select>";
    			echo $html;
    		 }else{
          redirect(base_url());
      	 }
    }

    public function buscarAlunos($id_turma){
  		if ($this->session->userdata("id")) {
  			$resultado = $this->Advertencia->pegaAlunos($id_turma);
  			$html = "<option selected disabled>Aluno(s)</option>";
  			foreach($resultado as $linha){
  				$html = $html.'<option value="'.$linha["id_aluno"].'">'.$linha["nome"].'</option>';
  			}
  			$html = $html."</select>";
    			echo $html;
    		}else{
          redirect(base_url());
       	}
    }


    public function obterAlunos($dados) {
        $buscar = explode("-", $dados);
        if($buscar[0] == 2) {
        		$buscar[1] = $buscar[1] + 5;
        }
        $resultado = $this->Aluno->getAlunosByTurmaAndCurso($buscar);
        $i = null;
        foreach ($resultado as $resu) {
            $i++;
        }
        $retorno["resultado"] = $resultado;
        $retorno["qtd"] = $i;
        echo json_encode($retorno);
    }

}
