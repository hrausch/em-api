<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Demandas extends CI_Model {

    public function alteraSituacao($id_demanda) {
        return($this->db->query('UPDATE demanda SET situacao="Concluída" WHERE id_demandas=' . $id_demanda));
    }
    
    public function alteraFilha($id_demanda, $id_filha) {
        return($this->db->query('UPDATE demanda SET demanda_filho='.$id_filha.' WHERE id_demandas=' . $id_demanda));
    }

    public function alteraData($id_demanda) {
        return($this->db->query('UPDATE demanda SET data_update= "' . date('Y-m-d H:i:s') . '" WHERE id_demandas=' . $id_demanda));
    }

    public function pegaDemandas($id_usuario) {
        $resultado = $this->db->query('SELECT * FROM demanda AS d JOIN usuario_envolvido_demanda AS u ON u.id_demanda = d.id_demandas WHERE u.id_usuario =' . $id_usuario . ' OR d.id_usuario_criador=' . $id_usuario . ' ORDER BY d.data_update')->result_array();
        return $resultado;
    }

    public function pegaDemandaPorId($id_demanda) {
        $resultado = $this->db->query('SELECT * FROM demanda WHERE id_demandas=' . $id_demanda)->result_array();
        return $resultado;
    }

    public function pegaDemandaMae($id_demanda) {
        $resultado = $this->db->query('SELECT * FROM demanda WHERE demanda_filho=' . $id_demanda)->result_array();
        return $resultado;
    }

    public function pegaTurmas($id_curso) {
        $resultado = $this->db->query("SELECT id_turma, turma FROM turma WHERE id_curso =" . $id_curso)->result_array();
        return $resultado;
    }

    public function pegaAlunos($id_turma) {
        $resultado = $this->db->query("SELECT id_aluno, nome FROM aluno WHERE id_turma =" . $id_turma)->result_array();
        return $resultado;
    }

    public function pegaAlunosPorId($id_demanda) {
        $resultado = $this->db->query("SELECT * FROM aluno_envolvido_demanda WHERE id_demanda =" . $id_demanda)->result_array();
        return $resultado;
    }

    public function pegaNomeUsuario($id_usuario) {
        $resultado = $this->db->query("SELECT nome FROM usuario WHERE id_usuario =" . $id_usuario);
        return $resultado->result_array();
    }

    public function pegaNomeAluno($id_aluno) {
        $resultado = $this->db->query("SELECT nome FROM aluno WHERE id_aluno =" . $id_aluno);
        return $resultado->result_array();
    }

    public function pegaTipo($id_tipo) {
        $resultado = $this->db->query("SELECT tipo_demanda FROM tipo_demanda WHERE id_tipo_demanda =" . $id_tipo);
        return $resultado->result_array();
    }

    public function pegaDestinatarios() {
        $resultado = $this->db->query("SELECT id_usuario, nome FROM usuario")->result_array();
        return $resultado;
    }

    public function insereDemanda($dados, $destinatarios, $alunos) {
        foreach ($destinatarios as $linha) {
            if ($this->db->insert('demanda', $dados) == false) {
                return false;
            }
            $demanda = $this->db->insert_id();
            $dados2['id_demanda'] = $demanda;
            $dados2['id_usuario'] = $linha;
            if ($this->db->insert('usuario_envolvido_demanda', $dados2) == false) {
                return false;
            }
            if ($alunos != NULL) {
                foreach ($alunos as $linha) {
                    $dados3['id_demanda'] = $demanda;
                    $dados3['id_aluno'] = $linha;
                    if ($this->db->insert('aluno_envolvido_demanda', $dados3) == false) {
                        return false;
                    }
                };
            }
        };
        return true;
    }
 
    public function insereDemandaFilha($dados, $destinatarios) {
    	  if ($this->db->insert('demanda', $dados) == false) {
                return false;
            }
          $demanda = $this->db->insert_id();
        foreach ($destinatarios as $linha) {
            $dados2['id_demanda'] = $demanda;
            $dados2['id_usuario'] = $linha;
            if ($this->db->insert('usuario_envolvido_demanda', $dados2) == false) {
                return false;}
            
        };
        
        return true;
    }

    public function addResposta($resposta) {
        if ($this->db->insert('resposta_demanda', $resposta) == false) {
                return false;
        }else {
				return true;        
        }
    }
    
    public function getRespostas($id) {
    	 $r = $this->db->query('SELECT * FROM resposta_demanda WHERE id_demanda=' . $id)->result_array();
    	 return $r;
    }

}

?>
