<?php
session_start();
date_default_timezone_set('Asia/Taipei');
$date = date('Y-m-d');
$db = new PDO('mysql:host=localhost;dbname=kpvsequ','admin','1234');