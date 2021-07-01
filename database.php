<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=crud_test', 'root', 'B0nd21');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
