<?php
include("db.php");
$sql = "SELECT * FROM participants";
$result = mysqli_query($conn, $sql);
$sql1 = "SELECT * FROM event";
$result1 = mysqli_query($conn, $sql1);
?>

<html>

<head>
    <title>Event Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet"
        crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2 class="text-center">Registration Page</h2>

        <form class="row g-3" id="addnewparticipant" method="POST">
            <div class="col-md-6">
                <label for="sname" class="form-label">Name</label>
                <input type="text" class="form-control" id="sname" name="sname" required>
            </div>
            <div class="col-md-6">
                <label for="srollno" class="form-label">Roll Number</label>
                <input type="text" class="form-control" id="srollno" name="srollno" required>
            </div>
            <div class="col-md-6">
                <label for="eventname" class="form-label">Event Name</label>
                <select id="eventname" class="form-select" name="eventname" required>
                    <option value="">Choose...</option>
                    <?php
                   
                   while ($row1 = mysqli_fetch_array($result1)) {

                    ?>
                    <option value="<?php echo $row1['ename']; ?>"><?php echo $row1['ename']; ?></option>

                    <?php
                   }
                   ;
                   ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="sphoneno" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="sphoneno" name="sphoneno" required>
            </div>
            <div class="col-md-4">
                <label for="sdept" class="form-label">Department</label>
                <select id="sdept" class="form-select" name="sdept" required>
                    <option value="">Choose...</option>
                    <option value="CSE">Computer Science and Engineering</option>
                    <option value="IT">Information Technology</option>
                    <option value="CSBS">Computer Science and Business Systems</option>
                    <option value="AIML">Artificial Intelligence and Machine Learning</option>
                    <option value="AIDS">Artificial Intelligence and Data Science</option>
                    <option value="EEE">Electrical and Electronics Engineering</option>
                    <option value="ECE">Electronics and Communication Engineering</option>
                    <option value="CIVIL">Civil Engineering</option>
                    <option value="MECH">Mechanical Engineering</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="syear" class="form-label">Year</label>
                <select id="syear" class="form-select" name="syear" required>
                    <option value="">Choose...</option>
                    <option value="First">First Year</option>
                    <option value="Second">Second Year</option>
                    <option value="Third">Third Year</option>
                    <option value="Fourth">Fourth Year</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="ssem" class="form-label">Semester</label>
                <select id="ssem" class="form-select" name="ssem" required>
                    <option value="">Choose...</option>
                    <option value="First">First Semester</option>
                    <option value="Second">Second Semester</option>
                    <option value="Third">Third Semester</option>
                    <option value="Fourth">Fourth Semester</option>
                    <option value="Fifth">Fifth Semester</option>
                    <option value="Sixth">Sixth Semester</option>
                    <option value="Seventh">Seventh Semester</option>
                    <option value="Eighth">Eighth Semester</option>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

    <script>
        $(document).on('submit', '#addnewparticipant', function (e) {
            e.preventDefault();
            
            var formData = new FormData(this);
            formData.append("save_newparticipant", true);

            $.ajax({
                type: "POST",
                url: "backend_register.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = JSON.parse(response);
                    console.log(res);

                    if (res.status == 200) {
                        $('#addnewparticipant')[0].reset();
                        alert("Participant added successfully!");
                    } else if (res.status == 500) {
                        alert("Error: " + res.message);
                    }
                },
                error: function () {
                    alert("An error occurred while processing the request.");
                }
            });
        });
    </script>

</body>

</html>
