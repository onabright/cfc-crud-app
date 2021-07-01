<?php

require_once('database.php');

//first get the id of the player to be updated
$id = $_GET['id'];

if(!$id){
	header('Location: index.php');
}
//retrieve the player from the db
$statement = $pdo->prepare('SELECT * FROM person WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$player = $statement->fetch(PDO::FETCH_ASSOC);

//var_dump($player);


//pass the player attributes variables
$name = $player['name'];
$surname = $player['surname'];
$designation = $player['designation'];
$country = $player['country'];
$address = $player['address'];
$salary= $player['salary'];
$updated = date('Y-m-d H:i:s');
$errors = [];
$success = [];

//then update the player if posted
if($_SERVER['REQUEST_METHOD'] === 'POST'){

	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$designation = $_POST['designation'];
	$country = $_POST['country'];
	$address = $_POST['address'];
	$salary= $_POST['salary'];
	$updated = date('Y-m-d H:i:s');

	if(!$surname){
		$errors[] = 'Last Name is required';
	}

	if(!$country){
		$errors[] = 'Country is required';
	}

	if(!$salary){
		$errors[] = 'Salary is required';
	}

    if(!is_dir('images'))
    {
        mkdir('images');
    }


    if(empty($errors)){

        //handle image uploading
        $image = $_FILES['image']?? null; //if there's no image,set image to null
        $imagePath = $player['image'];
        
        if($image && $image['tmp_name']) //only insert image if it has a temp name
        {
             //remove old image after update
            if($player['image'])
            {
                unlink($player['image']);
            }
            //set image path
            $imagePath = 'images/'. randomString(8).'/'. $image['name'];
            //make the path
            mkdir(dirname($imagePath));
            //move images to path
            move_uploaded_file($image['tmp_name'], $imagePath); 

        } 

  
		$statement = $pdo->prepare('UPDATE person SET image = :image, name = :name, surname = :surname, 
            designation = :designation, country = :country, address = :address, salary = :salary,
            updated = :updated
			          WHERE id = :id');

        $statement->bindValue(':image', $imagePath);
		$statement->bindValue(':name', $name);
		$statement->bindValue(':surname', $surname);
		$statement->bindValue(':designation', $designation);
		$statement->bindValue(':country', $country);
		$statement->bindValue(':address', $address);
		$statement->bindValue(':salary', $salary);
		$statement->bindValue(':updated', $updated);
		
		$statement->bindValue(':id', $id);

		$statement->execute();

        $success[] = 'Player updated successfully';

        //header('Location: players.php');
	
}

}

//generate a random name for uploaded images
function randomString($n)
{
    $characters ='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for($i = 0; $i < 10; $i++)
    {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }
    return $str;
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


    <h3>Chelsea FC | Update Player:  <?php echo $player['name'] . " ".  $player['surname'] ?></h3>

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

    <form method="post" action="" enctype="multipart/form-data">

         <?php if($player['image']): ?>
            <img src="<?php echo $player['image'] ?>" class="update-image">
        <?php endif; ?>

        <div class="mb-3">
            <label>Player Photo</label> <br>
            <input type="file" name="image">
        </div>

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

        <button type="submit" class="btn btn-primary">Update</button>
        
    </form>




