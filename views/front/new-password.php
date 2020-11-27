
<?php
if (!isset($_SESSION['session_code']) || $_SESSION['session_code'] != 1) {
    Redirect("index.php");
}
?>

<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <h1 style="color: darkred">Password Recovery</h1>

            
           
<!--            if (isset($_POST['sub'])) {
                $where = array(
                    "password" => md5($_POST['pass1'])
                );
                $d->update("patient", $where, array("id" => $_SESSION['id']));
                unset($_SESSION['session_code']);
                Redirect("index.php?u=profile");
            }-->
           

            <?php
           
            if (isset($_POST['sub'])) {
                $msg = "";

                if ($_POST['pass1'] == "") {
                    $msg .= "Password Required<br />";
                } else if ($_POST['pass2'] == "") {
                    $msg .= "Retype Password Required<br />";
                } else if ($_POST['pass1'] != $_POST['pass2']) {
                    $msg .= "Password not match<br />";
                } else if (strlen($_POST['pass1']) < 8) {
                    $msg .= "Password at least 8 character<br />";
                }

                if ($msg == "") { 
                    $where = array(
                    "password" => md5($_POST['pass1'])
                );
                $d->update("patient", $where, array("id" => $_SESSION['id']));
                unset($_SESSION['session_code']);
                Redirect("index.php?u=profile");
                }else {
                    echo $msg;
                }
            }
            ?>



            <form action = "" method = "post">
                <div class = "form-group">
                    <label for = "exampleInputEmail1">New Password</label>
                    <input type = "text" class = "form-control" id = "form_password" name = "pass1" placeholder = "Enter New Password"><span style = "color: red" class = "error_form" id = "password_error_message">At least 8 characters</span>
                </div>
                <div class = "form-group">
                    <label for = "exampleInputEmail1">Retype Password</label>
                    <input type = "text" class = "form-control" id = "form_retype_password" name = "pass2" placeholder = "Enter Retype Password"><span style = "color: red" class = "error_form" id = "retype_password_error_message">Password don't match</span>
                </div>
                <input type="submit" class="btn btn-info" name="sub" value="Send" />
            </form>

            <h4 style="color: darkred">Don't have an account? <a href = "index.php?f=sign_up">Click Here</a></h4>
        </div>
    </div>
</section>

<script>
    $(function () {
        $("#password_error_message").hide();
        $("#retype_password_error_message").hide();

        var error_password = false;
        var error_retype_password = false;

        $("#form_password").focusout(function () {
            check_password();
        })
        $("#form_retype_password").focusout(function () {
            check_retype_password();
        })

        function check_password() {
            var password_length = $("#form_password").val().length;
            if (password_length < 8) {
                $("#password_error_message").html("At least 8 characters");
                $("#password_error_message").show();
                error_message = true;
            } else {
                $("#password_error_message").hide();
            }
        }
        function check_retype_password() {
            var password = $("#form_password").val();
            var retype_password = $("#form_retype_password").val();
            if (password != retype_password) {
                $("#retype_password_error_message").html("Password don't match");
                $("#retype_password_error_message").show();
                error_retype_password = true;
            } else {
                $("#retype_password_error_message").hide();
            }
        }


    })
</script>
