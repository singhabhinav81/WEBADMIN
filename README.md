# WEBADMIN
CRUD APPLICATION using PHP & MySQL.


CREATE DATABASE CasualAdmin; 

<!--- DATABASE TABLE --->
CREATE TABLE `Content` (
`Content_ID` int(11) NOT NULL AUTO_INCREMENT,
`Nav_ID` int(11) NOT NULL,
`ContentTitle` varchar(100) DEFAULT NULL,
`Content` varchar(4000) NOT NULL,
`BeginDisplay` date DEFAULT NULL,
`EndDisplay` date DEFAULT NULL,
`Enabled` tinyint(1) NOT NULL,
`Display_Order` int(11) NOT NULL,
PRIMARY KEY (`Content_ID`)
);

CREATE TABLE `Nav` (
`Nav_ID` int(11) NOT NULL AUTO_INCREMENT,
`Nav_Title` varchar(50) NOT NULL,
`Display_Order` int(11) NOT NULL,
PRIMARY KEY (`Nav_ID`)
);

CREATE TABLE `SiteConfig` (
`SiteConfig_ID` int(11) NOT NULL AUTO_INCREMENT,
`ConfigName` varchar(50) NOT NULL,
`BEGDT` date DEFAULT NULL,
`ENDDT` date DEFAULT NULL,
`ShortTextValue` varchar(100) DEFAULT NULL,
`NumValue` int(11) DEFAULT NULL,
PRIMARY KEY (`SiteConfig_ID`)
);

CREATE TABLE `User_Dfn` (
`User_ID` int(11) NOT NULL AUTO_INCREMENT,
`username` varchar(20) NOT NULL,
`pwd` varchar(40) NOT NULL,
PRIMARY KEY (`User_ID`)
);

