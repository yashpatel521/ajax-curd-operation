<!DOCTYPE html>
<html lang="en">

<head>
    <title>CURD OPERATION</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2 class="text-center">CURD OPERATION</h2>
        <br><br>
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">
            Add Member
        </button>
        <br><br>

        <h2>All Record</h2>
        <div id="record_content">

        </div>
        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Member</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal for add member -->
                    <div class="modal-body">
                        <form id="addform" method="POST">
                            <input type="hidden" id="addmember" name="addmember" value="addmember">
                            <div class="form-group">
                                <label for="email">Username:</label>
                                <input type="Text" class="form-control" name="uname" placeholder="Enter Username" id="uname">
                            </div>

                            <div class="form-group">
                                <label for="email">Email address:</label>
                                <input type="email" class="form-control" placeholder="Enter email" id="email" name="email">
                            </div>


                            <div class="form-group">
                                <label for="email">Phone No:</label>
                                <input type="number" class="form-control" placeholder="Enter Phone No." name="phone" id="phone">
                            </div>

                        </form>
                    </div>

                    <!-- Modal footer for add member -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addrecord()">Add</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!--------------------- The Modal edit ------------------------>
        <div class="modal fade" id="update_user_modal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Member</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!------------------- Modal for edit member ---------------------------------->
                    <div class="modal-body">
                        <form id="updateform" method="POST">
                            <input type="hidden" id="updatemember" name="updatemember">
                            <div class="form-group">
                                <label for="email">Username:</label>
                                <input type="Text" class="form-control" name="updateuname" placeholder="Enter Username" id="updateuname">
                            </div>

                            <div class="form-group">
                                <label for="email">Email address:</label>
                                <input type="email" class="form-control" placeholder="Enter email" id="updateemail" name="updateemail">
                            </div>


                            <div class="form-group">
                                <label for="email">Phone No:</label>
                                <input type="number" class="form-control" placeholder="Enter Phone No." name="updatephone" id="updatephone">
                            </div>

                        </form>
                    </div>

                    <!-- Modal footer for edit member -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="updaterecord()">Update</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            readRecords();
        })

        function readRecords() {
            var readrecord = "readrecord";

            $.ajax({
                url: 'backend1.php',
                type: 'POST',
                data: {
                    readrecord: readrecord
                },

                success: function(data, status) {
                    $('#record_content').html(data);
                }
            })
        }

        function addrecord() {

            $.ajax({
                url: 'backend1.php',
                type: 'POST',
                data: $('#addform').serialize(),

                success: function(data, status) {
                    $('#uname').val("");
                    $('#email').val("");
                    $('#phone').val("");

                    readRecords();
                }
            })
        }

        function DeleteUser(deleteid) {
            var conf = confirm("Are you sure to delete this ?")
            if (conf == true) {
                $.ajax({
                    url: 'backend1.php',
                    type: 'POST',
                    data: {
                        id: deleteid
                    },
                    success: function() {
                        // alert('done');
                        readRecords();
                    }

                })
            }
        }

        function GetUserDetails(id) {
            $('#updatemember').val(id);
            $.post("backend1.php", {
                    did: id
                },
                function(data, status) {
                    var user = JSON.parse(data);
                    $('#updateuname').val(user.uname);
                    $('#updateemail').val(user.email);
                    $('#updatephone').val(user.phone);
                });
            $('#update_user_modal').modal("show");
        }

        function updaterecord() {
            var uname = $('#updateuname').val();
            var email = $('#updateemail').val();
            var phone = $('#updatephone').val();
            var updatemember = $('#updatemember').val();
            $.post("backend1.php", {
                    hid_id: updatemember,
                    uname: uname,
                    email: email,
                    phone: phone
                },
                function(data, status) {
                    $('#update_user_modal').modal("hide");
                    readRecords();
                }
            )


        }
    </script>
</body>

</html>