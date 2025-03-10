<?php
include("db.php");

//Add new participant
if (isset($_POST['save_newparticipant'])) {
    try {
        $sname = mysqli_real_escape_string($conn, $_POST['sname']);
        $srollno = mysqli_real_escape_string($conn, $_POST['srollno']);
        $eventname = mysqli_real_escape_string($conn, $_POST['eventname']);
        $sphoneno = mysqli_real_escape_string($conn, $_POST['sphoneno']);
        $sdept = mysqli_real_escape_string($conn, $_POST['sdept']);
        $syear = mysqli_real_escape_string($conn, $_POST['syear']);
        $ssem = mysqli_real_escape_string($conn, $_POST['ssem']);
        
        $query = "INSERT INTO participants(sname, srollno,eventname,sphoneno,sdept,syear,ssem) VALUES ('$sname', '$srollno','$eventname','$sphoneno','$sdept','$syear','$ssem')";
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

?>