<?php
require_once('database.php');

$statement = $pdo->prepare('SELECT * FROM person ORDER BY created DESC');
$statement->execute();
$players = $statement->fetchAll(PDO::FETCH_ASSOC);


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

    <h3>Chelsea FC | First Team Line Up</h3>

    <p>
  		<a href="create.php" class="btn btn-large btn-primary">Add New Player</a>
  	</p>
  	

    <table class="table table-success table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Pic</th>
      <th scope="col">Name</th>
      <th scope="col">Surname</th>
      <th scope="col">Position</th>
      <th scope="col">Country</th>
      <th scope="col">Wages(US$)</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach ($players as $index => $player): ?>
    <tr>
      <th scope="row"><?php echo $index + 1 ?></th>
       <td>
          <img src="<?php echo $player['image'] ?>" class="thumb-image">
     </td>
      <td><?php echo $player['name'] ?></td>
      <td><?php echo $player['surname'] ?></td>
      <td><?php echo $player['designation'] ?></td>
      <td><?php echo $player['country'] ?></td>
      <td><?php echo number_format($player['salary']) ?></td>
      <td>
      	<a href="view_one.php?id=<?php echo $player['id'] ?>" class="btn btn-sm btn-outline-success">View</a>
      	<a href="update.php?id=<?php echo $player['id']?>" class="btn btn-sm btn-outline-primary">Edit</a>
      	<form method="post" action="" style="display: inline-block;">
      		<input type="hidden" name="id" value="<?php echo $product['id'] ?>">
      		<button type="sumbit" class="btn btn-sm btn-outline-danger">Delete</button>
      	</form>
     </td>
    </tr>
  <?php endforeach ?>
  </tbody>
</table>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>