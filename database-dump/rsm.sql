-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Nov 22, 2019 alle 19:21
-- Versione del server: 10.1.38-MariaDB-0+deb9u1
-- Versione PHP: 7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rsm`
--

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `consTotPro_view`
-- (Vedi sotto per la vista effettiva)
--
DROP VIEW IF EXISTS `consTotPro_view`;
CREATE TABLE `consTotPro_view` (
`STO_ID` int(5)
,`STO_PRS_ID` varchar(10)
,`PRO_proname` varchar(200)
,`PRO_measureunit` varchar(200)
,`PRO_pack` varchar(200)
,`SUP_supname` varchar(200)
,`sum_plus` decimal(32,1)
,`sum_minus` decimal(32,1)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `consTotSto_view`
-- (Vedi sotto per la vista effettiva)
--
DROP VIEW IF EXISTS `consTotSto_view`;
CREATE TABLE `consTotSto_view` (
`STO_ID` int(5)
,`STO_PRS_ID` varchar(10)
,`PRO_proname` varchar(200)
,`PRO_measureunit` varchar(200)
,`PRO_pack` varchar(200)
,`SUP_supname` varchar(200)
,`STO_WAH_ID` varchar(10)
,`WAH_wahname` varchar(200)
,`sum_plus` decimal(32,1)
,`sum_minus` decimal(32,1)
);

-- --------------------------------------------------------

--
-- Struttura della tabella `consumption`
--

DROP TABLE IF EXISTS `consumption`;
CREATE TABLE `consumption` (
  `CON_ID` int(5) NOT NULL,
  `CON_STO_ID` int(5) NOT NULL,
  `CON_plus` decimal(10,1) NOT NULL,
  `CON_minus` decimal(10,1) NOT NULL,
  `CON_STO_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `consumption`
--

INSERT INTO `consumption` (`CON_ID`, `CON_STO_ID`, `CON_plus`, `CON_minus`, `CON_STO_date`) VALUES
(36, 42, '36.0', '0.0', '2019-05-28 20:26:53'),
(37, 43, '2.0', '0.0', '2019-06-19 09:03:40'),
(38, 44, '20.0', '0.0', '2019-06-19 09:35:19'),
(39, 42, '0.0', '1.0', '0000-00-00 00:00:00'),
(40, 44, '0.0', '1.0', '0000-00-00 00:00:00'),
(41, 45, '7.0', '0.0', '2019-06-24 12:10:49'),
(42, 42, '3.0', '0.0', '2019-06-24 12:23:05'),
(43, 42, '6.0', '0.0', '2019-06-24 12:26:05');

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `consumption_lastyear_view`
-- (Vedi sotto per la vista effettiva)
--
DROP VIEW IF EXISTS `consumption_lastyear_view`;
CREATE TABLE `consumption_lastyear_view` (
`CON_STO_ID` int(5)
,`PRS_ID` varchar(10)
,`proname` varchar(200)
,`PRO_procategory` varchar(200)
,`measureunit` varchar(200)
,`plus_1` decimal(32,1)
,`minus_1` decimal(32,1)
,`plus_2` decimal(32,1)
,`minus_2` decimal(32,1)
,`plus_3` decimal(32,1)
,`minus_3` decimal(32,1)
,`plus_4` decimal(32,1)
,`minus_4` decimal(32,1)
,`plus_5` decimal(32,1)
,`minus_5` decimal(32,1)
,`plus_6` decimal(32,1)
,`minus_6` decimal(32,1)
,`plus_7` decimal(32,1)
,`minus_7` decimal(32,1)
,`plus_8` decimal(32,1)
,`minus_8` decimal(32,1)
,`plus_9` decimal(32,1)
,`minus_9` decimal(32,1)
,`plus_10` decimal(32,1)
,`minus_10` decimal(32,1)
,`plus_11` decimal(32,1)
,`minus_11` decimal(32,1)
,`plus_12` decimal(32,1)
,`minus_12` decimal(32,1)
,`anno` int(4)
,`PRS_pzcostiva` decimal(21,2)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `consumption_view`
-- (Vedi sotto per la vista effettiva)
--
DROP VIEW IF EXISTS `consumption_view`;
CREATE TABLE `consumption_view` (
`CON_STO_ID` int(5)
,`PRS_ID` varchar(10)
,`proname` varchar(200)
,`PRO_procategory` varchar(200)
,`PRO_measureunit` varchar(200)
,`plus` decimal(32,1)
,`minus` decimal(32,1)
,`mese` int(2)
,`anno` int(4)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `consumption_year_view`
-- (Vedi sotto per la vista effettiva)
--
DROP VIEW IF EXISTS `consumption_year_view`;
CREATE TABLE `consumption_year_view` (
`CON_STO_ID` int(5)
,`PRS_ID` varchar(10)
,`proname` varchar(200)
,`PRO_procategory` varchar(200)
,`measureunit` varchar(200)
,`plus_1` decimal(32,1)
,`minus_1` decimal(32,1)
,`plus_2` decimal(32,1)
,`minus_2` decimal(32,1)
,`plus_3` decimal(32,1)
,`minus_3` decimal(32,1)
,`plus_4` decimal(32,1)
,`minus_4` decimal(32,1)
,`plus_5` decimal(32,1)
,`minus_5` decimal(32,1)
,`plus_6` decimal(32,1)
,`minus_6` decimal(32,1)
,`plus_7` decimal(32,1)
,`minus_7` decimal(32,1)
,`plus_8` decimal(32,1)
,`minus_8` decimal(32,1)
,`plus_9` decimal(32,1)
,`minus_9` decimal(32,1)
,`plus_10` decimal(32,1)
,`minus_10` decimal(32,1)
,`plus_11` decimal(32,1)
,`minus_11` decimal(32,1)
,`plus_12` decimal(32,1)
,`minus_12` decimal(32,1)
,`anno` int(4)
,`PRS_pzcostiva` decimal(21,2)
);

-- --------------------------------------------------------

--
-- Struttura della tabella `instock`
--

DROP TABLE IF EXISTS `instock`;
CREATE TABLE `instock` (
  `STO_ID` int(5) NOT NULL,
  `STO_PRS_ID` varchar(10) NOT NULL,
  `STO_WAH_ID` varchar(10) NOT NULL,
  `STO_quantity` decimal(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `instock`
--

INSERT INTO `instock` (`STO_ID`, `STO_PRS_ID`, `STO_WAH_ID`, `STO_quantity`) VALUES
(42, '27', '11', '13.0'),
(44, '29', '11', '34.0'),
(45, '28', '13', '7.0');

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `instock_view`
-- (Vedi sotto per la vista effettiva)
--
DROP VIEW IF EXISTS `instock_view`;
CREATE TABLE `instock_view` (
`STO_ID` int(5)
,`STO_PRS_ID` varchar(10)
,`PRO_proname` varchar(200)
,`PRO_procategory` varchar(200)
,`PRO_measureunit` varchar(200)
,`PRO_pack` varchar(200)
,`SUP_supname` varchar(200)
,`STO_WAH_ID` varchar(10)
,`WAH_wahname` varchar(200)
,`STO_quantity` decimal(10,1)
,`PRS_active` tinyint(1)
,`PRS_SUP_ID` int(5)
,`PRS_cost` decimal(10,2)
,`PRS_totalcost` decimal(21,2)
);

-- --------------------------------------------------------

--
-- Struttura della tabella `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `INV_ID` int(5) NOT NULL,
  `INV_IL_ID` int(5) NOT NULL,
  `INV_PRS_ID` int(5) NOT NULL,
  `INV_begininv` decimal(10,1) NOT NULL,
  `INV_totrequests` decimal(10,1) NOT NULL,
  `INV_endinv` decimal(10,1) NOT NULL,
  `INV_consumption` decimal(10,1) NOT NULL,
  `INV_totalcost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `inventorydone_view`
-- (Vedi sotto per la vista effettiva)
--
DROP VIEW IF EXISTS `inventorydone_view`;
CREATE TABLE `inventorydone_view` (
`IL_ID` int(5)
,`WAH_ID` int(5)
,`IL_inventorydate` datetime
,`STO_PRS_ID` int(5)
,`PRO_proname` varchar(200)
,`PRO_procategory` varchar(200)
,`PRO_measureunit` varchar(200)
,`totrequests` decimal(32,1)
,`pzcostiva` decimal(21,2)
,`begininv` decimal(10,1)
,`endinv` decimal(10,1)
,`consumption` decimal(10,1)
,`totalcost` decimal(10,2)
,`PRS_pzcostiva` decimal(21,2)
);

-- --------------------------------------------------------

--
-- Struttura della tabella `inventory_c`
--

DROP TABLE IF EXISTS `inventory_c`;
CREATE TABLE `inventory_c` (
  `INVC_ID` int(5) NOT NULL,
  `INVC_ILC_ID` int(5) NOT NULL,
  `INVC_STO_ID` int(5) NOT NULL,
  `INVC_begininv` decimal(10,2) NOT NULL,
  `INVC_plus` decimal(10,2) NOT NULL,
  `INVC_minus` decimal(10,2) NOT NULL,
  `INVC_consumption` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `inventory_cat`
--

DROP TABLE IF EXISTS `inventory_cat`;
CREATE TABLE `inventory_cat` (
  `IC_ID` int(5) NOT NULL,
  `IC_IL_ID` int(5) NOT NULL,
  `IC_CAT_ID` int(11) NOT NULL,
  `IC_catinventory` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `inventory_cat_view`
-- (Vedi sotto per la vista effettiva)
--
DROP VIEW IF EXISTS `inventory_cat_view`;
CREATE TABLE `inventory_cat_view` (
`IC_CAT_ID` int(11)
,`IL_WAH_ID` int(5)
,`WAH_wahname` varchar(200)
,`year` int(4)
,`gennaio` text
,`febbraio` text
,`marzo` text
,`aprile` text
,`maggio` text
,`giugno` text
,`luglio` text
,`agosto` text
,`settembre` text
,`ottobre` text
,`novembre` text
,`dicembre` text
);

-- --------------------------------------------------------

--
-- Struttura della tabella `inventory_c_list`
--

DROP TABLE IF EXISTS `inventory_c_list`;
CREATE TABLE `inventory_c_list` (
  `ILC_ID` int(5) NOT NULL,
  `ILC_WAH_ID` int(5) NOT NULL,
  `ILC_inventorydate` datetime NOT NULL,
  `ILC_inventorytot` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `inventory_list`
--

DROP TABLE IF EXISTS `inventory_list`;
CREATE TABLE `inventory_list` (
  `IL_ID` int(5) NOT NULL,
  `IL_WAH_ID` int(5) NOT NULL,
  `IL_inventorydate` datetime NOT NULL,
  `IL_inventorytot` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `inventory_tot_view`
-- (Vedi sotto per la vista effettiva)
--
DROP VIEW IF EXISTS `inventory_tot_view`;
CREATE TABLE `inventory_tot_view` (
`IL_WAH_ID` int(5)
,`WAH_wahname` varchar(200)
,`year` int(4)
,`gennaio` text
,`febbraio` text
,`marzo` text
,`aprile` text
,`maggio` text
,`giugno` text
,`luglio` text
,`agosto` text
,`settembre` text
,`ottobre` text
,`novembre` text
,`dicembre` text
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `inventory_view`
-- (Vedi sotto per la vista effettiva)
--
DROP VIEW IF EXISTS `inventory_view`;
CREATE TABLE `inventory_view` (
`INV_ID` int(5)
,`INV_IL_ID` int(5)
,`IL_inventorydate` datetime
,`INV_PRS_ID` int(5)
,`PRO_proname` varchar(200)
,`PRO_procode` varchar(200)
,`PRO_pack` varchar(200)
,`PRO_measureunit` varchar(200)
,`INV_begininv` decimal(10,1)
,`INV_totrequests` decimal(10,1)
,`INV_endinv` decimal(10,1)
,`INV_consumption` decimal(10,1)
,`INV_totalcost` decimal(10,2)
,`pzcostiva` decimal(21,2)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `lastrequests_view`
-- (Vedi sotto per la vista effettiva)
--
DROP VIEW IF EXISTS `lastrequests_view`;
CREATE TABLE `lastrequests_view` (
`STO_PRS_ID` varchar(10)
,`PRO_proname` varchar(200)
,`PRO_procategory` varchar(200)
,`PRO_measureunit` varchar(200)
,`REQ_reqwahid` int(5)
,`reqwahname` varchar(200)
,`REQ_pwahconfirm` decimal(10,1)
,`REQ_rwahconfirm` int(5)
,`totrequests` decimal(32,1)
,`REQ_reqdate` datetime
,`PRS_pzcostiva` decimal(21,2)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `permessi_view`
-- (Vedi sotto per la vista effettiva)
--
DROP VIEW IF EXISTS `permessi_view`;
CREATE TABLE `permessi_view` (
`USR_ID` int(5)
,`USR_usrname` varchar(200)
,`USR_usrmail` varchar(200)
,`USR_role` varchar(50)
,`permessi` text
,`permessi_nomi` text
,`USR_active` tinyint(1)
,`mainrep` text
,`maincen` text
,`mainrep_name` text
,`maincen_name` text
);

-- --------------------------------------------------------

--
-- Struttura della tabella `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `PE_ID` int(5) NOT NULL,
  `PE_USR_ID` int(5) NOT NULL,
  `PE_WAH_ID` int(5) NOT NULL,
  `PE_mainrep` tinyint(1) DEFAULT NULL,
  `PE_maincen` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `permissions`
--

INSERT INTO `permissions` (`PE_ID`, `PE_USR_ID`, `PE_WAH_ID`, `PE_mainrep`, `PE_maincen`) VALUES
(75, 1, 0, NULL, 1),
(76, 1, 0, 1, NULL),
(81, 3, 11, NULL, 1),
(82, 3, 0, 1, NULL),
(83, 24, 10, 1, NULL),
(84, 24, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `pf_view`
-- (Vedi sotto per la vista effettiva)
--
DROP VIEW IF EXISTS `pf_view`;
CREATE TABLE `pf_view` (
`PRS_ID` int(5)
,`PRS_PRO_ID` int(5)
,`PRO_proname` varchar(200)
,`PRO_procategory` varchar(200)
,`PRO_procode` varchar(200)
,`PRO_pack` varchar(200)
,`PRO_measureunit` varchar(200)
,`PRS_SUP_ID` int(5)
,`SUP_supname` varchar(200)
,`PRS_cost` decimal(10,2)
,`PRS_iva` decimal(10,1)
,`PRS_active` tinyint(1)
,`PRS_totalcost` decimal(21,2)
);

-- --------------------------------------------------------

--
-- Struttura della tabella `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `PRO_ID` int(5) NOT NULL,
  `PRO_code` varchar(200) NOT NULL,
  `PRO_proname` varchar(200) NOT NULL,
  `PRO_procategory` varchar(200) NOT NULL,
  `PRO_pack` varchar(200) NOT NULL,
  `PRO_measureunit` varchar(200) NOT NULL,
  `PRO_description` text NOT NULL,
  `PRO_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `products`
--

INSERT INTO `products` (`PRO_ID`, `PRO_code`, `PRO_proname`, `PRO_procategory`, `PRO_pack`, `PRO_measureunit`, `PRO_description`, `PRO_active`) VALUES
(29, '1234', 'Acqua Goccia di Carnia Naturale 1', '1', '', 'bottiglie', 'Acqua naturale', 1),
(30, '5678', 'Fette biscottate Mulino Bianco', '2', '6', 'buste', 'fette biscottate per colazione integrali', 1),
(31, '7891', 'Novarapid', '3', '6', 'siringhe', 'insulina', 1),
(32, '1235', 'Acqua Goccia di Carnia Frizzante', '1', '6', 'bottiglie', 'Acqua frizzante', 0),
(33, '15646', 'Guanti in lattice', '1', '50', 'confezioni', 'guanti in lattice', 1),
(34, '196493', 'Guanti in nitrile', '1', '10', 'scatole', 'descrizione guanti', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `productssuppliers`
--

DROP TABLE IF EXISTS `productssuppliers`;
CREATE TABLE `productssuppliers` (
  `PRS_ID` int(5) NOT NULL,
  `PRS_PRO_ID` varchar(200) NOT NULL,
  `PRS_SUP_ID` varchar(200) NOT NULL,
  `PRS_cost` decimal(10,2) NOT NULL,
  `PRS_iva` decimal(10,1) NOT NULL,
  `PRS_start` varchar(30) NOT NULL,
  `PRS_end` varchar(30) NOT NULL,
  `PRS_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `productssuppliers`
--

INSERT INTO `productssuppliers` (`PRS_ID`, `PRS_PRO_ID`, `PRS_SUP_ID`, `PRS_cost`, `PRS_iva`, `PRS_start`, `PRS_end`, `PRS_active`) VALUES
(27, '29', '12', '7.00', '22.0', '28-05-2019 20:21:55', '', 1),
(28, '30', '14', '4.50', '22.0', '28-05-2019 20:22:16', '', 1),
(29, '33', '12', '0.50', '22.0', '19-06-2019 09:02:34', '', 1),
(30, '34', '15', '1.62', '22.0', '19-06-2019 09:16:14', '19-06-2019 09:32:14am', 0),
(31, '33', '14', '0.55', '22.0', '19-06-2019 09:20:28', '19-06-2019 09:32:59am', 0),
(32, '34', '14', '0.63', '22.0', '19-06-2019 09:26:45', '', 1),
(33, '31', '15', '4.52', '22.0', '24-06-2019 11:41:06', '', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE `requests` (
  `REQ_ID` int(5) NOT NULL,
  `REQ_STO_ID` int(5) NOT NULL,
  `REQ_reqquantity` decimal(10,1) NOT NULL,
  `REQ_reqwahid` int(5) NOT NULL,
  `REQ_pwahconfirm` decimal(10,1) DEFAULT NULL,
  `REQ_rwahconfirm` int(5) DEFAULT NULL,
  `REQ_reqdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `requests`
--

INSERT INTO `requests` (`REQ_ID`, `REQ_STO_ID`, `REQ_reqquantity`, `REQ_reqwahid`, `REQ_pwahconfirm`, `REQ_rwahconfirm`, `REQ_reqdate`) VALUES
(53, 42, '2.0', 14, '1.0', NULL, '2019-06-19 08:27:39'),
(54, 42, '30.0', 12, '5.0', NULL, '2019-06-19 09:44:31'),
(55, 44, '18.0', 12, '5.0', NULL, '2019-06-19 09:44:31'),
(56, 43, '1.0', 12, NULL, NULL, '2019-06-19 09:44:31'),
(57, 42, '30.0', 12, '6.0', NULL, '2019-06-19 09:44:33'),
(58, 44, '18.0', 12, '5.0', NULL, '2019-06-19 09:44:33'),
(59, 43, '1.0', 12, NULL, NULL, '2019-06-19 09:44:33'),
(60, 42, '30.0', 12, '2.0', NULL, '2019-06-19 09:45:50'),
(61, 44, '18.0', 12, '5.0', NULL, '2019-06-19 09:45:50'),
(62, 43, '1.0', 12, NULL, NULL, '2019-06-19 09:45:50'),
(63, 42, '3.0', 12, '1.0', 1, '2019-06-19 09:50:03'),
(64, 44, '5.0', 12, '2.0', NULL, '2019-06-19 09:50:03'),
(65, 42, '5.0', 12, '3.0', NULL, '2019-06-19 09:53:50'),
(66, 44, '2.0', 12, '1.0', 1, '2019-06-19 09:53:50'),
(67, 42, '5.0', 12, '1.0', NULL, '2019-06-19 10:00:09'),
(68, 44, '6.0', 12, '5.0', NULL, '2019-06-19 10:00:09'),
(69, 42, '2.0', 10, NULL, NULL, '2019-06-25 10:42:14'),
(70, 44, '3.0', 10, NULL, NULL, '2019-06-25 10:42:14'),
(78, 44, '1.0', 10, NULL, NULL, '2019-06-25 10:53:27'),
(79, 42, '1.0', 10, NULL, NULL, '2019-06-25 10:55:16'),
(80, 44, '2.0', 10, NULL, NULL, '2019-06-25 10:55:16');

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `requests_view`
-- (Vedi sotto per la vista effettiva)
--
DROP VIEW IF EXISTS `requests_view`;
CREATE TABLE `requests_view` (
`REQ_ID` int(5)
,`REQ_STO_ID` int(5)
,`STO_PRS_ID` varchar(10)
,`REQ_reqdate` datetime
,`PRO_proname` varchar(200)
,`PRO_pack` varchar(200)
,`PRO_measureunit` varchar(200)
,`SUP_supname` varchar(200)
,`REQ_prowahid` varchar(10)
,`prowahname` varchar(200)
,`REQ_reqwahid` int(5)
,`reqwahname` varchar(200)
,`STO_quantity` decimal(10,1)
,`REQ_reqquantity` decimal(10,1)
,`REQ_pwahconfirm` decimal(10,1)
,`REQ_rwahconfirm` int(5)
);

-- --------------------------------------------------------

--
-- Struttura della tabella `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers` (
  `SUP_ID` int(5) NOT NULL,
  `SUP_supname` varchar(200) NOT NULL,
  `SUP_supaddress` varchar(200) NOT NULL,
  `SUP_supphone` varchar(200) NOT NULL,
  `SUP_supmail` varchar(200) NOT NULL,
  `SUP_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `suppliers`
--

INSERT INTO `suppliers` (`SUP_ID`, `SUP_supname`, `SUP_supaddress`, `SUP_supphone`, `SUP_supmail`, `SUP_active`) VALUES
(12, 'Fornitore1', 'via Roma 11, Torino', '0225 457896', 'forn1@fornitore.it', 1),
(13, 'Fornitore2', 'via Torino 15, Belluno', '0429 514689', 'forn2@fornitore.it', 0),
(14, 'Fornitore3', 'via Treviso 21, Vicenza', '0444 48976', 'forn3@fornitore.it', 1),
(15, 'Fornitore 4', 'Via Roma 19, Torino', '0154693625', 'fornitore4@fornitore.it', 1),
(16, 'Fornitore 9', 'via Roma 12, Torino', '0225 457897', '', 1);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `tot_inventory_view`
-- (Vedi sotto per la vista effettiva)
--
DROP VIEW IF EXISTS `tot_inventory_view`;
CREATE TABLE `tot_inventory_view` (
`IL_ID` int(5)
,`WAH_ID` int(5)
,`STO_PRS_ID` int(5)
,`PRO_proname` varchar(200)
,`PRO_measureunit` varchar(200)
,`totrequests` decimal(32,1)
,`pzcostiva` decimal(21,2)
,`begininv` decimal(10,1)
,`endinv` decimal(10,1)
,`consumption` decimal(10,1)
,`totalcost` decimal(10,2)
,`PRS_pzcostiva` decimal(21,2)
);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `USR_ID` int(5) NOT NULL,
  `USR_usrname` varchar(200) NOT NULL,
  `USR_usrpsw` varchar(200) NOT NULL,
  `USR_usrmail` varchar(200) NOT NULL,
  `USR_role` varchar(50) NOT NULL,
  `USR_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`USR_ID`, `USR_usrname`, `USR_usrpsw`, `USR_usrmail`, `USR_role`, `USR_active`) VALUES
(1, 'admin', '$2y$10$PG0K7gUGmuhtVH1SeLXup.BCuSGprsbB40YjckT0rHedhLwGsYBJ.', 'admin@admin.it', 'admin', 1),
(2, 'veronica', '$.2019.$', 'veronica@veronica.it', 'wah', 1),
(3, 'alberto', '$2y$10$uATT/4fd89vUFDuviNbZu.O3Tti8LkALJz0/4lBFOzzZhj6ja7o/m', 'alberto@alberto.it', 'wah', 1),
(24, 'prova', '$2y$10$IbczNyKLYP7EQmhRb70x9.3zKyhmhleWhbVtM64z8mc5kZsvp6XAK', 'prova@prova.it', 'rep', 1),
(42, 'cali', '$2y$10$PLiczbwuom9OpEt.BBgcOOQ35qXUm9HZX1bIVglHKp9ijx69h/QjW', 'cali@cali.it', 'admin', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `warehouses`
--

DROP TABLE IF EXISTS `warehouses`;
CREATE TABLE `warehouses` (
  `WAH_ID` int(5) NOT NULL,
  `WAH_wahname` varchar(200) NOT NULL,
  `WAH_wahcategory` varchar(200) NOT NULL,
  `WAH_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `warehouses`
--

INSERT INTO `warehouses` (`WAH_ID`, `WAH_wahname`, `WAH_wahcategory`, `WAH_active`) VALUES
(10, 'Ala blu', '2', 1),
(11, 'Generale', '1', 1),
(12, 'Ala verde', '2', 1),
(13, 'Alimentare', '1', 1),
(14, 'Ala rosa', '2', 0);

-- --------------------------------------------------------

--
-- Struttura per la vista `consTotPro_view`
--
DROP TABLE IF EXISTS `consTotPro_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`rsm`@`localhost` SQL SECURITY DEFINER VIEW `consTotPro_view`  AS  select `stov`.`STO_ID` AS `STO_ID`,`stov`.`STO_PRS_ID` AS `STO_PRS_ID`,`stov`.`PRO_proname` AS `PRO_proname`,`stov`.`PRO_measureunit` AS `PRO_measureunit`,`stov`.`PRO_pack` AS `PRO_pack`,`stov`.`SUP_supname` AS `SUP_supname`,sum(`cons`.`CON_plus`) AS `sum_plus`,sum(`cons`.`CON_minus`) AS `sum_minus` from (`instock_view` `stov` join `consumption` `cons` on((`stov`.`STO_ID` = `cons`.`CON_STO_ID`))) group by `stov`.`STO_PRS_ID` ;

-- --------------------------------------------------------

--
-- Struttura per la vista `consTotSto_view`
--
DROP TABLE IF EXISTS `consTotSto_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`rsm`@`localhost` SQL SECURITY DEFINER VIEW `consTotSto_view`  AS  select `stov`.`STO_ID` AS `STO_ID`,`stov`.`STO_PRS_ID` AS `STO_PRS_ID`,`stov`.`PRO_proname` AS `PRO_proname`,`stov`.`PRO_measureunit` AS `PRO_measureunit`,`stov`.`PRO_pack` AS `PRO_pack`,`stov`.`SUP_supname` AS `SUP_supname`,`stov`.`STO_WAH_ID` AS `STO_WAH_ID`,`stov`.`WAH_wahname` AS `WAH_wahname`,sum(`cons`.`CON_plus`) AS `sum_plus`,sum(`cons`.`CON_minus`) AS `sum_minus` from (`instock_view` `stov` join `consumption` `cons` on((`stov`.`STO_ID` = `cons`.`CON_STO_ID`))) group by `cons`.`CON_STO_ID` ;

-- --------------------------------------------------------

--
-- Struttura per la vista `consumption_lastyear_view`
--
DROP TABLE IF EXISTS `consumption_lastyear_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`rsm`@`localhost` SQL SECURITY DEFINER VIEW `consumption_lastyear_view`  AS  select `consumption_year_view`.`CON_STO_ID` AS `CON_STO_ID`,`consumption_year_view`.`PRS_ID` AS `PRS_ID`,`consumption_year_view`.`proname` AS `proname`,`consumption_year_view`.`PRO_procategory` AS `PRO_procategory`,`consumption_year_view`.`measureunit` AS `measureunit`,`consumption_year_view`.`plus_1` AS `plus_1`,`consumption_year_view`.`minus_1` AS `minus_1`,`consumption_year_view`.`plus_2` AS `plus_2`,`consumption_year_view`.`minus_2` AS `minus_2`,`consumption_year_view`.`plus_3` AS `plus_3`,`consumption_year_view`.`minus_3` AS `minus_3`,`consumption_year_view`.`plus_4` AS `plus_4`,`consumption_year_view`.`minus_4` AS `minus_4`,`consumption_year_view`.`plus_5` AS `plus_5`,`consumption_year_view`.`minus_5` AS `minus_5`,`consumption_year_view`.`plus_6` AS `plus_6`,`consumption_year_view`.`minus_6` AS `minus_6`,`consumption_year_view`.`plus_7` AS `plus_7`,`consumption_year_view`.`minus_7` AS `minus_7`,`consumption_year_view`.`plus_8` AS `plus_8`,`consumption_year_view`.`minus_8` AS `minus_8`,`consumption_year_view`.`plus_9` AS `plus_9`,`consumption_year_view`.`minus_9` AS `minus_9`,`consumption_year_view`.`plus_10` AS `plus_10`,`consumption_year_view`.`minus_10` AS `minus_10`,`consumption_year_view`.`plus_11` AS `plus_11`,`consumption_year_view`.`minus_11` AS `minus_11`,`consumption_year_view`.`plus_12` AS `plus_12`,`consumption_year_view`.`minus_12` AS `minus_12`,`consumption_year_view`.`anno` AS `anno`,`consumption_year_view`.`PRS_pzcostiva` AS `PRS_pzcostiva` from `consumption_year_view` where (`consumption_year_view`.`anno` = year(curdate())) ;

-- --------------------------------------------------------

--
-- Struttura per la vista `consumption_view`
--
DROP TABLE IF EXISTS `consumption_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`rsm`@`localhost` SQL SECURITY DEFINER VIEW `consumption_view`  AS  select `con`.`CON_STO_ID` AS `CON_STO_ID`,`isview`.`STO_PRS_ID` AS `PRS_ID`,`isview`.`PRO_proname` AS `proname`,`isview`.`PRO_procategory` AS `PRO_procategory`,`isview`.`PRO_measureunit` AS `PRO_measureunit`,sum(`con`.`CON_plus`) AS `plus`,sum(`con`.`CON_minus`) AS `minus`,month(`con`.`CON_STO_date`) AS `mese`,year(`con`.`CON_STO_date`) AS `anno` from (`consumption` `con` join `instock_view` `isview` on((`con`.`CON_STO_ID` = `isview`.`STO_ID`))) group by `con`.`CON_STO_ID`,year(`con`.`CON_STO_date`),month(`con`.`CON_STO_date`) order by year(`con`.`CON_STO_date`),month(`con`.`CON_STO_date`) ;

-- --------------------------------------------------------

--
-- Struttura per la vista `consumption_year_view`
--
DROP TABLE IF EXISTS `consumption_year_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`rsm`@`localhost` SQL SECURITY DEFINER VIEW `consumption_year_view`  AS  select `conv`.`CON_STO_ID` AS `CON_STO_ID`,`conv`.`PRS_ID` AS `PRS_ID`,`conv`.`proname` AS `proname`,`conv`.`PRO_procategory` AS `PRO_procategory`,`conv`.`PRO_measureunit` AS `measureunit`,if((`conv`.`mese` = 1),`conv`.`plus`,NULL) AS `plus_1`,if((`conv`.`mese` = 1),`conv`.`minus`,NULL) AS `minus_1`,if((`conv`.`mese` = 2),`conv`.`plus`,NULL) AS `plus_2`,if((`conv`.`mese` = 2),`conv`.`minus`,NULL) AS `minus_2`,if((`conv`.`mese` = 3),`conv`.`plus`,NULL) AS `plus_3`,if((`conv`.`mese` = 3),`conv`.`minus`,NULL) AS `minus_3`,if((`conv`.`mese` = 4),`conv`.`plus`,NULL) AS `plus_4`,if((`conv`.`mese` = 4),`conv`.`minus`,NULL) AS `minus_4`,if((`conv`.`mese` = 5),`conv`.`plus`,NULL) AS `plus_5`,if((`conv`.`mese` = 5),`conv`.`minus`,NULL) AS `minus_5`,if((`conv`.`mese` = 6),`conv`.`plus`,NULL) AS `plus_6`,if((`conv`.`mese` = 6),`conv`.`minus`,NULL) AS `minus_6`,if((`conv`.`mese` = 7),`conv`.`plus`,NULL) AS `plus_7`,if((`conv`.`mese` = 7),`conv`.`minus`,NULL) AS `minus_7`,if((`conv`.`mese` = 8),`conv`.`plus`,NULL) AS `plus_8`,if((`conv`.`mese` = 8),`conv`.`minus`,NULL) AS `minus_8`,if((`conv`.`mese` = 9),`conv`.`plus`,NULL) AS `plus_9`,if((`conv`.`mese` = 9),`conv`.`minus`,NULL) AS `minus_9`,if((`conv`.`mese` = 10),`conv`.`plus`,NULL) AS `plus_10`,if((`conv`.`mese` = 10),`conv`.`minus`,NULL) AS `minus_10`,if((`conv`.`mese` = 11),`conv`.`plus`,NULL) AS `plus_11`,if((`conv`.`mese` = 11),`conv`.`minus`,NULL) AS `minus_11`,if((`conv`.`mese` = 12),`conv`.`plus`,NULL) AS `plus_12`,if((`conv`.`mese` = 12),`conv`.`minus`,NULL) AS `minus_12`,`conv`.`anno` AS `anno`,`pf_view`.`PRS_totalcost` AS `PRS_pzcostiva` from (`consumption_view` `conv` join `pf_view` on((`pf_view`.`PRS_ID` = `conv`.`PRS_ID`))) group by `conv`.`CON_STO_ID`,`conv`.`anno` order by `conv`.`anno`,`conv`.`CON_STO_ID` ;

-- --------------------------------------------------------

--
-- Struttura per la vista `instock_view`
--
DROP TABLE IF EXISTS `instock_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`rsm`@`localhost` SQL SECURITY DEFINER VIEW `instock_view`  AS  select `instock`.`STO_ID` AS `STO_ID`,`instock`.`STO_PRS_ID` AS `STO_PRS_ID`,`products`.`PRO_proname` AS `PRO_proname`,`products`.`PRO_procategory` AS `PRO_procategory`,`products`.`PRO_measureunit` AS `PRO_measureunit`,`products`.`PRO_pack` AS `PRO_pack`,`suppliers`.`SUP_supname` AS `SUP_supname`,`instock`.`STO_WAH_ID` AS `STO_WAH_ID`,`warehouses`.`WAH_wahname` AS `WAH_wahname`,`instock`.`STO_quantity` AS `STO_quantity`,`pf_view`.`PRS_active` AS `PRS_active`,`pf_view`.`PRS_SUP_ID` AS `PRS_SUP_ID`,`pf_view`.`PRS_cost` AS `PRS_cost`,`pf_view`.`PRS_totalcost` AS `PRS_totalcost` from ((((`instock` join `pf_view` on((`instock`.`STO_PRS_ID` = `pf_view`.`PRS_ID`))) join `products` on((`pf_view`.`PRS_PRO_ID` = `products`.`PRO_ID`))) join `suppliers` on((`pf_view`.`PRS_SUP_ID` = `suppliers`.`SUP_ID`))) join `warehouses` on((`warehouses`.`WAH_ID` = `instock`.`STO_WAH_ID`))) ;

-- --------------------------------------------------------

--
-- Struttura per la vista `inventorydone_view`
--
DROP TABLE IF EXISTS `inventorydone_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`rsm`@`localhost` SQL SECURITY DEFINER VIEW `inventorydone_view`  AS  select `il`.`IL_ID` AS `IL_ID`,`il`.`IL_WAH_ID` AS `WAH_ID`,`il`.`IL_inventorydate` AS `IL_inventorydate`,`inv`.`INV_PRS_ID` AS `STO_PRS_ID`,`lastreq`.`PRO_proname` AS `PRO_proname`,`lastreq`.`PRO_procategory` AS `PRO_procategory`,`lastreq`.`PRO_measureunit` AS `PRO_measureunit`,`lastreq`.`totrequests` AS `totrequests`,`lastreq`.`PRS_pzcostiva` AS `pzcostiva`,`inv`.`INV_begininv` AS `begininv`,`inv`.`INV_endinv` AS `endinv`,`inv`.`INV_consumption` AS `consumption`,`inv`.`INV_totalcost` AS `totalcost`,`lastreq`.`PRS_pzcostiva` AS `PRS_pzcostiva` from ((`inventory_list` `il` join `inventory` `inv` on((`il`.`IL_ID` = `inv`.`INV_IL_ID`))) join `lastrequests_view` `lastreq` on((`lastreq`.`REQ_reqwahid` = `il`.`IL_WAH_ID`))) where ((`inv`.`INV_PRS_ID` = `lastreq`.`STO_PRS_ID`) and (year(`il`.`IL_inventorydate`) = year(curdate())) and (month(`il`.`IL_inventorydate`) = month(curdate()))) ;

-- --------------------------------------------------------

--
-- Struttura per la vista `inventory_cat_view`
--
DROP TABLE IF EXISTS `inventory_cat_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`rsm`@`localhost` SQL SECURITY DEFINER VIEW `inventory_cat_view`  AS  select `invcat`.`IC_CAT_ID` AS `IC_CAT_ID`,`ilist`.`IL_WAH_ID` AS `IL_WAH_ID`,`wah`.`WAH_wahname` AS `WAH_wahname`,year(`ilist`.`IL_inventorydate`) AS `year`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 2),`invcat`.`IC_catinventory`,NULL) separator ',') AS `gennaio`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 3),`invcat`.`IC_catinventory`,NULL) separator ',') AS `febbraio`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 4),`invcat`.`IC_catinventory`,NULL) separator ',') AS `marzo`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 5),`invcat`.`IC_catinventory`,NULL) separator ',') AS `aprile`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 6),`ilist`.`IL_inventorytot`,NULL) separator ',') AS `maggio`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 7),`invcat`.`IC_catinventory`,NULL) separator ',') AS `giugno`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 8),`invcat`.`IC_catinventory`,NULL) separator ',') AS `luglio`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 9),`invcat`.`IC_catinventory`,NULL) separator ',') AS `agosto`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 10),`invcat`.`IC_catinventory`,NULL) separator ',') AS `settembre`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 11),`invcat`.`IC_catinventory`,NULL) separator ',') AS `ottobre`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 12),`invcat`.`IC_catinventory`,NULL) separator ',') AS `novembre`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 1),`invcat`.`IC_catinventory`,NULL) separator ',') AS `dicembre` from ((`inventory_cat` `invcat` join `inventory_list` `ilist` on((`invcat`.`IC_IL_ID` = `ilist`.`IL_ID`))) join `warehouses` `wah` on((`wah`.`WAH_ID` = `ilist`.`IL_WAH_ID`))) group by if((month(`ilist`.`IL_inventorydate`) = 1),year((`ilist`.`IL_inventorydate` - interval 1 month)),year(`ilist`.`IL_inventorydate`)),`ilist`.`IL_WAH_ID`,`invcat`.`IC_CAT_ID` order by year(`ilist`.`IL_inventorydate`) desc ;

-- --------------------------------------------------------

--
-- Struttura per la vista `inventory_tot_view`
--
DROP TABLE IF EXISTS `inventory_tot_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`rsm`@`localhost` SQL SECURITY DEFINER VIEW `inventory_tot_view`  AS  select `ilist`.`IL_WAH_ID` AS `IL_WAH_ID`,`wah`.`WAH_wahname` AS `WAH_wahname`,year(`ilist`.`IL_inventorydate`) AS `year`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 2),`ilist`.`IL_inventorytot`,NULL) separator ',') AS `gennaio`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 3),`ilist`.`IL_inventorytot`,NULL) separator ',') AS `febbraio`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 4),`ilist`.`IL_inventorytot`,NULL) separator ',') AS `marzo`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 5),`ilist`.`IL_inventorytot`,NULL) separator ',') AS `aprile`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 6),`ilist`.`IL_inventorytot`,NULL) separator ',') AS `maggio`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 7),`ilist`.`IL_inventorytot`,NULL) separator ',') AS `giugno`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 8),`ilist`.`IL_inventorytot`,NULL) separator ',') AS `luglio`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 9),`ilist`.`IL_inventorytot`,NULL) separator ',') AS `agosto`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 10),`ilist`.`IL_inventorytot`,NULL) separator ',') AS `settembre`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 11),`ilist`.`IL_inventorytot`,NULL) separator ',') AS `ottobre`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 12),`ilist`.`IL_inventorytot`,NULL) separator ',') AS `novembre`,group_concat(if((month(`ilist`.`IL_inventorydate`) = 1),`ilist`.`IL_inventorytot`,NULL) separator ',') AS `dicembre` from (`inventory_list` `ilist` join `warehouses` `wah` on((`ilist`.`IL_WAH_ID` = `wah`.`WAH_ID`))) group by if((month(`ilist`.`IL_inventorydate`) = 1),year((`ilist`.`IL_inventorydate` - interval 1 month)),year(`ilist`.`IL_inventorydate`)),`ilist`.`IL_WAH_ID` order by year(`ilist`.`IL_inventorydate`) desc ;

-- --------------------------------------------------------

--
-- Struttura per la vista `inventory_view`
--
DROP TABLE IF EXISTS `inventory_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`rsm`@`localhost` SQL SECURITY DEFINER VIEW `inventory_view`  AS  select `inv`.`INV_ID` AS `INV_ID`,`inv`.`INV_IL_ID` AS `INV_IL_ID`,`il`.`IL_inventorydate` AS `IL_inventorydate`,`inv`.`INV_PRS_ID` AS `INV_PRS_ID`,`pf`.`PRO_proname` AS `PRO_proname`,`pf`.`PRO_procode` AS `PRO_procode`,`pf`.`PRO_pack` AS `PRO_pack`,`pf`.`PRO_measureunit` AS `PRO_measureunit`,`inv`.`INV_begininv` AS `INV_begininv`,`inv`.`INV_totrequests` AS `INV_totrequests`,`inv`.`INV_endinv` AS `INV_endinv`,`inv`.`INV_consumption` AS `INV_consumption`,`inv`.`INV_totalcost` AS `INV_totalcost`,`pf`.`PRS_totalcost` AS `pzcostiva` from ((`inventory` `inv` join `pf_view` `pf` on((`inv`.`INV_PRS_ID` = `pf`.`PRS_ID`))) join `inventory_list` `il` on((`inv`.`INV_IL_ID` = `il`.`IL_ID`))) ;

-- --------------------------------------------------------

--
-- Struttura per la vista `lastrequests_view`
--
DROP TABLE IF EXISTS `lastrequests_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`rsm`@`localhost` SQL SECURITY DEFINER VIEW `lastrequests_view`  AS  select `req_v`.`STO_PRS_ID` AS `STO_PRS_ID`,`req_v`.`PRO_proname` AS `PRO_proname`,`products`.`PRO_procategory` AS `PRO_procategory`,`req_v`.`PRO_measureunit` AS `PRO_measureunit`,`req_v`.`REQ_reqwahid` AS `REQ_reqwahid`,`req_v`.`reqwahname` AS `reqwahname`,`req_v`.`REQ_pwahconfirm` AS `REQ_pwahconfirm`,`req_v`.`REQ_rwahconfirm` AS `REQ_rwahconfirm`,sum(`req_v`.`REQ_pwahconfirm`) AS `totrequests`,`req_v`.`REQ_reqdate` AS `REQ_reqdate`,`pf_view`.`PRS_totalcost` AS `PRS_pzcostiva` from (((`requests_view` `req_v` join `pf_view` on((`req_v`.`STO_PRS_ID` = `pf_view`.`PRS_ID`))) join `productssuppliers` on((`productssuppliers`.`PRS_ID` = `pf_view`.`PRS_ID`))) join `products` on((`productssuppliers`.`PRS_PRO_ID` = `products`.`PRO_ID`))) where ((year(`req_v`.`REQ_reqdate`) = year((curdate() - interval 1 month))) and (month(`req_v`.`REQ_reqdate`) = month((curdate() - interval 1 month))) and (`req_v`.`REQ_rwahconfirm` = 1)) group by `req_v`.`STO_PRS_ID`,`req_v`.`REQ_reqwahid` ;

-- --------------------------------------------------------

--
-- Struttura per la vista `permessi_view`
--
DROP TABLE IF EXISTS `permessi_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`rsm`@`localhost` SQL SECURITY DEFINER VIEW `permessi_view`  AS  select `usr`.`USR_ID` AS `USR_ID`,`usr`.`USR_usrname` AS `USR_usrname`,`usr`.`USR_usrmail` AS `USR_usrmail`,`usr`.`USR_role` AS `USR_role`,group_concat(if(`per`.`PE_WAH_ID`,`per`.`PE_WAH_ID`,NULL) separator ',') AS `permessi`,group_concat(if(`per`.`PE_WAH_ID`,`wah`.`WAH_wahname`,NULL) separator ', ') AS `permessi_nomi`,`usr`.`USR_active` AS `USR_active`,group_concat(if((`per`.`PE_mainrep` = 1),`per`.`PE_WAH_ID`,NULL) separator ',') AS `mainrep`,group_concat(if((`per`.`PE_maincen` = 1),`per`.`PE_WAH_ID`,NULL) separator ',') AS `maincen`,group_concat(if((`per`.`PE_mainrep` = 1),`wah`.`WAH_wahname`,NULL) separator ',') AS `mainrep_name`,group_concat(if((`per`.`PE_maincen` = 1),`wah`.`WAH_wahname`,NULL) separator ',') AS `maincen_name` from ((`users` `usr` left join `permissions` `per` on((`usr`.`USR_ID` = `per`.`PE_USR_ID`))) left join `warehouses` `wah` on((`per`.`PE_WAH_ID` = `wah`.`WAH_ID`))) group by `usr`.`USR_ID` ;

-- --------------------------------------------------------

--
-- Struttura per la vista `pf_view`
--
DROP TABLE IF EXISTS `pf_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`rsm`@`localhost` SQL SECURITY DEFINER VIEW `pf_view`  AS  select `productssuppliers`.`PRS_ID` AS `PRS_ID`,`products`.`PRO_ID` AS `PRS_PRO_ID`,`products`.`PRO_proname` AS `PRO_proname`,`products`.`PRO_procategory` AS `PRO_procategory`,`products`.`PRO_code` AS `PRO_procode`,`products`.`PRO_pack` AS `PRO_pack`,`products`.`PRO_measureunit` AS `PRO_measureunit`,`suppliers`.`SUP_ID` AS `PRS_SUP_ID`,`suppliers`.`SUP_supname` AS `SUP_supname`,`productssuppliers`.`PRS_cost` AS `PRS_cost`,`productssuppliers`.`PRS_iva` AS `PRS_iva`,`productssuppliers`.`PRS_active` AS `PRS_active`,(`productssuppliers`.`PRS_cost` + round(((`productssuppliers`.`PRS_iva` * `productssuppliers`.`PRS_cost`) / 100),2)) AS `PRS_totalcost` from ((`productssuppliers` join `products` on((`productssuppliers`.`PRS_PRO_ID` = `products`.`PRO_ID`))) join `suppliers` on((`productssuppliers`.`PRS_SUP_ID` = `suppliers`.`SUP_ID`))) ;

-- --------------------------------------------------------

--
-- Struttura per la vista `requests_view`
--
DROP TABLE IF EXISTS `requests_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`rsm`@`localhost` SQL SECURITY DEFINER VIEW `requests_view`  AS  select `req`.`REQ_ID` AS `REQ_ID`,`req`.`REQ_STO_ID` AS `REQ_STO_ID`,`isv`.`STO_PRS_ID` AS `STO_PRS_ID`,`req`.`REQ_reqdate` AS `REQ_reqdate`,`isv`.`PRO_proname` AS `PRO_proname`,`isv`.`PRO_pack` AS `PRO_pack`,`isv`.`PRO_measureunit` AS `PRO_measureunit`,`isv`.`SUP_supname` AS `SUP_supname`,`isv`.`STO_WAH_ID` AS `REQ_prowahid`,`pwah`.`WAH_wahname` AS `prowahname`,`req`.`REQ_reqwahid` AS `REQ_reqwahid`,`rwah`.`WAH_wahname` AS `reqwahname`,`isv`.`STO_quantity` AS `STO_quantity`,`req`.`REQ_reqquantity` AS `REQ_reqquantity`,`req`.`REQ_pwahconfirm` AS `REQ_pwahconfirm`,`req`.`REQ_rwahconfirm` AS `REQ_rwahconfirm` from (((`requests` `req` join `instock_view` `isv` on((`req`.`REQ_STO_ID` = `isv`.`STO_ID`))) join `warehouses` `pwah` on((`isv`.`STO_WAH_ID` = `pwah`.`WAH_ID`))) join `warehouses` `rwah` on((`req`.`REQ_reqwahid` = `rwah`.`WAH_ID`))) ;

-- --------------------------------------------------------

--
-- Struttura per la vista `tot_inventory_view`
--
DROP TABLE IF EXISTS `tot_inventory_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`rsm`@`localhost` SQL SECURITY DEFINER VIEW `tot_inventory_view`  AS  select `il`.`IL_ID` AS `IL_ID`,`il`.`IL_WAH_ID` AS `WAH_ID`,`inv`.`INV_PRS_ID` AS `STO_PRS_ID`,`lastreq`.`PRO_proname` AS `PRO_proname`,`lastreq`.`PRO_measureunit` AS `PRO_measureunit`,`lastreq`.`totrequests` AS `totrequests`,`lastreq`.`PRS_pzcostiva` AS `pzcostiva`,`inv`.`INV_begininv` AS `begininv`,`inv`.`INV_endinv` AS `endinv`,`inv`.`INV_consumption` AS `consumption`,`inv`.`INV_totalcost` AS `totalcost`,`lastreq`.`PRS_pzcostiva` AS `PRS_pzcostiva` from ((`inventory_list` `il` join `inventory` `inv` on((`il`.`IL_ID` = `inv`.`INV_IL_ID`))) join `lastrequests_view` `lastreq` on((`inv`.`INV_PRS_ID` = `lastreq`.`STO_PRS_ID`))) where (`lastreq`.`REQ_reqwahid` = `il`.`IL_WAH_ID`) ;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `consumption`
--
ALTER TABLE `consumption`
  ADD PRIMARY KEY (`CON_ID`);

--
-- Indici per le tabelle `instock`
--
ALTER TABLE `instock`
  ADD PRIMARY KEY (`STO_ID`);

--
-- Indici per le tabelle `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`INV_ID`);

--
-- Indici per le tabelle `inventory_c`
--
ALTER TABLE `inventory_c`
  ADD PRIMARY KEY (`INVC_ID`);

--
-- Indici per le tabelle `inventory_cat`
--
ALTER TABLE `inventory_cat`
  ADD PRIMARY KEY (`IC_ID`);

--
-- Indici per le tabelle `inventory_c_list`
--
ALTER TABLE `inventory_c_list`
  ADD PRIMARY KEY (`ILC_ID`);

--
-- Indici per le tabelle `inventory_list`
--
ALTER TABLE `inventory_list`
  ADD PRIMARY KEY (`IL_ID`);

--
-- Indici per le tabelle `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`PE_ID`);

--
-- Indici per le tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`PRO_ID`);

--
-- Indici per le tabelle `productssuppliers`
--
ALTER TABLE `productssuppliers`
  ADD PRIMARY KEY (`PRS_ID`);

--
-- Indici per le tabelle `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`REQ_ID`);

--
-- Indici per le tabelle `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`SUP_ID`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USR_ID`);

--
-- Indici per le tabelle `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`WAH_ID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `consumption`
--
ALTER TABLE `consumption`
  MODIFY `CON_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT per la tabella `instock`
--
ALTER TABLE `instock`
  MODIFY `STO_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT per la tabella `inventory`
--
ALTER TABLE `inventory`
  MODIFY `INV_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT per la tabella `inventory_c`
--
ALTER TABLE `inventory_c`
  MODIFY `INVC_ID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `inventory_cat`
--
ALTER TABLE `inventory_cat`
  MODIFY `IC_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT per la tabella `inventory_c_list`
--
ALTER TABLE `inventory_c_list`
  MODIFY `ILC_ID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `inventory_list`
--
ALTER TABLE `inventory_list`
  MODIFY `IL_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT per la tabella `permissions`
--
ALTER TABLE `permissions`
  MODIFY `PE_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT per la tabella `products`
--
ALTER TABLE `products`
  MODIFY `PRO_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT per la tabella `productssuppliers`
--
ALTER TABLE `productssuppliers`
  MODIFY `PRS_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT per la tabella `requests`
--
ALTER TABLE `requests`
  MODIFY `REQ_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT per la tabella `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `SUP_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `USR_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT per la tabella `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `WAH_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
