CREATE TABLE IF NOT EXISTS `kontakte` (
  `kid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `vorname` varchar(30) DEFAULT NULL,
  `strasse` varchar(128) DEFAULT NULL,
  `plz` int(11) DEFAULT NULL,
  `ort` varchar(50) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `tpriv` varchar(50) DEFAULT NULL,
  `tgesch` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

INSERT INTO `kontakte` (`kid`, `name`, `vorname`, `strasse`, `plz`, `ort`, `email`, `tpriv`, `tgesch`) VALUES
(1, 'Adam', 'Susanne', '', 2540, 'Grenchen', 's.adam@gmail.com', '', '032 786 22 11'),
(2, 'Zahler', 'Max', 'Bergweg 789', 3000, 'Bern', 'max.zahler@hotmail.com', '031 777 88 99', '031 999 88 55'),
(3, 'Pierren', 'Hansruedi', 'Bernstrasse 90', 2500, 'Biel', 'hr.pierren@gmail.com', '031 777 44 33', ''),
(4, 'Gfeller', 'Jessica', 'Moosweg 89', 4600, 'Olten', 'jessica@gfeller.ch', '032 878 66 44', '031 786 77 66'),
(5, 'Muster', 'Hans', 'Hauptstrasse 88', 4500, 'Solothurn', 'hans.muster@bluewin.ch', '032 888 99 11', '032 999 88 11');
