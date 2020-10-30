<?php

  session_start();

  if(!isset($_SESSION['adminlogin'])){
    header('location:../login.php');
  }

  include("../connect.php");

  //get and display images
  $details = "SELECT * FROM indeximages";

  $result = $conn->query($details);

  if(!$result){
    echo $conn->error;
  }

  $counter = 0;

  while($row = $result->fetch_assoc()){
  
    $path = $row['path'];

    $path_array[$counter] = $path;
  
    $counter++;

  }

  //get and display strings
  $details1 = "SELECT * FROM indexstrings";

  $result1 = $conn->query($details1);

  if(!$result1){
    echo $conn->error;
  }

  $counter = 0;

  while($row = $result1->fetch_assoc()){
  
    $string = $row['string'];

    $string_array[$counter] = $string;
  
    $counter++;

  }

  //update new detail and refresh page
  if(isset($_POST['post_number'])){

    $number = $_POST['post_number'];
    $new_detail = $_POST['new_detail'];

    $number = htmlentities($number);
    $new_detail = htmlentities($new_detail);

    $stmt = $conn->prepare("UPDATE indexstrings SET string =? WHERE indexstrings.id =? ");

    $stmt->bind_param('si', $new_detail, $number);
    $stmt->execute();

    header("Refresh:0");

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

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

  <link href="../css/carousel.css" rel="stylesheet">
  <link href="../css/mystyle.css" rel="stylesheet">

</head>

<?php include('../navbar.php'); ?>

<body>

  <div id="mycontainer">

    <h4 class='myheadingindex'>Edit home page text</h4>
    <h5 class='myheadingdash'>Change details</h5>
        <form method='POST' action='editindexstring.php'>
          <div class='form-row'>
            <div class='col-sm-12 my-1'>
              <label>Choose a number of the text you want to edit:</label>
                <select class='form-control' name='post_number'>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  <option>13</option>
                  <option>14</option>
                </select>
              <label class='pt-1'>Enter new replacement text</label>
                <input placeholder='Enter new information' class='date form-control bg-white' name='new_detail'/>
              <div class='py-3'>
                <button type='submit' class='btn btn-primary'>Submit</button>
              </div>
            </div>
          </div>
        </form>
        <p>Go <a href='admindash.php'>back</a> to the admin dashboard.</p>

  </div>

  <main role="main">

  <?php

    echo"

      <div id='myCarousel' class='carousel slide' data-ride='carousel'>
        <div class='carousel-inner'>
          <div class='carousel-item active'>
            <img class='d-block' src='../img/$path_array[0]'>
            <div class='container'>
              <div class='carousel-caption text-centre'>
                <h1>$string_array[0] <span class='dot'>1</span></h1>
                <p>$string_array[1] <span class='dot'>2</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class='container marketing'>

      <div class='row'>
        <div class='col-lg-4'>
          
          <div class='mb-1'><img src='../img/$path_array[1]' width='140' height='140'>
          </img></div>
          <span class='dot'>3</span>
          <h2>$string_array[2] </h2>
          <span class='dot'>4</span>
          <p>$string_array[3] </p>
          <p><a class='btn btn-secondary' href='#' role='button'>Register today &raquo;</a></p>
        </div>
        <div class='col-lg-4'>
        <div class='mb-1'><img src='../img/$path_array[2]' width='140' height='140'>
          </img></div>
          <span class='dot'>5</span>
          <h2>$string_array[4] </h2>
          <span class='dot'>6</span>
          <p>$string_array[5] </p>
          <p><a class='btn btn-secondary' href='#' role='button'>Register today &raquo;</a></p>
        </div>
        <div class='col-lg-4'>
        <div class='mb-1'><img src='../img/$path_array[3]' width='140' height='140'>
          </img></div>
          <span class='dot'>7</span>
          <h2>$string_array[6]</h2>
          <span class='dot'>8</span>
          <p>$string_array[7]</p>
          <p><a class='btn btn-secondary' href='#' role='button'>Register today &raquo;</a></p>
        </div>
      </div>

      <hr class='featurette-divider'>

      <div class='row featurette'>
        <div class='col-md-7'>
          <h2 class='featurette-heading'>$string_array[8]<span class='dot'>9</span></span></h2>
          <p class='lead'>$string_array[9] <span class='dot'>10</span></p>
        </div>
        <div class='col-md-5'>
          <img src='../img/$path_array[4]' class='bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto' width='500'
            height='500'></img>
        </div>
      </div>

      <hr class='featurette-divider'>

      <div class='row featurette'>
        <div class='col-md-7 order-md-2'>
          <h2 class='featurette-heading'>$string_array[10]<span class='dot'>11</span></h2>
          <p class='lead'>$string_array[11]<span class='dot'>12</span></p>
        </div>
        <div class='col-md-5 order-md-1'>
          <img src='../img/$path_array[5]' class='bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto' width='500'
            height='500'></img>
        </div>
      </div>

      <hr class='featurette-divider'>

      <div class='row featurette'>
        <div class='col-md-7'>
          <h2 class='featurette-heading'>$string_array[12]<span class='dot'>13</span></h2>
          <p class='lead'>$string_array[13]<span class='dot'>14</span></p>
        </div>
        <div class='col-md-5'>
          <img src='../img/$path_array[6]' class='bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto' width='500'
            height='500'></img>
        </div>
      </div>

    ";

  ?>

  <hr class="featurette-divider">

  </div>

  </main>

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