<?php

  session_start();

  if(!isset($_SESSION['adminlogin'])){
    header('location:../login.php');
  }

  include('../connect.php');

  $read = "SELECT * FROM clientdetails WHERE id > 0 ORDER BY name ASC ";

  $result = $conn->query($read);

  if(!$result){
    echo $conn->error;
  } else {
    
  }

  $counter = 0;

  while($row = $result->fetch_assoc()){

    $get_name = $row['name'];
    $get_id = $row['id'];

    $name_array[$counter] = $get_name;
    $id_array[$counter] = $get_id;

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

    <h4 class='myheading'>Choose multiple clients to message</h4>
      <form method='POST' action='chatgroup.php'>
        <label><strong>Enter message details:</strong></label>
          <div class='form-row'>
            <div class='col-sm-12 my-1'>
              <textarea type='text' class='form-control' value='' name='post_message'></textarea>
            </div>
          </div>
        <label class='my-3'>Press ctrl and click on multiple names to message multiple recipients</label>

        <?php

          $start=0;
          $max=count($name_array);

          echo"<select class='form-control' name='chosen_id[]' size='$max' multiple=''>";

          while ($start < $max) {
            $id = $id_array[$start];
            $name = $name_array[$start];
            echo "<option value='$id'>$name</option>";
            $start++;
          }
        ?>
        </select>
        <button type='submit' class='my-3 btn btn-primary'>Send message</button>
 
      </form>

    <?php

      if(isset($_POST['chosen_id'])){

        $message = $_POST['post_message'];
        $chosen_id = $_POST['chosen_id'];
        $total_chosen_id = sizeof($chosen_id);

        $total_chosen_id = htmlentities($total_chosen_id);

        for($i=0;$i<$total_chosen_id;$i++) {

          $insert_id = $chosen_id[$i];
          $insert_message = $message;
          $insert_author = 'Personal Trainer';

          $insert_id = htmlentities($insert_id);
          $insert_message = htmlentities($insert_message);

          $stmt = $conn->prepare("INSERT INTO clientmessages (message_id, client_id, message, date, time, author) 
          VALUES (NULL, ?, ?, CURDATE(), CURTIME(), ?) "); 
        
          $stmt->bind_param('iss', $insert_id, $insert_message, $insert_author);
          $stmt->execute();

        }

        echo" <p> $i Messages send succesfully. Go <a href='chatdash.php'>back</a> to chat dashboard.</p> ";

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
