<?php
require_once('database.php');

$id = $_GET['id'] ?? null;

if(!$id){
	header('Location: index.php');
	exit;
}

	$statement = $pdo->prepare('SELECT * FROM person WHERE id = :id');
	$statement->bindValue(':id', $id);
	$statement->execute();
	$player = $statement->fetch(PDO::FETCH_ASSOC);

	//var_dump($player);

	$name = $player['image'];
    $name = $player['name'];
	$surname = $player['surname'];
	$designation = $player['designation'];
	$country = $player['country'];
	$address = $player['address'];
	$salary= $player['salary'];

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

    <h3>Chelsea FC | <?php echo $player['name'] . " ".  $player['surname'] ?></h3>

    <form>
         <?php if($player['image']): ?>
            <img src="<?php echo $player['image'] ?>" class="update-image">
        <?php endif; ?>

    	<div class="mb-3">
            <label>First Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name ?>" readonly>
        </div>

        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="surname" class="form-control" value="<?php echo $surname ?>" readonly>
        </div>
        <div class="mb-3">
            <label>Field Position</label>
            <input type="text" name="designation" class="form-control" value="<?php echo $designation ?>" readonly>
        </div>

        <div class="mb-3">
            <label>Address</label>
            <textarea class="form-control" name="address" readonly><?php echo $address ?></textarea>
        </div>

        <div class="mb-3">
            <label>Salary</label>
            <input type="number" step=".01" name="price" class="form-control" value="<?php echo $salary ?>" readonly>
        </div>
        
    </form>

    <p>
  		<a href="index.php" class="btn btn-large btn-primary">Back to Players</a>
  	</p>




</body>
</html>
