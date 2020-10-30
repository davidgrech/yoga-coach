<?php
  session_start();
  if(!isset($_SESSION['adminlogin'])){
    header('location:../login.php');
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

    <h4 class='myheadingbig'>Register new client</h4>
      <table class="table table-bordered table-sm">
        <tbody>
          <tr>
            <td>
              <div class='form-row'>
                <div class='col-sm-9 my-1'>
                  <p>Register a new client here</p>
                </div>
                <div class='col-3 my-1'>      
                  <a class="btn btn-primary" href="registerclient.php" role="button">Go</a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      <h4 class='myheadingdash'>Chat with clients</h4>
      <table class="table table-bordered table-sm">
        <tbody>
          <tr>
            <td>
              <div class='form-row'>
                <div class='col-sm-9 my-1'>
                  <p>chat to clients here</p>
                </div>
                <div class='col-3 my-1'>      
                  <a class="btn btn-primary" href="chatdash.php" role="button">Go</a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      <h4 class='myheadingdash'>Create new class</h4>
      <table class="table table-bordered table-sm">
        <tbody>
          <tr>
            <td>
              <div class='form-row'>
                <div class='col-sm-9 my-1'>
                  <p>Create a new class here</p>
                </div>
                <div class='col-3 my-1'>      
                  <a class="btn btn-primary" href="createclass.php" role="button">Go</a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      <h4 class='myheadingdash'>View and manage classes</h4>
      <table class="table table-bordered table-sm">
        <tbody>
          <tr>
            <td>
              <div class='form-row'>
                <div class='col-sm-9 my-1'>
                  <p>View and manage classes here</p>
                </div>
                <div class='col-3 my-1'>      
                  <a class="btn btn-primary" href="viewclasses.php" role="button">Go</a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      <h4 class='myheadingdash'>Create client program</h4>
      <table class="table table-bordered table-sm">
        <tbody>
          <tr>
            <td>
              <div class='form-row'>
                <div class='col-sm-9 my-1'>
                  <p>Create program here</p>
                </div>
                <div class='col-3 my-1'>      
                  <a class="btn btn-primary" href="createclientprogram.php" role="button">Go</a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      <h4 class='myheadingdash'>View clients and manage program</h4>

      <table class="table table-bordered table-sm">
        <tbody>
          <tr>
            <td>
              <div class='form-row'>
                <div class='col-sm-9 my-1'>
                  <p>View clients and manage their program here</p>
                </div>
                <div class='col-3 my-1'>      
                  <a class="btn btn-primary" href="viewclients.php" role="button">Go</a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      <h4 class='myheadingdash'>View newly registered client history</h4>
      <table class="table table-bordered table-sm">
        <tbody>
          <form method='POST' action='newclienthistory.php'>
            <tr>
              <td>
                <div class='form-row'>
                  <div class='col-sm-5'>
                    <p>Pick a year to view new client registrations</p>
                  </div>
                  <div class='col-sm-4'>
                    <select class='form-control' name='posted_year'>
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
                  <div class='col-3'>      
                    <button type='submit' class='btn btn-primary mt-1'>Go</button>
                  </div>
                </div>
              </td>
            </tr>
          </form>
        </tbody>
      </table>

      <h4 class='myheadingdash'>Edit contact page</h4>
      <table class="table table-bordered table-sm">
        <tbody>
          <tr>
            <td>
              <div class='form-row'>
                <div class='col-sm-9 my-1'>
                  <p>Change contact page details</p>
                </div>
                <div class='col-3 my-1'>      
                  <a class="btn btn-primary" href="editcontact.php" role="button">Go</a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      <h4 class='myheadingdash'>Edit home page images</h4>
      <table class="table table-bordered table-sm">
        <tbody>
          <tr>
            <td>
              <div class='form-row'>
                <div class='col-sm-9 my-1'>
                  <p>Edit home page images here</p>
                </div>
                <div class='col-3 my-1'>      
                  <a class="btn btn-primary" href="editindeximages.php" role="button">Go</a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      <h4 class='myheadingdash'>Edit home page text</h4>
      <table class="table table-bordered table-sm">
        <tbody>
          <tr>
            <td>
              <div class='form-row'>
                <div class='col-sm-9 my-1'>
                  <p>Edit home page images here</p>
                </div>
                <div class='col-3 my-1'>      
                  <a class="btn btn-primary" href="editindexstring.php" role="button">Go</a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    
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