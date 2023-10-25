CREATE DATABASE  IF NOT EXISTS `fullstack_laboratorio`;
USE `fullstack_laboratorio`;

CREATE TABLE `corsi` (
  `idcorso` int NOT NULL AUTO_INCREMENT,
  `corso` varchar(45) NOT NULL,
  PRIMARY KEY (`idcorso`)
);
INSERT INTO `corsi` VALUES (1,'Sviluppo Frontend'),(2,'Sviluppo Backend'),(3,'UX/UI Design'),(4,'Database'),(5,'Inglese'),(6,'DevOps'),(7,'Big Data');


CREATE TABLE `tipo_utenti` (
  `idtipo_utenti` int NOT NULL AUTO_INCREMENT,
  `tipologia` varchar(45) NOT NULL,
  PRIMARY KEY (`idtipo_utenti`)
);
INSERT INTO `tipo_utenti` VALUES (1,'Studente'),(2,'Admin');

CREATE TABLE `utenti` (
  `idUtente` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `cognome` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `tipoUtente` varchar(45) NOT NULL,
  PRIMARY KEY (`idUtente`)
);
INSERT INTO `utenti` VALUES (1,'Thomas','Statile','stati','thomastatile@gmail.com','password','1'),(2,'Denisa ','Zeka','denisa','denisazeka@gmail.com','ciao','1'),(3,'Matteo','Muratori','matteo','matteomura@gmail.com','mura','1'),(4,'Francesco','Baltimora','francesco','francibalti@gmail.com ','franci','1'),(5,'Luis','Alberto','luis','luis@gmail.com','luis','1'),(6,'Luca','Sacchi','luca','sacchi@gmail.com','sacchi','2'),(7,'','','','','','1'),(9,'Rocco','Siffredi','thom','thomasstatile@gmail.com','ciao','1'),(10,'Thomas','Sta','ccc','FAcciaml.duro@gmail.com','password','1'),(11,'salvatore','mazza','salvatore','ghghhh@kjfienmf.com','mazza','1'),(12,'Asia','Pogliani','asia','asia@gmail.com','ciao','1'),(15,'Roberto','sacchi','sacchimerda','sacchimerda@gmail.com','pass','1'),(16,'alfredo','robi','robi','robi@gmail.com','ss','1'),(17,'Lucia','Zacca','Lucia','lucia@gmail.com','ww','2'),(18,'Diego','Maradona','Diego','maradona@gmail.com','napoli','1'),(21,'Mario','Balotelli','supermario','mario@gmail.com','inter','1'),(22,'Paolo','Robberto','paolo','paolo@gmail.com','paolo','1'),(28,'Arnaldo','Arnaldo','Arnaldo','arna@gmail.com','arnaldo','1'),(29,'Giacomo','Ava','jack','jack@gmail.com','jack','2');

CREATE TABLE `voti_corsi` (
  `idvoti_corsi` int NOT NULL AUTO_INCREMENT,
  `id_utente` int NOT NULL,
  `id_corso` int NOT NULL,
  `voto` float NOT NULL,
  PRIMARY KEY (`idvoti_corsi`),
  KEY `id_utente_idx` (`id_utente`),
  KEY `id_corso_idx` (`id_corso`),
  CONSTRAINT `id_corso` FOREIGN KEY (`id_corso`) REFERENCES `corsi` (`idcorso`),
  CONSTRAINT `id_utente` FOREIGN KEY (`id_utente`) REFERENCES `utenti` (`idUtente`)
);
INSERT INTO `voti_corsi` VALUES (35,1,1,90),(36,1,2,88),(37,1,3,85),(38,1,4,95),(39,1,5,80),(40,1,6,86),(41,1,7,89),(42,2,1,85),(43,2,2,86),(44,2,3,90),(45,2,4,95),(46,2,5,97),(47,2,6,87),(48,2,7,80),(49,3,1,78),(50,3,2,85),(51,3,3,80),(52,3,4,88),(53,3,5,92),(54,3,6,60),(55,3,7,65),(56,4,1,78),(57,4,2,80),(58,4,4,84),(59,4,5,86),(60,4,6,88),(61,4,7,90),(62,5,1,84),(63,5,2,86),(64,5,3,88),(65,5,4,90),(66,5,5,92),(67,5,6,94),(68,5,7,96);

CREATE TABLE `feedback_corsi` (
  `idfeedback_corsi` int NOT NULL AUTO_INCREMENT,
  `id_utente` int NOT NULL,
  `id_corso` int NOT NULL,
  `feedback` tinytext NOT NULL,
  `testo_feedback` text,
  PRIMARY KEY (`idfeedback_corsi`),
  KEY `ID_Utente_idx` (`id_utente`),
  KEY `ID_Corso_idx` (`id_corso`),
  CONSTRAINT `IDCorso` FOREIGN KEY (`id_corso`) REFERENCES `corsi` (`idcorso`),
  CONSTRAINT `IDUtente` FOREIGN KEY (`id_utente`) REFERENCES `utenti` (`idUtente`)
);
INSERT INTO `feedback_corsi` VALUES (1,1,1,'1',NULL),(2,1,3,'3',NULL),(3,4,2,'3','Il corso ha soddisfatto in parte le mie aspettative'),(4,1,4,'3','buono'),(5,1,7,'4','buono'),(6,1,7,'4','buono'),(7,1,4,'3','buono'),(8,1,4,'3','buono'),(9,1,6,'Buono','Il corso ha soddisfatto in parte le mie aspettative'),(10,9,1,'Pessimo','schifoso\r\n'),(11,1,3,'Eccellente','corso ben strutturato'),(12,1,3,'Eccellente','corso ben strutturato'),(13,1,7,'Buono',''),(14,1,7,'Buono',''),(15,12,3,'Decente','il corso era decente'),(16,1,1,'Pessimo','');
