-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/10/2024 às 05:32
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `wev`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `depoimentos`
--

CREATE TABLE `depoimentos` (
  `comentario` text NOT NULL,
  `data_postagem` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `depoimentos`
--

INSERT INTO `depoimentos` (`comentario`, `data_postagem`, `usuario_id`) VALUES
('1', '2024-10-04 17:58:00', NULL),
('aa', '2024-10-04 18:50:53', NULL),
('aa', '2024-10-04 18:51:23', NULL),
('ca', '2024-10-04 18:54:23', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagens`
--

CREATE TABLE `imagens` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `imagem` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `visits` int(11) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lng` varchar(100) NOT NULL,
  `regiao` varchar(50) NOT NULL,
  `descricao` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `places`
--

INSERT INTO `places` (`id`, `name`, `visits`, `foto`, `lat`, `lng`, `regiao`, `descricao`) VALUES
(0, 'Encontro das Águas', 0, 'encontro_das_aguas.png', '-3.1022', '-60.2174', 'Norte', 'Este fenômeno natural ocorre na confluência dos rios Negro e Solimões, onde as águas de diferentes temperaturas e densidades se encontram, mas não se misturam. Os visitantes podem fazer passeios de barco para observar essa incrível junção, além de desfrutar da rica fauna e flora da região amazônica.'),
(0, 'Parque Nacional de Anavilhanas', 0, 'anavilhanas.png', '-3.0593', '-60.1948', 'Norte', 'Este parque abriga um dos maiores arquipélagos fluviais do mundo, com mais de 400 ilhas. Os turistas podem explorar trilhas, praticar ecoturismo e observar a vida selvagem, incluindo botos, aves raras e uma rica vegetação de igapós.'),
(0, 'Floresta Nacional do Tapajós', 0, 'tapajos.png', '-2.9018', '-55.9733', 'Norte', 'Uma vasta área de floresta tropical preservada, ideal para trilhas, observação de pássaros e experiências de imersão na biodiversidade da Amazônia. O visitante pode também conhecer as comunidades ribeirinhas e suas práticas sustentáveis.'),
(0, 'Teatro Amazonas', 1, 'teatro_amazonas.png', '-3.0982', '-60.0213', 'Norte', 'Um dos principais símbolos da era do ciclo da borracha, o teatro é famoso por sua arquitetura neoclássica e interior ricamente decorado. Os visitantes podem fazer visitas guiadas e apreciar apresentações de ópera, balé e música clássica.'),
(0, 'Parque Nacional da Chapada dos Guimarães', 0, 'chapada_guimaraes.png', '-15.4231', '-55.7110', 'Norte', 'Este parque é conhecido por suas impressionantes formações rochosas, cachoeiras e mirantes deslumbrantes. Ideal para caminhadas e trilhas, é também um ótimo local para observação de vida selvagem e apreciação da natureza.'),
(0, 'Praia de Jericoacoara', 1, 'jericoacoara.png', '-2.7906893', '-40.5204057', 'Nordeste', 'Com suas belas dunas e lagoas de água cristalina, Jericoacoara é perfeita para práticas de esportes aquáticos, como windsurf e kitesurf. A vila tem um charme rústico, com pousadas aconchegantes e restaurantes que servem frutos do mar frescos.'),
(0, 'Fernando de Noronha', 0, 'noronha.png', '-3.8579', '-32.4280', 'Nordeste', 'Este arquipélago é famoso por suas praias paradisíacas e biodiversidade marinha. Os visitantes podem fazer mergulho com snorkel ou cilindro, observar tartarugas e golfinhos, além de relaxar em praias de areia branca e águas cristalinas.'),
(0, 'Pantanal', 0, 'pantanal.png', '-19.2018', '-56.5084', 'Centro-Oeste', 'O Pantanal é a maior área alagada do mundo e abriga uma diversidade incrível de vida selvagem, incluindo onças-pintadas, jacarés e uma infinidade de aves. Os visitantes podem fazer safáris fotográficos, passeios a cavalo e experimentar a cultura local.'),
(0, 'Chapada dos Guimarães', 1, 'chapada_guimaraes.png', '-15.3833', '-55.4375', 'Centro-Oeste', 'Este destino oferece vistas deslumbrantes, trilhas em meio à natureza e diversas cachoeiras. Os visitantes podem explorar cavernas e apreciar a rica biodiversidade local, além de participar de passeios guiados.'),
(0, 'Brasília', 0, 'brasilia.png', '-15.7801', '-47.9292', 'Centro-Oeste', 'A capital do Brasil é um exemplo de urbanismo moderno, com sua arquitetura única projetada por Oscar Niemeyer. Os visitantes podem conhecer os principais pontos turísticos, como o Congresso Nacional, a Catedral e o Palácio da Alvorada, além de desfrutar de parques e lagos.'),
(0, 'Parque Nacional da Chapada dos Veadeiros', 0, 'veadeiros.png', '-14.1944', '-47.4167', 'Centro-Oeste', 'Um local de beleza natural impressionante, com cachoeiras, formações rochosas e trilhas desafiadoras. O parque é ideal para ecoturismo, onde os visitantes podem se conectar com a natureza e observar uma rica fauna e flora.'),
(0, 'Cidade de Goiás', 0, 'goias.png', '-15.9406', '-50.1566', 'Centro-Oeste', 'Uma cidade histórica que preserva a arquitetura colonial e o charme do passado. Os visitantes podem explorar museus, igrejas e conhecer a história de grandes figuras da literatura brasileira, além de desfrutar da culinária local.'),
(0, 'Cristo Redentor', 2, 'cristo_redentor.png', '-22.9518903', '-43.2101997', 'Sudeste', 'Uma das Novas Sete Maravilhas do Mundo, a estátua do Cristo Redentor oferece vistas espetaculares do Rio de Janeiro. Os visitantes podem acessar o monumento através de vans ou trem e explorar a área ao redor, que conta com um lindo parque.'),
(0, 'Parque Nacional da Serra da Canastra', 1, 'canastra.png', '-20.2540634', '-46.4190149', 'Sudeste', 'Este parque é famoso por suas cachoeiras e a rica fauna, incluindo o lobo-guará e a onça-pintada. Os visitantes podem fazer trilhas, acampar e observar a natureza em seu estado mais puro.'),
(0, 'Avenida Paulista', 0, 'av_paulista.png', '-23.5611', '-46.6550', 'Sudeste', 'O coração financeiro de São Paulo, a Avenida Paulista é cercada por museus, centros culturais e lojas. Os visitantes podem aproveitar os diversos eventos culturais, feiras e o famoso Parque Trianon ao longo da avenida.'),
(0, 'Ouro Preto', 0, 'ouro_preto.png', '-20.3852', '-43.5034', 'Sudeste', 'Uma cidade histórica famosa por sua arquitetura barroca e rica história da mineração de ouro. Os visitantes podem explorar igrejas, museus e as ruas de pedra, além de participar de festivais de cultura local.'),
(0, 'Parque Ibirapuera', 1, 'ibirapuera.png', '-23.5874', '-46.6569', 'Sudeste', 'Um dos maiores parques urbanos do Brasil, oferece áreas para caminhadas, lagos, museus e espaços culturais. Os visitantes podem relaxar em meio à natureza, praticar esportes e participar de eventos culturais.'),
(0, 'Gramado', 0, 'gramado.png', '-29.3702', '-50.8108', 'Sul', 'Conhecida por seu clima europeu, Gramado é famosa por suas festividades, como o Natal Luz. Os visitantes podem desfrutar de chocolates caseiros, passeios de pedalinho e atrações turísticas, como o Mini Mundo e o Lago Negro.'),
(0, 'Florianópolis', 2, 'florianopolis.png', '-27.5722619', '-48.4218137', 'Sul', 'A ilha é famosa por suas belas praias, trilhas e gastronomia baseada em frutos do mar. Os visitantes podem explorar as praias, fazer caminhadas em áreas naturais e experimentar a cultura local nas festividades.'),
(0, 'Parque Nacional de Aparados da Serra', 1, 'aparados.png', '-29.2027', '-49.4231', 'Sul', 'Com desfiladeiros impressionantes e cachoeiras, o parque é ideal para caminhadas e observação de aves. Os visitantes podem explorar trilhas e desfrutar das vistas panorâmicas.'),
(0, 'Bento Gonçalves', 0, 'bento_goncalves.png', '-29.1669', '-51.5128', 'Sul', 'A capital do vinho no Brasil oferece experiências enológicas, com visitas a vinícolas e degustações. Os visitantes podem explorar a cultura italiana da região e participar de festivais de vinho.'),
(0, 'Parque Nacional da Serra Geral', 0, 'serra_geral.png', '-29.2012', '-50.4153', 'Sul', 'O parque é conhecido por suas montanhas e paisagens deslumbrantes. Os visitantes podem fazer trilhas, praticar escalada e observar a biodiversidade local, incluindo diversas espécies de plantas e animais.'),
(0, 'Lençóis Maranhenses', 1, 'lencois.png', '-2.4859385', '-43.128407', 'Nordeste', 'Os Lençóis Maranhenses são um parque nacional localizado no estado do Maranhão, famoso por suas extensas dunas de areia branca e lagoas de água doce que se formam durante a estação das chuvas. O local oferece vistas deslumbrantes, oportunidades para caminhadas, e um ecossistema único que abriga diversas espécies de fauna e flora. É um destino ideal para quem busca aventuras e contato com a natureza.'),
(0, 'cac', 0, 'Balneario-Camboriu-vista-de-cima.png', '111', '1111', 'nordeste', 'aa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `imagem` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `imagem`) VALUES
(24, 'caio', 'testetadeu@1', 'c4ca4238a0b923820dcc509a6f75849b', ''),
(25, 'adm', 'adm', 'c4ca4238a0b923820dcc509a6f75849b', ''),
(26, 'adm11', 'adm11', 'c4ca4238a0b923820dcc509a6f75849b', ''),
(27, 'tadeu', 'tadeu', 'c4ca4238a0b923820dcc509a6f75849b', ''),
(28, 'gabriel', 'gabriel@gmail.com', '8833f1325fb6341757b30f6de91487a5', ''),
(38, 'mazur2', 'mazur2@gmail.com', '$2y$10$k6SIQKsLoakQY8vr2LXO3epGyHcO97OVRPXXjKM1YP21JQPDItP/u', ''),
(39, 'ghasdj', 'asdwa@gmail.com', '$2y$10$EK8zsHcM5kI8BGZzxoVS/emcY0hUSkM0YuYNxkZI/Oj/GO6D1gk5W', ''),
(40, 'caioagr', 'cacac@fafa.com', '$2y$10$pBze0na4Hh/EdaABbzZeiO.a/KTd/mwrM5OypXxI3SxhMVhbdn0U6', ''),
(41, 'ca', 'leonatelhorrivel@gmail.com', '$2y$10$7Kfvj5/P1kyThptE5ALI7e1xS7G0oAG79REIsx7Xxu67N1G5tkkp6', ''),
(42, 'caio1234', 'caio', 'c4ca4238a0b923820dcc509a6f75849b', ''),
(43, '1', 'caiosanchesm@gmail.com', '$2y$10$aTCmD2u357HTSdEignN2reAln.JIIgT7ZIMVu7WzLeWLVApcEMMkW', ''),
(44, 'caio sanches', 'agr@1', '$2y$10$71Bzuv5RNWkO7dTCzHZhqumoZikxG4kKNgRuV0RYcWSA/nlmvcZdy', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `depoimentos`
--
ALTER TABLE `depoimentos`
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `imagens`
--
ALTER TABLE `imagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `imagens`
--
ALTER TABLE `imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `depoimentos`
--
ALTER TABLE `depoimentos`
  ADD CONSTRAINT `depoimentos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `imagens`
--
ALTER TABLE `imagens`
  ADD CONSTRAINT `imagens_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
