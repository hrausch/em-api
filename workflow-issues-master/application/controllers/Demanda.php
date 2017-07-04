<?php

class Demanda extends CI_Controller {

    private $section;
    private $data;
    private $url;

    public function __construct() {
        parent::__construct();
        $this->load->model("Demandas");
        $this->load->helper("url");
        $this->load->database();
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
                "url" => $this->url
            );
            $dados['demandas_recebidas'] = $this->geraHtmlTabelaDemandas($this->Demandas->pegaDemandas($this->session->userdata("id")));
            $section = $this->parser->parse("demandas", $dados, true);
            $entrada = array(
                "url" => $this->url,
                "title" => "Demandas",
                "section" => $section,
                "usuario" => $this->session->userdata("usuario")
            );
            $this->parser->parse("home", $entrada);
        } else {
            redirect(base_url());
        }
    }

    public function loadpageadddemanda() {
        if ($this->session->userdata("id")) {
            $dados = array(
                "url" => $this->url
            );
            $dados['destinatarios'] = $this->Demandas->pegaDestinatarios();
            $dados['usuario'] = $this->session->userdata("usuario");
            $section = $this->parser->parse("adicionardemanda", $dados, true);
            $entrada = array(
                "url" => $this->url,
                "title" => "Nova demanda",
                "section" => $section,
                "usuario" => $this->session->userdata("usuario")
            );

            $this->parser->parse("home", $entrada);
        } else {
            redirect(base_url());
        }
    }

    public function buscarTurmas($id_curso) {
        if ($this->session->userdata("id")) {
            $resultado = $this->Demandas->pegaTurmas($id_curso);
            $html = '<select class="form-control" name="turma" id="turma_select" onchange="mudouTurma($(this).val());"><option selected disabled>Turma</option>';
            foreach ($resultado as $linha) {
                $html = $html . '<option value="' . $linha["id_turma"] . '">' . $linha["turma"] . '</option>';
            }
            $html = $html . "</select>";
            echo $html;
        } else {
            redirect(base_url());
        }
    }

    public function buscarAlunos($id_turma) {
        if ($this->session->userdata("id")) {
            $resultado = $this->Demandas->pegaAlunos($id_turma);
            $html = "<option selected disabled>Aluno(s)</option>";
            foreach ($resultado as $linha) {
                $html = $html . '<option value="' . $linha["id_aluno"] . '">' . $linha["nome"] . '</option>';
            }
            $html = $html . "</select>";
            echo $html;
        } else {
            redirect(base_url());
        }
    }

    public function geraHtmlTabelaDemandas($demandas) {
        $resultado = "";
        foreach ($demandas as $linha) {
            $nome = $this->Demandas->pegaNomeUsuario($linha['id_usuario_criador']);
            $nome2 = $this->Demandas->pegaNomeUsuario($linha['id_usuario']);
            $tipo = $this->Demandas->pegaTipo($linha["id_tipo_demanda"]);
            if ($tipo[0]["tipo_demanda"] != "Resposta") {
                if ($linha['situacao'] == "Aguardando resposta") {
                    $resultado = $resultado . '<tr bgcolor="#FFFFD5">';
                } elseif ($linha['situacao'] == "Concluída") {
                    $resultado = $resultado . '<tr bgcolor="#E2FFD5">';
                }
                $resultado = $resultado . '<td>' . $nome[0]["nome"] . '</td>';
                $resultado = $resultado . '<td>' . $nome2[0]["nome"] . '</td>';
                $resultado = $resultado . '<td>' . $tipo[0]["tipo_demanda"] . '</td>';
                $resultado = $resultado . '<td>' . date("d/m/Y", strtotime($linha['data_criacao'])) . '</td>';
                $resultado = $resultado . '<td>' . date("H:i - d/m/Y", strtotime($linha['data_update'])) . '</td>';
                $resultado = $resultado . '<td>' . $linha['situacao'] . '</td>';
                $resultado = $resultado . '<td><a href="{url}index.php/Demanda/detalhes/' . $linha['id_demanda'] . '/' . $linha['id_usuario_criador'] . '/' . $linha['id_usuario'] . '" class="btn btn-default"><i class="fa fa-info-circle"></i></a></button></td>';
                $resultado = $resultado . '</tr>';
           }
        }
        return $resultado;
    }

    public function concluir($id_demanda) {
        $temfilha = true;
        $teste = true;
        do {
            $mae = $this->Demandas->pegaDemandaPorId($id_demanda);
            if ($this->Demandas->alteraSituacao($id_demanda) == false) {
                $teste = false;
            }
            if ($mae[0]['demanda_filho'] == NULL) {
                $temfilha = false;
            } else {
                $id_demanda = $mae[0]['demanda_filho'];
            }
        } while ($temfilha == true);
        if ($teste) {
            echo '<script>location.href="http://localhost/Estagio/workflow-issues-master/index.php/Demanda";
  			alert("Esta demanda foi marcada como concluída!!!");
  			</script>';
        } else {
            echo "<strong>OCORREU UM ERRO DURANTE O PROCESSO. POR FAVOR TENTE NOVAMENTE!</strong";
        }
    }

    public function geraHtmlDetalhes($dados) {

        $tipo = $this->Demandas->pegaTipo($dados['dados'][0]["id_tipo_demanda"]);
        $id = $dados['dados'][0]['id_demandas'];
        $resultado = "";
        $resultado = $resultado . '<tr><th scope="row" width="18%">Remetente:</th><td align=left>' . $dados['remetente'][0]['nome'] . '</td></tr>';
        $resultado = $resultado . '<tr><th scope="row" width="18%">Destinatário:</th><td align=left>' . $dados['destinatario'][0]['nome'] . '</td></tr>';
        $resultado = $resultado . '<tr><th scope="row" width="18%">Data:</th><td align=left>' . date("d-m-Y", strtotime($dados['dados'][0]['data_criacao'])) . '</td></tr>';
        $resultado = $resultado . '<tr><th scope="row" width="18%">Tipo:</th><td align=left>' . $tipo[0]["tipo_demanda"] . '</td></tr>';
        $resultado = $resultado . '<tr><th scope="row" width="18%">Descrição:</th><td align=left>' . $dados['dados'][0]["texto"] . '</td></tr>';
        if ($dados["alunos"] != NULL) {
            $resultado = $resultado . '<th scope="row" width="18%">Alunos envolvidos:</th><td align=left>';
            $i = 0;
            $len = count($dados["alunos"]);
            foreach ($dados["alunos"] as $aluno) {
                $nome = $this->Demandas->pegaNomeAluno($aluno['id_aluno']);
                $resultado = $resultado . $nome[0]['nome'];
                if ($i != $len - 1) {
                    $resultado = $resultado . ' - ';
                }
                $i++;
            }
            $resultado = $resultado . '</td></tr>';
        }
        if ($dados['dados'][0]["arquivo_anexo"] != NULL) {
            $resultado = $resultado . '<tr><th scope="row" width="18%">Arquivo anexo:</th><td align=left>' . '<a href="localhost/Estagio/workflow-issues-master/uploads/demandas/' . $dados['dados'][0]["arquivo_anexo"] . '" download><font color="blue">Clique aqui para baixar o arquivo anexado</font></a>' . '</td></tr>';
        }
        $resultado = $resultado . '</tbody></table>';
        
        
        $respostas = $this->Demandas->getRespostas($id);
        if($respostas != NULL) {
        		foreach($respostas as $r){
        			$respostade = $this->Demandas->pegaNomeUsuario($r["id_usuario_criador"]);
        			$resultado = $resultado . '<br><table class="table"><caption>Resposta de ' . $respostade[0]['nome'] . ' em ' . date("d/m/Y H:i", strtotime($r['data'])) . '<caption><tbody>';
        			$resultado = $resultado . '<tr><th scope="row" width="18%">Descrição:</th><td align=left>' . $r["texto"] . '</td></tr>';
        			if ($r["arquivo_anexo"] != NULL) {
                    $resultado = $resultado . '<tr><th scope="row" width="18%">Arquivo anexo:</th><td align=left>' . '<a href="localhost/Estagio/workflow-issues-master/uploads/demandas/' . $r["arquivo_anexo"] . '" download><font color="blue">Clique aqui para baixar o arquivo anexado</font></a>' . '</td></tr>';
               }
               $resultado = $resultado.'</table>';
        		}        
        }
        if ($dados['dados'][0]["situacao"] != "Concluída") {
            if ($this->session->userdata("id") == $dados["id_remetente"]) {
                $resultado = $resultado . '<center><a id="botao" class="btn btn-primary" href="{url}index.php/Demanda/adicionarrespostademanda/' . $id . '/' . $dados['id_destinatario'] . '" style="display:block; width:20%">Responder</a><br>';
            } else {
                $resultado = $resultado . '<center><a id="botao" class="btn btn-primary" href="{url}index.php/Demanda/adicionarrespostademanda/' . $id . '/' . $dados['id_remetente'] . '" style="display:block; width:20%">Responder</a><br>';
            }
            $resultado = $resultado . '<center><a id="botao" class="btn btn-primary" href="{url}index.php/Demanda/adicionarfilha/' . $id . '" style="display:block; width:20%"> Gerar uma demanda filha</a><br>';
            $resultado = $resultado . '<center><a id="botao" class="btn btn-primary" href="{url}index.php/Demanda/concluir/' . $id . '" style="display:block; width:20%">Encerrar demanda</a><br>';    
        }
        $resultado = $resultado . '<a id="botao" class="btn btn-primary" href="{url}index.php/Demanda" style="display:block; width:20%;">Voltar</a></center>';
        return $resultado;
    }

    public function detalhes($id_demanda, $remetente, $destinatario) {
        if ($this->session->userdata("id")) {
            $dados = array(
                "url" => $this->url
            );
            $info['dados'] = $this->Demandas->pegaDemandaPorId($id_demanda);
            $info['alunos'] = $this->Demandas->pegaAlunosPorId($id_demanda);
            $info['remetente'] = $this->Demandas->pegaNomeUsuario($remetente);
            $info['destinatario'] = $this->Demandas->pegaNomeUsuario($destinatario);
            $info['id_destinatario'] = $destinatario;
            $info['id_remetente'] = $remetente;
            $dados['detalhes'] = $this->geraHtmlDetalhes($info);
            $section = $this->parser->parse("detalhesdemanda", $dados, true);
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

    public function registrarDemanda() {
        if ($this->session->userdata("id")) {
            $dados['data_criacao'] = date('Y-m-d');
            $dados['data_update'] = date('Y-m-d H:i:s');
            $dados['texto'] = $this->input->post('descricao');
            $dados['id_usuario_criador'] = $this->session->userdata("id");
            $dados['situacao'] = "Aguardando resposta";
            $dados['id_tipo_demanda'] = $this->input->post('tipo');
            $destinatarios = $this->input->post('destinatarios[]');
            $alunos = $this->input->post('alunos[]');
            //APENAS SE TIVER ARQUIVO ANEXADO
            if ($_FILES['arquivo_anexo']['name'] != "") {
                $configuracao = array(
                    'upload_path' => './uploads/demandas/',
                    'allowed_types' => '*',
                    'file_name' => date('Y-m-d-H:i:s') . '-' . $dados['id_usuario_criador'] . '.' . $_FILES['arquivo_anexo']['name']
                );
                $this->load->library('upload');
                $dados['arquivo_anexo'] = $configuracao['file_name'];
                $this->upload->initialize($configuracao);
                if ($this->upload->do_upload('arquivo_anexo') == false) {
                    echo $this->upload->display_errors();
                }
            }
            $resultado = $this->Demandas->insereDemanda($dados, $destinatarios, $alunos);
            if ($resultado) {
                echo '<script>alert("NOVA DEMANDA ADICIONADA COM SUCESSO!!!");
  				location.href="http://localhost/Estagio/workflow-issues-master/index.php/Demanda";</script>';
            } else {
                echo "<center><strong>Ocorreu algum erro ao adicionar os dados no banco!!! Retorne e tente novamente.</strong></center>";
            }
        } else {
            redirect(base_url());
        }
    }
    
    public function registraFilha($idmae) {
        if ($this->session->userdata("id")) {
        		$mae = $this->Demandas->pegaDemandaPorId($idmae);
            $dados['data_criacao'] = date('Y-m-d');
            $dados['data_update'] = date('Y-m-d H:i:s');
            $dados['demanda_mae'] = $idmae;
            $dados['texto'] = $this->input->post('descricao');
            $dados['id_usuario_criador'] = $this->session->userdata("id");
            $dados['situacao'] = $mae[0]["situacao"];
 				$dados['id_tipo_demanda'] = $this->input->post('tipo');
            $destinatarios = $this->input->post('destinatarios[]');
           
            //APENAS SE TIVER ARQUIVO ANEXADO
            if ($_FILES['arquivo_anexo']['name'] != "") {
                $configuracao = array(
                    'upload_path' => './uploads/demandas/',
                    'allowed_types' => '*',
                    'file_name' => date('Y-m-d-H:i:s') . '-' . $dados['id_usuario_criador'] . '.' . $_FILES['arquivo_anexo']['name']
                );
                $this->load->library('upload');
                $dados['arquivo_anexo'] = $configuracao['file_name'];
                $this->upload->initialize($configuracao);
                if ($this->upload->do_upload('arquivo_anexo') == false) {
                    echo $this->upload->display_errors();
                }
            }
            $resultado = $this->Demandas->insereDemandaFilha($dados, $destinatarios);
            if ($resultado) {
                echo '<script>alert("NOVA DEMANDA ADICIONADA COM SUCESSO!!!");
  				location.href="http://localhost/Estagio/workflow-issues-master/index.php/Demanda";</script>';
            } else {
                echo "<center><strong>Ocorreu algum erro ao adicionar os dados no banco!!! Retorne e tente novamente.</strong></center>";
            }
        } else {
            redirect(base_url());
        }
    }

    public function adicionarrespostademanda($id_demanda, $destinatario) {
        if ($this->session->userdata("id")) {
            $dados = array(
                "url" => $this->url
            );
            $dados['id_demanda'] = $id_demanda;
            $dados['destinatario'] = $destinatario;
            $section = $this->parser->parse("adicionarrespostademanda", $dados, true);
            $entrada = array(
                "url" => $this->url,
                "title" => "Resposta",
                "section" => $section,
                "usuario" => $this->session->userdata("usuario")
            );
            $this->parser->parse("home", $entrada);
        } else {
            redirect(base_url());
        }
    }

    public function registraResposta($id_demanda) {
        if ($this->session->userdata("id")) {
            $resposta['id_demanda'] = $id_demanda;
            $this->Demandas->alteraData($id_demanda);
            $resposta['texto'] = $this->input->post('descricao');
            $resposta['data'] = date('Y-m-d H:i:s');
            $resposta['id_usuario_criador'] = $this->session->userdata("id");
             //APENAS SE TIVER ARQUIVO ANEXADO
            if ($_FILES['arquivo_anexo']['name'] != "") {
                $configuracao = array(
                    'upload_path' => './uploads/demandas/',
                    'allowed_types' => '*',
                    'file_name' => date('Y-m-d-H:i:s') . '-' . $_FILES['arquivo_anexo']['name']
                );
                $this->load->library('upload');
                $resposta['arquivo_anexo'] = $configuracao['file_name'];
                $this->upload->initialize($configuracao);
                if ($this->upload->do_upload('arquivo_anexo') == false) {
                    echo $this->upload->display_errors();
                }
            }
            if ($this->Demandas->addResposta($resposta) == false) {
                echo "<center><strong>Ocorreu algum erro ao adicionar os dados no banco!!! Retorne e tente novamente.</strong></center>";
            } else {
                echo '<script>alert("RESPOSTA ENVIADA COM SUCESSSO!!!");
  				location.href="http://localhost/Estagio/workflow-issues-master/index.php/Demanda";</script>';
            }
        } else {
            redirect(base_url());
        }
    }
    
    public function adicionarfilha($id){
    	    if ($this->session->userdata("id")) {
            $dados = array(
                "url" => $this->url
            );
            $dados["id_demanda"] = $id;
            $dados["demandamae"] = $this->Demandas->pegaDemandaPorId($id);
				$dados['destinatarios'] = $this->Demandas->pegaDestinatarios();
            $section = $this->parser->parse("adddemandafilha", $dados, true);
            $entrada = array(
                "url" => $this->url,
                "title" => "Demandas",
                "section" => $section,
                "usuario" => $this->session->userdata("usuario")
            );
            $this->parser->parse("home", $entrada);
        } else {
            redirect(base_url());
        }
    }

}
