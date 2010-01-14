
-- 
-- Table structure for table `zok_poll`
-- 

CREATE TABLE `zok_poll` (
  `Id` int(11) NOT NULL auto_increment,
  `UserId` int(11) NOT NULL default '0',
  `Question` varchar(255) NOT NULL default '',
  `VariantList` text NOT NULL,
  `ResultList` varchar(60) NOT NULL default '',
  `TotalVotes` int(11) NOT NULL default '0',
  `Status` enum('active','inactive','deleted','unconfirmed') NOT NULL default 'inactive',
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `zok_poll` VALUES (1, 3, 'What is the best kind of E-Bisness ? Share your opinion !!', '<var>Scamers are the kings of the internet !</var><var>Spam is the most brilliant technology of 12 century !!</var><var>Dating sites is the feature of internet money making</var><var>Porno industry erns the biggest cash in the world. Do you want to see some pics ? ;-)</var><var>Only long and hard work with directories and SEO can bring success</var><var>Crazy ideas are the engine of moneymaking !!</var>', '4;2;2;1;;1;', 10, 'active');