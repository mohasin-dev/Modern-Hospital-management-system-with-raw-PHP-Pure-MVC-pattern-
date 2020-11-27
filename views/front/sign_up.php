<link href="assets/css/fSelect.css" rel="stylesheet">
<script src="assets/js/fSelect.js"></script>
<script>
    (function ($) {
        $(function () {
            $('.test').fSelect();
        });
    })(jQuery);
</script>

<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>

<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">

            <div style="margin-top: 25px">

                <ul class="nav nav-tabs" role="tablist" >
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Patient</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Doctor</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Employee</a></li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="home">

                        <?php
                        if (isset($_POST['sub'])) {
                            $msg = "";

                            if ($_POST['fn'] == "") {
                                $msg .= "Full name requerd <br />";
                            }
                            if ($_POST['em'] == "") {
                                $msg .= "Email requerd <br />";
                            } else if (!filter_var($_POST['em'], FILTER_VALIDATE_EMAIL)) {
                                $msg .= "Invalid email address<br />";
                            }

                            if ($_POST['pass1'] == "") {
                                $msg .= "Password Required<br />";
                            } else if ($_POST['pass2'] == "") {
                                $msg .= "Retype Password Required<br />";
                            } else if ($_POST['pass1'] != $_POST['pass2']) {
                                $msg .= "Password not match<br />";
                            } else if (strlen($_POST['pass1']) < 3) {
                                $msg .= "Password too small<br />";
                            }
                            if ($_POST['addr'] == "") {
                                $msg .= "Address requerd <br />";
                            }
                            if ($_POST['gen'] == "") {
                                $msg .= "Genger requerd <br />";
                            }
                            if ($_POST['con'] == "") {
                                $msg .= "Contact requerd <br />";
                            }
                            if ($_POST['birth'] == "") {
                                $msg .= "Date of  dirth requerd <br />";
                            }

                            if ($msg == "") {
                                echo "<h1 style='color:green'>Congratulations! Registration Successful</h1>";
                            } else {
                                echo $msg;
                            }

                            $ext = extension($_FILES['pic']['name']);

                            $data = array(
                                "name" => $d->VD($_POST['fn']),
                                "email" => $d->VD($_POST['em']),
                                "password" => md5($_POST['pass1']),
                                "address" => $d->VD($_POST['addr']),
                                "cityid" => $d->VD($_POST['ctid']),
                                "status" => RandStr(20),
                                "gender" => $d->VD($_POST['gen']),
                                "maritalstatus" => $d->VD($_POST['ms']),
                                "contact" => $d->VD($_POST['con']),
                                "Picture" => $ext,
                            );
                            if ($d->insert("patient", $data)) {
                                //echo $d->Id;
                                if ($ext) {
                                    move_uploaded_file($_FILES['pic']['tmp_name'], "images/users/pic/" . md5("ab-" . $d->Id . "-idb-project") . ".$ext");
                                }

                                $headers = "From: sales@rupantarbd.com\r\n";
                                $headers .= "Reply-To: sales@rupantarbd.com\r\n";
                                $headers .= "MIME-Version: 1.0\r\n";
                                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                                $message = "<html><body>For activate your account, <a href='http://www.kichunai.com/index.php?f=verify&code={$data['status']}'>Click Here</a></body></html>";

                                mail($data['email'], "Account varification", $message, $headers);

                                Redirect("index.php?f=verify");
                                //Redirect("index.php?f=cong");
                            } else {
                                echo $d->Error;
                            }
                        }
                        ?>



                        <h1 style="color: darkred">Registration</h1>
                        <br />
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="wp-form-control wpcf7-text" id="name" name="fn" placeholder="Name" value="<?php if (isset($_POST['fn'])) echo $_POST['fn'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="wp-form-control wpcf7-text" id="exampleInputEmail1" autocomplete="off"  name="em" placeholder="Email" value="<?php if (isset($_POST['em'])) echo $_POST['em'] ?>">
                                <span id="ava"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="wp-form-control wpcf7-text form-_text"   id="form_password" name="pass1" placeholder="Password"><span style="color: red"  class="error_form" id="password_error_message">At least 8 characters</span>
                            </div>

                            <div class="progress" style="display: none;">
                                <div class="progress-bar" role="progressbar" style="width: 0%;"></div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword2">Retype Password</label>
                                <input type="password" class="wp-form-control wpcf7-text form-_text" id="form_retype_password" name="pass2" placeholder="Retype Password"><span style="color: red" class="error_form" id="retype_password_error_message">Password don't match</span>
                            </div>
                            <div class="form-group">
                                <label for="name">Address</label>
                                <input type="text" class="wp-form-control wpcf7-text" id="address" name="addr" placeholder="Address" value="<?php if (isset($_POST['addr'])) echo $_POST['addr'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="cnt">Country</label>
                                <select name="cntid" class="wp-form-control wpcf7-text">
                                    <option value="0">Choose Country</option>
                                    <?php
                                    $allcnt = $d->view("country", "*", array("name", "asc"));
                                    while ($cnt = $allcnt->fetch_object()) {
                                        if (isset($_POST['cntid']) && $_POST['cntid'] == $cnt->id) {
                                            echo "<option selected value='$cnt->id'>$cnt->name</option>";
                                        } else {
                                            echo "<option value='$cnt->id'>$cnt->name</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ct">City</label>
                                <select name="ctid" class="wp-form-control wpcf7-text">
                                    <option value="0">Choose Country First</option>
                                    <?php
                                    if (isset($_POST[ctid]) && $_POST['ctid'] > 0) {
                                        $allct = $d->view("city", "*", array("name", "asc"), array("countryid" => $_POST['cntid']));

                                        while ($ct = $allct->fetch_object()) {
                                            if ($ct->countryid == $_POST['ctid']) {
                                                echo "<option selected value='$cnt->id'>$cnt->name</option>";
                                            } else {
                                                echo "<option value='$ct->id'>$ct->name</option>";
                                            }
                                        }
                                    } else {
                                        echo "<option value='$ct->id'>$ct->name</option>";
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Contact</label>
                                <input type="text" class="wp-form-control wpcf7-text" id="contact" name="con" placeholder="Contact Number" value="<?php if (isset($_POST['con'])) echo $_POST['con'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="gender">Gender</label><br />
                                <input type="radio" name="gen" id="gen1" value="1"> Male
                                <input type="radio" name="gen" id="gen2" value="2"> Female
                                <input type="radio" name="gen" id="gen3" value="3"> Other
                            </div>

                            <div class="form-group">
                                <label for="ms">Marital Status</label><br />
                                <input type="radio" name="ms" id="ms1" value="1"> Single
                                <input type="radio" name="ms" id="ms2" value="2"> Married               
                            </div>

                            <div class="form-group">
                                <label for="name">Age</label>
                                <input type="text" class="wp-form-control wpcf7-text" id="age" name="ag" placeholder="Age" value="<?php if (isset($_POST['ag'])) echo $_POST['ag'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of birth</label>
                                <input type="date" class="wp-form-control wpcf7-text" id="bod" name="birth" placeholder="Date of birth" value="<?php if (isset($_POST['birth'])) echo $_POST['birth'] ?>">
                            </div>
                            <div class="form-group">

                                <div class="form-group">
                                    <label for="exampleInputFile">Picture</label>
                                    <input type="file" id="exampleInputFile" name="pic" class="wp-form-control wpcf7-text">
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="chec"> Check me out
                                    </label>
                                </div>
                                <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-upload"></i><span>Submit</span></button><br><br><br>

                                </form><br><br>
                                <h4 style="color: darkred">Already have an account? <a href="index.php?f=login">Click Here</a></h4>
                            </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="profile">
                        <?php
                        if (isset($_POST['sub'])) {

                            $ext = extension($_FILES['pic']['name']);

                            $data = array(
                                "name" => $d->VD($_POST['name']),
                                "email" => $d->VD($_POST['email']),
                                "password" => $d->VD($_POST['pass']),
                                "designationid" => $d->VD($_POST['digid']),
//        "degreesid" => $d->VD($_POST['degreeid']),
//        "specialistid" => $d->VD($_POST['speid']),
                                "fees" => $d->VD($_POST['fees']),
                                "contact" => $d->VD($_POST['contact']),
                                "picture" => $ext
                            );
                            //print_r($data);
                            if ($d->insert("doctor", $data)) {
                                $id = $d->Id;
//        if ($ext) {
//            if ($ext != "jpg" && $ext != "jpeg" && $ext != "png" && $ext != "gif") {
//                $ext = "";
//            } else {
//                move_uploaded_file($_FILES['pic']['tmp_name'], "images/doctor/pic/" . md5("ab-1" . $d->Id . "idb") . ".$ext");
//                //echo "Save Successfully";
//                //Redirect("index.php?e=doctor_view");
//            }
//        } else {
//            echo $d->Error;
//        }
                                if ($_POST['degreeid']) {
                                    foreach ($_POST['degreeid'] as $degid) {
                                        $arr = array(
                                            "doctorid" => $id,
                                            "degreesid" => $degid
                                        );
                                        $d->insert("doctor_degree", $arr);
                                        print_r($arr);
                                    }
                                }

                                if ($_POST['speid']) {
                                    foreach ($_POST['speid'] as $speid) {
                                        $arrr = array(
                                            "doctorid" => $id,
                                            "specialistid" => $speid
                                        );
                                        $d->insert("doctor_specialist", $arrr);
                                        //print_r($arrr);
                                    }
                                }
                            } else {
                                echo $d->Error;
                            }
                        }
                        ?>
                        <h1 style="color: darkred">Registration</h1>
                        <br />

                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Full name" name="name" value="">
                            </div>
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Enter email" name="email" value="">
                            </div>
                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Enter password" name="pass" value="">
                            </div>
                            <div class="form-group">
                                <label for="cnt">Designation</label>
                                <select name="digid" class="wp-form-control wpcf7-text">
                                    <option value="0">Chose designation</option>
                                    <?php
                                    $allDes = $d->view("designation", "*", array("name", "asc"));
                                    while ($des = $allDes->fetch_object()) {
                                        if (isset($_POST['digid']) && $_POST['digid'] == $des->id) {
                                            echo "<option selected value='$des->id'>$des->name</option> ";
                                        } else {
                                            echo "<option value='$des->id'>$des->name</option> ";
                                        }
                                    }
                                    ?>

                                </select>
                            </div> 

                            <div class="form-group">
                                <label for="cnt">Degrees</label>
                                <select name="degreeid" multiple="" class=" test wp-form-control wpcf7-text">
                                    <option value="0">Chose degrees</option>
                                    <?php
                                    $allDeg = $d->view("degrees", "*", array("name", "asc"));
                                    while ($deg = $allDeg->fetch_object()) {
                                        if (isset($_POST['digreeid']) && $_POST['digreeid'] == $deg->id) {
                                            echo "<option selected value='$deg->id'>$deg->name</option> ";
                                        } else {
                                            echo "<option value='$deg->id'>$deg->name</option> ";
                                        }
                                    }
                                    ?>

                                </select>
                            </div> 

                            <div class="form-group">
                                <label for="cnt">Specialist</label>
                                <select name="speid" multiple="" class="test wp-form-control wpcf7-text">
                                    <option value="0">Chose Specialist</option>
                                    <?php
                                    $allSpe = $d->view("specialist", "*", array("name", "asc"));
                                    while ($spe = $allSpe->fetch_object()) {
                                        if (isset($_POST['digreeid']) && $_POST['digreeid'] == $spe->id) {
                                            echo "<option selected value='$spe->id'>$spe->name</option> ";
                                        } else {
                                            echo "<option value='$spe->id'>$spe->name</option> ";
                                        }
                                    }
                                    ?>

                                </select>
                            </div> 


                            <div class="form-group">
                                <label for="name">Fees</label>
                                <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Fees" name="fees" value="">
                            </div> 

                            <div class="form-group">
                                <label for="name">Contact</label>
                                <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Contact" name="contact" value="">
                            </div>

                            <div class="form-group">
                                <label for="name">Picture</label>
                                <input type="file" id="name" placeholder="Uplode your Picture" name="pic" value="">
                            </div>
                            <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-upload"></i><span>Submit</span></button><br><br><br>
                            <br /><br />
                        </form><br><br>

                        <h4 style="color: darkred">Already have an account? <a href="index.php?f=login">Click Here</a></h4>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="messages">
                        <?php
                        if (isset($_POST['sub'])) {

                            $ext = extension($_FILES['pic']['name']);

                            $data = array(
                                "name" => $d->VD($_POST['name']),
                                "email" => $d->VD($_POST['em']),
                                "password" => md5($_POST['pass']),
                                "designationid" => $d->VD($_POST['digid']),
                                "salary" => $d->VD($_POST['salary']),
                                "joiningdata" => $d->VD($_POST['jdname']),
                                "type" => $d->VD($_POST['type']),
                                "contact" => $d->VD($_POST['contact']),
                                "picture" => $ext
                            );

                            if ($d->insert("employee", $data)) {
                                if ($ext) {
                                    if ($ext != "jpg" && $ext != "jpeg" && $ext != "png" && $ext != "gif") {

                                        $ext = "";
                                    } else {

                                        move_uploaded_file($_FILES['pic']['tmp_name'], "images/employee/pic/" . md5("ab-1" . $d->Id . "idb") . ".$ext");
                                        echo "Save Successfully";
                                    }
                                } else {
                                    echo $d->Error;
                                }
                            }
                        }
                        ?>
                        <h1 style="color: darkred">Registration</h1>
                        <br />

                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Full name" name="name" value="">
                            </div>
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Enter email" name="em" value="">
                            </div>
                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Enter password" name="pass" value="">
                            </div>
                            <div class="form-group">
                                <label for="cnt">Designationid</label>
                                <select name="digid" class="wp-form-control wpcf7-text">
                                    <option value="0">Chose designation</option>
                                    <?php
                                    $allDes = $d->view("designation", "*", array("name", "asc"));
                                    while ($des = $allDes->fetch_object()) {
                                        if (isset($_POST['digid']) && $_POST['digid'] == $des->id) {
                                            echo "<option selected value='$des->id'>$des->name</option> ";
                                        } else {
                                            echo "<option value='$des->id'>$des->name</option> ";
                                        }
                                    }
                                    ?>

                                </select>
                                <div class="form-group">
                                    <label for="name">Salary</label>
                                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Salary" name="salary" value="">
                                </div>
                                <div class="form-group">
                                    <label for="name">Joining Date</label>
                                    <input type="date" class="wp-form-control wpcf7-text" id="name" placeholder="" name="jdname" value="">
                                </div>
                                <div class="form-group">
                                    <label for="name">Type</label>
                                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Employee type" name="type" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Contact</label>
                                <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Employee type" name="contact" value="">
                            </div>
                            <div class="form-group">
                                <label for="name">Picture</label>
                                <input type="file" id="name" placeholder="Uplode your Picture" name="pic" value="">
                            </div>
                            <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-upload"></i><span>Submit</span></button>

                            <br /><br />
                    </div>
                </div>
            </div>
        </div>
</section>
<?php
$allcnt = $d->view("country", "*", array("name", "asc"));
?>
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
            if (password_length < 3) {
                $("#password_error_message").html("At least 3 characters");
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


<script>

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email.toLowerCase());
    }

    $(document).ready(function () {
        $("#form_password").focus(function () {
            $(".progress").show();
        });
        $("#form_password").blur(function () {
            $(".progress").hide();
        });
        $("#form_password").keyup(function () {
            var score = 0;
            var p = $(this).val();
            if (p.length > 3) {
                score++;
            }
            if (p.match(/[a-z]/) && p.match(/[A-Z]/)) {
                score++;
            }
            if (p.match(/[0-9]/)) {
                score++;
            }
            if (p.match(/[!,@,#,$,%,^]/)) {
                score++;
            }

            $(".progress-bar").removeClass("progress-bar-danger progress-bar-warning progress-bar-info progress-bar-success");
            $(".progress-bar").css({"width": "0%"});
            $(".progress-bar").text("");
            if (score == 1) {
                $(".progress-bar").addClass("progress-bar-danger");
                $(".progress-bar").css({"width": "25%"});
                $(".progress-bar").text("very weak");
            }
            if (score == 2) {
                $(".progress-bar").addClass("progress-bar-warning");
                $(".progress-bar").css({"width": "50%"});
                $(".progress-bar").text("weak");
            }
            if (score == 3) {
                $(".progress-bar").addClass("progress-bar-info");
                $(".progress-bar").css({"width": "75%"});
                $(".progress-bar").text("average");
            }
            if (score == 4) {
                $(".progress-bar").addClass("progress-bar-success");
                $(".progress-bar").css({"width": "100%"});
                $(".progress-bar").text("strong");
            }
        });
        $("input[name='em']").blur(function () {
            if (validateEmail($(this).val())) {
                $.ajax({
                    type: "GET",
                    data: {
                        "email": $(this).val()
                    },
                    url: "ajax/available.php",
                    success: function (result) {
                        if (result == 100) {
                            $("#ava").text("Not available");
                            $("#ava").css({"color": "red"});
                            $("input[name='em']").css({"border": "1px solid red"});
                        } else {
                            $("#ava").text("Available");
                            $("#ava").css({"color": "green"});
                            $("input[name='em']").css({"border": "1px solid green"});
                        }
                    }
                });
            } else {
                $("#ava").text("");
            }
        });
        $("body").on("click", "input[name='sub']", function () {
            var err = 0;
            /*##### Name validation ##### */

            if ($("input[name='fn']").val() == "") {
                err++;
                $("input[name='fn']").css({"border": "1px solid #f00"});
            } else {
                $("input[name='fn']").css({"border": "1px solid green"});
            }
            /*##### Email validation ##### */

            if ($("input[name='em']").val() == "") {
                err++;
                $("input[name='em']").css({"border": "1px solid #f00"});
            } else if (!validateEmail($("input[name='em']").val())) {
                err++;
                $("input[name='em']").css({"border": "1px solid #f00"});
            } else if ($("#ava").text() != "Available") {
                err++;
                $("input[name='em']").css({"border": "1px solid #f00"});
            } else {
                $("input[name='em']").css({"border": "1px solid green"});
            }
            /*##### Password validation ##### */

            if ($("input[name='pass1']").val() == "") {
                err++;
                $("input[name='pass1']").css({"border": "1px solid #f00"});
            } else {
                $("input[name='pass1']").css({"border": "1px solid green"});
            }
            /*##### Retype password validation ##### */

            if ($("input[name='pass2']").val() == "") {
                err++;
                $("input[name='pass2']").css({"border": "1px solid #f00"});
            } else {
                $("input[name='pass2']").css({"border": "1px solid green"});
            }

            /*##### Country validation ##### */

            if ($("input[name='cntid']").val() == "") {
                err++;
                $("input[name='cntid']").css({"border": "1px solid red"});
            } else {
                $("input[name='cntid']").css({"border": "1px solid green"});
            }
            /*##### Address validation ##### */

            if ($("input[name='addr']").val() == "") {
                err++;
                $("input[name='addr']").css({"border": "1px solid red"});
            } else {
                $("input[name='addr']").css({"border": "1px solid green"});
            }
            /*##### Contact validation ##### */

            if ($("input[name='con']").val() == "") {
                err++;
                $("input[name='con']").css({"border": "1px solid red"});
            } else {
                $("input[name='con']").css({"border": "1px solid green"});
            }
            /*##### Age validation ##### */


            if ($("input[name='ag']").val() == "") {
                err++;
                $("input[name='ag']").css({"border": "1px solid red"});
            } else {
                $("input[name='ag']").css({"border": "1px solid green"});
            }

            /*##### Date of birth validation ##### */

            if ($("input[name='birth']").val() == "") {
                err++;
                $("input[name='birth']").css({"border": "1px solid red"});
            } else {
                $("input[name='birth']").css({"border": "1px solid green"});
            }

            /*##### Gender validation ##### */
            if ($("input[name='gen']").val() == "") {
                err++;
                $("input[name='gen']").css({"border": "1px solid red"});
            } else {
                $("input[name='gen']").css({"border": "1px solid green"});
            }

            if (err > 0) {
                alert("Value missing in requird field")
                return false;
            }
        });
        $("select[name='cntid']").change(function () {
            $("select[name='ctid']").html("");
            var cnt = $(this).val();
            if (cnt == 0) {
                $("select[name='ctid']").append("<option value='0'>Choose Country First</option>");
            }


<?php
while ($cnt = $allcnt->fetch_object()) {
    echo "else if (cnt == $cnt->id) {";
    $allct = $d->view("city", "*", array("name", "asc"), array("countryid" => $cnt->id));
    while ($ct = $allct->fetch_object()) {
        echo "$(\"select[name = 'ctid']\").append(\"<option value='$ct->id'>$ct->name</option>\");";
    }
    echo "}";
}
?>
        });
    });
</script>




