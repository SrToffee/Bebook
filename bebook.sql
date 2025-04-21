-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Abr-2022 às 23:06
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bebook`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `author`
--

CREATE TABLE `author` (
  `id_author` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `author`
--

INSERT INTO `author` (`id_author`, `name`) VALUES
(1, 'george'),
(2, 'martin'),
(3, 'rose');

-- --------------------------------------------------------

--
-- Estrutura da tabela `book`
--

CREATE TABLE `book` (
  `id_book` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `pbl_date` date DEFAULT NULL,
  `price` float NOT NULL,
  `ISBN` int(11) DEFAULT NULL,
  `id_pub` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `book`
--

INSERT INTO `book` (`id_book`, `name`, `pbl_date`, `price`, `ISBN`, `id_pub`) VALUES
(1, 'GOT', '0000-00-00', 12.99, 789567789, 1),
(2, 'harry po', '0000-00-00', 13.99, 789439, 1),
(3, 'hgo', '0000-00-00', 13.99, 789439, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `book_author`
--

CREATE TABLE `book_author` (
  `id_author` int(11) NOT NULL,
  `id_book` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `book_author`
--

INSERT INTO `book_author` (`id_author`, `id_book`) VALUES
(1, 1),
(2, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `book_gender`
--

CREATE TABLE `book_gender` (
  `id_book` int(11) NOT NULL,
  `id_gender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `book_gender`
--

INSERT INTO `book_gender` (`id_book`, `id_gender`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `gender`
--

CREATE TABLE `gender` (
  `id_gender` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `gender`
--

INSERT INTO `gender` (`id_gender`, `name`) VALUES
(1, 'fantasy');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `o_date` date NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `order_d`
--

CREATE TABLE `order_d` (
  `id_order` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `price` float NOT NULL,
  `quant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `publisher`
--

CREATE TABLE `publisher` (
  `id_pub` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `publisher`
--

INSERT INTO `publisher` (`id_pub`, `name`) VALUES
(1, 'escape');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `u_type` int(11) NOT NULL,
  `zip` varchar(30) DEFAULT NULL,
  `address` varchar(70) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `borndate` date DEFAULT '2001-01-01',
  `pic` varchar(30) DEFAULT '_uploads/defaulpic.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `password`, `u_type`, `zip`, `address`, `contact`, `borndate`, `pic`) VALUES
(1, 'admin', 'admin@email.com', 'Test1234.', 0, NULL, NULL, NULL, '2001-01-01', '_uploads/defaulpic.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `zip_code`
--

CREATE TABLE `zip_code` (
  `zip` varchar(8) NOT NULL,
  `region` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id_author`);

--
-- Índices para tabela `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id_book`);

--
-- Índices para tabela `book_author`
--
ALTER TABLE `book_author`
  ADD PRIMARY KEY (`id_author`,`id_book`),
  ADD KEY `id_book` (`id_book`);

--
-- Índices para tabela `book_gender`
--
ALTER TABLE `book_gender`
  ADD PRIMARY KEY (`id_book`,`id_gender`),
  ADD KEY `id_gender` (`id_gender`);

--
-- Índices para tabela `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id_gender`);

--
-- Índices para tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices para tabela `order_d`
--
ALTER TABLE `order_d`
  ADD PRIMARY KEY (`id_order`,`id_book`),
  ADD KEY `id_book` (`id_book`);

--
-- Índices para tabela `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id_pub`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `zip` (`zip`);

--
-- Índices para tabela `zip_code`
--
ALTER TABLE `zip_code`
  ADD PRIMARY KEY (`zip`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `author`
--
ALTER TABLE `author`
  MODIFY `id_author` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `book`
--
ALTER TABLE `book`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `gender`
--
ALTER TABLE `gender`
  MODIFY `id_gender` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id_pub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `book_author`
--
ALTER TABLE `book_author`
  ADD CONSTRAINT `book_author_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `author` (`id_author`),
  ADD CONSTRAINT `book_author_ibfk_2` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_book`);

--
-- Limitadores para a tabela `book_gender`
--
ALTER TABLE `book_gender`
  ADD CONSTRAINT `book_gender_ibfk_1` FOREIGN KEY (`id_gender`) REFERENCES `gender` (`id_gender`),
  ADD CONSTRAINT `book_gender_ibfk_2` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_book`);

--
-- Limitadores para a tabela `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Limitadores para a tabela `order_d`
--
ALTER TABLE `order_d`
  ADD CONSTRAINT `order_d_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_book`),
  ADD CONSTRAINT `order_d_ibfk_2` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`);

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`zip`) REFERENCES `zip_code` (`zip`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
