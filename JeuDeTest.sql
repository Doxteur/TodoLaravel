-- Note Pas Important
INSERT INTO `todos` (`ID`, `texte`, `termine`, `timestamp`, `theme`, `important`) VALUES (NULL, 'Ma Premiere Note Non Importante', '0', CURRENT_TIMESTAMP, NULL, '0');
-- Note Importante
INSERT INTO `todos` (`ID`, `texte`, `termine`, `timestamp`, `theme`, `important`) VALUES (NULL, 'Ma Deuxieme Note  Importante', '0', CURRENT_TIMESTAMP, NULL, '1');
-- Note Importante et Termine
INSERT INTO `todos` (`ID`, `texte`, `termine`, `timestamp`, `theme`, `important`) VALUES (NULL, 'Ma Troisieme Note Importante et Terminee', '1', CURRENT_TIMESTAMP, NULL, '1');
-- Note non Importante et Termine
INSERT INTO `todos` (`ID`, `texte`, `termine`, `timestamp`, `theme`, `important`) VALUES (NULL, 'Ma Quatrieme Note Non Importante et Terminee', '1', CURRENT_TIMESTAMP, NULL, '0');