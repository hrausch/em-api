<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class GraficosNotas extends CI_Model {

  public function notas($id_aluno) {
    $resultado = $this->db->query('SELECT * FROM fato_notas WHERE id_aluno ="' . $id_aluno.'"')->result_array();
    return $resultado;
  }

  public function disciplina_notas($id){
    return $this->db->query("SELECT d.nome_disciplina, d.id_disciplina FROM disciplina AS d JOIN fato_notas AS f ON d.id_disciplina=".$id)->result_array();

  }
    public function geraGrafBarra($curso, $turma, $periodo, $ano) {
        $dados['grafico'] = $this->db->query('SELECT DISTINCT(fn.id_disciplina), d.disciplina, d.nome_disciplina, fn.bimestre, AVG(fn.nota) 	AS nota, STDDEV(fn.nota) AS desvio FROM fato_notas fn JOIN disciplina d ON d.id_disciplina = fn.id_disciplina WHERE fn.id_turma =' . $turma . '   AND fn.id_curso=' . $curso . ' and fn.ano =' . $ano . ' AND fn.bimestre <=' . $periodo . ' GROUP BY fn.id_disciplina, fn.bimestre, d.nome_disciplina')->result_array();
        return $dados['grafico'];
    }

    public function geraGrafRadar($curso, $turma, $periodo, $ano) {
        //PROCURA AS DISCIPLINAS DA SÉRIE EM QUESTÃO (RETORNA O ID E NOME DAS MESMAS)
        $dados['graficoRadar'] = $this->db->query('SELECT DISTINCT(fn.id_disciplina), d.nome_disciplina FROM fato_notas fn JOIN disciplina d ON d.id_disciplina = fn.id_disciplina WHERE fn.id_turma =' . $turma . ' AND fn.id_curso=' . $curso . ' and fn.ano =2015 AND fn.bimestre <=' . $periodo . ' GROUP BY fn.id_disciplina, d.nome_disciplina')->result_array();
        //PARA CADA DISCIPLINA É CONTADA O NÚMERO DE MÉDIAS PERDIDAS
        $contador = 0;
        //DEFININDO A MÉDIA POR BIMESTRE E O GRUPO DOS MESMOS
        if ($periodo == 1) {
            $grupo = '(1)';
            $media = 12;
        } else if ($periodo == 2) {
            $grupo = '(1, 2)';
            $media = 30;
        } else if ($periodo == 3) {
            $grupo = '(1, 2, 3)';
            $media = 42;
        } else {
            $grupo = '(1, 2, 3, 4)';
            $media = 60;
        }
        while ($contador < count($dados['graficoRadar'])) {
            $disciplina = $dados['graficoRadar'][$contador]['id_disciplina'];
            $resultado = $this->db->query('SELECT COUNT(cont) as medias_perdidas from (SELECT count(distinct(id_aluno)) as cont FROM fato_notas fn2 WHERE fn2.bimestre IN ' . $grupo . ' AND fn2.id_curso=' . $curso . ' AND fn2.id_turma=' . $turma . ' AND fn2.ano=' . $ano . ' AND fn2.id_disciplina=' . $disciplina . ' group by id_aluno having sum(nota) < ' . $media . ') as temp')->result_array();
            //O NÚMERO DE MÉDIAS PERDIDAS É ADICIONADO AO ARRAY DAS DISCILINAS
            $dados['graficoRadar'][$contador]['medias_perdidas'] = (int) $resultado[0]['medias_perdidas'];
            $contador++;
        }
        return $dados['graficoRadar'];
    }

}

?>
