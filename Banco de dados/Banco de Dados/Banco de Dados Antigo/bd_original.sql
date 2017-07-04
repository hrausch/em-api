
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 28/07/2016 às 18:07:44
-- Versão do Servidor: 10.0.20-MariaDB
-- Versão do PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `u864777242_advt`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `advertencia`
--

CREATE TABLE IF NOT EXISTS `advertencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_professor` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `disciplina` varchar(30) NOT NULL,
  `descricao` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `arquivo` varchar(50) NOT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_professor` (`id_professor`,`id_aluno`),
  KEY `id_professor_2` (`id_professor`,`id_aluno`),
  KEY `id_aluno` (`id_aluno`),
  KEY `tipo` (`tipo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Extraindo dados da tabela `advertencia`
--

INSERT INTO `advertencia` (`id`, `id_professor`, `id_aluno`, `disciplina`, `descricao`, `status`, `data`, `arquivo`, `tipo`) VALUES
(17, 5, 2, 'te', '2222222', 'Finalizado', '0000-00-00', '', 1),
(18, 5, 2, 'eret', 'ss', 'Finalizado', '0000-00-00', '', 1),
(19, 5, 3, 'bd', 'oi', 'Ciência dos responsáveis', '0000-00-00', '', 1),
(20, 5, 4, 'BD', 'matou aula', 'Encaminhada', '0000-00-00', '', 1),
(21, 5, 3, 'dddd', 'aa', 'Encaminhada', '0000-00-00', '', 2),
(22, 5, 3, 'Banco de Dados', 'teste', 'Encaminhada', '0000-00-00', '', 2),
(23, 5, 1, 'banco de dados.', 'Matou aula para almoçar.', 'Análise da comissão', '2016-03-22', '', 2),
(24, 5, 2, 'banco de dados.', 'Matou aula para almoçar.', 'Ciência dos responsáveis', '2016-03-22', '', 2),
(25, 5, 3, 'banco de dados.', 'Matou aula para almoçar.', 'Encaminhada', '2016-03-22', '', 2),
(26, 5, 4, 'banco de dados.', 'Matou aula para almoçar.', 'Encaminhada', '2016-03-22', '', 2),
(27, 5, 1, 'asdasd', 'adasd', 'Encaminhada', '2016-04-07', '', 1),
(28, 5, 2, 'asdasd', 'adasd', 'Encaminhada', '2016-04-07', '', 1),
(29, 5, 3, 'asdasd', 'adasd', 'Encaminhada', '2016-04-07', '', 1),
(30, 5, 4, 'asdasd', 'adasd', 'Encaminhada', '2016-04-07', '', 1),
(31, 5, 5, 'asdasd', 'adasd', 'Encaminhada', '2016-04-07', '', 1),
(32, 5, 10, 'BD', 'TESTE123', 'Encaminhada', '2016-04-20', '', 2),
(33, 5, 11, 'BD', 'TESTE123', 'Encaminhada', '2016-04-20', '', 2),
(34, 5, 12, 'BD', 'TESTE123', 'Encaminhada', '2016-04-20', '', 2),
(35, 5, 6, '*', 'Ficou jogando no laboratório', 'Encaminhada', '2016-06-03', '', 1),
(36, 5, 8, '*', 'Ficou jogando no laboratório', 'Encaminhada', '2016-06-03', '', 1),
(37, 5, 10, '*', 'Ficou jogando no laboratório', 'Encaminhada', '2016-06-03', '', 1),
(38, 5, 1, 'Database', 'Ocorreu um erro no sistema.', 'Encaminhada', '2016-07-21', '', 2),
(39, 5, 3, 'Database', 'Ocorreu um erro no sistema.', 'Encaminhada', '2016-07-21', '', 2),
(40, 5, 5, 'Database', 'Ocorreu um erro no sistema.', 'Encaminhada', '2016-07-21', '', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `id_aluno` int(11) NOT NULL AUTO_INCREMENT,
  `id_curso` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `matricula` varchar(45) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_aluno`),
  UNIQUE KEY `matricula` (`matricula`),
  UNIQUE KEY `matricula_2` (`matricula`),
  KEY `fk_student_course_idx` (`id_curso`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id_aluno`, `id_curso`, `id_turma`, `matricula`, `nome`, `foto`) VALUES
(1, 2, 1, '1', '1', 'foto_silhueta.jpg'),
(2, 2, 1, '2', 'aluno2', 'foto_silhueta.jpg'),
(3, 2, 1, '3', '3', 'foto_silhueta.jpg'),
(4, 2, 1, '4', '4', 'foto_silhueta.jpg'),
(5, 2, 1, '5', '5', 'foto_silhueta.jpg'),
(6, 2, 1, '6', '6', 'foto_silhueta.jpg'),
(7, 2, 1, '7', '7', 'foto_silhueta.jpg'),
(8, 2, 1, '8', '8', 'foto_silhueta.jpg'),
(9, 2, 1, '9', '9', 'foto_silhueta.jpg'),
(10, 2, 1, '10', '10', 'foto_silhueta.jpg'),
(11, 2, 1, '11', '11', 'foto_silhueta.jpg'),
(12, 2, 1, '12', '12', 'foto_silhueta.jpg'),
(13, 2, 1, '13', '13', 'foto_silhueta.jpg'),
(14, 2, 1, '14', '14', 'foto_silhueta.jpg'),
(15, 2, 1, '15', '15', 'foto_silhueta.jpg'),
(16, 2, 1, '16', '16', 'foto_silhueta.jpg'),
(17, 2, 1, '17', '17', 'foto_silhueta.jpg'),
(18, 2, 1, '18', '18', 'foto_silhueta.jpg'),
(19, 2, 1, '19', '19', 'foto_silhueta.jpg'),
(20, 2, 1, '20', '20', 'foto_silhueta.jpg'),
(21, 2, 1, '21', '21', 'foto_silhueta.jpg'),
(22, 2, 1, '22', '22', 'foto_silhueta.jpg'),
(23, 2, 1, '23', '23', 'foto_silhueta.jpg'),
(24, 2, 1, '24', '24', 'foto_silhueta.jpg'),
(25, 2, 1, '25', '25', 'foto_silhueta.jpg'),
(26, 2, 1, '26', '26', 'foto_silhueta.jpg'),
(27, 2, 1, '27', '27', 'foto_silhueta.jpg'),
(28, 2, 1, '28', '28', 'foto_silhueta.jpg');




-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario_advertencia`
--

CREATE TABLE IF NOT EXISTS `comentario_advertencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_advertencia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `arquivo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_advertencia` (`id_advertencia`,`id_usuario`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `comentario_advertencia`
--

INSERT INTO `comentario_advertencia` (`id`, `id_advertencia`, `id_usuario`, `comentario`, `data_criacao`, `arquivo`) VALUES
(7, 17, 5, 'aa', '2016-02-17 19:09:42', ''),
(8, 17, 5, 'oi', '2016-03-01 21:19:03', ''),
(9, 21, 5, 'teste', '2016-03-22 17:47:32', ''),
(10, 23, 5, 'teste', '2016-03-22 18:28:02', ''),
(11, 24, 5, 'Os pais agendaram reunião', '2016-06-03 19:29:01', ''),
(12, 24, 5, 'quero a suspensão do aluno', '2016-06-03 19:29:16', ''),
(13, 17, 5, 'os pais foram convocados.', '2016-06-08 20:34:06', ''),
(14, 17, 5, 'estava jogando no laboratório!', '2016-06-08 20:34:54', '');



--
-- Estrutura da tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` int(11) NOT NULL,
  `curso` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id_curso`, `curso`) VALUES
(1, 'EDIFICAÇÕES'),
(2, 'INFORMÁTICA'),
(3, 'MECATRÔNICA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE IF NOT EXISTS `disciplina` (
  `id_disciplina` int(11) NOT NULL AUTO_INCREMENT,
  `disciplina` varchar(45) DEFAULT NULL,
  `nome_disciplina` varchar(255) DEFAULT NULL,
  `departamento` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id_disciplina`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=131 ;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`id_disciplina`, `disciplina`, `nome_disciplina`, `departamento`) VALUES
(35, '8INF.004', 'Administração e Gerência de Estações e Servidores', NULL),
(36, '8INF.141', 'Banco de Dados', NULL),
(37, '8FG.029', 'Biologia II', NULL),
(38, '8FG.026', ' Educação Física II', NULL),
(39, '8INF.005', 'Engenharia de Software', NULL),
(40, '8INF.007', 'Estruturas de Dados', NULL),
(41, '8FG.030', 'Física II', NULL),
(42, '8FG.033', 'Geografia II', NULL),
(43, '8FG.034', 'História II', NULL),
(44, '8FG.035', 'Língua Estrangeira Inglês II', NULL),
(45, '8FG.027', ' Língua Portuguesa II', NULL),
(46, '8FG.031', ' Matemática II', NULL),
(47, '8FG.028', 'Prática de Redação II', NULL),
(48, '8FG.032', 'Química II', NULL),
(49, '8INF.006', 'Redes de Computadores', NULL),
(50, '8INF.009', 'Aplicações para Web', NULL),
(51, '8FG.055', 'Educação Física III', NULL),
(52, '8FG.059', 'Física III', NULL),
(53, '8FG.064', 'História III', NULL),
(54, '8INF.010', ' Informática e Sociedade', NULL),
(55, '8FG.067', ' Língua Estrangeira Inglês III', NULL),
(56, '8FG.056', 'Língua Portuguesa III', NULL),
(57, '8INF.153', 'Linguagem de Programação II', NULL),
(58, '8FG.061', 'Matemática III', NULL),
(59, '8FG.058', 'Prática de Redação III', NULL),
(60, '8INF.011', 'Práticas em Tecnologias da Informação', NULL),
(61, '8FG.062', 'Química III', NULL),
(62, '8INF.008', 'Sistemas de Informação', NULL),
(63, '8FG.066', 'Sociologia', NULL),
(64, '8FG.002', 'Artes', NULL),
(65, '8FG.009', ' Biologia I', NULL),
(66, '8FG.003', ' Educação Física I', NULL),
(67, '8FG.016', 'Filosofia', NULL),
(68, '8FG.011', 'Física I', NULL),
(69, '8INF.142', 'Fundamentos de Informática', NULL),
(70, '8FG.014', 'Geografia I', NULL),
(71, '8FG.015', 'História I', NULL),
(72, '8INF.023', 'Inglês Técnico', NULL),
(73, '8FG.019', ' Língua Estrangeira Inglês I', NULL),
(74, '8FG.005', 'Língua Portuguesa I', NULL),
(75, '8INF.143', 'Linguagem de Programação I', NULL),
(76, '8FG.001', 'Matemática I', NULL),
(77, '8FG.006', 'Prática de Redação I', NULL),
(78, '8FG.013', 'Química I', NULL),
(79, '8MECT.020', 'Des. Técn. Básico', NULL),
(80, '8FG.155', ' Língua Estrangeira Espanhol I', NULL),
(81, '8MECT.052', 'Sistemas Digitais', NULL),
(82, '8MECT.022', 'Tecnologia dos Materiais', NULL),
(83, '8MECT.002', ' Acionamentos e Comandos Elétricos', NULL),
(84, '8MECT.044', 'Circuitos Elétricos', NULL),
(85, '8MECT.010', 'Desenho Auxiliado por Computador e Elementos de Máquinas', NULL),
(86, '8MECT.047', 'Eletrônica Analógica e de Potência', NULL),
(87, '8MECT.005', 'Estrutura de Dados e Microcontroladores', NULL),
(88, '8MECT.048', 'Máquinas Térmicas e de Fluxo', NULL),
(89, '8MECT.049', 'Mecânica Técnica e Resistência dos Materiais', NULL),
(90, '8MECT.003', ' Metrologia e Ajustagem Mecânica', NULL),
(91, '8MECT.007', 'Automação Industrial e Robótica', NULL),
(92, '8MECT.134', ' Eletrohidráulica e Eletropneumática', NULL),
(93, '8MECT.081', ' Instalações Elétricas', NULL),
(94, '8MECT.006', 'Instrumentação e Controle de Processos', NULL),
(95, '8FG.157', 'Língua Estrangeira Espanhol III', NULL),
(96, '8MECT.008', 'Máquinas Elétricas', NULL),
(97, '8MECT.009', 'Processos de Usinagem', NULL),
(98, '8MECT.001', 'Qualidade e Segurança do Trabalho', NULL),
(99, '8MECT.011', 'Soldagem e Manutenção Mecânica', NULL),
(100, '8INF.147', 'Sistemas de Informação', NULL),
(101, '8INF.148', 'Estruturas de Dados', NULL),
(102, '8EDIF.125', 'Desenho Técnico e Arquitetônico', NULL),
(103, '8EDIF.120', ' Estruturas I', NULL),
(104, '8EDIF.017', 'Informática Geral', NULL),
(105, '8EDIF.102', 'Legislação', NULL),
(106, '8EDIF.100', 'Materiais de Construção I', NULL),
(107, '8EDIF.101', 'Planejamento, Orçamento e Controle de Obras I', NULL),
(108, '8EDIF.127', 'Segurança do Trabalho na Construção Civil', NULL),
(109, '8EDIF.122', 'Tecnologia das Construções II', NULL),
(110, '8EDIF.126', 'Topografia', NULL),
(111, '8EDIF.128', 'Empreendedorismo', NULL),
(112, '8EDIF.123', 'Estruturas II', NULL),
(113, '8EDIF.117', 'Instalações Elétricas', NULL),
(114, '8EDIF.118', 'Instalações Hidráulicas', NULL),
(115, '8EDIF.114', 'Materiais de Construção II', NULL),
(116, '8EDIF.097', 'Mecânica dos Solos e Fundações', NULL),
(117, '8EDIF.115', 'Planejamento, Orçamento e Controle de Obras II', NULL),
(118, '8EDIF.093', 'Projeto Arquitetônico', NULL),
(119, '8EDIF.124', 'Tecnologia das Construções III', NULL),
(120, '8EDIF.018', 'Desenho Técnico', NULL),
(121, '8MECT.046', 'Elementos de Máquinas', NULL),
(122, '8MECT.004', 'Processos de Soldagem e Manutenção Mecânica', NULL),
(123, '8EDIF.121', NULL, NULL),
(124, '8FG.004', NULL, NULL),
(125, '8EDIF.119', NULL, NULL),
(126, '8EDIF.001', NULL, NULL),
(127, '8FG.156', NULL, NULL),
(128, '8EDIF.116', NULL, NULL),
(129, '8MECT.I.1', NULL, NULL),
(130, '8MECT.I.2', NULL, NULL);


-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_advertencia`
--

CREATE TABLE IF NOT EXISTS `itens_advertencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_advertencia` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_advertencia` (`id_advertencia`,`id_item`),
  KEY `id_item` (`id_item`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Extraindo dados da tabela `itens_advertencia`
--

INSERT INTO `itens_advertencia` (`id`, `id_advertencia`, `id_item`) VALUES
(1, 17, 1),
(2, 17, 2),
(3, 18, 1),
(4, 19, 2),
(5, 20, 2),
(6, 21, 8),
(7, 22, 9),
(8, 22, 10),
(9, 23, 9),
(10, 24, 9),
(11, 25, 9),
(12, 26, 9),
(13, 27, 1),
(14, 27, 2),
(15, 28, 1),
(16, 28, 2),
(17, 29, 1),
(18, 29, 2),
(19, 30, 1),
(20, 30, 2),
(21, 31, 1),
(22, 31, 2),
(23, 32, 9),
(24, 32, 10),
(25, 33, 9),
(26, 33, 10),
(27, 34, 9),
(28, 34, 10),
(29, 35, 1),
(30, 36, 1),
(31, 37, 1),
(32, 38, 8),
(33, 39, 8),
(34, 40, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`id`, `tipo`) VALUES
(1, 'Leve'),
(2, 'Grave'),
(3, 'Gravíssima');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_itens`
--

CREATE TABLE IF NOT EXISTS `tipo_itens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo` (`id_tipo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `tipo_itens`
--

INSERT INTO `tipo_itens` (`id`, `id_tipo`, `item`) VALUES
(1, 1, 'Tem postura indadequada com o ambiente de sala de aula'),
(2, 1, 'Uso de vocabulário incoveniente'),
(3, 1, 'Não faz os deveres e trabalhos escolares solicitados pelo professor(a)'),
(4, 1, 'Não faz anotaçõesa das matérias e não participa das aulas'),
(5, 1, 'Compareceu às aulas com vestimenta inadequada: sem uniforme'),
(6, 1, 'Manuseio e/ou uso de celular e/ou aparelho eletrônico em sala de aula'),
(7, 1, 'Não trouxe o material necessário às aulas'),
(8, 2, 'Tumultua a sala com conversas e brincadeiras, mantendo-se desatento e indiferente às aulas'),
(9, 2, 'Ausência em dia de Avaliação/Teste, sem justificativa'),
(10, 2, 'Má conservação'),
(11, 2, 'Ausência da sala de aula ou da escola sem autorização'),
(12, 3, 'Age com rebeldia, não controla suas ações; grita, é brusco e imprevisível'),
(13, 3, 'Falta de respeito com professor(a), não obedece, não cumpre ordens, não aceita conselhos e repreensões'),
(14, 3, 'Briga com colegas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE IF NOT EXISTS `turma` (
  `id_turma` int(11) NOT NULL AUTO_INCREMENT,
  `id_curso` int(11) DEFAULT NULL,
  `turma` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_turma`),
  KEY `fk_turma_curso1_idx` (`id_curso`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`id_turma`, `id_curso`, `turma`) VALUES
(1, NULL, '1 Integrado'),
(2, NULL, '2 Integrado'),
(3, NULL, '3 Integrado'),
(4, NULL, '1 Subsequente'),
(5, NULL, '2 Subsequente');



-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `login` varchar(45) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `ultimo_acesso` timestamp NULL DEFAULT NULL,
  `tipo_usuario` text NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `email`, `login`, `nome`, `senha`, `ultimo_acesso`, `tipo_usuario`) VALUES
(5, '111@teste.com', '111', 'User 1', 'bcbe3365e6ac95ea2c0343a2395834dd', NULL, 'cordenador'),
(6, 'breno@breno', '123', 'breno', 'A665A45920422F9D417E4867EFDC4FB8A04A1F3FFF1FA07E998E86F7F7A27AE3', NULL, 'professor');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
