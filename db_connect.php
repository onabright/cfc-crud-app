<?php

/*
//connect to db
$pdo = new PDO('mysql:host=localhost;port=3306;', 'root', 'B0nd21');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//create databse
$statement = $pdo->prepare('CREATE DATABASE crud_test');
$statement->execute();
*/


#connect to existing database and create table table using PDO

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=crud_test', 'root', 'B0nd21');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*
$statement = $pdo->prepare("CREATE TABLE person(
                           id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                           name varchar(255) ,
                           surname varchar(255) NOT NULL,
                           designation varchar(255),
                           salary float(10) NOT NULL,
                           address text,
                           created datetime NOT NULL,
                           updated datetime
                           )");
$statement->execute();

*/

#insert values into table 
/*
$statement = $pdo->prepare("INSERT INTO person
							(name, surname, designation, salary, created)
							VALUES
							('Tony', 'Rudiger', 'Left Back', 400000, now()),
							('Kai', 'Havertz', 'Center Forward', 500000, now()),
							('Ngolo', 'Kante', 'Mid Fielder', 500000, now()),
							('Reese', 'James', 'Right Back', 200000, now()),
							('Christian', 'Pulisic', 'Forward', 400000, now())
							");
$statement->execute();
*/

#retrieve values from db;
/*
$statement = $pdo->prepare('SELECT * FROM person ORDER BY created DESC');
$statement->execute();
$persons = $statement->fetchAll(PDO::FETCH_ASSOC);

echo '<pre>';
var_dump($persons);
echo '</pre>';

*/


