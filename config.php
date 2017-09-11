<?php

define('DB_HOST','localhost');
define('DB_NAME','WEBADMIN');
define('DB_USER','root');
define('DB_PWD','');

$siteTitle = 'PlaceHolder_siteTitle';
$siteFooter= 'PlaceHolder_siteFooter';
$siteBrand= 'PlaceHolder_siteBrand';
$siteAddress= 'PlaceHolder_siteAddress';
$siteShortTitle = 'PlaceHolder_siteShortTitle';
/*Query contents of source table*/
$sql="SELECT ConfigName
,ShortTextValue
FROM SiteConfig";
/*echo '<br>sql :'.$sql;*/
$link = connectDB();
if ($result = mysqli_query($link,$sql)){
while ($row = mysqli_fetch_array($result)) {
if ($row[0] == 'siteTitle') { $siteTitle = $row[1];}
if ($row[0] == 'siteFooter') { $siteFooter = $row[1];}
if ($row[0] == 'siteBrand') { $siteBrand = $row[1];}
if ($row[0] == 'siteAddress') { $siteAddress = $row[1];}
if ($row[0] == 'siteShortTitle') { $siteShortTitle = $row[1];}
}
}
/*Close database connection*/
mysqli_close ( $link );?>
