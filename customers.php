<?php
class Customers
{
  private $servername = 'localhost';
  private $username = 'root';
  private $password = '';
  private $dbname = 'blog_db';
  public $con;

  // Database Connection
  public function __construct()
  {
    $this->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    if (mysqli_connect_error()) {
      die("Failed to connect to MySQL: " . mysqli_connect_error());
    } else {
      return $this->con;
    }
  }

  // Insert customer data into customer table
  public function insertData($post) {
    $name = $this->con->real_escape_string($_POST['name']);
    $email = $this->con->real_escape_string($_POST['email']);
    $username = $this->con->real_escape_string($_POST['username']);
    $password = $this->con->real_escape_string(md5($_POST['password']));

    $query = "INSERT INTO customers(name, email, username, password) VALUES(
              '$name', '$email', '$username', '$password')";
    
    $sql = $this->con->query($query);
    if ($sql) {
      header('Location: index.php?msg1=insert');
    } else {
      echo "Registration failed, try again!";
    }
  }

  // Fetch customer record for show listing
  public function displayData() {
    $query = "SELECT * FROM customers";
    $result = $this->con->query($query);
    if ($result->num_rows > 0) {
      $data = array();
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
      return $data;
    } else {
      echo "No found records";
    }
  }

  // Fetch single data for edit from customer table
  public function dipslayRecordById($id) {
    $query = "SELECT * FROM customers WHERE id = '$id'";
    $result = $this->con->query($query);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row;
    } else {
      echo "Record not found";
    }
  }

  // Update customer data into customer table
  public function updateRecord($postData) {
    $name = $this->con->real_escape_string($_POST['uname']);
    $email = $this->con->real_escape_string($_POST['uemail']);
    $username = $this->con->real_escape_string($_POST['upname']);
    $id = $this->con->real_escape_string($_POST['id']);
    if (!empty($id) && !empty($postData)) {
      $query = "UPDATE customers SET name = '$name', email = '$email', username = 
                '$username' WHERE id = '$id'";
      $sql = $this->con->query($query);
      if ($sql) {
        header('Location: index.php?msg2=update');
      } else {
        echo "Registration update failed, try again!";
      }
    }
  }

  // Delete customer data from customer table
  public function deleteRecord($id) {
    $query = "DELETE FROM customers WHERE id = '$id'";
    $sql = $this->con->query($query);
    if ($sql == true) {
      header('Location: index.php?msg3=delete');
    } else {
      echo "Record does not delete, try again!";
    }
  }
}
?>