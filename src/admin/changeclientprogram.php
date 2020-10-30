<?php

  session_start();

  if(!isset($_SESSION['adminlogin'])){
    header('location:../login.php');
  }

  include('../connect.php');

  if(isset($_POST['id_validation'])){

    $id_validation = $_POST['id_validation'];
    $get_client_program_id = $_POST['client_program_id'];

    $id_validation = htmlentities($id_validation);
    $get_client_program_id = htmlentities($get_client_program_id);

    $stmt = $conn->prepare("SELECT name FROM clientdetails WHERE clientdetails.id = ?");

    $stmt -> bind_param("i", $id_validation);
    $stmt -> execute();
    
    $stmt -> store_result(); 
    $stmt -> bind_result($name); 
    $stmt -> fetch();

  }else{

    header('location:viewclients.php');

  }

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

    <h4 class='myheading'>Change Client Program</h4>

    <table class="table table-bordered table-sm">
      <tbody>
        <tr>
          <td>
            <form method='POST' action='programchangesuccess.php'>
            <label><strong>Change program details:</strong></label>
              <div class='form-row'>
                <div class='col-sm-12 my-1'>
                  <label>Client name:</label>
                    <input type='hidden' value='<?php echo"$get_client_program_id"?>' name='client_program_id'>
                    <input placeholder='<?php echo"$name"?>' class='form-control bg-white'name='id'/>
                    <label>Minutes per day:</label>
                    <select class='form-control' name='minutes_per_day'>
                        <option>15</option>
                        <option>30</option>
                        <option>45</option>
                        <option>60</option>
                        <option>75</option>
                        <option>90</option>
                        <option>105</option>
                        <option>120</option>
                    </select>
                    <label>Yoga type:</label>
                    <select class='form-control' name='yoga_type'>
                        <option>Beginner Yoga</option>
                        <option>Hatha Yoga</option>
                        <option>Core Strength Yoga</option>
                        <option>Restorative Yoga</option>
                        <option>Pranayama Yoga</option>
                        <option>Meditation Yoga</option>
                        <option>Stress Reduction Yoga</option>
                        <option>Relax Yoga</option>
                    </select>
                    <label>Complete:</label>
                    <select class='form-control' name='complete'>
                        <option>No</option>
                        <option>Yes</option>
                    </select>
                </div>
                  <div class='p-2'>
                      <button type='submit' class='btn btn-primary'>Change Program</button>
                  </div>
              </div>
            </form>
          </td>
        </tr>
      </tbody>
    </table>

    <p>Go <a href='viewclients.php'>back</a> to view clients.</p>
    
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