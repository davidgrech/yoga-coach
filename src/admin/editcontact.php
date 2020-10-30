<?php

  session_start();  

  if(!isset($_SESSION['adminlogin'])){
    header('location:../login.php');
  }

  include("../connect.php");

  $details = "SELECT * FROM contactstrings";

  $result = $conn->query($details);

  if(!$result){
    echo $conn->error;
  }

  $counter = 0;

  while($row = $result->fetch_assoc()){
  
    $string = $row['string'];

    $string_array[$counter] = $string;
  
    $counter++;

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

    <h4 class='myheading'>Change contact details</h4>

    <p><strong>Address: </strong><?php echo"$string_array[0]"; ?></p>
    <p><strong>Phone number: </strong><?php echo"$string_array[1]"; ?></p>
    <p><strong>E-mail: </strong><?php echo"$string_array[2]"; ?></p>

    <h5 class='myheadingdash'>Update details</h5>
      <form method='POST' action='editcontact.php'>
        <div class='form-row'>
          <div class='col-sm-12 my-1'>
            <label>Choose a detail to edit:</label>
              <select class='form-control' name='post_number'>
                <option value='1'>Address</option>
                <option value='2'>Phone number</option>
                <option value='3'>Email</option>
              </select>
            <label class='pt-1'>Enter new information</label>
              <input placeholder='Enter new information' class='date form-control bg-white' name='new_detail'/>
          <div class='py-3'>
            <button type='submit' class='btn btn-primary'>Submit</button>
          </div>
        </div>
      </form>

    <?php

      if(isset($_POST['post_number'])){

        $number = $_POST['post_number'];
        $new_detail = $_POST['new_detail'];


        $number = htmlentities($number);
        $new_detail = htmlentities($new_detail);

        $stmt = $conn->prepare("UPDATE contactstrings SET string =? WHERE contactstrings.id =? ");

        $stmt->bind_param('si', $new_detail, $number);
        $stmt->execute();

        header("Refresh:0");

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