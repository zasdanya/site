<?php
define("HOST","localhost");
define("USER","root");
define("PASSWORD","");
define("DATABASE","test");

$db=@mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die("No connect (database)");
//mysqli_set_charset($db,'utf-8') or die("No coding connection");
