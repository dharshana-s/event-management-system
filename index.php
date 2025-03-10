<?php
include("db.php");
$sql = "SELECT * FROM event";
$result = mysqli_query($conn, $sql);
session_start();
if(!isset($_SESSION["username"]))
{
    header("location:login.php");
}
?>
<html>

<head>
    <title>Event Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet"
        crossorigin="anonymous">
</head>

<body>
<a class="btn btn-secondary active float-end"  href="logout.php">Logout</a>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Home</a>
        <a class="nav-link" href="#events">Events</a>
        <a class="nav-link" href="#registration">Registration</a>
      </div>
    </div>
  </div>
</nav>
    
<h2>Home Page</h2>
<section class="events text-center" id="events">               
                    <?php
                   
                   while ($row = mysqli_fetch_array($result)) {

                    ?>
                       
                       <img src="<?php echo $row['poster']; ?>" height="100px" width="120px"><br>
                           <?php echo $row['ename']; ?><br>
                           <?php echo $row['elocation']; ?><br>
                           <?php echo $row['eguidelines']; ?><br>
                           <?php echo $row['ecname']; ?><br>
                           <?php echo $row['dept']; ?><br>
                           <?php echo $row['cnumber']; ?><br>
                           <?php echo $row['emailid']; ?><br>
                           <?php echo $row['dateofevent']; ?><br>
                           <button type="button" class="btn btn-primary "><a href="register.php" target="_blank" style="text-decoration:none;color:white;">Register</a></button><br><br><br>
                               
                <?php
                   }
                   ;
                   ?>
</section>
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

    <script>
        

    </script>

</body>

</html>