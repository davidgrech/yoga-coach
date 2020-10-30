<?php

  session_start();  

  if(!isset($_SESSION['adminlogin'])){
    header('location:../login.php');
  }

  include("../connect.php");

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

  <div id='mycontainer'>

    <h4 class='myheading'>Image upload result</h4>

      <?php

        if(isset($_POST['number'])){

          $number = $_POST['number'];

          $number = htmlentities($number);

        } else {
          header('location:editindeximages.php');
        }


        $test = ($_FILES['myfileupload']);

        $filedata = $_FILES['myfileupload']['tmp_name'];
        $filename = $_FILES['myfileupload']['name'];
        $filetype = $_FILES['myfileupload']['type'];

        $allowed = array('image/jpg', 'image/jpeg', 'image/gif', 'image/png');

        if(!in_array($filetype, $allowed)) {

          echo" 
              
            <table class='table table-bordered table-sm'>
              <tbody>
                <tr>
                  <td>
                    <p><strong>Only jpg, jpeg, gif and png files are allowed. Go <a href='editindeximages.php'>back</a> to try again.</p></strong></p>
                  </td>
                </tr>
              </tbody>
            </table>
          
          ";

        }else{
        
          $moved = move_uploaded_file($filedata, "../img/$filename");
    
          if($moved){

            $filename = htmlentities($filename);
            $filetype = htmlentities($filetype);
            $number = htmlentities($number);

            $stmt = $conn->prepare("UPDATE indeximages SET path = ?, typefile = ? WHERE indeximages.id = ? ");
        
            $stmt->bind_param('ssi', $filename, $filetype, $number);
            $stmt->execute();

              echo"

                <table class='table table-bordered table-sm'>
                  <tbody>
                    <tr>
                      <td>
                        <p><strong>Image uploaded successfully Go <a href='editindeximages.php'>back</a> to change home page images.</strong></p>
                      </td>
                    </tr>
                  </tbody>
                </table>
              
              ";
            
          }else{
    
            echo "$filename could not be uploaded";
    
          }

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