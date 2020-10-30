<?php

  session_start();

  if(!isset($_SESSION['adminlogin'])){
    header('location:../login.php');
  }

  include('../connect.php');

  $details = "SELECT * FROM clientdetails";

  $result = $conn->query($details);

  if(!$result){
    echo $conn->error;
  }

  if(isset($_POST['posted_year'])){

    $posted_year = $conn->real_escape_string($_POST['posted_year']);

    $posted_year = htmlentities($posted_year);

  } else {
    header('location:admindash.php');
  }

  $january =0;
  $february =0;
  $march =0;
  $april =0;
  $may =0;
  $june =0;
  $july =0;
  $august =0;
  $september =0;
  $october =0;
  $november =0;
  $december =0;

  while($row = $result->fetch_assoc()){

    $id = $row['id'];
    $email = $row['email'];
    $passw = $row['pass'];
    $name = $row['name'];
    $phone = $row['phone'];
    $address = $row ['address'];
    $month_joined = $row['month_joined'];
    $year_joined = $row['year_joined'];

  if($year_joined == $posted_year){

    if($month_joined == 'January'){
        $january +=1;
    }elseif($month_joined == 'February'){
        $february +=1;
    }elseif($month_joined == 'March'){
        $march +=1;
    }elseif($month_joined == 'April'){
        $april +=1;
    }elseif($month_joined == 'May'){
        $may +=1;
    }elseif($month_joined == 'June'){
        $june +=1;
    }elseif($month_joined == 'July'){
        $july +=1;
    }elseif($month_joined == 'August'){
        $august +=1;
    }elseif($month_joined == 'September'){
        $september +=1;
    }elseif($month_joined == 'October'){
        $october +=1;
    }elseif($month_joined == 'November'){
        $november +=1;
    }elseif($month_joined == 'December'){
        $december +=1;
    }

    }

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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.0.0-beta2/Chart.min.js"></script>

  <link href="../css/mystyle.css" rel="stylesheet">

</head>

<?php include('../navbar.php'); ?>

<body>

  <div class="mychartcontainer">

    <h4 class='myheadingclient ml-2'>History of New Client Registrations</h4>

    <form>
    
      <canvas id="c" width="550" height="400"></canvas>
      <script>
        
        var ctx = $("#c");
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
        
            <?php
        
              echo"
            
                labels: ['January;$posted_year', 'February;$posted_year', 'March;$posted_year', 'April;$posted_year', 'May;$posted_year', 'June;$posted_year', 'July;$posted_year', 'August;$posted_year', 'September;$posted_year', 'October;$posted_year', 'November;$posted_year', 'December;$posted_year'],
            
              ";
        
            ?>
        
            datasets: [{
              label: 'clients',
              xAxisID:'xAxis1',
        
                <?php

                  echo"
                  
                    data: [$january, $february, $march, $april, $may, $june, $july, $august, $september, $october, $november, $december,],

                  ";

                ?>

                backgroundColor: "#3e95cd",
                borderColor: "#235270",
                strokeColor: "blue",
                borderWidth: 1
            }]
          },
          options:{
            legend: { 
                display: false 
                },
            title: {
                    display: true,
                    text: 'New Client Registrations in <?php echo"$posted_year"?>'
                }, 
            scales:{
                xAxes:[
                {
                  id:'xAxis1',
                  type:"category",
                  ticks:{
                    callback:function(label){
                      var month = label.split(";")[0];
                      var year = label.split(";")[1];
                      return month;
                    }
                  }
                },
                {
                  id:'xAxis2',
                  type:"category",
                  gridLines: {
                    drawOnChartArea: false,
                  },
                  ticks:{
                    callback:function(label){
                      var month = label.split(";")[0];
                      var year = label.split(";")[1];
                      if(month === "June"){
                        return year;
                      }else{
                        return "";
                      }
                    }
                  }
                }],
              yAxes:[{
                ticks:{
                    beginAtZero:true
        
                },
                scaleLabel: {
                    display: true,
                    labelString: "New Clients"
                }
                
              }]
            }
          }
        });

      </script>
    
    </form>

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