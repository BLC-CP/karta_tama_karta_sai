-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2024 at 06:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kartamci`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(15) UNSIGNED NOT NULL,
  `nrn_admin` varchar(255) NOT NULL,
  `sexo` enum('Mane','Feto') NOT NULL,
  `data_moris` varchar(15) NOT NULL,
  `tlp` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` text NOT NULL,
  `id_direksaun` int(15) UNSIGNED NOT NULL,
  `levelkarta` enum('adminkarta','userkarta') NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nrn_admin`, `sexo`, `data_moris`, `tlp`, `email`, `password`, `id_direksaun`, `levelkarta`, `img`) VALUES
(23, 'Brito Lazaro da Conceicao', 'Mane', '1996-07-27', '75684634', 'britomci@gmail.com', '$2y$10$IlHzXMt0j4vDtArbOSG0DO01mpbo99E3FgQHA5AC04tM3mYxTQUDW', 33, 'adminkarta', 'gg.jpg'),
(24, 'Marzenio Lopes', 'Mane', '1995-06-15', '76765645', 'marzenio@gmail.com', '$2y$10$/f3DX728VD2ialil/IfqOOu.uMWziXaqzJzczNl3SUEW4r4mFQAIK', 38, 'userkarta', '1728827124498.jpg'),
(25, 'Antonia da Conceicao', 'Feto', '1999-06-30', '76112244', 'antonia@gmail.com', '$2y$10$jFSIDuxEzVobDd4m3rlOB.KmahYo6FAcSa1fIWyuEhT0EvPrTlNdq', 11, 'userkarta', 'avatar-4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_direksaun`
--

CREATE TABLE `tb_direksaun` (
  `id_direksaun` int(15) UNSIGNED NOT NULL,
  `nrn_direksaun` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_direksaun`
--

INSERT INTO `tb_direksaun` (`id_direksaun`, `nrn_direksaun`) VALUES
(1, 'Direção-Geral dos   Serviços Corporativos'),
(2, 'Direção-Geral   do Comércio'),
(5, 'Direção-Geral   da Indústria'),
(6, 'Gabinete de Cooperação,  Parcerias e Reformas'),
(7, 'Interno'),
(8, 'Direção Gabinete de Apoio  Jurídico'),
(9, 'Direção Gabinete de Inspeção   e Auditoria'),
(10, 'Direção Nacional de  Coordenação de Serviços  e Planeamento'),
(11, 'Departamento   de Pesquisa'),
(12, 'Departamento de Gestão  de Dados e Estatística'),
(13, 'Direção Nacional de  Finanças'),
(14, 'Departamento de Contabilidade   e Verificação'),
(15, 'Departamento de   Orçamento e Receitas'),
(16, 'Departamento de   Pagamentos'),
(17, 'Direção Nacional de  Recursos Humanos'),
(18, 'Departamento de Gestão   de Recursos Humanos'),
(19, 'Departamento de Planeamento  de Recursos Humanos'),
(20, 'Direção Nacional de  Aprovisionamento'),
(21, 'Departamento de  Aprovisionamento Geral'),
(22, 'Departamento de Estatística   do Aprovisionamento'),
(23, 'Direção Nacional de   Logística e Património'),
(24, 'Departamento de Gestão   de Frotas e Propriedades'),
(25, 'Departamento de   Fornecimento e Gestão   de Armazenagem'),
(27, 'Direção Nacional do   Comércio Interno'),
(28, 'Departamento de   Licenciamento e Cadastro'),
(29, 'Departamento de   Desenvolvimento de Mercados'),
(30, 'Direção Nacional do   Comércio Externo'),
(31, 'Departamento de Cooperação  Internaciona'),
(32, 'Departamento de Exportação   e Importação'),
(33, 'Direção Nacional de Marketing'),
(34, 'Departamento de Marketing e   Apoio Técnico'),
(35, 'Departamento de Apoio às  Atividades Comerciais'),
(36, 'Departamento de Média e  Tecnologias de Informação e  Comunicação'),
(37, 'Direção Nacional de Regulação  Comercial e Proteção de   Consumidores'),
(38, 'Departamento de Regulação   e Padrões'),
(39, 'Departamento de Controlo e  Monitorização de Preços'),
(40, 'Departamento de Proteção de  Consumidores'),
(41, 'Direção Nacional do   Desenvolvimento Industrial'),
(42, 'Departamento de  Parques Industriais'),
(43, 'Departamento de Apoio  a Centros Industriais'),
(44, 'Departamento de  Licenciamento Industrial  e Cadastro'),
(45, 'Direção Nacional da   Indústria Manufatureira'),
(46, 'Departamento de Apoio às  Atividades Industriais'),
(47, 'Departamento de Indústria   Pesada e Bens de Consumo'),
(48, 'Direção Nacional de Apoio ao  Desenvolvimento das Micro,   Pequenas e Médias Empresas'),
(49, 'Departamento de Apoio às   Micro, Pequenas e   Médias Empresas'),
(50, 'Departamento de Apoio ao   Desenvolvimento e Inovação   Empresarial');

-- --------------------------------------------------------

--
-- Table structure for table `tb_fasilidade`
--

CREATE TABLE `tb_fasilidade` (
  `id_fasilidade` varchar(25) NOT NULL,
  `data_registu` varchar(15) NOT NULL,
  `deskrisaun` text NOT NULL,
  `marka` varchar(200) NOT NULL,
  `modelu` varchar(255) NOT NULL,
  `serial_number` varchar(100) NOT NULL,
  `kondisaun` enum('Diak','Ladiak') NOT NULL,
  `id_staff` int(15) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_fasilidade`
--

INSERT INTO `tb_fasilidade` (`id_fasilidade`, `data_registu`, `deskrisaun`, `marka`, `modelu`, `serial_number`, `kondisaun`, `id_staff`) VALUES
('RDTL-01', '2024-10-13', 'Computer', 'Dell', 'Code i3', '424243', 'Diak', 5),
('RDTL-02', '2024-10-13', 'Computer', 'HP', 'Code i7', '52324', 'Diak', 4),
('RDTL-03', '2024-10-13', 'Laptop', 'Lenovo', 'Core i7', '3432423', 'Diak', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_karta_sai`
--

CREATE TABLE `tb_karta_sai` (
  `id_karta_sai` int(10) UNSIGNED NOT NULL,
  `id_admin` int(10) UNSIGNED NOT NULL,
  `id_direksaun` int(15) UNSIGNED NOT NULL,
  `data_karta_sai` varchar(15) NOT NULL,
  `no_ref` varchar(15) NOT NULL,
  `asuntu` text NOT NULL,
  `hato` varchar(255) NOT NULL,
  `kategoria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_karta_sai`
--

INSERT INTO `tb_karta_sai` (`id_karta_sai`, `id_admin`, `id_direksaun`, `data_karta_sai`, `no_ref`, `asuntu`, `hato`, `kategoria`) VALUES
(11, 25, 7, '2024-10-13', '422364', 'Partisipa Seromonia Lansamentu Website', 'Sr. Fabiano da Conceicao', 'Ho respeito ami konvida Sr. Fabiano da Conceicao, hodi bele mai partisipa serimonia lansamentu Website MCI nian');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karta_tama`
--

CREATE TABLE `tb_karta_tama` (
  `id_karta_tama` int(15) UNSIGNED NOT NULL,
  `id_admin` int(15) UNSIGNED NOT NULL,
  `id_direksaun` int(15) UNSIGNED NOT NULL,
  `data_karta_tama` varchar(15) NOT NULL,
  `no_ref` int(15) NOT NULL,
  `asuntu` text NOT NULL,
  `hato` varchar(255) NOT NULL,
  `kategoria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_karta_tama`
--

INSERT INTO `tb_karta_tama` (`id_karta_tama`, `id_admin`, `id_direksaun`, `data_karta_tama`, `no_ref`, `asuntu`, `hato`, `kategoria`) VALUES
(13, 24, 2, '2024-10-13', 4523, 'Enkontru Geral', 'Dr. Juvencio da Conceicao', 'Ho respeito ami konvida Dr. Juvencio da Conceicao hodi bele mai tuir enkontru'),
(14, 24, 5, '2024-10-13', 53534, 'Limpeza', 'Sr. Jose Amelio da Conceioca', 'Ho respeito ami hato ba Sr. Jose Amelio da Conceioca, hodi hato ba staff sira hotu hodi bele halo limpeza iha loron sesta feira');

-- --------------------------------------------------------

--
-- Table structure for table `tb_staff`
--

CREATE TABLE `tb_staff` (
  `id_staff` int(15) UNSIGNED NOT NULL,
  `nrn_staff` varchar(200) NOT NULL,
  `sexo_staff` enum('Mane','Feto') NOT NULL,
  `data_moris_staff` varchar(15) NOT NULL,
  `tlp_staff` varchar(15) NOT NULL,
  `email_staff` varchar(150) NOT NULL,
  `id_admin` int(15) UNSIGNED NOT NULL,
  `img_staff` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_staff`
--

INSERT INTO `tb_staff` (`id_staff`, `nrn_staff`, `sexo_staff`, `data_moris_staff`, `tlp_staff`, `email_staff`, `id_admin`, `img_staff`) VALUES
(4, 'Josefina Ribeiro', 'Feto', '1996-12-31', '75167002', 'josefina@gmail.com', 25, 'Photo on 03-05-2024 at 13.21.jpg'),
(5, 'Edeit Asoryantho', 'Mane', '1996-11-29', '75656443', 'edeit@gail.com', 24, 'Screenshot 2024-10-10 101348.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_direksaun` (`id_direksaun`);

--
-- Indexes for table `tb_direksaun`
--
ALTER TABLE `tb_direksaun`
  ADD PRIMARY KEY (`id_direksaun`);

--
-- Indexes for table `tb_fasilidade`
--
ALTER TABLE `tb_fasilidade`
  ADD PRIMARY KEY (`id_fasilidade`),
  ADD KEY `id_staff` (`id_staff`);

--
-- Indexes for table `tb_karta_sai`
--
ALTER TABLE `tb_karta_sai`
  ADD PRIMARY KEY (`id_karta_sai`),
  ADD UNIQUE KEY `no_ref` (`no_ref`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_dsm` (`id_direksaun`);

--
-- Indexes for table `tb_karta_tama`
--
ALTER TABLE `tb_karta_tama`
  ADD PRIMARY KEY (`id_karta_tama`),
  ADD UNIQUE KEY `no_ref` (`no_ref`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_dst` (`id_direksaun`);

--
-- Indexes for table `tb_staff`
--
ALTER TABLE `tb_staff`
  ADD PRIMARY KEY (`id_staff`),
  ADD KEY `id_direksaun_staff` (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tb_direksaun`
--
ALTER TABLE `tb_direksaun`
  MODIFY `id_direksaun` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tb_karta_sai`
--
ALTER TABLE `tb_karta_sai`
  MODIFY `id_karta_sai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_karta_tama`
--
ALTER TABLE `tb_karta_tama`
  MODIFY `id_karta_tama` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_staff`
--
ALTER TABLE `tb_staff`
  MODIFY `id_staff` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD CONSTRAINT `tb_admin_ibfk_1` FOREIGN KEY (`id_direksaun`) REFERENCES `tb_direksaun` (`id_direksaun`);

--
-- Constraints for table `tb_fasilidade`
--
ALTER TABLE `tb_fasilidade`
  ADD CONSTRAINT `tb_fasilidade_ibfk_2` FOREIGN KEY (`id_staff`) REFERENCES `tb_staff` (`id_staff`);

--
-- Constraints for table `tb_karta_sai`
--
ALTER TABLE `tb_karta_sai`
  ADD CONSTRAINT `tb_karta_sai_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `tb_admin` (`id_admin`);

--
-- Constraints for table `tb_karta_tama`
--
ALTER TABLE `tb_karta_tama`
  ADD CONSTRAINT `tb_karta_tama_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `tb_admin` (`id_admin`);

--
-- Constraints for table `tb_staff`
--
ALTER TABLE `tb_staff`
  ADD CONSTRAINT `tb_staff_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `tb_admin` (`id_admin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
