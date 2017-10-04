<?php
error_reporting(E_ALL);
$mysqluser='flashapp';
$mysqlhaslo='foto8245gen';
$mysqldb='fotogen';
$mysqlhost='localhost';

//$sqlconn = mysql_connect($mysqlhost, $mysqluser, $mysqlhaslo) or die ("Connect");
//$sqldb = mysql_select_db($mysqldb) or die ("B"); 
//$link = mysql_connect();
$link=mysql_connect($mysqlhost,$mysqluser,$mysqlhaslo) or die ("Nie mozna sie polaczyc");
$baza = mysql_select_db ($mysqldb) or die ("Nie mozna wybrac bazy danych");


?>