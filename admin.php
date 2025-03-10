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
<?php
include("db.php");
$sql1 = "SELECT * FROM participants";
$result1 = mysqli_query($conn, $sql1);
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
    <a class="btn btn-secondary active float-end"  href="logout.php">Logout</a>
    <a class="btn btn-info active float-end"  href="index.php">HomePage</a>
        <h2 class="text-center">Admin Page: Add Events</h2>

        <!-- Nav Tabs -->
        <ul class="nav nav-tabs" id="myTabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#addingevents">Add Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#viewingparticipants">View Participants</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-3">
            <div id="addingevents" class="tab-pane fade show active">

                <div class="py-4">
                    <button type="button" class="btn btn-info float-end" data-bs-toggle="modal"
                        data-bs-target="#addevent">Add
                        Event</button>
                </div>
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
                                <th scope="col">Action</th>

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
                                    <td>
                                        <button type="button" value="<?php echo $row['id']; ?>"
                                            class="btn btn-primary btneventedit">Edit</button>
                                        <button type="button" value="<?php echo $row['id']; ?>"
                                            class="btn btn-danger btneventdelete">Delete</button>
                                    </td>
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

            <div id="viewingparticipants" class="tab-pane fade">
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




    <!-- add event Modal -->
    <div class="modal fade" id="addevent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addnewevent" enctype="multipart/form-data">
                        <input type="text" name="ename" placeholder="Enter Name" required>
                        <input type="text" name="elocation" placeholder="Enter Event Location" required>
                        <input type="text" name="eguidelines" placeholder="Enter Guidelines" required>
                        <input type="text" name="ecname" placeholder="Enter Coordinator Name" required>
                        <input type="text" name="dept" placeholder="Enter Department" required>
                        <input type="number" name="cnumber" placeholder="Enter Coordinator Number" required>
                        <input type="email" name="emailid" placeholder="Enter Mail ID" required>
                        <input type="date" name="dateofevent" placeholder="Enter Date of Event" required>
                        <input type="file" accept="image/png, image/jpeg, image/jpg" name="poster" placeholder="Upload Event poster" required>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit event Modal -->
    <div class="modal fade" id="Editevent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="Editnewevent">
                        <input type="hidden" name="id" id="id" required>
                        <input type="text" name="ename" id="ename" placeholder="Enter Name" required>
                        <input type="text" name="elocation" id="elocation" placeholder="Enter Event Location" required>
                        <input type="text" name="eguidelines" id="eguidelines" placeholder="Enter Guidelines" required>
                        <input type="text" name="ecname" id="ecname" placeholder="Enter Coordinator Name" required>
                        <input type="text" name="dept" id="dept" placeholder="Enter Department" required>
                        <input type="text" name="cnumber" id="cnumber" placeholder="Enter Coordinator Number" required>
                        <input type="text" name="emailid" id="emailid" placeholder="Enter Mail ID" required>
                        <input type="text" name="dateofevent" id="dateofevent" placeholder="Enter Date of Event"required>
                        <input type="file" accept="image/png, image/jpeg, image/jpg" name="poster" id="poster" placeholder="Upload Event poster" required>
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
//add new event
        $(document).on('submit', '#addnewevent', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append("save_newevent", true);
            $.ajax({
                type: "POST",
                url: "backend.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    console.log(res)
                    if (res.status == 200) {
                        $('#addevent').modal('hide');
                        $('#addnewevent')[0].reset();
                        $('#event').load(location.href + " #event");
                        alert("added successfully")

                    }
                    else if (res.status == 500) {
                        $('#addevent').modal('hide');
                        $('#addnewevent')[0].reset();
                        console.error("Error:", res.message);
                        alert("Something Went wrong.! try again")
                    }
                }
            });

        });
//delete event
        $(document).on('click', '.btneventdelete', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var event_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "backend.php",
                    data: {
                        'delete_event': true,
                        'event_id': event_id
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {
                            alert(res.message);
                        }
                        else {
                            $('#event').load(location.href + " #event");
                        }
                    }
                });
            }
        });
//get values for edit
        $(document).on('click', '.btneventedit', function (e) {
            e.preventDefault();
            var event_id = $(this).val();
            console.log(event_id)
            $.ajax({
                type: "POST",
                url: "backend.php",
                data: {
                    'edit_event': true,
                    'event_id': event_id
                },
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    console.log(res)
                    if (res.status == 500) {
                        alert(res.message);
                    }
                    else {
                        //$('#event_id2').val(res.data.uid);

                        $('#id').val(res.data.id);
                        $('#ename').val(res.data.ename);
                        $('#elocation').val(res.data.elocation);
                        $('#eguidelines').val(res.data.eguidelines);
                        $('#ecname').val(res.data.ecname);
                        $('#dept').val(res.data.dept);
                        $('#cnumber').val(res.data.cnumber);
                        $('#emailid').val(res.data.emailid);
                        $('#dateofevent').val(res.data.dateofevent);
                        $('#poster').text(res.data.poster);
                        $('#Editevent').modal('show');
                    }
                }
            });
        });
//edit new event
        $(document).on('submit', '#Editnewevent', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            console.log(formData)
            formData.append("save_editevent", true);
            $.ajax({
                type: "POST",
                url: "backend.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                        $('#Editevent').modal('hide');
                        $('#Editnewevent')[0].reset();
                        $('#event').load(location.href + " #event");
                        alert(res.message)

                    }
                    else if (res.status == 500) {
                        $('#Editevent').modal('hide');
                        $('#Editnewevent')[0].reset();
                        console.error("Error:", res.message);
                        alert("Something Went wrong.! try again")
                    }
                }
            });
        });
//image
    </script>

</body>

</html>