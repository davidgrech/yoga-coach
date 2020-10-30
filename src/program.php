<?php
    session_start();

    if(!isset($_SESSION['clientlogin'])){
        header('location:login.php');
    }
    include('connect.php');

    $client = $_SESSION['client_id'];
    $details = "SELECT * FROM clientprogram WHERE client_id = '$client' ";
    $result = $conn->query($details);

    if(!$result){
        echo $conn->error;
    }

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Rowan Cobelli</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="css/mystyle.css" rel="stylesheet">
    </head>

    <?php include('navbar.php'); ?>

    <body>
        <div id="mycontainer">
            <h4 class='myheading'>Personalised Program</h4>
            <?php
                if(isset($_POST['complete'])){
                    $complete = $_POST['complete'];
                    $id = $_POST['id'];
                    $complete = htmlentities($complete);
                    $id = htmlentities($id);

                    $update_complete = "UPDATE `clientprogram` SET `complete` = ? WHERE `clientprogram`.`client_program_id` = ? ";
                    $stmt = $conn->prepare($update_complete);
                    $stmt->bind_param('si', $complete, $id);
                    $stmt->execute();

                    if($complete == 'Yes'){
                        echo"<p><strong>Congratulations! The result has been submitted to your personal trainer.</strong></p>";
                    }else{
                        echo"<p><strong>That's a shame. The result has been submitted to your personal trainer.</strong></p>";
                    }
                }
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Week</th>
                        <th scope="col">Yoga Type</th>
                        <th scope="col">Minutes per day</th>
                        <th scope="col">Complete</th>
                    </tr>
                </thead>
            <?php

                while($row = $result->fetch_assoc()){
                    $get_id = $row['client_program_id'];
                    $client_id = $row['client_id'];
                    $week = $row['week'];
                    $minutes_per_day = $row['minutes_per_day'];
                    $yoga_type = $row['yoga_type'];
                    $complete = $row['complete'];
                    echo "
                        <tbody>
                            <tr>
                                <th scope='row'>$week</th>
                                <td>$yoga_type</td>
                                <td>$minutes_per_day</td>
                                <td>
                                    <form class='form-inline' method='POST' action='program.php'>
                                        <input type='hidden' value='$get_id' name='id'>
                                        <select type='text'  class='form-control mt-1 ml-1' placeholder='$complete' name='complete'>
                                            <option>No</option>
                                            <option>Yes</option>
                                        </select>
                                        <button type='submit' class='btn btn-primary ml-1 mt-1'>Submit</button>
                                    </form>
                                </td>
                            </tr>
                    ";
                }
                echo "</tbody>";
            ?> 
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>