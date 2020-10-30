<?php

  session_start();

  if(!isset($_SESSION['adminlogin'])){
    header('location:../login.php');
  }

  include('../connect.php');

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Rowan Cobelli</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <link href="../css/mystyle.css" rel="stylesheet">

</head>

<?php include('../navbar.php'); ?>

<body>

  <div id="mycontainer">

    <h4 class='myheadingbig'>Register New Client</h4>

    <table class="table table-bordered table-sm">
      <tbody>
        <tr>
          <td>
            <form method='POST' action='registerclient.php'>
              <h6><strong>Enter new client details:</strong></h6>
              <div class='form-row'>
                <div class='col-sm-12 my-1'>
                  <label class='mt-1'><strong>Email:</strong></label>
                      <input type='email' class='form-control' value='' name='email'>
                      <p>Must be no more than 30 characters long</p>
                  <label class='mt-1'><strong>Password:</strong></label>
                      <input type='password' class='form-control'value='' name='pass'>
                      <p>Must be no more than 20 characters long</p>
                  <label class='mt-1'><strong>Name:</strong></label>
                      <input type='text' class='form-control'value='' name='name'>
                      <p>Must be no more than 20 characters long</p>
                  <label class='mt-1'><strong>Phone number:</strong></label>
                      <input type='text' class='form-control'value='' name='phone'>
                      <p>Must be no more than 20 digits long</p>
                  <label class='mt-1'><strong>Address:</strong></label>
                    <input type='text' class='form-control'value='' name='address'>
                    <p>Must be no more than 100 characters long</p>
                  <label class='mt-1'><strong>Month joined:</strong></label>
                  <select class='form-control' name='month_joined'>
                    <option>January</option>
                    <option>February</option>
                    <option>March</option>
                    <option>April</option>
                    <option>May</option>
                    <option>June</option>
                    <option>July</option>
                    <option>August</option>
                    <option>September</option>
                    <option>October</option>
                    <option>November</option>
                    <option>December</option>
                  </select>
                  <label class='mt-1'><strong>Year joined:</strong></label>
                  <select class='form-control' name='year_joined'>
                    <option>2020</option>
                    <option>2021</option>
                    <option>2022</option>
                    <option>2023</option>
                    <option>2024</option>
                    <option>2025</option>
                    <option>2026</option>
                    <option>2027</option>
                    <option>2028</option>
                    <option>2029</option>
                    <option>2030</option>
                    <option>2031</option>
                    <option>2032</option>
                    <option>2033</option>
                    <option>2034</option>
                    <option>2035</option>
                    <option>2036</option>
                    <option>2037</option>
                    <option>2038</option>
                    <option>2039</option>
                    <option>2040</option>
                  </select>
                </div>
                <div class='p-2'>
                    <button type='submit' class='btn btn-primary'>Submit</button>
                </div>
              </div>
            </form>
          </td>
        </tr>
      </tbody>
    </table>

    <?php

      if(isset($_POST['email'])){

      $email = $_POST['email'];
      $pass = $_POST['pass'];
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $year_joined = $_POST['year_joined'];
      $month_joined = $_POST['month_joined'];

      $email = htmlentities($email);
      $pass = htmlentities($pass);
      $name = htmlentities($name);
      $phone = htmlentities($phone);
      $address = htmlentities($address);
      $year_joined = htmlentities($year_joined);
      $month_joined = htmlentities($month_joined);

      $stmt = $conn->prepare("INSERT INTO clientdetails (email, pass, name, phone, address, month_joined, year_joined) 
      VALUES (?, ?, ?, ?, ?, ?, ?) "); 

      $stmt->bind_param('sssssss', $email, $pass, $name, $phone, $address, $month_joined, $year_joined);
      $stmt->execute();

      echo"<p>Client was added succesfully. Go <a href='admindash.php'>back</a> to dashboard</p> ";
      
      }

    ?>

  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>

</body>

</html>