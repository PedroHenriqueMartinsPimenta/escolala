-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12-Maio-2022 às 02:27
-- Versão do servidor: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `escola`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alternativa`
--

CREATE TABLE `alternativa` (
  `CODIGO` int(11) NOT NULL,
  `OPCAO` text NOT NULL,
  `questoes_CODIGO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `alternativa`
--

INSERT INTO `alternativa` (`CODIGO`, `OPCAO`, `questoes_CODIGO`) VALUES
(1, '1231231', 1),
(2, '21231', 1),
(3, '31221', 1),
(4, '21231', 1),
(5, '23123132', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividade`
--

CREATE TABLE `atividade` (
  `CODIGO` int(11) NOT NULL,
  `SRC` varchar(200) NOT NULL,
  `INICIO` datetime NOT NULL,
  `FIM` date DEFAULT NULL,
  `usuario_CODIGO` int(11) NOT NULL,
  `turma_CODIGO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `atividade`
--

INSERT INTO `atividade` (`CODIGO`, `SRC`, `INICIO`, `FIM`, `usuario_CODIGO`, `turma_CODIGO`) VALUES
(3, 'https://localhost/escola/upload/Screenshot_4.png', '2020-12-22 12:40:13', '0000-00-00', 2, 1),
(4, 'https://localhost/escola/upload/Screenshot_4.png', '2020-12-22 12:40:54', '0000-00-00', 2, 1),
(5, 'https://localhost/escola/upload/Screenshot_4.png', '2020-12-22 12:42:55', '0000-00-00', 2, 1),
(6, 'https://localhost/escola/upload/Screenshot_4.png', '2020-12-22 01:03:45', '0000-00-00', 2, 1),
(7, 'https://localhost/escola/upload/2020_12_22_01_05_10/Screenshot_5.png', '2020-12-22 01:05:10', '0000-00-00', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aula`
--

CREATE TABLE `aula` (
  `CODIGO` int(11) NOT NULL,
  `NOME` varchar(45) NOT NULL,
  `escola_CODIGO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aula`
--

INSERT INTO `aula` (`CODIGO`, `NOME`, `escola_CODIGO`) VALUES
(1, '1Âº aula', 1),
(2, '1Âº aula', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `CODIGO` int(11) NOT NULL,
  `TIPO` int(11) NOT NULL DEFAULT '0',
  `PESO` int(11) NOT NULL DEFAULT '1',
  `NOME` varchar(45) NOT NULL,
  `ATIVA` int(11) NOT NULL DEFAULT '0',
  `periodo_CODIGO` int(11) NOT NULL,
  `materia_CODIGO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `avaliacao`
--

INSERT INTO `avaliacao` (`CODIGO`, `TIPO`, `PESO`, `NOME`, `ATIVA`, `periodo_CODIGO`, `materia_CODIGO`) VALUES
(1, 1, 1, 'TESTE', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao_has_usuario`
--

CREATE TABLE `avaliacao_has_usuario` (
  `CODIGO` int(11) NOT NULL,
  `NOTA` double NOT NULL,
  `avaliacao_CODIGO` int(11) NOT NULL,
  `usuario_CODIGO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aviso`
--

CREATE TABLE `aviso` (
  `CODIGO` int(11) NOT NULL,
  `MESSAGE` text NOT NULL,
  `DATA` datetime NOT NULL,
  `TYPE` int(11) NOT NULL DEFAULT '0',
  `EMAIL` int(11) NOT NULL DEFAULT '0',
  `usuario_CODIGO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aviso_has_usuario`
--

CREATE TABLE `aviso_has_usuario` (
  `CODIGO` int(11) NOT NULL,
  `aviso_CODIGO` int(11) NOT NULL,
  `usuario_CODIGO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `chat`
--

CREATE TABLE `chat` (
  `CODIGO` int(11) NOT NULL,
  `MENSAGEM` text NOT NULL,
  `HORARIO` datetime NOT NULL,
  `SEND_CODIGO` int(11) NOT NULL,
  `RECECIVER_CODIGO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola`
--

CREATE TABLE `escola` (
  `CODIGO` int(11) NOT NULL,
  `NOME` varchar(90) NOT NULL,
  `RUA` varchar(90) NOT NULL,
  `COMPLEMENTO` varchar(45) DEFAULT NULL,
  `BAIRRO` varchar(45) NOT NULL,
  `CIDADE` varchar(45) NOT NULL,
  `ESTADO` varchar(2) NOT NULL,
  `TELEFONE` varchar(45) DEFAULT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `PRIVILEGIO` int(11) NOT NULL DEFAULT '1',
  `DATA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `escola`
--

INSERT INTO `escola` (`CODIGO`, `NOME`, `RUA`, `COMPLEMENTO`, `BAIRRO`, `CIDADE`, `ESTADO`, `TELEFONE`, `EMAIL`, `PRIVILEGIO`, `DATA`) VALUES
(1, 'Pedro Henrique Martins Pimenta', 'Sagrada famÃ­lia ', 'NÂº 142 ap 104', 'SeminÃ¡rio', 'Crato', 'CE', '(88)99491-8261', 'pedrohenrique234322@gmail.com', 1, '2020-12-21'),
(2, 'TÃ‰CNICO EM INFORMATICA JOSÃ‰ MARTINS PIMENTA', 'hbvchkvhcjh', 'jhkjvhcjkvhkj', 'teste', 'Crato', 'CE', '(88)99491-8261', 'pedrohenrique2343222@gmail.com', 1, '2021-01-09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `frequencia`
--

CREATE TABLE `frequencia` (
  `CODIGO` int(11) NOT NULL,
  `DATA` datetime NOT NULL,
  `usuario_CODIGO` int(11) NOT NULL,
  `periodo_CODIGO` int(11) NOT NULL,
  `aula_CODIGO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `frequencia`
--

INSERT INTO `frequencia` (`CODIGO`, `DATA`, `usuario_CODIGO`, `periodo_CODIGO`, `aula_CODIGO`) VALUES
(1, '2021-03-15 00:00:00', 3, 4, 1),
(2, '2021-03-16 00:00:00', 4, 4, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `horario`
--

CREATE TABLE `horario` (
  `CODIGO` int(11) NOT NULL,
  `DIA` int(11) NOT NULL DEFAULT '1',
  `aula_CODIGO` int(11) NOT NULL,
  `materia_CODIGO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `horario`
--

INSERT INTO `horario` (`CODIGO`, `DIA`, `aula_CODIGO`, `materia_CODIGO`) VALUES
(1, 1, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `link`
--

CREATE TABLE `link` (
  `CODIGO` int(11) NOT NULL,
  `PARA` varchar(200) NOT NULL,
  `DISPONIVEL` int(1) NOT NULL DEFAULT '1',
  `usuario_CODIGO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `link`
--

INSERT INTO `link` (`CODIGO`, `PARA`, `DISPONIVEL`, `usuario_CODIGO`) VALUES
(2, 'https://localhost/escola/admin/matricula.php?codigo=1', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia`
--

CREATE TABLE `materia` (
  `CODIGO` int(11) NOT NULL,
  `NOME` varchar(45) NOT NULL,
  `usuario_CODIGO` int(11) NOT NULL,
  `turma_CODIGO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `materia`
--

INSERT INTO `materia` (`CODIGO`, `NOME`, `usuario_CODIGO`, `turma_CODIGO`) VALUES
(1, '1Âº aula', 2, 1),
(2, 'Biologia', 7, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `periodo`
--

CREATE TABLE `periodo` (
  `CODIGO` int(11) NOT NULL,
  `INICIO` date NOT NULL,
  `FIM` date NOT NULL,
  `NOME` varchar(45) NOT NULL,
  `MEDIA` int(11) NOT NULL DEFAULT '0',
  `escola_CODIGO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `periodo`
--

INSERT INTO `periodo` (`CODIGO`, `INICIO`, `FIM`, `NOME`, `MEDIA`, `escola_CODIGO`) VALUES
(1, '2020-12-22', '2020-12-31', '1Âº semestre 2020', 0, 1),
(2, '2021-01-08', '2021-06-30', '1Âº semestre 2021', 1, 2),
(3, '2021-03-04', '2021-03-06', 'TESTE 2021', 0, 1),
(4, '2021-03-15', '2021-03-25', 'ghfghgfh 2021', 0, 1),
(5, '2021-03-25', '2021-12-02', 'Biologia 2021', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `questoes`
--

CREATE TABLE `questoes` (
  `CODIGO` int(11) NOT NULL,
  `PERGUNTA` text NOT NULL,
  `IMAGE` varchar(200) DEFAULT NULL,
  `CORRETA` int(11) NOT NULL DEFAULT '0',
  `avaliacao_CODIGO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `questoes`
--

INSERT INTO `questoes` (`CODIGO`, `PERGUNTA`, `IMAGE`, `CORRETA`, `avaliacao_CODIGO`) VALUES
(1, '2162153', 'https://localhost/escola/upload/2020_12_22_01_12_05/Screenshot_4.png', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `site`
--

CREATE TABLE `site` (
  `CODIGO` int(11) NOT NULL,
  `LINK` varchar(200) NOT NULL,
  `escola_CODIGO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `site`
--

INSERT INTO `site` (`CODIGO`, `LINK`, `escola_CODIGO`) VALUES
(2, 'https://localhost/escola/site/89140038_Pedro_Henrique_Martins_Pimenta/', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `CODIGO` int(11) NOT NULL,
  `NOME` varchar(45) NOT NULL,
  `LIMITE` int(11) NOT NULL DEFAULT '0',
  `MOMENTO` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`CODIGO`, `NOME`, `LIMITE`, `MOMENTO`) VALUES
(1, 'TÃ‰CNICO EM INFORMATICA JOSÃ‰', 30, '2020-12-22 12:23:44'),
(2, '1Âº Informatica', 30, '2021-01-09 12:59:32');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `CODIGO` int(11) NOT NULL,
  `NOME` varchar(45) NOT NULL,
  `SOBRENOME` varchar(45) NOT NULL,
  `RUA` varchar(90) NOT NULL,
  `COMPLEMENTO` varchar(45) DEFAULT NULL,
  `BAIRRO` varchar(45) NOT NULL,
  `CIDADE` varchar(45) NOT NULL,
  `ESTADO` varchar(2) NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `PERMISSAO` int(11) NOT NULL DEFAULT '0',
  `SENHA` varchar(45) NOT NULL,
  `ATIVO` int(11) NOT NULL DEFAULT '1',
  `ACESSO` int(11) DEFAULT '0',
  `EMAIL_SECUNDARIO` varchar(200) DEFAULT NULL,
  `escola_CODIGO` int(11) NOT NULL,
  `PESQUISA` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`CODIGO`, `NOME`, `SOBRENOME`, `RUA`, `COMPLEMENTO`, `BAIRRO`, `CIDADE`, `ESTADO`, `EMAIL`, `PERMISSAO`, `SENHA`, `ATIVO`, `ACESSO`, `EMAIL_SECUNDARIO`, `escola_CODIGO`, `PESQUISA`) VALUES
(1, 'jj', 'jj', 'jjhjkj', 'jhh', 'jhkj', 'Crato', 'CE', 'pedrohenrique234322@gmail.com', 2, 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'pedrohenrique234322@gmail.com', 1, 1),
(2, 'Pedro Henrique', 'Martins Pimenta', 'jshkjdhskj', '', 'dhfkjdhfkj', 'Mauriti', 'CE', 'pedrohenrique234322@outlook.com', 1, 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'pedrohenrique234322@gmail.com', 1, 1),
(3, 'Pedro Henrique', 'Martins Pimenta', 'teste', '', 'Buritizinho ', 'Mauriti', 'CE', 'pedrohenrique234322@hotmail.com', 0, 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'pedrohenrique234322@gmail.com', 1, 1),
(4, 'TÃ‰CNICO EM INFORMATICA JOSÃ‰', 'PIMENTA', 'dhfdgfjh', '', 'dhgfhjed', 'Crato', 'CE', 'tecofhome@gmail.com8589699', 0, 'e10adc3949ba59abbe56e057f20f883e', 2, 0, 'pedrohenrique234322@gmail.com', 1, 0),
(5, 'TÃ‰CNICO EM INFORMATICA JOSÃ‰', 'PIMENTA', 'teste', '', 'dhfkjdhfkj', 'Crato', 'CE', 'admpedrohenrique20171@outlook.com', 2, 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'pedrohenrique234322@gmail.com', 2, 1),
(7, 'TÃ‰CNICO EM INFORMATICA JOSÃ‰', 'PIMENTA', 'dhfdgfjh', '', 'SeminÃ¡rio ', 'Crato', 'ce', 'gocomprasdelivery@gmail.com', 1, 'e10adc3949ba59abbe56e057f20f883e', 1, 0, '', 2, 1),
(8, 'Pedro Henrique', 'Pimenta', 'teste', '', 'SeminÃ¡rio', 'Crato', 'CE', 'pedrohenrique234322222222@gmail.com4304617', 2, 'e10adc3949ba59abbe56e057f20f883e', 2, 0, 'pedrohenrique234322@gmail.com', 1, 1),
(9, 'Pedro Henrique', 'Pimenta', 'dhfdgfjh', '', 'dhfkjdhfkj', 'Crato', 'CE', 'pedrohenrique23424614322@gmail.com', 0, 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 'pedrohenrique234322@gmail.com', 1, 1),
(10, 'Pedro Henrique', 'Pimenta', 'Sagrada famÃ­lia ', '', 'SeminÃ¡rio', 'Crato', 'CE', 'pedrohenrique2343224654@gmail.com3917022', 0, 'e10adc3949ba59abbe56e057f20f883e', 2, 0, 'pedrohenrique234322@gmail.com', 1, 1),
(11, 'Pedro Henrique', 'Pimenta', '1', '', 'Buritizinho ', 'Crato', 'CE', 'pedrohenrique2343456522@gmail.com9164716', 1, 'e10adc3949ba59abbe56e057f20f883e', 2, 0, 'pedrohenrique234322@gmail.com', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_has_turma`
--

CREATE TABLE `usuario_has_turma` (
  `usuario_CODIGO` int(11) NOT NULL,
  `turma_CODIGO` int(11) NOT NULL,
  `STATUS` int(11) NOT NULL DEFAULT '1',
  `periodo_CODIGO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario_has_turma`
--

INSERT INTO `usuario_has_turma` (`usuario_CODIGO`, `turma_CODIGO`, `STATUS`, `periodo_CODIGO`) VALUES
(1, 1, 1, NULL),
(3, 1, 1, NULL),
(4, 1, 1, NULL),
(5, 2, 1, NULL),
(10, 1, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternativa`
--
ALTER TABLE `alternativa`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `fk_alternativa_questoes1_idx` (`questoes_CODIGO`);

--
-- Indexes for table `atividade`
--
ALTER TABLE `atividade`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `fk_atividade_usuario1_idx` (`usuario_CODIGO`),
  ADD KEY `fk_atividade_turma1_idx` (`turma_CODIGO`);

--
-- Indexes for table `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `fk_aula_escola1_idx` (`escola_CODIGO`);

--
-- Indexes for table `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `fk_avaliacao_periodo1_idx` (`periodo_CODIGO`),
  ADD KEY `fk_avaliacao_materia1_idx` (`materia_CODIGO`);

--
-- Indexes for table `avaliacao_has_usuario`
--
ALTER TABLE `avaliacao_has_usuario`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `fk_avaliacao_has_usuario_usuario1_idx` (`usuario_CODIGO`),
  ADD KEY `fk_avaliacao_has_usuario_avaliacao1_idx` (`avaliacao_CODIGO`);

--
-- Indexes for table `aviso`
--
ALTER TABLE `aviso`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `fk_aviso_usuario1_idx` (`usuario_CODIGO`);

--
-- Indexes for table `aviso_has_usuario`
--
ALTER TABLE `aviso_has_usuario`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `fk_aviso_has_usuario_usuario1_idx` (`usuario_CODIGO`),
  ADD KEY `fk_aviso_has_usuario_aviso1_idx` (`aviso_CODIGO`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `fk_chat_usuario1_idx` (`SEND_CODIGO`),
  ADD KEY `fk_chat_usuario2_idx` (`RECECIVER_CODIGO`);

--
-- Indexes for table `escola`
--
ALTER TABLE `escola`
  ADD PRIMARY KEY (`CODIGO`),
  ADD UNIQUE KEY `EMAIL_UNIQUE` (`EMAIL`);

--
-- Indexes for table `frequencia`
--
ALTER TABLE `frequencia`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `fk_frequencia_usuario1_idx` (`usuario_CODIGO`),
  ADD KEY `fk_frequencia_periodo1_idx` (`periodo_CODIGO`),
  ADD KEY `fk_frequencia_aula1_idx` (`aula_CODIGO`);

--
-- Indexes for table `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `fk_HORARIO_aula1_idx` (`aula_CODIGO`),
  ADD KEY `fk_HORARIO_materia1_idx` (`materia_CODIGO`);

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `fk_link_usuario1_idx` (`usuario_CODIGO`);

--
-- Indexes for table `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `fk_materia_usuario1_idx` (`usuario_CODIGO`),
  ADD KEY `fk_materia_turma1_idx` (`turma_CODIGO`);

--
-- Indexes for table `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `fk_periodo_escola1_idx` (`escola_CODIGO`);

--
-- Indexes for table `questoes`
--
ALTER TABLE `questoes`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `fk_questoes_avaliacao1_idx` (`avaliacao_CODIGO`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`CODIGO`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`CODIGO`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`CODIGO`),
  ADD UNIQUE KEY `EMAIL_UNIQUE` (`EMAIL`),
  ADD KEY `fk_aluno_escola_idx` (`escola_CODIGO`);

--
-- Indexes for table `usuario_has_turma`
--
ALTER TABLE `usuario_has_turma`
  ADD KEY `fk_usuario_has_turma_turma1_idx` (`turma_CODIGO`),
  ADD KEY `fk_usuario_has_turma_usuario1_idx` (`usuario_CODIGO`),
  ADD KEY `fk_usuario_has_turma_periodo1_idx` (`periodo_CODIGO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternativa`
--
ALTER TABLE `alternativa`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `atividade`
--
ALTER TABLE `atividade`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `aula`
--
ALTER TABLE `aula`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `avaliacao_has_usuario`
--
ALTER TABLE `avaliacao_has_usuario`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aviso`
--
ALTER TABLE `aviso`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aviso_has_usuario`
--
ALTER TABLE `aviso_has_usuario`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `escola`
--
ALTER TABLE `escola`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `frequencia`
--
ALTER TABLE `frequencia`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `horario`
--
ALTER TABLE `horario`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `materia`
--
ALTER TABLE `materia`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `periodo`
--
ALTER TABLE `periodo`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `questoes`
--
ALTER TABLE `questoes`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `alternativa`
--
ALTER TABLE `alternativa`
  ADD CONSTRAINT `fk_alternativa_questoes1` FOREIGN KEY (`questoes_CODIGO`) REFERENCES `questoes` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `atividade`
--
ALTER TABLE `atividade`
  ADD CONSTRAINT `fk_atividade_turma1` FOREIGN KEY (`turma_CODIGO`) REFERENCES `turma` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_atividade_usuario1` FOREIGN KEY (`usuario_CODIGO`) REFERENCES `usuario` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `aula`
--
ALTER TABLE `aula`
  ADD CONSTRAINT `fk_aula_escola1` FOREIGN KEY (`escola_CODIGO`) REFERENCES `escola` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `fk_avaliacao_materia1` FOREIGN KEY (`materia_CODIGO`) REFERENCES `materia` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_avaliacao_periodo1` FOREIGN KEY (`periodo_CODIGO`) REFERENCES `periodo` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `avaliacao_has_usuario`
--
ALTER TABLE `avaliacao_has_usuario`
  ADD CONSTRAINT `fk_avaliacao_has_usuario_avaliacao1` FOREIGN KEY (`avaliacao_CODIGO`) REFERENCES `avaliacao` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_avaliacao_has_usuario_usuario1` FOREIGN KEY (`usuario_CODIGO`) REFERENCES `usuario` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `aviso`
--
ALTER TABLE `aviso`
  ADD CONSTRAINT `fk_aviso_usuario1` FOREIGN KEY (`usuario_CODIGO`) REFERENCES `usuario` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `aviso_has_usuario`
--
ALTER TABLE `aviso_has_usuario`
  ADD CONSTRAINT `fk_aviso_has_usuario_aviso1` FOREIGN KEY (`aviso_CODIGO`) REFERENCES `aviso` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_aviso_has_usuario_usuario1` FOREIGN KEY (`usuario_CODIGO`) REFERENCES `usuario` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `fk_chat_usuario1` FOREIGN KEY (`SEND_CODIGO`) REFERENCES `usuario` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_chat_usuario2` FOREIGN KEY (`RECECIVER_CODIGO`) REFERENCES `usuario` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `frequencia`
--
ALTER TABLE `frequencia`
  ADD CONSTRAINT `fk_frequencia_aula1` FOREIGN KEY (`aula_CODIGO`) REFERENCES `aula` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_frequencia_periodo1` FOREIGN KEY (`periodo_CODIGO`) REFERENCES `periodo` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_frequencia_usuario1` FOREIGN KEY (`usuario_CODIGO`) REFERENCES `usuario` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `fk_HORARIO_aula1` FOREIGN KEY (`aula_CODIGO`) REFERENCES `aula` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_HORARIO_materia1` FOREIGN KEY (`materia_CODIGO`) REFERENCES `materia` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `link`
--
ALTER TABLE `link`
  ADD CONSTRAINT `fk_link_usuario1` FOREIGN KEY (`usuario_CODIGO`) REFERENCES `usuario` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `fk_materia_turma1` FOREIGN KEY (`turma_CODIGO`) REFERENCES `turma` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materia_usuario1` FOREIGN KEY (`usuario_CODIGO`) REFERENCES `usuario` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `periodo`
--
ALTER TABLE `periodo`
  ADD CONSTRAINT `fk_periodo_escola1` FOREIGN KEY (`escola_CODIGO`) REFERENCES `escola` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `questoes`
--
ALTER TABLE `questoes`
  ADD CONSTRAINT `fk_questoes_avaliacao1` FOREIGN KEY (`avaliacao_CODIGO`) REFERENCES `avaliacao` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_aluno_escola` FOREIGN KEY (`escola_CODIGO`) REFERENCES `escola` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario_has_turma`
--
ALTER TABLE `usuario_has_turma`
  ADD CONSTRAINT `fk_usuario_has_turma_periodo1` FOREIGN KEY (`periodo_CODIGO`) REFERENCES `periodo` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_turma_turma1` FOREIGN KEY (`turma_CODIGO`) REFERENCES `turma` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_turma_usuario1` FOREIGN KEY (`usuario_CODIGO`) REFERENCES `usuario` (`CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
