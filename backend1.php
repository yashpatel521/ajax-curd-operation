<?php
$con = mysqli_connect('localhost', 'root');
$db = mysqli_select_db($con, 'first');

// print_r($_POST);

if (isset($_POST['readrecord'])) {
    $data = ' <table class="table table-dark table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>';

    $disquery = "SELECT * FROM curdoperation";
    $res = mysqli_query($con, $disquery);

    if (mysqli_num_rows($res) > 0) {
        $c = 1;
        while ($row = mysqli_fetch_array($res)) {
            $data .= '<tr>
                <td>' . $c++ . '</td>
                <td>' . $row['uname'] . '</td>
                <td>' . $row['email'] . '</td>
                <td>' . $row['phone'] . '</td>
                <td><button type="button" class="btn btn-info" onclick="GetUserDetails(' . $row['id'] . ')">Edit</button></td>
                <td><button type="button" class="btn btn-danger" onclick="DeleteUser(' . $row['id'] . ')">Delete</button></td>
            </tr>';
        }
    }
    $data .= '</tbody></table>';
    echo $data;
}



if (!empty($_POST['addmember'])) {
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    // print_r($_POST);

    $query = "INSERT INTO curdoperation (uname,email,phone)VALUES ('$uname','$email','$phone')";
    $res = mysqli_query($con, $query);
}

if (isset($_POST['id'])) {
    // print_r($_POST);
    // die();
    $userid = $_POST['id'];

    $query = "DELETE FROM curdoperation WHERE id='$userid'";
    mysqli_query($con, $query);
}

if (isset($_POST['did']) && isset($_POST['did']) != "") {

    // print_r($_POST);
    // die();

    $userid = $_POST['did'];

    $query = "SELECT * FROM curdoperation WHERE id='$userid'";
    $res = mysqli_query($con, $query);

    $response = array();

    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {  // assoc is use for key value pair ,we can use array also
            $response = $row;
        }
    } else {
        $response['status'] = 200;
        $response['message'] = "Data not Found";
    }

    echo json_encode($response);
    // 
} else {
    $response['status'] = 200;
    $response['message'] = "Data not Found";
}

if (!empty($_POST['hid_id'])) {

    // print_r($_POST);
    // die();

    $userid = $_POST['hid_id'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $query = "UPDATE curdoperation SET uname='$uname',email='$email',phone='$phone' WHERE id='$userid'";
    mysqli_query($con, $query);
}
