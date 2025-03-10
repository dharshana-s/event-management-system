<?php
include("db.php");
$sql = "SELECT * FROM event";
$result = mysqli_query($conn, $sql);
session_start();
if (!isset($_SESSION["username"])) {
    header("location:login.php");
}
?>
<?php
include("db.php");
$sql1 = "SELECT * FROM participants";
$result1 = mysqli_query($conn, $sql1);
?>
<?php
include("db.php");
$sql2 = "SELECT * FROM admin";
$result2 = mysqli_query($conn, $sql2);
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
    <div class="container mt-4">
        <a class="btn btn-secondary active float-end" href="logout.php">Logout</a>
        <a class="btn btn-info active float-end" href="index.php">HomePage</a>
        <h2 class="text-center">Super Admin Page: Add admins</h2>
        <!-- Nav Tabs-->
        <ul class="nav nav-tabs" id="myTabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#addingadmins">Add Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#viewingevents">View Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#viewingparticipants">View Participants</a>
            </li>
        </ul>

        <!-- Tab Contents-->
        <div class="tab-content mt-3">
            <div id="addingadmins" class="tab-pane fade show active">
                <button type="button" class="btn btn-info float-end" data-bs-toggle="modal"
                    data-bs-target="#addadmin">Add
                    Admin</button>

                <div class="py-4">
                    <table class="table" id="admin">
                        <thead>
                            <tr>
                                <th scope="col">S.No</th>
                                <th scope="col">Username</th>
                                <th scope="col">Password</th>
                                <th scope="col">Admin Name</th>
                                <th scope="col">College Name</th>
                                <th scope="col">College ID</th>
                                <th scope="col">Contact No.</th>
                                <th scope="col">Mail ID</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $e = 1;
                            while ($row2 = mysqli_fetch_array($result2)) {
                                ?>
                                <tr>
                                    <td><?php echo $e; ?></td>
                                    <td><?php echo $row2['adminusername']; ?></td>
                                    <td><?php echo $row2['adminpassword']; ?></td>
                                    <td><?php echo $row2['adminname']; ?></td>
                                    <td><?php echo $row2['admincollegename']; ?></td>
                                    <td><?php echo $row2['admincollegeid']; ?></td>
                                    <td><?php echo $row2['admincontact']; ?></td>
                                    <td><?php echo $row2['adminmailid']; ?></td>
                                    <td>
                                        <button type="button" value="<?php echo $row['id']; ?>"
                                            class="btn btn-primary btnadminedit">Edit</button>
                                        <button type="button" value="<?php echo $row['id']; ?>"
                                            class="btn btn-danger btnadmindelete">Delete</button>
                                    </td>
                                </tr>
                                <?php
                                $e++;
                            }
                            ;
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <div id="viewingevents" class="tab-pane fade show">
                <div class="py-4">
                    <table class="table" id="event">
                        <thead>
                            <tr>
                                <th scope="col">S.No</th>
                                <th scope="col">Event Name</th>
                                <th scope="col">Event Location</th>
                                <th scope="col">Event guidelines</th>
                                <th scope="col">Event coordinator name</th>
                                <th scope="col">Department</th>
                                <th scope="col">Contact Number</th>
                                <th scope="col">Mail id</th>
                                <th scope="col">Date of Event</th>
                                <th scope="col">Poster</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $s = 1;
                            while ($row = mysqli_fetch_array($result)) {

                                ?>
                                <tr>
                                    <td><?php echo $s; ?></td>
                                    <td><?php echo $row['ename']; ?></td>
                                    <td><?php echo $row['elocation']; ?></td>
                                    <td><?php echo $row['eguidelines']; ?></td>
                                    <td><?php echo $row['ecname']; ?></td>
                                    <td><?php echo $row['dept']; ?></td>
                                    <td><?php echo $row['cnumber']; ?></td>
                                    <td><?php echo $row['emailid']; ?></td>
                                    <td><?php echo $row['dateofevent']; ?></td>
                                    <td><img src="<?php echo $row['poster']; ?>" height="30px" width="40px"></td>

                                </tr>
                                <?php
                                $s++;
                            }
                            ;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="viewingparticipants" class="tab-pane fade show">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Student Roll Number</th>
                            <th scope="col">Event Name</th>
                            <th scope="col">Student Phone Number</th>
                            <th scope="col">StudentDepartment</th>
                            <th scope="col">Student Year</th>
                            <th scope="col">Student Semester</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $a = 1;
                        while ($row1 = mysqli_fetch_array($result1)) {

                            ?>
                            <tr>
                                <td><?php echo $a; ?></td>
                                <td><?php echo $row1['sname']; ?></td>
                                <td><?php echo $row1['srollno']; ?></td>
                                <td><?php echo $row1['eventname']; ?></td>
                                <td><?php echo $row1['sphoneno']; ?></td>
                                <td><?php echo $row1['sdept']; ?></td>
                                <td><?php echo $row1['syear']; ?></td>
                                <td><?php echo $row1['ssem']; ?></td>

                            </tr>
                            <?php
                            $a++;
                        }
                        ;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- add admin Modal -->
    <div class="modal fade" id="addadmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addnewadmin" >
                        <input type="text" name="adminusername" placeholder="Enter Admin Username" required>
                        <input type="text" name="adminpassword" placeholder="Enter Admin Password" required>
                        <input type="text" name="adminname" placeholder="Enter Admin Name" required>
                        <input type="text" name="admincollegename" placeholder="Enter Admin College Name" required>
                        <input type="text" name="admincollegeid" placeholder="Enter Admin College id" required>
                        <input type="number" name="admincontact" placeholder="Enter Admin Contact Number" required>
                        <input type="email" name="adminmailid" placeholder="Enter Admin Mail ID" required>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit admin Modal -->
    <div class="modal fade" id="Editadmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="Editnewadmin">
                        <input type="text" name="adminusername" placeholder="Enter Admin Username" required>
                        <input type="text" name="adminpassword" id="adminpassword" placeholder="Enter Admin Password"
                            required>
                        <input type="text" name="adminname" id="adminname" placeholder="Enter Admin Name" required>
                        <input type="text" name="admincollegename" id="admincollegename"
                            placeholder="Enter Admin College Name" required>
                        <input type="text" name="admincollegeid" id="admincollegeid"
                            placeholder="Enter Admin College id" required>
                        <input type="number" name="admincontact" id="admincontact"
                            placeholder="Enter Admin Contact Number" required>
                        <input type="email" name="adminmailid" id="adminmailid" placeholder="Enter Admin Mail ID"
                            required>
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
        $(document).ready(function () {
            $('#event').DataTable();
        });
        //add new admin
        $(document).on('submit', '#addnewadmin', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append("save_newadmin", true);
            $.ajax({
                type: "POST",
                url: "backend_admin.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    console.log(res)
                    if (res.status == 200) {
                        $('#addadmin').modal('hide');
                        $('#addnewadmin')[0].reset();
                        $('#admin').load(location.href + " #admin");
                        alert("added successfully")

                    }
                    else if (res.status == 500) {
                        $('#addadmin').modal('hide');
                        $('#addnewadmin')[0].reset();
                        console.error("Error:", res.message);
                        alert("Something Went wrong.! try again")
                    }
                }
            });

        });
        //delete admin
        $(document).on('click', '.btnadmindelete', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var admin_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "backend_admin.php",
                    data: {
                        'delete_admin': true,
                        'admin_id': admin_id
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {
                            alert(res.message);
                        }
                        else {
                            $('#admin').load(location.href + " #admin");
                        }
                    }
                });
            }
        });
        //get values for edit
        $(document).on('click', '.btnadminedit', function (e) {
            e.preventDefault();
            var admin_id = $(this).val();
            console.log(admin_id)
            $.ajax({
                type: "POST",
                url: "backend_admin.php",
                data: {
                    'edit_admin': true,
                    'admin_id': admin_id
                },
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    console.log(res)
                    if (res.status == 500) {
                        alert(res.message);
                    }
                    else {
                        //$('#admin_id2').val(res.data.uid);

                        $('#id').val(res.data.id);
                        $('#adminusername').val(res.data.adminusername);
                        $('#adminpassword').val(res.data.adminpassword);
                        $('#adminname').val(res.data.adminname);
                        $('#admincollegename').val(res.data.admincollegename);
                        $('#admincollegeid').val(res.data.admincollegeid);
                        $('#admincontact').val(res.data.admincontact);
                        $('#adminmailid').val(res.data.emailid);
                        $('#dateofevent').val(res.data.adminmailid);
                        $('#Editadmin').modal('show');
                    }
                }
            });
        });
        //edit new admin
        $(document).on('submit', '#Editnewadmin', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            console.log(formData)
            formData.append("save_editadmin", true);
            $.ajax({
                type: "POST",
                url: "backend_admin.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                        $('#Editadmin').modal('hide');
                        $('#Editnewadmin')[0].reset();
                        $('#admin').load(location.href + " #admin");
                        alert(res.message)

                    }
                    else if (res.status == 500) {
                        $('#Editadmin').modal('hide');
                        $('#Editnewadmin')[0].reset();
                        console.error("Error:", res.message);
                        alert("Something Went wrong.! try again")
                    }
                }
            });
        });

    </script>

</body>

</html>