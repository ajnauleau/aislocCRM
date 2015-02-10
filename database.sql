
CREATE TABLE IF NOT EXISTS `emaillist` (
  `emailadd` varchar(255) NOT NULL,
  PRIMARY KEY  (`emailadd`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='List of all gotten emails';


CREATE TABLE IF NOT EXISTS `finishedurls` (
  `urlname` varchar(255) NOT NULL,
  PRIMARY KEY  (`urlname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='List of finished urls';



CREATE TABLE IF NOT EXISTS `workingurls` (
  `urlname` varchar(255) NOT NULL,
  PRIMARY KEY  (`urlname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='List of current working urls';
