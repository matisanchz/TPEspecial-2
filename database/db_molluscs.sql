-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2022 a las 20:32:58
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_molluscs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class`
--

CREATE TABLE `class` (
  `id_class` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `author` varchar(45) NOT NULL,
  `features` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `class`
--

INSERT INTO `class` (`id_class`, `name`, `author`, `features`) VALUES
(1, 'Gastropoda', 'Cuvier, 1797', 'Cephalic area; Ventral muscular foot; Dorsal shell'),
(2, 'Bivalvia', 'Linnaeus, 1758', 'Without head and tentacles. No radula and odontophore.'),
(3, 'Scaphopoda', 'Bronn, 1862', 'The only class of exclusively infaunal marine molluscs. They look like tusks.'),
(4, 'Monoplacophora', 'Odhner, 1940', 'Univalved, limpet-shaped, untorted. This class was considered as extinct until 1950.'),
(5, 'Polyplacophora', 'J.E. Gray, 1821', 'All specimens bear a protective dorsal shell that is divided into eight articulating aragonite valves embedded in the tough muscular girdle that surrounds their bodies.'),
(6, 'Cephalopoda', 'Cuvier, 1797', 'Nervous system and behavior, variety of chemical sense organs, vision and Photoreception. They all have tentacles.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `specie`
--

CREATE TABLE `specie` (
  `id_specie` int(11) NOT NULL,
  `scientific_name` varchar(120) NOT NULL,
  `author` varchar(65) NOT NULL,
  `location` varchar(60) NOT NULL,
  `id_subclass` int(11) NOT NULL,
  `photo` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `specie`
--

INSERT INTO `specie` (`id_specie`, `scientific_name`, `author`, `location`, `id_subclass`, `photo`) VALUES
(1, 'Macrocypraea cervinetta cervinetta', 'Kiener, 1843', 'Mexico-Peru; Galápagos', 1, 'https://storage.googleapis.com/conchology-general-images/documents/Gastropods/Images/Cypraea_cervinetta_5.jpg'),
(2, 'Antalis dentalis', 'Linnaeus, 1758', 'Italy', 7, 'https://storage.googleapis.com/conchology-images/1280000sup/1282353.jpg'),
(3, 'Cadulus chuni', 'Jaeckel, 1932', 'Philippines', 8, 'https://storage.googleapis.com/conchology-images/970000sup/975301.jpg'),
(4, 'Elysia Timida', 'Risso, 1818', 'Cape Verde and Canary Islands.', 2, 'img/images-db/species/634d8c0518afc.jpeg'),
(5, 'Notodoris minor', 'Eliot, 1904', 'Indo-west Pacific area', 2, 'https://upload.wikimedia.org/wikipedia/commons/9/91/Notodoris_minor_cropped.jpg'),
(6, 'Athoracophorus papillatus', 'Hutton, 1879', 'New Zeland', 3, 'https://www.mollusca.co.nz/images_shells/4000/3984_Athoracophorus_papillatus_1_1.jpg'),
(7, 'Sepia officinalis', 'Linnaeus, 1758', 'Mediterranean Sea', 15, 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/HPIM1795.JPG/250px-HPIM1795.JPG'),
(8, 'Todarodes sagittatus', 'Lamarck, 1798', 'Mediterranean sea', 15, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQCivQoUKcZv8SlFNr24Ko6sLzotpQjjINDJA&usqp=CAU'),
(9, 'Octopus Vulgaria', 'Cuvier, 1797', 'Mediterranean Sea', 17, 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/33/Octopus3.jpg/250px-Octopus3.jpg'),
(10, 'Octopus Lunulatus', 'Quoy & Gaimard, 1832', 'Australia', 17, 'img/images-db/species/634d8d2654a7b.jpeg'),
(11, 'Vampyroteuthis infernalis', 'Chun, 1903', 'Indian, Pacific & Atlantic Ocean', 16, 'img/images-db/species/634d8d9300f28.jpeg'),
(12, 'Argonauta Argo', 'Linnaeus, 1758', 'Cosmopolitan', 14, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjzt1TCl-uA62sg-yHBaxg7e-ik3yuN1B5UA&usqp=CAU'),
(13, 'Argonauta hians', 'Lightfoot, 1786', 'Philippines', 14, 'https://storage.googleapis.com/conchology-images/1220000sup/1228161.jpg'),
(14, 'Argonauta nodosus', 'Lightfoot, 1786', 'Cosmopolitan', 14, 'img/images-db/species/634d8aa854f5f.png'),
(15, 'Argonauta cornuta', 'Conrad, 1854', 'Western Mexico to Baja California', 14, 'https://www.jaxshells.org/74026.jpg'),
(16, 'Argonauta Bottgeri', 'Maltzan, 1881', 'Southern & Eastern Africa', 14, 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/48/Argonauta_bottgeri_eggcase.png/220px-Argonauta_bottgeri_eggcase.png'),
(17, 'Acanthochitona achates', 'Gould, 1859', 'Japan', 11, 'https://storage.googleapis.com/conchology-images/110000sup/111086.jpg'),
(18, 'Acanthochitona hirudiniformis', 'Broderip & Sowerby, 1832', 'Costa Rica', 11, 'https://storage.googleapis.com/conchology-images/1090000sup/1098986.jpg'),
(19, 'Leptoplax wilsoni', 'Sykes, 1896', 'Australia', 11, 'https://storage.googleapis.com/conchology-images/1090000sup/1096245.jpg'),
(20, 'Lorica volvox', 'Reeve, 1847', 'Australia', 12, 'https://storage.googleapis.com/conchology-images/1090000sup/1096274.jpg'),
(21, 'Loricella angasi', 'Adams, 1864', 'Australia', 12, 'https://storage.googleapis.com/conchology-images/1090000sup/1096271.jpg'),
(22, 'Acanthopleura spinosa', 'Bruguiere, 1792', 'Philippines', 10, 'https://storage.googleapis.com/conchology-images/150000sup/152605.jpg'),
(23, 'Acanthopleura gemmata', 'Blainville, 1825', 'Philipines', 10, 'https://storage.googleapis.com/conchology-images/910000sup/916120.jpg'),
(24, 'Chiton goodallii', 'Broderip, 1832', 'Ecuador', 10, 'https://storage.googleapis.com/conchology-images/1090000sup/1096859.jpg'),
(25, 'Chiton marmoratus', 'Gmelin, 1791', 'Guadeloupe', 10, 'https://storage.googleapis.com/conchology-images/540000sup/545086.jpg'),
(26, 'Acanthochitona dissimilis', 'Taki, 1931', 'China', 11, 'https://storage.googleapis.com/conchology-images/1280000sup/1281379.jpg'),
(27, 'Amphidromus semifrenatus', 'Martens, 1900', 'Sumatra Island, Aceh', 3, 'https://conchology.s3.amazonaws.com/landsnail/web/photo-1837.jpg'),
(28, 'Obba parmula', 'Broderip, 1841', 'Philippines', 3, 'https://conchology.s3.amazonaws.com/landsnail/web/photo-225.jpg'),
(29, 'Acuticosta chinensis', 'Lea, 1868', 'China', 6, 'https://storage.googleapis.com/conchology-images/1020000sup/1028754.jpg'),
(30, 'Unio pictorum gaudioni', 'Drouet, 1881', 'Greece', 6, 'https://storage.googleapis.com/conchology-images/1130000sup/1137663.jpg'),
(31, 'Lioconcha castrensis', 'Linnaeus, 1758', 'Philippines', 4, 'https://storage.googleapis.com/conchology-images/1220000sup/1220768.jpg'),
(32, 'Periglypta corbis', 'Lamarck, 1818', 'Philippines', 4, 'https://storage.googleapis.com/conchology-images/1060000sup/1066465.jpg'),
(33, 'Placamen flindersi', 'Cotton & Godfrey, 1938', 'Australia', 4, 'https://storage.googleapis.com/conchology-images/810000sup/818082.jpg'),
(34, 'Timoclea costellifera', 'Adams & Reeve, 1850', 'Philippines', 4, 'https://storage.googleapis.com/conchology-images/920000sup/923521.jpg'),
(35, 'Spondylus visayensis', 'Poppe & Tagaro, 2010', 'Philippines', 5, 'https://storage.googleapis.com/conchology-images/1240000sup/1244242.jpg'),
(36, 'Spondylus foliaceus f. croceus', 'Lamarck, 1819', 'Philippines', 5, 'https://storage.googleapis.com/conchology-images/1260000sup/1264229.jpg'),
(37, 'Spondylus imperialis', 'Chenu, 1843', 'Philippines', 5, 'https://storage.googleapis.com/conchology-images/1140000sup/1148688.jpg'),
(38, 'Annachlamys reevei', 'Adams & Reeve, 1850', 'Philippines', 5, 'https://storage.googleapis.com/conchology-images/1040000sup/1044427.jpg'),
(39, 'Argopecten ventricosus', 'Sowerby II, 1842', 'Mexico', 5, 'https://storage.googleapis.com/conchology-images/920000sup/923349.jpg'),
(40, 'Neopilina galatheae', 'Lemche, 1957', 'Costa Rica', 9, 'http://www.daviddarling.info/images2/Neopilina.jpg'),
(41, 'Nautilus Pompilius', 'Linnaeus, 1758', 'Australia & Indonesia', 13, 'https://indiabiodiversity.org/files-api/api/get/crop/img//Nautilus%20pompilius/65a.jpg?h=500'),
(42, 'Nautilus Scrobiculatus', 'Lightfoot, 1786', 'New Guinea', 13, 'img/images-db/species/634d8ca913032.jpeg'),
(43, 'Agaronia java', 'Chan & Nguang, 2019', 'Indonesia', 1, 'https://storage.googleapis.com/conchology-images/1220000sup/1224443.jpg'),
(44, 'Gastridium geographus', 'Linnaeus, 1758', 'Philipiness', 1, 'https://storage.googleapis.com/conchology-images/100000sup/105620.jpg'),
(45, 'Amoria hunteri', 'Iredale, 1931', 'Australia', 1, 'https://storage.googleapis.com/conchology-images/330000sup/333770.jpg'),
(46, 'Harpago arthriticus', 'Röding, 1798', 'Philippines', 1, 'https://storage.googleapis.com/conchology-images/100000sup/100321.jpg'),
(47, 'Cinguloterebra vicdani', 'Kosuge, 1981', 'Philippines', 1, 'https://storage.googleapis.com/conchology-images/320000sup/322039.jpg'),
(48, 'Homalocantha anomaliae', 'Kosuge, 1979', 'Philippines', 1, 'https://storage.googleapis.com/conchology-images/190000sup/195631.jpg'),
(49, 'Murex Pecten', 'Lightfoot, 1786', 'Philippines', 1, 'https://storage.googleapis.com/conchology-images/640000sup/648568.jpg'),
(50, 'Annepona mariae', 'Schilder, 1927', 'Philippines', 1, 'https://storage.googleapis.com/conchology-images/130000sup/135806.jpg'),
(51, 'Barycypraea fultoni', 'Sowerby III, 1903', 'South Africa', 1, 'https://storage.googleapis.com/conchology-images/1030000sup/1034858.jpg'),
(52, 'Barycypraea teulerei', 'Cazenavette, 1846', 'Oman', 1, 'https://storage.googleapis.com/conchology-images/1110000sup/1110525.jpg'),
(53, 'Cribrarula Cribraria', 'Linnaeus, 1758', 'Philippines', 1, 'https://storage.googleapis.com/conchology-images/570000sup/579032.jpg'),
(54, 'Erronea onyx', 'Linnaeus, 1758', 'Philippines', 1, 'https://storage.googleapis.com/conchology-images/1070000sup/1076756.jpg'),
(55, 'Nucleolaria nucleus', 'Linnaeus, 1758', 'Philippines', 1, 'https://storage.googleapis.com/conchology-images/370000sup/377070.jpg'),
(56, 'Pusula solandri', 'Sowerby I, 1832', 'Panama', 1, 'https://storage.googleapis.com/conchology-images/230000sup/237382.jpg'),
(57, 'Volva volva f. habei', 'Oyama, 1961', 'China', 1, 'https://storage.googleapis.com/conchology-images/1270000sup/1278515.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subclass`
--

CREATE TABLE `subclass` (
  `id_subclass` int(11) NOT NULL,
  `name` varchar(65) NOT NULL,
  `author` varchar(45) NOT NULL,
  `id_class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `subclass`
--

INSERT INTO `subclass` (`id_subclass`, `name`, `author`, `id_class`) VALUES
(1, 'Prosobranchia', 'Haeckel, 1904', 1),
(2, 'Opisthobranchia', 'Willan & Morton, 1985', 1),
(3, 'Pulmonata', 'Cuvier, 1814', 1),
(4, 'Heterodonta', 'J. E. Gray, 1854', 2),
(5, 'Pteriomorphia', 'Beurlen, 1944', 2),
(6, 'Palaeoheterodonta', 'Newell, 1965', 2),
(7, 'Dentaliida', 'da Costa, 1776', 3),
(8, 'Gadilida', 'Starobogatov, 1974', 3),
(9, 'Neopilinidae', 'Knight & Yochelson, 1958', 4),
(10, 'Chitonidae', 'Rafinesque, 1815', 5),
(11, 'Acanthochitonidae', 'Pilsbry, 1893', 5),
(12, 'Loricidae', 'Shumacher, 1817', 5),
(13, 'Nautiloidea', 'Agassiz, 1847', 6),
(14, 'Argonautidae', 'Cantraine, 1841', 6),
(15, 'Sepiida', 'Zittel, 1895', 6),
(16, 'Vampyromorphida', 'Pickford, 1939', 6),
(17, 'Octopoda', 'Leach, 1818', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '$2a$12$hWfh92ojhnbzVMHdgFIhtui/x8Zfh7eMHFl1grFMO1fJ.64Q89ApO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id_class`);

--
-- Indices de la tabla `specie`
--
ALTER TABLE `specie`
  ADD PRIMARY KEY (`id_specie`),
  ADD KEY `fk_Specie_Subclass` (`id_subclass`);

--
-- Indices de la tabla `subclass`
--
ALTER TABLE `subclass`
  ADD PRIMARY KEY (`id_subclass`),
  ADD KEY `fk_Subclass_Class` (`id_class`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `class`
--
ALTER TABLE `class`
  MODIFY `id_class` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `specie`
--
ALTER TABLE `specie`
  MODIFY `id_specie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `subclass`
--
ALTER TABLE `subclass`
  MODIFY `id_subclass` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `specie`
--
ALTER TABLE `specie`
  ADD CONSTRAINT `fk_Specie_Subclass` FOREIGN KEY (`id_subclass`) REFERENCES `subclass` (`id_subclass`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `subclass`
--
ALTER TABLE `subclass`
  ADD CONSTRAINT `fk_Subclass_Class` FOREIGN KEY (`id_class`) REFERENCES `class` (`id_class`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
