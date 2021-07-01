<?php

require_once('database.php');

//initialize variables
$name = '';
$surname = '';
$designation = '';
$country = '';
$address = '';
$salary= '';
$updated = date('Y-m-d H:i:s');
$errors = [];
$success = [];

//only submit if request method is post

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$designation = $_POST['designation'];
	$country = $_POST['country'];
	$address = $_POST['address'];
	$salary= $_POST['salary'];
	$created = date('Y-m-d H:i:s');

	if(!$surname){
		$errors[] = 'Last Name is required';
	}

	if(!$country){
		$errors[] = 'Country is required';
	}

	if(!$salary){
		$errors[] = 'Salary is required';
	}

	if(empty($errors)){

		$statement = $pdo->prepare("INSERT INTO person (name, surname, designation, country, address, salary, created)
			                         VALUES
			                         (:name, :surname, :designation, :country, :address, :salary, :created)");

		$statement->bindValue(':name', $name);
		$statement->bindValue(':surname', $surname);
		$statement->bindValue(':designation', $designation);
		$statement->bindValue(':country', $country);
		$statement->bindValue(':address', $address);
		$statement->bindValue(':salary', $salary);
		$statement->bindValue(':created', $created);

		$statement->execute();

		$success[] = 'Player created successfully';
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="players.css" rel="stylesheet">

  <title>Chelsea Players</title>
  </head>
  <body>

  	<p>
  		<a href="index.php" class="btn btn-large btn-secondary">Back to Players</a>
  	</p>


    <h3>Chelsea FC | Add new Player</h3>

    <?php if(!empty($errors)): ?>

    <div class="alert alert-danger">
    	<?php foreach($errors as $error): ?>
    	<div><?php echo $error ?></div>
   		 <?php endforeach ?>
    </div>

    <?php endif ?>

	<?php if(!empty($success)): ?>	
    <div class="alert alert-success">
    	<?php foreach($success as $s) :?>
    	<div><?php echo $s?></div>
        <?php endforeach?>
    </div>
    <?php endif ?>

    <form method="post" action="">
    	<div class="mb-3">
            <label>First Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name ?>">
        </div>

        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="surname" class="form-control" value="<?php echo $surname ?>">
        </div>
        <div class="mb-3">
            <label>Field Position</label>
            <input type="text" name="designation" class="form-control" value="<?php echo $designation ?>">
        </div>

        <div class="mb-3">
            <label>Country</label>
            <input type="text"  name="country" class="form-control" value="<?php echo $country ?>">
        </div>

        <div class="mb-3">
            <label>Address</label>
            <textarea class="form-control" name="address"><?php echo $address ?></textarea>
        </div>

        <div class="mb-3">
            <label>Salary</label>
            <input type="number" step=".01" name="salary" class="form-control" value="<?php echo $salary ?>">
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
        
    </form>
