<?php
include("db.php");

//Add new Admin
if (isset($_POST['save_newadmin'])) {
    try {
        $adminusername = mysqli_real_escape_string($conn, $_POST['adminusername']);
        $adminpassword = mysqli_real_escape_string($conn, $_POST['adminpassword']);
        $adminname = mysqli_real_escape_string($conn, $_POST['adminname']);
        $admincollegename = mysqli_real_escape_string($conn, $_POST['admincollegename']);
        $admincollegeid = mysqli_real_escape_string($conn, $_POST['admincollegeid']);
        $admincontact = mysqli_real_escape_string($conn, $_POST['admincontact']);
        $adminmailid = mysqli_real_escape_string($conn, $_POST['adminmailid']);
        
        $query = "INSERT INTO admin(adminusername, adminpassword,adminname,admincollegename,admincollegeid,admincontact,adminmailid) VALUES ('$adminusername', '$adminpassword','$adminname','$admincollegename','$admincollegeid','$admincontact','$adminmailid')";
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

//delete Admin
if (isset($_POST['delete_admin'])) {
    $admin_id = mysqli_real_escape_string($conn, $_POST['admin_id']);

    $query = "DELETE FROM admin WHERE id='$admin_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Admin Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Admin Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

//get data for admin edit
if (isset($_POST['edit_admin'])) {
    $admin_id = mysqli_real_escape_string($conn, $_POST['admin_id']);

    $query = "SELECT * FROM admin WHERE id='$admin_id'";
    $query_run = mysqli_query($conn, $query);

    $Admin_data = mysqli_fetch_array($query_run);


    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Admin details Fetched Successfully by id',
            'data' => $Admin_data
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Admin details Details Not fetched'
        ];
        echo json_encode($res);
        return;
    }
}

//event edit
if (isset($_POST['save_editadmin'])) {
    $admin_id = mysqli_real_escape_string($conn, $_POST['id']);
    $adminusername = mysqli_real_escape_string($conn, $_POST['adminusername']);
    $adminpassword = mysqli_real_escape_string($conn, $_POST['adminpassword']);
    $adminname = mysqli_real_escape_string($conn, $_POST['adminname']);
    $admincollegename = mysqli_real_escape_string($conn, $_POST['admincollegename']);
    $admincollegeid = mysqli_real_escape_string($conn, $_POST['admincollegeid']);
    $admincontact = mysqli_real_escape_string($conn, $_POST['admincontact']);
    $adminmailid = mysqli_real_escape_string($conn, $_POST['adminmailid']);
    
    $query = "UPDATE admin SET adminusername='$adminusername',adminpassword='$adminpassword',adminname='$adminname',admincollegename='$admincollegename',admincollegeid='$admincollegeid',admincontact='$admincontact',adminmailid='$adminmailid' WHERE id='$admin_id'";
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
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}



?>