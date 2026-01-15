-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/01/2026 às 00:27
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
-- Banco de dados: `meusite`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome_categoria` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome_categoria`, `descricao`) VALUES
(1, 'Produtividade', 'Ferramentas para aumentar sua produtividade'),
(2, 'Criação de Imagens', NULL),
(3, 'Utilitários', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `inteligencias_artificiais`
--

CREATE TABLE `inteligencias_artificiais` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `nome_ia` varchar(255) NOT NULL,
  `link_ia` varchar(500) NOT NULL,
  `descricao` text DEFAULT NULL,
  `imagem_url` varchar(500) DEFAULT NULL,
  `data_inclusao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `inteligencias_artificiais`
--

INSERT INTO `inteligencias_artificiais` (`id`, `id_categoria`, `nome_ia`, `link_ia`, `descricao`, `imagem_url`, `data_inclusao`) VALUES
(8, 1, 'roadmap', 'https://roadmap.sh/', 'ele serve pra ajuda voce em seu codigo', 'https://tse3.mm.bing.net/th/id/OIP.qehT6Xy-hj8kSXJLlbrvMgAAAA?rs=1&pid=ImgDetMain&o=7&rm=3', '2026-01-14 22:12:51'),
(9, 1, 'emergent', 'https://app.emergent.sh/', 'ele vai ajuda voce em criar site e muita coisa legal', 'https://th.bing.com/th/id/OIP.yj4xWpcA6tw8FKJuDc8NLQAAAA?o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3', '2026-01-14 22:16:16'),
(10, 1, 'same.new', 'https://same.new/', 'Gerador de modelos de páginas web e templates prontos para iniciar projetos rapidamente\r\n(modelos HTML/CSS).', 'https://tse2.mm.bing.net/th/id/OIP.RR87W_ExH8FuP78Bgq79TAAAAA?rs=1&pid=ImgDetMain&o=7&rm=3', '2026-01-14 22:18:22'),
(11, 3, 'file.pizza', 'https://file.pizza/', 'Serviço simples para compartilhar arquivos ponto a ponto via link temporário — ideal para\r\ntransferências rápidas sem cadastro.', 'https://images.rawpixel.com/image_1100/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDI0LTAyL2FuZ3VzdGVvd19hZXJpYWxfdG9wX2Rvd25fdmlld19vZl9waXp6YV9yZWFsaXN0aWNfcGhvdG9ncmFwaHlfbV9kYmRkNmJhMy1jOTBjLTQ1MTUtYmNlMy1mOGE1NjRiNTgyYWNfMS5qcGc.jpg', '2026-01-14 22:20:43'),
(12, 3, 'g-meh', 'https://g-meh.com/', 'Site com ferramentas/scripts — dependendo do serviço, ajuda a identificar ou compilar\r\nprogramas; verifique a página específica para detalhes.', 'https://tse2.mm.bing.net/th/id/OIP.X8AesFZN9tqnNDe4CiTLbAAAAA?rs=1&pid=ImgDetMain&o=7&rm=3', '2026-01-14 22:22:33'),
(13, 1, 'hackerai', 'https://hackerai.co/', 'Chat/assistente com foco em desenvolvimento e hacking ético; usa IA para ajudar a\r\nprogramar, gerar ideias e solucionar problemas (compare com outros chatbots). obs ele tem limitacao de uso', 'https://th.bing.com/th/id/OIP.WrRz6-pJygJj_NwHsTox9wHaHa?o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3', '2026-01-14 22:24:49'),
(14, 2, 'spline.design', 'https://spline.design/', 'Editor 3D online para criar e exportar imagens, cenas e objetos 3D para web — ideal para\r\nprotótipos visuais e ilustrações interativas.', 'https://cc.sj-cdn.net/instructor/1i94b7non60nr-clickup-university/courses/1qlpiosmu87r/promo-image.1691588366.png', '2026-01-14 22:26:40'),
(15, 1, 'deepsite', 'https://deepsite.me/', 'Ferramenta que converte ou gera HTML e pré-visualiza páginas — útil para ver como sua\r\npágina está ficando enquanto desenvolve.', 'https://tse2.mm.bing.net/th/id/OIP.SYTVhXXH9iqkzwhGjlb5lgHaEK?rs=1&pid=ImgDetMain&o=7&rm=3', '2026-01-14 22:28:17'),
(16, 2, 'gambo', 'https://www.gambo.ai/', 'Plataforma que usa IA para ajudar na criação de elementos de jogos — prototipagem de\r\nmecânicas, assets e ideias com suporte por IA.', 'https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/247123066/original/82d728a41c5b865da22507a102a09c3c602964d8/design-simple-and-unique-lettermark-logo.jpg', '2026-01-14 22:30:03'),
(17, 1, 'uiverse.io', 'https://uiverse.io/', 'Coleção de componentes, templates e blocos UI prontos para usar em HTML/CSS — facilita\r\ncriar designs modernos sem partir do zero.', 'https://tse3.mm.bing.net/th/id/OIP.ZuTZDT_Kd1_Ln1ufleSRdQAAAA?rs=1&pid=ImgDetMain&o=7&rm=3', '2026-01-14 22:31:11'),
(18, 2, 'polotno', 'https://studio.polotno.com/', 'Editor online para criar e editar imagens, layouts e pequenas animações — bom para design\r\nrápido de posts e banners.', 'https://play-lh.googleusercontent.com/xRJj_FBXVkfoGTCz-ZRs_jwgwQDg8AnjOOGpjSvzfFCyXaZ4nki-51Whs8TDoG8c7dI', '2026-01-14 22:34:25'),
(19, 3, 'quickref', 'https://quickref.me/', 'Guia de referência rápida com comandos, snippets e dicas para várias linguagens e\r\nferramentas — útil como consulta durante o desenvolvimento.', 'https://tse1.mm.bing.net/th/id/OIP.JjaiqY1FbPegDTlQwugYrQHaEs?rs=1&pid=ImgDetMain&o=7&rm=3', '2026-01-14 22:40:03'),
(20, 3, 'Gerador de Grade CSS', 'https://cssgridgenerator.io/', 'O gerador de grade CSS é uma ferramenta que ajuda desenvolvedores a criar layouts personalizados de grade CSS com mais facilidade. O gerador permite que os usuários especifiquem o número de colunas, fileiras e o tamanho da calha. Feito com', 'https://tse1.mm.bing.net/th/id/OIP.-n1ZOff0a08DBEYB881rVQHaEH?w=600&h=333&rs=1&pid=ImgDetMain&o=7&rm=3', '2026-01-14 22:42:28'),
(21, 2, 'Raphael AI', 'https://raphael.app/', 'é um site que oferece um gerador de imagens com inteligência artificial — gratuito, sem necessidade de login e sem limite de uso:', 'https://static.vecteezy.com/system/resources/previews/003/016/894/large_2x/blue-pink-alphabet-letter-logo-for-branding-and-business-vector.jpg', '2026-01-14 22:48:37'),
(22, 2, 'PublicPrompts', 'https://www.publicprompts.art/', 'é um site que oferece uma biblioteca gratuita de prompts, modelos e recursos para criação de imagens com inteligência artificial', 'https://cdn.textstudio.com/text-effect/877/5ccfa/Public.png', '2026-01-14 22:50:49'),
(24, 3, 'Educação-Código.', 'https://www.freecodecamp.org/', 'é um site de aprendizado de programação gratuito e acessível, onde você pode aprender a programar, fazer desafios e projetos, e ganhar certificações', 'https://miro.medium.com/v2/resize:fit:1167/1*or7zmUdNORBSI3NJft-qgA@2x.jpeg', '2026-01-14 22:55:15');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sugestoes_ia`
--

CREATE TABLE `sugestoes_ia` (
  `id` int(11) NOT NULL,
  `nome_ia` varchar(255) NOT NULL,
  `link_ia` varchar(500) NOT NULL,
  `descricao` text DEFAULT NULL,
  `imagem_url` varchar(500) DEFAULT NULL,
  `comentarios` text DEFAULT NULL,
  `admin_aprovado` tinyint(1) DEFAULT 0,
  `data_sugestao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `sugestoes_ia`
--

INSERT INTO `sugestoes_ia` (`id`, `nome_ia`, `link_ia`, `descricao`, `imagem_url`, `comentarios`, `admin_aprovado`, `data_sugestao`) VALUES
(1, 'gemini', 'https://gemini.google.com/app/', 'chat', 'https://encrypted-tbn0.gstatic.com/licensed-image?q=tbn:ANd9GcTkk3XRqK1ZTv95bL3284LBvpz-4d3amo2iqjHUUye15BGE4j6BWSUNuC2i70N--agkKCL3ouFz8YmoWEyKcBSeu7vz8YOptYomKYkWzIAX0VlUquU', 'ela muito boa pra ajuda faze foto', 1, '2025-11-23 23:45:28'),
(2, 'app.emergent', 'https://app.emergent.sh/landing/', 'faco de uso', 'https://encrypted-tbn0.gstatic.com/licensed-image?q=tbn:ANd9GcTkk3XRqK1ZTv95bL3284LBvpz-4d3amo2iqjHUUye15BGE4j6BWSUNuC2i70N--agkKCL3ouFz8YmoWEyKcBSeu7vz8YOptYomKYkWzIAX0VlUquU', 'goste e recoemndo', 1, '2025-12-21 21:33:19');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha_hash`, `is_admin`, `data_cadastro`) VALUES
(4, 'REGIS APARECIDO FERREIRA RAMOS', 'regis@gmail.com', '$2y$10$iGJVgbHKcQl2OZlFeL0sQOy5O5rXxEQ9V/yulYHwBezbqaAxhCRhK', 1, '2025-11-23 01:26:17'),
(8, 'KILDYMARA CÂNDIDA ARAÚJO SILVA', 'kildymarac@gmail.com', '$2y$10$/VhmoANt4lJeqdsIckMM0OnYSOlnP4aiqm551rTcaZIEIQWoqj3O.', 0, '2026-01-12 23:45:02');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome_categoria` (`nome_categoria`);

--
-- Índices de tabela `inteligencias_artificiais`
--
ALTER TABLE `inteligencias_artificiais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Índices de tabela `sugestoes_ia`
--
ALTER TABLE `sugestoes_ia`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `inteligencias_artificiais`
--
ALTER TABLE `inteligencias_artificiais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `sugestoes_ia`
--
ALTER TABLE `sugestoes_ia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `inteligencias_artificiais`
--
ALTER TABLE `inteligencias_artificiais`
  ADD CONSTRAINT `inteligencias_artificiais_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
