-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Set-2019 às 06:14
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `testback`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `headersrequest`
--

CREATE TABLE `headersrequest` (
  `id` int(10) UNSIGNED NOT NULL,
  `accept` varchar(10) NOT NULL,
  `host` varchar(100) NOT NULL,
  `user_agent` varchar(50) NOT NULL,
  `headers_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `headersresponse`
--

CREATE TABLE `headersresponse` (
  `id` int(10) UNSIGNED NOT NULL,
  `content_length` varchar(30) NOT NULL,
  `via` varchar(30) NOT NULL,
  `connection` varchar(10) NOT NULL,
  `access_control_allow_credentials` varchar(10) NOT NULL,
  `content_type` varchar(50) NOT NULL,
  `server` varchar(50) NOT NULL,
  `access_control_allow_origin` varchar(10) NOT NULL,
  `headers_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `latencies`
--

CREATE TABLE `latencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `proxy` varchar(10) NOT NULL,
  `kong` varchar(10) NOT NULL,
  `request_lat` varchar(10) NOT NULL,
  `request_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_09_17_005513_create_reques_table', 1),
(2, '2019_09_17_005600_create_respons_table', 1),
(3, '2019_09_17_005622_create_headersrequest_table', 1),
(4, '2019_09_17_005636_create_headersresponse_table', 1),
(5, '2019_09_17_005657_create_route_table', 1),
(6, '2019_09_17_005715_create_servic_table', 1),
(7, '2019_09_17_005745_create_latencies_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reques`
--

CREATE TABLE `reques` (
  `id` int(10) UNSIGNED NOT NULL,
  `method` varchar(10) NOT NULL,
  `uri` varchar(10) NOT NULL,
  `url` varchar(150) NOT NULL,
  `size` varchar(10) NOT NULL,
  `upstream_uri` varchar(10) NOT NULL,
  `uuid` varchar(50) NOT NULL,
  `client_ip` varchar(100) NOT NULL,
  `created_at` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `respons`
--

CREATE TABLE `respons` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `request_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `route`
--

CREATE TABLE `route` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` varchar(10) NOT NULL,
  `hosts` varchar(150) NOT NULL,
  `route_id` varchar(150) NOT NULL,
  `methods` varchar(150) NOT NULL,
  `path` varchar(10) NOT NULL,
  `preserve_host` varchar(10) NOT NULL,
  `protocols` varchar(50) NOT NULL,
  `regex_priority` varchar(10) NOT NULL,
  `service_id` varchar(150) NOT NULL,
  `strip_path` varchar(10) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `request_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servic`
--

CREATE TABLE `servic` (
  `id` int(10) UNSIGNED NOT NULL,
  `content_timeout` varchar(20) NOT NULL,
  `created_at` varchar(30) NOT NULL,
  `host` varchar(100) NOT NULL,
  `service_id` varchar(150) NOT NULL,
  `name` varchar(50) NOT NULL,
  `path` varchar(10) NOT NULL,
  `port` varchar(10) NOT NULL,
  `protocol` varchar(10) NOT NULL,
  `read_timeout` varchar(20) NOT NULL,
  `retries` varchar(10) NOT NULL,
  `updated_at` varchar(30) NOT NULL,
  `write_timeout` varchar(20) NOT NULL,
  `request_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `headersrequest`
--
ALTER TABLE `headersrequest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `headersrequest_headers_id_foreign` (`headers_id`);

--
-- Índices para tabela `headersresponse`
--
ALTER TABLE `headersresponse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `headersresponse_headers_id_foreign` (`headers_id`);

--
-- Índices para tabela `latencies`
--
ALTER TABLE `latencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `latencies_request_id_foreign` (`request_id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `reques`
--
ALTER TABLE `reques`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `respons`
--
ALTER TABLE `respons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `respons_request_id_foreign` (`request_id`);

--
-- Índices para tabela `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`id`),
  ADD KEY `route_request_id_foreign` (`request_id`);

--
-- Índices para tabela `servic`
--
ALTER TABLE `servic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `servic_request_id_foreign` (`request_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `headersrequest`
--
ALTER TABLE `headersrequest`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `headersresponse`
--
ALTER TABLE `headersresponse`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `latencies`
--
ALTER TABLE `latencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `reques`
--
ALTER TABLE `reques`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `respons`
--
ALTER TABLE `respons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `route`
--
ALTER TABLE `route`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `servic`
--
ALTER TABLE `servic`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `headersrequest`
--
ALTER TABLE `headersrequest`
  ADD CONSTRAINT `headersrequest_headers_id_foreign` FOREIGN KEY (`headers_id`) REFERENCES `reques` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `headersresponse`
--
ALTER TABLE `headersresponse`
  ADD CONSTRAINT `headersresponse_headers_id_foreign` FOREIGN KEY (`headers_id`) REFERENCES `respons` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `latencies`
--
ALTER TABLE `latencies`
  ADD CONSTRAINT `latencies_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `reques` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `respons`
--
ALTER TABLE `respons`
  ADD CONSTRAINT `respons_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `reques` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `reques` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `servic`
--
ALTER TABLE `servic`
  ADD CONSTRAINT `servic_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `reques` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
