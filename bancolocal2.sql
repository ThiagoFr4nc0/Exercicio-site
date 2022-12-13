--
-- Banco de dados: `bancolocal`
--

CREATE DATABASE `bancolocal`;
USE `bancolocal`;

--
-- Estrutura da tabela `tarefas`
--

DROP TABLE IF EXISTS `tarefas`;
CREATE TABLE IF NOT EXISTS `tarefas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codusuario` int(11) NOT NULL,
  `data_hora` datetime NOT NULL,
  `descricao` text,
  PRIMARY KEY (`codigo`),
  KEY `fk_tarefas_codusuario` (`codusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tarefas`
--

INSERT INTO `tarefas` (`codigo`, `codusuario`, `data_hora`, `descricao`) VALUES
(2, 8, '2022-11-27 19:39:22', 'Calcular Imposto de Renda'),
(3, 8, '2022-11-27 19:40:09', 'Ir ao Supermercado'),
(4, 8, '2022-11-28 22:24:17', ' AAAA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `email` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `verificador` int(5) NOT NULL,
  `verificado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`codigo`, `nome`, `email`, `usuario`, `senha`, `verificador`, `verificado`) VALUES
(8, 'Jhonatan Galante', 'jhonatangalante@hotmail.com', 'jhonatan', '7c4a8d09ca3762af61e59520943dc26494f8941b', 5849, 1);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD CONSTRAINT `fk_tarefas_codusuario` FOREIGN KEY (`codusuario`) REFERENCES `usuarios` (`codigo`);
COMMIT;

