CREATE DATABASE geartoswopc;

--CREATING TABLE oc_accounts
CREATE TABLE `oc_accounts` (
  `idAccount` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(145) NOT NULL,
  `password` varchar(145) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `idLocation` int(10) unsigned DEFAULT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastModifiedDate` datetime DEFAULT NULL,
  `lastSigninDate` datetime DEFAULT NULL,
  `activationToken` varchar(225) NOT NULL,
  PRIMARY KEY (`idAccount`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--INSERTING DATA INTO oc_accounts
INSERT INTO oc_accounts VALUES ('1','dsf','sdf@sdf.com','sdf','1','','2012-04-30 20:18:04','','','6f15b4fb0b1660020cc613b1ef768b90');



--CREATING TABLE oc_categories
CREATE TABLE `oc_categories` (
  `idCategory` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `order` int(2) unsigned NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idCategoryParent` int(10) unsigned NOT NULL DEFAULT '0',
  `friendlyName` varchar(64) NOT NULL,
  `description` text,
  `price` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`idCategory`) USING BTREE,
  KEY `Index_fname` (`friendlyName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--INSERTING DATA INTO oc_categories
INSERT INTO oc_categories VALUES ('80','Basse','2','2012-05-05 19:04:14','0','basse','Basse','0');
INSERT INTO oc_categories VALUES ('81','Guitare','1','2012-05-05 19:04:20','0','guitare','Guitare','0');
INSERT INTO oc_categories VALUES ('82','Jazz','3','2012-04-30 21:13:28','81','jazz','Jazz','0');
INSERT INTO oc_categories VALUES ('83','Electrique','2','2012-05-05 19:07:17','81','electrique-81','Electrique','0');
INSERT INTO oc_categories VALUES ('84','Acoustique','1','2012-05-05 19:06:50','81','acoustique-81','Acoustique','0');
INSERT INTO oc_categories VALUES ('85','Synth&eacute;tiseur','3','2012-05-05 19:04:30','0','synthetiseur','Synth&eacute;tiseur','0');
INSERT INTO oc_categories VALUES ('86','Electrique','2','2012-05-05 19:05:07','80','electrique','Electrique','0');
INSERT INTO oc_categories VALUES ('87','Acoustique','1','2012-05-05 19:04:52','80','acoustique','Acoustique','0');
INSERT INTO oc_categories VALUES ('88','Ampli Combo','3','2012-05-05 19:05:38','80','ampli-combo','Ampli Combo','0');
INSERT INTO oc_categories VALUES ('89','Ampli T&ecirc;te','4','2012-05-05 19:06:04','80','ampli-tete','Ampli T&ecirc;te','0');
INSERT INTO oc_categories VALUES ('90','Ampli Baffle','5','2012-05-05 19:06:25','80','ampli-baffle','Ampli Baffle','0');
INSERT INTO oc_categories VALUES ('91','Ampli Combo','4','2012-05-05 19:07:34','81','ampli-combo-81','Ampli Combo','0');
INSERT INTO oc_categories VALUES ('92','Ampli T&ecirc;te','5','2012-05-05 19:07:53','81','ampli-tete-81','Ampli T&ecirc;te','0');
INSERT INTO oc_categories VALUES ('93','Batterie','4','2012-05-05 19:04:40','0','batterie','Batterie','0');
INSERT INTO oc_categories VALUES ('94','Acoustique','1','2012-05-05 19:09:21','93','acoustique-93','Acoustique','0');
INSERT INTO oc_categories VALUES ('95','Electronique','2','2012-05-05 19:09:32','93','electronique','Electronique','0');
INSERT INTO oc_categories VALUES ('96','Percussions','3','2012-04-30 21:30:25','93','percussions','Percussions','0');
INSERT INTO oc_categories VALUES ('97','Ampli Baffle','6','2012-05-05 19:08:13','81','ampli-baffle-81','Ampli Baffle','0');
INSERT INTO oc_categories VALUES ('98','Synth&eacute;tiseur','1','2012-05-05 19:08:36','85','synthetiseur-85','Synth&eacute;tiseur','0');
INSERT INTO oc_categories VALUES ('99','Piano','2','2012-05-05 19:08:49','85','piano','Piano','0');
INSERT INTO oc_categories VALUES ('100','Sampler','3','2012-05-05 19:09:04','85','sampler','Sampler','0');
INSERT INTO oc_categories VALUES ('101','Studio','5','2012-04-30 21:36:07','0','studio','Studio','0');
INSERT INTO oc_categories VALUES ('102','Mixage','1','2012-04-30 21:40:41','101','mixage','Mixage','0');
INSERT INTO oc_categories VALUES ('103','Enregistrement','2','2012-04-30 21:40:13','101','enregistrement','Enregistrement','0');
INSERT INTO oc_categories VALUES ('104','Effets','6','2012-04-30 21:38:52','80','effets','Effets','0');
INSERT INTO oc_categories VALUES ('105','Effets','7','2012-04-30 21:39:49','81','effets-81','Effets','0');
INSERT INTO oc_categories VALUES ('106','Moniteurs','3','2012-04-30 21:42:45','101','moniteurs','Moniteurs','0');
INSERT INTO oc_categories VALUES ('107','Microphones','4','2012-04-30 21:43:42','101','microphones','Microphones','0');
INSERT INTO oc_categories VALUES ('108','Classique','1','2012-05-05 19:07:04','81','classique','Classique','0');
INSERT INTO oc_categories VALUES ('109','Micros','8','2012-04-30 21:45:49','81','micros','Micros','0');
INSERT INTO oc_categories VALUES ('110','Accessoires','9','2012-04-30 21:46:17','81','accessoires','Accessoires','0');
INSERT INTO oc_categories VALUES ('111','DVD / Livres','10','2012-04-30 21:58:55','81','dvd-livres-81','DVD / Livres','0');
INSERT INTO oc_categories VALUES ('114','Micros','8','2012-04-30 21:48:57','80','micros-80','Micros','0');
INSERT INTO oc_categories VALUES ('115','Accessoires','9','2012-04-30 21:49:17','80','accessoires-80','Accessoires','0');
INSERT INTO oc_categories VALUES ('116','DVD / Livres','10','2012-04-30 21:58:04','80','dvd-livres','DVD / Livres','0');
INSERT INTO oc_categories VALUES ('117','Informatique','12','2012-04-30 21:50:47','81','informatique','Informatique','0');
INSERT INTO oc_categories VALUES ('119','Informatique','12','2012-04-30 21:52:08','80','informatique-80','Informatique','0');
INSERT INTO oc_categories VALUES ('120','Software','4','2012-04-30 21:53:57','85','software','Software','0');
INSERT INTO oc_categories VALUES ('121','Hardware','5','2012-04-30 21:54:24','85','hardware','Hardware','0');
INSERT INTO oc_categories VALUES ('122','Software','3','2012-04-30 21:55:07','93','software-93','Software','0');
INSERT INTO oc_categories VALUES ('123','Microphone','5','2012-05-05 19:09:47','93','microphone','Microphone','0');
INSERT INTO oc_categories VALUES ('124','Interface Audio','5','2012-05-05 19:10:04','101','interface-audio','Interface Audio','0');
INSERT INTO oc_categories VALUES ('125','Software','6','2012-04-30 22:03:50','101','software-101','Software','0');
INSERT INTO oc_categories VALUES ('126','Effets','7','2012-05-05 19:11:03','101','effets-101','Effets','0');
INSERT INTO oc_categories VALUES ('127','Ordinateur','9','2012-05-05 19:10:43','101','ordinateur','Ordinateur','0');
INSERT INTO oc_categories VALUES ('128','Accessoires','10','2012-04-30 22:06:32','101','accessoires-101','Accessoires','0');
INSERT INTO oc_categories VALUES ('129','Accessoires','6','2012-04-30 22:13:57','85','accessoires-85','Accessoires','0');



--CREATING TABLE oc_locations
CREATE TABLE `oc_locations` (
  `idLocation` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `idLocationParent` int(10) unsigned NOT NULL DEFAULT '0',
  `friendlyName` varchar(64) NOT NULL,
  PRIMARY KEY (`idLocation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--INSERTING DATA INTO oc_locations
INSERT INTO oc_locations VALUES ('3','Ile de France','0','ile-de-france');
INSERT INTO oc_locations VALUES ('4','Alsace','0','alsace');
INSERT INTO oc_locations VALUES ('5','Aquitaine','0','aquitaine');
INSERT INTO oc_locations VALUES ('6','Auvergne','0','auvergne');
INSERT INTO oc_locations VALUES ('7','Basse Normandie','0','basse-normandie');
INSERT INTO oc_locations VALUES ('8','Bourgogne','0','bourgogne');
INSERT INTO oc_locations VALUES ('9','Bretagne','0','bretagne');
INSERT INTO oc_locations VALUES ('10','Centre','0','centre');
INSERT INTO oc_locations VALUES ('11','Champagne Ardennes','0','champagne-ardennes');
INSERT INTO oc_locations VALUES ('12','Corse','0','corse');
INSERT INTO oc_locations VALUES ('13','Franche Comt&eacute;','0','franche-comte');
INSERT INTO oc_locations VALUES ('14','Haute Normandie','0','haute-normandie');
INSERT INTO oc_locations VALUES ('15','Languedoc Roussillon','0','languedoc-roussillon');
INSERT INTO oc_locations VALUES ('16','Limousin','0','limousin');
INSERT INTO oc_locations VALUES ('17','Lorraine','0','lorraine');
INSERT INTO oc_locations VALUES ('18','Midi Pyr&eacute;n&eacute;es','0','midi-pyrenees');
INSERT INTO oc_locations VALUES ('19','Nord Pas De Calais','0','nord-pas-de-calais');
INSERT INTO oc_locations VALUES ('20','Pays de Loire','0','pays-de-loire');
INSERT INTO oc_locations VALUES ('21','Picardie','0','picardie');
INSERT INTO oc_locations VALUES ('22','Poitou Charentes','0','poitou-charentes');
INSERT INTO oc_locations VALUES ('23','Provence Alpes Cote d\'Azur','0','provence-alpes-cote-dazur');
INSERT INTO oc_locations VALUES ('24','Rhone Alpes','0','rhone-alpes');
INSERT INTO oc_locations VALUES ('25','Guadeloupe','0','guadeloupe');
INSERT INTO oc_locations VALUES ('26','Martinique','0','martinique');
INSERT INTO oc_locations VALUES ('27','Guyane','0','guyane');
INSERT INTO oc_locations VALUES ('28','R&eacute;union','0','reunion');



--CREATING TABLE oc_posts
CREATE TABLE `oc_posts` (
  `idPost` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `isAvailable` int(1) NOT NULL DEFAULT '1',
  `isConfirmed` int(1) NOT NULL DEFAULT '0',
  `idCategory` int(10) unsigned NOT NULL DEFAULT '0',
  `type` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(145) NOT NULL,
  `description` text NOT NULL,
  `email` varchar(145) NOT NULL,
  `idLocation` int(10) unsigned NOT NULL DEFAULT '0',
  `place` varchar(145) DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `ip` varchar(18) NOT NULL DEFAULT '',
  `insertDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(8) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `hasImages` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idPost`) USING BTREE,
  KEY `FK_posts_categories` (`idCategory`),
  KEY `Index_title` (`title`),
  CONSTRAINT `FK_posts_categories` FOREIGN KEY (`idCategory`) REFERENCES `oc_categories` (`idCategory`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--INSERTING DATA INTO oc_posts
INSERT INTO oc_posts VALUES ('3','0','1','80','0','dmlkfjqsdmlkf','mlksdfsmlkdfj','sdqlmkfqsdf@qsdfqsd.fr','3','','smdlkqsmdlkfj','145','91.121.173.125','2012-04-30 19:08:44','tvbpsad1','','0');
INSERT INTO oc_posts VALUES ('4','0','1','80','0','Effets guitare TC ELECTRONIC','Echange Effets guitare TC ELECTRONIC contre un overdrive des marques Surh, Boss, Ibanez&lt;br /&gt;','smarterbizbox@gmail.com','0','Paris','Herv&eacute;','150','86.195.65.3','2012-04-30 19:17:39','4hsoapwl','0601020304','1');
INSERT INTO oc_posts VALUES ('7','1','1','83','0','Musicman Axis Sport de 1997 en super etat','J\'&eacute;change cette merveille ...&lt;br /&gt;&lt;br /&gt;Musicman Axis Sport de 1997 en super &eacute;tat :&lt;br /&gt;&lt;br /&gt;Aucun pet et pas de rayures.&lt;br /&gt;
&lt;br /&gt;
Elle date de Mai 1997.&lt;br /&gt;
Micros Di Marzio comme sur le mod&egrave;le Van Halen signature.&lt;br /&gt;
&lt;br /&gt;
Vibrato 2 points, m&eacute;caniques autobloquantes.&lt;br /&gt;
&Eacute;tui  Musicman d\'origine.&lt;br /&gt;
Guitare en super &eacute;tat car tr&egrave;s peu jou&eacute;e.&lt;br /&gt;
Vendue dans son flycase musicman d\'origine.&lt;br /&gt;','qdsqfd@deed.de','9','Brest','Antoine','990','86.212.13.216','2012-04-30 19:40:02','w9fipsc4','0677554433','1');
INSERT INTO oc_posts VALUES ('8','1','1','83','0','Gibson LP Black 1976','J\'&eacute;change Gibson LP Black 1976 :&lt;br /&gt;&lt;br /&gt;N&deg; de s&eacute;rie : 7 5--8 - dat&eacute;e de 1995 &lt;br /&gt;
Corps : Acajou massif&lt;br /&gt;
Table : Erable&lt;br /&gt;
Manche : coll&eacute; en Acajou 1 pi&egrave;ce&lt;br /&gt;
Touche : Palissandre&lt;br /&gt;
Profil de manche : 50s Rounded&lt;br /&gt;
Frettes : 22 type Medium Jumbo&lt;br /&gt;
Micros : classic 57\'&lt;br /&gt;
Contr&ocirc;les : 1 volume par micro, 1 tonalit&eacute; par micro, s&eacute;lecteur 3 positions&lt;br /&gt;
Chevalet : Gibson ABR-1&lt;br /&gt;
Cordier : Gibson TonePros Locking Stopbar&lt;br /&gt;
Accastillage : chrom&eacute;&lt;br /&gt;
Poids : 4,1 Kg&lt;br /&gt;
Etat g&eacute;n&eacute;ral : 7 / 10&lt;br /&gt;
Guitare qui a &eacute;t&eacute; jou&eacute;e et pr&eacute;sente des pocks&lt;br /&gt;
&lt;br /&gt;
Flight case non original EPIPHONE fourni','azertytrez@yopmail.com','19','Lille','Thomas','3700','86.212.13.216','2012-04-30 19:41:19','wu6qfcb2','0609080706','1');
INSERT INTO oc_posts VALUES ('9','1','1','83','0','Fender Stratocaster Blanche ','J\'&eacute;change &lt;br /&gt;&lt;br /&gt;&Eacute;tat Impeccable, Copie conforme de la c&eacute;l&egrave;bre stratocaster de
 1954. Corps en 1 pi&egrave;ce, bois de Sen, micros Maxon d\'origine (Dry-Z), 
Manche &eacute;rable 1 pi&egrave;ce...&lt;br /&gt;
&lt;br /&gt;
Rien a envier a sa grande sœur du Fender Custom Shop...Avec son flycase d\'origine...&lt;br /&gt;
&lt;br /&gt;
Potentios changer (originaux fournis), condensateur PIO 0.47uF.&lt;br /&gt;
&lt;br /&gt;
Regardez mes autres annonces...','sdf@sdf.com','4','Strasbourg','Christophe','1350','86.212.13.216','2012-04-30 19:46:19','r97j2gbl','0633336677','1');
INSERT INTO oc_posts VALUES ('10','1','1','83','0','PRS 212','J\'&eacute;change cette PRS 212 neuve &eacute;tat mint 10/10&lt;br /&gt;&lt;br /&gt;able &eacute;rable Flam&eacute; 10 TOP&lt;br /&gt;Corps acajou&lt;br /&gt;Manche &lt;span class=\&quot;blockblack\&quot;&gt;dalbergia s&eacute;lectionn&eacute;&lt;/span&gt;&lt;br /&gt;Touche &lt;span class=\&quot;blockblack\&quot;&gt;dalbergia s&eacute;lectionn&eacute;&lt;/span&gt;&lt;br /&gt;Profil du manche &lt;span class=\&quot;blockblack\&quot;&gt;\&quot;wide fat\&quot;&lt;/span&gt;&lt;br /&gt;Nombre de frettes 22&lt;br /&gt;Rep&egrave;res de touche &lt;span class=\&quot;blockblack\&quot;&gt;shadow birds&lt;/span&gt;&lt;br /&gt;Diapason &lt;span class=\&quot;blockblack\&quot;&gt;635mm (25\&quot;)&lt;/span&gt;      &lt;br /&gt;Micro Manche &lt;span class=\&quot;blockblack\&quot;&gt;57/08 Narrowfield&lt;/span&gt;&lt;br /&gt;Micro Central &lt;span class=\&quot;blockblack\&quot;&gt;57/08 Narrowfield&lt;/span&gt;&lt;br /&gt;Micro Chevalet &lt;span class=\&quot;blockblack\&quot;&gt;57/08 Narrowfield&lt;/span&gt;&lt;br /&gt;S&eacute;lecteur micros 5 positions&lt;br /&gt;Contr&ocirc;les &lt;span class=\&quot;blockblack\&quot;&gt;volume et tone&lt;/span&gt;&lt;br /&gt;M&eacute;caniques &lt;span class=\&quot;blockblack\&quot;&gt;PRS 14:1 phase II low mass locking&lt;/span&gt;&lt;br /&gt;Accastillage &lt;span class=\&quot;blockblack\&quot;&gt;nickel&lt;/span&gt;&lt;br /&gt;Livr&eacute;e en &eacute;tui','asd@sdf.com','3','75020 Paris','asd','1500','86.212.13.216','2012-04-30 19:50:11','3gd95ykb','0601020304','1');
INSERT INTO oc_posts VALUES ('11','1','1','83','0','fdgdfg','fdgdfg&lt;br /&gt;','dsfg@dfg.com','3','','dsf','0','82.240.249.237','2012-05-01 17:19:07','7qwuv8cn','','1');
INSERT INTO oc_posts VALUES ('12','1','0','80','0','Test','Foobar','test@yopmail.com','3','','Lukas','0','90.2.238.72','2012-05-05 14:10:07','k3ij7rpt','','0');



--CREATING TABLE oc_postshits
CREATE TABLE `oc_postshits` (
  `idHit` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idPost` int(10) unsigned NOT NULL,
  `hitTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(18) NOT NULL,
  PRIMARY KEY (`idHit`),
  KEY `FK_PostsHits_idPost` (`idPost`),
  KEY `Index_hitTime` (`hitTime`),
  CONSTRAINT `FK_PostsHits_idPost` FOREIGN KEY (`idPost`) REFERENCES `oc_posts` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--INSERTING DATA INTO oc_postshits
INSERT INTO oc_postshits VALUES ('2','3','2012-04-30 19:08:51','91.121.173.125');
INSERT INTO oc_postshits VALUES ('3','3','2012-04-30 19:09:05','91.121.173.125');
INSERT INTO oc_postshits VALUES ('4','3','2012-04-30 19:09:10','91.121.173.125');
INSERT INTO oc_postshits VALUES ('5','3','2012-04-30 19:09:41','86.195.65.3');
INSERT INTO oc_postshits VALUES ('6','3','2012-04-30 19:09:42','66.249.72.113');
INSERT INTO oc_postshits VALUES ('11','4','2012-04-30 19:17:44','86.195.65.3');
INSERT INTO oc_postshits VALUES ('12','4','2012-04-30 19:17:46','66.249.72.113');
INSERT INTO oc_postshits VALUES ('13','3','2012-04-30 19:17:55','91.121.173.125');
INSERT INTO oc_postshits VALUES ('14','4','2012-04-30 19:18:01','86.195.65.3');
INSERT INTO oc_postshits VALUES ('17','3','2012-04-30 19:20:13','91.121.173.125');
INSERT INTO oc_postshits VALUES ('25','7','2012-04-30 19:40:07','91.121.173.125');
INSERT INTO oc_postshits VALUES ('26','7','2012-04-30 19:40:50','91.121.173.125');
INSERT INTO oc_postshits VALUES ('27','7','2012-04-30 19:45:57','91.121.173.125');
INSERT INTO oc_postshits VALUES ('28','9','2012-04-30 19:46:23','91.121.173.125');
INSERT INTO oc_postshits VALUES ('29','9','2012-04-30 19:47:29','91.121.173.125');
INSERT INTO oc_postshits VALUES ('30','7','2012-04-30 19:49:09','91.121.173.125');
INSERT INTO oc_postshits VALUES ('31','10','2012-04-30 19:50:13','91.121.173.125');
INSERT INTO oc_postshits VALUES ('32','8','2012-04-30 20:08:31','91.121.173.125');
INSERT INTO oc_postshits VALUES ('33','8','2012-04-30 20:08:54','91.121.173.125');
INSERT INTO oc_postshits VALUES ('34','8','2012-04-30 20:09:13','91.121.173.125');
INSERT INTO oc_postshits VALUES ('35','8','2012-04-30 20:10:00','91.121.173.125');
INSERT INTO oc_postshits VALUES ('36','7','2012-04-30 20:15:05','91.121.173.125');
INSERT INTO oc_postshits VALUES ('37','7','2012-04-30 20:17:37','91.121.173.125');
INSERT INTO oc_postshits VALUES ('38','7','2012-04-30 20:17:40','91.121.173.125');
INSERT INTO oc_postshits VALUES ('39','7','2012-04-30 20:17:41','91.121.173.125');
INSERT INTO oc_postshits VALUES ('40','10','2012-04-30 21:21:03','86.212.13.216');
INSERT INTO oc_postshits VALUES ('41','10','2012-04-30 22:32:39','86.212.13.216');
INSERT INTO oc_postshits VALUES ('42','10','2012-04-30 22:34:13','86.212.13.216');
INSERT INTO oc_postshits VALUES ('43','10','2012-04-30 22:34:58','86.212.13.216');
INSERT INTO oc_postshits VALUES ('44','10','2012-04-30 22:36:06','86.212.13.216');
INSERT INTO oc_postshits VALUES ('45','8','2012-04-30 22:52:36','86.212.13.216');
INSERT INTO oc_postshits VALUES ('46','10','2012-04-30 23:00:47','86.212.13.216');
INSERT INTO oc_postshits VALUES ('47','10','2012-04-30 23:02:42','86.212.13.216');
INSERT INTO oc_postshits VALUES ('48','10','2012-05-01 07:43:22','86.212.13.216');
INSERT INTO oc_postshits VALUES ('49','10','2012-05-01 07:44:39','86.212.13.216');
INSERT INTO oc_postshits VALUES ('50','9','2012-05-01 07:49:29','86.212.13.216');
INSERT INTO oc_postshits VALUES ('51','9','2012-05-01 07:50:02','86.212.13.216');
INSERT INTO oc_postshits VALUES ('52','8','2012-05-01 07:54:31','86.212.13.216');
INSERT INTO oc_postshits VALUES ('53','7','2012-05-01 08:00:59','86.212.13.216');
INSERT INTO oc_postshits VALUES ('54','7','2012-05-01 08:02:46','86.212.13.216');
INSERT INTO oc_postshits VALUES ('55','8','2012-05-01 08:13:06','86.212.13.216');
INSERT INTO oc_postshits VALUES ('56','7','2012-05-01 08:14:24','86.212.13.216');
INSERT INTO oc_postshits VALUES ('57','8','2012-05-01 09:26:58','86.212.13.216');
INSERT INTO oc_postshits VALUES ('58','7','2012-05-01 10:00:12','86.212.13.216');
INSERT INTO oc_postshits VALUES ('59','11','2012-05-01 17:19:09','86.195.65.3');
INSERT INTO oc_postshits VALUES ('60','10','2012-05-01 17:19:57','86.195.65.3');
INSERT INTO oc_postshits VALUES ('61','11','2012-05-01 17:20:51','86.195.65.3');
INSERT INTO oc_postshits VALUES ('62','11','2012-05-01 17:21:06','86.195.65.3');
INSERT INTO oc_postshits VALUES ('63','10','2012-05-01 17:29:07','86.195.65.3');
INSERT INTO oc_postshits VALUES ('64','9','2012-05-05 16:01:55','82.240.249.237');
INSERT INTO oc_postshits VALUES ('65','11','2012-05-05 16:03:41','82.240.249.237');
INSERT INTO oc_postshits VALUES ('66','8','2012-05-05 17:03:46','82.240.249.237');
INSERT INTO oc_postshits VALUES ('67','9','2012-05-05 17:04:25','82.240.249.237');



-- THE END

