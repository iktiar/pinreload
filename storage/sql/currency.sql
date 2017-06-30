# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.21-MariaDB)
# Database: coinmanagement_dev
# Generation Time: 2017-06-13 04:12:09 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table currency
# ------------------------------------------------------------

DROP TABLE IF EXISTS `currency`;

CREATE TABLE `currency` (
  `currencyId` int(11) NOT NULL AUTO_INCREMENT,
  `isoCode` varchar(10) NOT NULL,
  `currencyName` varchar(500) NOT NULL,
  PRIMARY KEY (`currencyId`),
  UNIQUE KEY `isoCode_UNIQUE` (`isoCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `currency` WRITE;
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;

INSERT INTO `currency` (`currencyId`, `isoCode`, `currencyName`)
VALUES
	(1,'AED','United Arab Emirates dirham'),
	(2,'AFN','Afghan afghani'),
	(3,'ALL','Albanian lek'),
	(4,'AMD','Armenian dram'),
	(5,'ANG','Netherlands Antillean guilder'),
	(6,'AOA','Angolan kwanza'),
	(7,'ARS','Argentine peso'),
	(8,'AUD','Australian dollar'),
	(9,'AWG','Aruban florin'),
	(10,'AZN','Azerbaijani manat'),
	(11,'BAM','Bosnia and Herzegovina convertible mark'),
	(12,'BBD','Barbados dollar'),
	(13,'BDT','Bangladeshi taka'),
	(14,'BGN','Bulgarian lev'),
	(15,'BHD','Bahraini dinar'),
	(16,'BIF','Burundian franc'),
	(17,'BMD','Bermudian dollar'),
	(18,'BND','Brunei dollar'),
	(19,'BOB','Boliviano'),
	(20,'BOV','Bolivian Mvdol (funds code)'),
	(21,'BRL','Brazilian real'),
	(22,'BSD','Bahamian dollar'),
	(23,'BTN','Bhutanese ngultrum'),
	(24,'BWP','Botswana pula'),
	(25,'BYN','Belarusian ruble'),
	(26,'BYR','Belarusian ruble'),
	(27,'BZD','Belize dollar'),
	(28,'CAD','Canadian dollar'),
	(29,'CDF','Congolese franc'),
	(30,'CHE','WIR Euro (complementary currency)'),
	(31,'CHF','Swiss franc'),
	(32,'CHW','WIR Franc (complementary currency)'),
	(33,'CLF','Unidad de Fomento (funds code)'),
	(34,'CLP','Chilean peso'),
	(35,'CNY','Chinese yuan'),
	(36,'COP','Colombian peso'),
	(37,'COU','Unidad de Valor Real (UVR) (funds code)[7]'),
	(38,'CRC','Costa Rican colon'),
	(39,'CUC','Cuban convertible peso'),
	(40,'CUP','Cuban peso'),
	(41,'CVE','Cape Verde escudo'),
	(42,'CZK','Czech koruna'),
	(43,'DJF','Djiboutian franc'),
	(44,'DKK','Danish krone'),
	(45,'DOP','Dominican peso'),
	(46,'DZD','Algerian dinar'),
	(47,'EGP','Egyptian pound'),
	(48,'ERN','Eritrean nakfa'),
	(49,'ETB','Ethiopian birr'),
	(50,'EUR','Euro'),
	(51,'FJD','Fiji dollar'),
	(52,'FKP','Falkland Islands pound'),
	(53,'GBP','Pound sterling'),
	(54,'GEL','Georgian lari'),
	(55,'GHS','Ghanaian cedi'),
	(56,'GIP','Gibraltar pound'),
	(57,'GMD','Gambian dalasi'),
	(58,'GNF','Guinean franc'),
	(59,'GTQ','Guatemalan quetzal'),
	(60,'GYD','Guyanese dollar'),
	(61,'HKD','Hong Kong dollar'),
	(62,'HNL','Honduran lempira'),
	(63,'HRK','Croatian kuna'),
	(64,'HTG','Haitian gourde'),
	(65,'HUF','Hungarian forint'),
	(66,'IDR','Indonesian rupiah'),
	(67,'ILS','Israeli new shekel'),
	(68,'INR','Indian rupee'),
	(69,'IQD','Iraqi dinar'),
	(70,'IRR','Iranian rial'),
	(71,'ISK','Icelandic króna'),
	(72,'JMD','Jamaican dollar'),
	(73,'JOD','Jordanian dinar'),
	(74,'JPY','Japanese yen'),
	(75,'KES','Kenyan shilling'),
	(76,'KGS','Kyrgyzstani som'),
	(77,'KHR','Cambodian riel'),
	(78,'KMF','Comoro franc'),
	(79,'KPW','North Korean won'),
	(80,'KRW','South Korean won'),
	(81,'KWD','Kuwaiti dinar'),
	(82,'KYD','Cayman Islands dollar'),
	(83,'KZT','Kazakhstani tenge'),
	(84,'LAK','Lao kip'),
	(85,'LBP','Lebanese pound'),
	(86,'LKR','Sri Lankan rupee'),
	(87,'LRD','Liberian dollar'),
	(88,'LSL','Lesotho loti'),
	(89,'LYD','Libyan dinar'),
	(90,'MAD','Moroccan dirham'),
	(91,'MDL','Moldovan leu'),
	(92,'MGA','Malagasy ariary'),
	(93,'MKD','Macedonian denar'),
	(94,'MMK','Myanmar kyat'),
	(95,'MNT','Mongolian tögrög'),
	(96,'MOP','Macanese pataca'),
	(97,'MRO','Mauritanian ouguiya'),
	(98,'MUR','Mauritian rupee'),
	(99,'MVR','Maldivian rufiyaa'),
	(100,'MWK','Malawian kwacha'),
	(101,'MXN','Mexican peso'),
	(102,'MXV','Mexican Unidad de Inversion(UDI) (funds code)'),
	(103,'MYR','Malaysian ringgit'),
	(104,'MZN','Mozambican metical'),
	(105,'NAD','Namibian dollar'),
	(106,'NGN','Nigerian naira'),
	(107,'NIO','Nicaraguan córdoba'),
	(108,'NOK','Norwegian krone'),
	(109,'NPR','Nepalese rupee'),
	(110,'NZD','New Zealand dollar'),
	(111,'OMR','Omani rial'),
	(112,'PAB','Panamanian balboa'),
	(113,'PEN','Peruvian Sol'),
	(114,'PGK','Papua New Guinean kina'),
	(115,'PHP','Philippine peso'),
	(116,'PKR','Pakistani rupee'),
	(117,'PLN','Polish złoty'),
	(118,'PYG','Paraguayan guaraní'),
	(119,'QAR','Qatari riyal'),
	(120,'RON','Romanian leu'),
	(121,'RSD','Serbian dinar'),
	(122,'RUB','Russian ruble'),
	(123,'RWF','Rwandan franc'),
	(124,'SAR','Saudi riyal'),
	(125,'SBD','Solomon Islands dollar'),
	(126,'SCR','Seychelles rupee'),
	(127,'SDG','Sudanese pound'),
	(128,'SEK','Swedish krona/kronor'),
	(129,'SGD','Singapore dollar'),
	(130,'SHP','Saint Helena pound'),
	(131,'SLL','Sierra Leonean leone'),
	(132,'SOS','Somali shilling'),
	(133,'SRD','Surinamese dollar'),
	(134,'SSP','South Sudanese pound'),
	(135,'STD','São Tomé and Príncipe dobra'),
	(136,'SYP','Syrian pound'),
	(137,'SZL','Swazi lilangeni'),
	(138,'THB','Thai baht'),
	(139,'TJS','Tajikistani somoni'),
	(140,'TMT','Turkmenistani manat'),
	(141,'TND','Tunisian dinar'),
	(142,'TOP','Tongan paʻanga'),
	(143,'TRY','Turkish lira'),
	(144,'TTD','Trinidad and Tobago dollar'),
	(145,'TWD','New Taiwan dollar'),
	(146,'TZS','Tanzanian shilling'),
	(147,'UAH','Ukrainian hryvnia'),
	(148,'UGX','Ugandan shilling'),
	(149,'USD','United States dollar'),
	(150,'USN','United States dollar (next day) (funds code)'),
	(151,'UYI','Uruguay Peso en Unidades Indexadas (URUIURUI) (funds code)'),
	(152,'UYU','Uruguayan peso'),
	(153,'UZS','Uzbekistan som'),
	(154,'VEF','Venezuelan bolívar'),
	(155,'VND','Vietnamese dong'),
	(156,'VUV','Vanuatu vatu'),
	(157,'WST','Samoan tala'),
	(158,'XAF','CFA franc BEAC'),
	(159,'XAG','Silver (one troy ounce)'),
	(160,'XAU','Gold (one troy ounce)'),
	(161,'XBA','European Composite Unit(EURCO) (bond market unit)'),
	(162,'XBB','European Monetary Unit(E.M.U.-6) (bond market unit)'),
	(163,'XBC','European Unit of Account 9(E.U.A.-9) (bond market unit)'),
	(164,'XBD','European Unit of Account 17(E.U.A.-17) (bond market unit)'),
	(165,'XCD','East Caribbean dollar'),
	(166,'XDR','Special drawing rights'),
	(167,'XFU','UIC franc(special settlement currency)'),
	(168,'XOF','CFA franc BCEAO'),
	(169,'XPD','Palladium (onetroy ounce)'),
	(170,'XPF','CFP franc(franc Pacifique)'),
	(171,'XPT','Platinum (onetroy ounce)'),
	(172,'XSU','SUCRE'),
	(173,'XTS','Code reserved for testing purposes'),
	(174,'XUA','ADB Unit of Account'),
	(175,'XXX','No currency'),
	(176,'YER','Yemeni rial'),
	(177,'ZAR','South African rand'),
	(178,'ZMW','Zambian kwacha');

/*!40000 ALTER TABLE `currency` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
