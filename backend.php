<?php
include("db.php");

//Add new Event
if (isset($_POST['save_newevent'])) {
    try {
        $ename = mysqli_real_escape_string($conn, $_POST['ename']);
        $elocation = mysqli_real_escape_string($conn, $_POST['elocation']);
        $eguidelines = mysqli_real_escape_string($conn, $_POST['eguidelines']);
        $ecname = mysqli_real_escape_string($conn, $_POST['ecname']);
        $dept = mysqli_real_escape_string($conn, $_POST['dept']);
        $cnumber = mysqli_real_escape_string($conn, $_POST['cnumber']);
        $emailid = mysqli_real_escape_string($conn, $_POST['emailid']);
        $dateofevent = mysqli_real_escape_string($conn, $_POST['dateofevent']);
        $poster = $_FILES['poster'];
        print_r($_FILES['poster']);
        $poster_loc = $_FILES['poster']['tmp_name'];
        $poster_name = $_FILES['poster']['name'];
        $poster_des = "uploads/".$poster_name;
        move_uploaded_file($poster_loc,'uploads/'.$poster_name);
        $query = "INSERT INTO event(ename, elocation,eguidelines,ecname,dept,cnumber,emailid,dateofevent,poster) VALUES ('$ename', '$elocation','$eguidelines','$ecname','$dept','$cnumber','$emailid','$dateofevent','$poster_des')";
        if (mysqli_query($conn, $query)) {
            $res = [
                'status' => 200,
                'message' => 'Details Updated Successfully'
            ];
            echo json_encode($res);
        } else {
            throw new Exception('Query Failed: ' . mysqli_error($conn));
        }
    } catch (Exception $e) {
        $res = [
            'status' => 500,
            'message' => 'Error: ' . $e->getMessage()
        ];
        echo json_encode($res);
    }
}

//delete event
if (isset($_POST['delete_event'])) {
    $event_id = mysqli_real_escape_string($conn, $_POST['event_id']);

    $query = "DELETE FROM event WHERE id='$event_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

//get data for event edit
if (isset($_POST['edit_event'])) {
    $event_id = mysqli_real_escape_string($conn, $_POST['event_id']);

    $query = "SELECT * FROM event WHERE id='$event_id'";
    $query_run = mysqli_query($conn, $query);

    $Event_data = mysqli_fetch_array($query_run);


    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $Event_data
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

//event edit
if (isset($_POST['save_editevent'])) {
    $event_id = mysqli_real_escape_string($conn, $_POST['id']);
    $ename = mysqli_real_escape_string($conn, $_POST['ename']);
    $elocation = mysqli_real_escape_string($conn, $_POST['elocation']);
    $eguidelines = mysqli_real_escape_string($conn, $_POST['eguidelines']);
    $ecname = mysqli_real_escape_string($conn, $_POST['ecname']);
    $dept = mysqli_real_escape_string($conn, $_POST['dept']);
    $cnumber = mysqli_real_escape_string($conn, $_POST['cnumber']);
    $emailid = mysqli_real_escape_string($conn, $_POST['emailid']);
    $dateofevent = mysqli_real_escape_string($conn, $_POST['dateofevent']);
    $poster = $_FILES['poster'];
        print_r($_FILES['poster']);
        $poster_loc = $_FILES['poster']['tmp_name'];
        $poster_name = $_FILES['poster']['name'];
        $poster_des = "uploads/".$poster_name;
    $query = "UPDATE event SET ename='$ename',elocation='$elocation',eguidelines='$eguidelines',ecname='$ecname',dept='$dept',cnumber='$cnumber',emailid='$emailid',dateofevent='$dateofevent',poster='$poster_des' WHERE id='$event_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}


//for upload image
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $event_id = $_POST['event_id']; // Get user ID from input
    $image = $_FILES['image'];

    $imageName = time() . '_' . basename($image['name']);
    $targetFilePath = 'uploads/' . $imageName;

    if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
        $sql = "INSERT INTO photos (event_id, image_path) VALUES ('$event_id', '$targetFilePath')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Image uploaded successfully!');</script>";
        } else {
            echo "<script>alert('Database Error!');</script>";
        }
    } else {
        echo "<script>alert('Upload failed!');</script>";
    }
}

?>