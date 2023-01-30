<?php
// Include database file
include 'customers.php';

$customerObj = new Customers();

// Delete record from table
if (isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
  $deleteId = $_GET['deleteId'];
  $customerObj->deleteRecord($deleteId);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP: CRUD Application using OOP and MySQL</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
</head>
<body>

<div class="card text-center" style="padding: 15px;">
<h4>PHP: CRUD (Add, Edit, Delete, View) Application using OOP and MySQL</h4>
</div><br><br>

<div class="container">
  <?php
  if (isset($_GET['msg1']) == "insert") {
    echo "<div class='alert alert-success alert-dismissible'>
          <button type='button' class='close' data-dismiss='alert'>&times;</button>
          Your Registration added successfully
          </div>";
  }
  if (isset($_GET['msg2']) == "update") {
    echo "<div class='alert alert-success alert-dismissible'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    Your Registration updated successfully
    </div>";
  }
  if (isset($_GET['msg3']) == "delete") {
    echo "<div class='alert alert-success alert-dismissible'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    Record deleted successfully
    </div>";
  }
  ?>

  <h2>View Records <a href="add.php" class="btn btn-primary" style="float:right;">Add New Record</a></h2>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Username</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $customers = $customerObj->displayData();
      foreach ($customers as $customer) {
        ?>
        <tr>
          <td><?php echo $customer['id'] ?></td>
          <td><?php echo $customer['name'] ?></td>
          <td><?php echo $customer['email'] ?></td>
          <td><?php echo $customer['username'] ?></td>
          <td>
    <a href="edit.php?editId=<?php echo $customer['id'] ?>" style="color:green"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp
    <a href="index.php?deleteId=<?php echo $customer['id'] ?>" style="color:red"
              onclick="confirm('Are you sure want to delete this record')">
              <i class="fa fa-trash" aria-hidden="true"></i></a></td>
        </tr>
      <?php }
      ?>
    </tbody>
  </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
</body>
</html>

