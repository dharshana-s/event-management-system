<?php
$host = "localhost"; // Your database server name
$user = "root"; // Your database username
$password = ""; // Your database password
$db = "ems"; // Your database name

session_start();


$data = mysqli_connect($host,$user,$password,$db);
if($data == false)
{
    die("connection error");
}
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $username = $_POST["username"];
    $password = $_POST["password"];
//admin login
    $sql = "SELECT adminusername, adminpassword FROM admin where adminusername='".$username."' AND adminpassword='".$password."' ";

    $result = mysqli_query($data,$sql);
    $row = mysqli_fetch_array($result);
//superadmin login
    $sql2 = "SELECT sadminusername, sadminpassword FROM superadmin where sadminusername='".$username."' AND sadminpassword='".$password."' ";

    $result2 = mysqli_query($data,$sql2);
    $row2 = mysqli_fetch_array($result2);
//user login
    $sql3 = "SELECT email, password FROM user where email='".$username."' AND password='".$password."' ";

    $result3 = mysqli_query($data,$sql3);
    $row3 = mysqli_fetch_array($result3);

    if($row){
        $_SESSION["username"]=$username;
        header("location: admin.php");

    }
    elseif($row2)
    {
        $_SESSION["username"]=$username;
        header("location:superadmin.php");
    }
    elseif($row3)
    {
        $_SESSION["username"]=$username;
        header("location:index.php");
    }
    else{
        echo "username or password incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet"
        crossorigin="anonymous">
        
</head>
<body>
    <center>
        <br><br><br><br><br><br><br><br><br><br><br><br>
        
    <div  class="container" >
    <h1>EMS LOGIN</h1>
    <form action="#" method="POST">
        <label>Username</label>
        <input type="text" name="username" required><br>
        <label>Password</label>
        <input type="password" name="password" required><br>
        <button class="btn btn-primary" type="submit" value="Login">Login</button>
        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                    data-bs-target="#adduser">New User</button>
        </form>
    </div>
    </center>




    <!----add new user-->
    <div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addnewuser" >
                        <input type="text" name="firstName" placeholder="Enter First Name" required>
                        <input type="text" name="lastName" placeholder="Enter Last Name" required>
                        <input type="email" name="email" placeholder="Enter Email ID" required>
                        <input type="password" name="password" placeholder="Enter Password" required>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    
<script>
     //add new user
     $(document).on('submit', '#addnewuser', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append("save_newuser", true);
            $.ajax({
                type: "POST",
                url: "backend_user.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log("Response:",response);
                    var res = jQuery.parseJSON(response);
                    console.log(res)
                    if (res.status == 200) {
                        $('#adduser').modal('hide');
                        $('#addnewuser')[0].reset();
                        alert("added successfully")

                    }
                    else if (res.status == 500) {
                        $('#adduser').modal('hide');
                        $('#addnewuser')[0].reset();
                        console.error("Error:", res.message);
                        alert("Something Went wrong.! try again")
                    }
                }
            });

        });
</script>

</body>
</html>