<?php

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

    <h4 class='myheadingbig'>Contact us</h4>
    
    <div class='card p-2'>
      <p class='mt-2'><strong>Address: </strong><?php echo"$string_array[0]"; ?></p>
      <p><strong>Phone number: </strong><?php echo"$string_array[1]"; ?></p>
      <p><strong>E-mail: </strong><?php echo"$string_array[2]"; ?></p>
    </div>
    <h4 class='myheadingdash'>Register</h4>
    <form class='card p-2' method='POST' action='contact.php'>
      <div class='form-row'>
        <div class='col-sm-12 my-1'>
          <label><strong>Name:</strong></label>
            <input placeholder='Enter name' class='date form-control bg-white' name='post_name1'/>
            <p class='mt-2 text-secondary'>No more than 20 characters long</p>
          <label class='mt-1'><strong>Email:</strong></label>
            <input placeholder='Enter email' class='date form-control bg-white' name='post_email'/>
            <p class='mt-2 text-secondary'>No more than 30 characters long</p>
          <label class='mt-1'><strong>Phone Number:</strong></label>
            <input placeholder='Enter phone number' class='date form-control bg-white' name='post_phone'/>
            <p class='mt-2 text-secondary'>No more than 20 characters long</p>
          <label class='mt-1'><strong>Address:</strong></label>
            <input placeholder='Enter phone number' class='date form-control bg-white' name='post_address'/>
            <p class='mt-2 text-secondary'>No more than 100 characters long</p>
        </div>
        <div class='p-2'>
          <button type='submit' class='btn btn-primary'>Submit</button>
        </div>
      </div>
    </form>

    <?php

      //insert new registration details from a new contact
      if(isset($_POST['post_name1'])){

        $name = $_POST['post_name1'];
        $email = $_POST['post_email'];
        $phone = $_POST['post_phone'];
        $address = $_POST['post_address'];

        $registration_message = '( Email : '.$email.' ) ( Phone : '.$phone.' ) ( Address : '.$address.' )';

        $id = 0;
        $name = $name.' (Registration)';
        $name = htmlentities($name);
        $registration_message = htmlentities($registration_message);

        $insertsql = "INSERT INTO `clientmessages` (`message_id`, `client_id`, `message`, `date`, `time`, `author`) 
                      VALUES (NULL, ?, ?, CURDATE(), CURTIME(), ?); ";
        $stmt = $conn->prepare($insertsql);
        $stmt->bind_param('iss', $id, $registration_message, $name); 
        $stmt->execute();

        echo "<p class='mt-2'>Your registration form has been sent successfully. A member of the team will be in touch shortly.</p>";
      }
    ?>
    <h4 class='myheadingdash'>Send us a message</h4>
      <form class='card p-2' method='POST' action='contact.php'>
          <div class='form-row'>
            <div class='col-sm-12 my-1'>
              <label><strong>Name:</strong></label>
                <input placeholder='Enter name' class='date form-control bg-white' name='post_name'/>
                <p class='mt-2 text-secondary'>No more than 20 characters long</p>
              <label class='mt-1'><strong>Email:</strong></label>
                <input placeholder='Enter email' class='date form-control bg-white' name='post_email'/>
                <p class='mt-2 text-secondary'>No more than 30 characters long</p>
              <label class='mt-1'><strong>Phone Number:</strong></label>
                <input placeholder='Enter phone number' class='date form-control bg-white' name='post_phone'/>
                <p class='mt-2 text-secondary'>No more than 20 digits long</p>
              <label class='mt-1'><strong>Message:</strong></label>
                <textarea placeholder='Enter message details' type='text' class='form-control' name='post_message'></textarea>
                <p class='mt-2 text-secondary'>No more than 200 characters long</p>
            </div>
            <div class='p-2'>
              <button type='submit' class='btn btn-primary'>Submit</button>
            </div>
          </div>
        </form>

      <?php

        //insert new message from new contact
        if(isset($_POST['post_message'])){

          $name = $_POST['post_name'];
          $email = $_POST['post_email'];
          $phone = $_POST['post_phone'];
          $post_message = $_POST['post_message'];

          $message = $post_message.' ( Email : '.$email.' ) ( Phone : '.$phone.' )';

          $id = 0;

          $name = $name.' (Message)';
          $name = htmlentities($name);
          $message = htmlentities($message);
          $insertsql = "INSERT INTO `clientmessages` (`message_id`, `client_id`, `message`, `date`, `time`, `author`) 
                        VALUES (NULL, ?, ?, CURDATE(), CURTIME(), ?); ";

          $stmt = $conn->prepare($insertsql);
          $stmt->bind_param('iss', $id, $message, $name); 
          $stmt->execute();
          echo "<p class='mt-2'>Message sent successfully. A member of the team will be in touch shortly.</p>";
        }
      ?>
    <hr class="my-5 featurette-divider">
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