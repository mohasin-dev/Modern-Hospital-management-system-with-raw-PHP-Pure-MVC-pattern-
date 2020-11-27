<section id="blogArchive">
    <div class="container">
        <div class="col-md-12">

            <h1 style="color: darkred">Find Your Doctor</h1>


            <div id="search">
                <form method="get">
                    <label style="display: inline-block">Search By Specialist</label> 
                    <input class="wp-form-control wpcf7-text" type="text" name="name" id="name" /> 
                    <img class="loding" src="images/loading.gif" width="50" id="loading" style="display: none" />
                    <span id="list">

                    </span>
                </form>
            </div>
        </div>
    </div>
</section>


<script src="jquery-3.2.1.min.js"></script>
<script>
    $(document).ready(function (e) {
        $("#name").keyup(function () {
            //$("#list").html("");
            $("#list ul").remove();
            $("#loading").show();
            $.ajax({
                type: 'GET',
                data: {
                    "name": $(this).val()
                },
                url: "find_doctor_ajax.php",
                success: function (result) {
                    $("#loading").hide();
                    var dt = "";
                    if (result.length > 0) {
                        for (i = 0; i < result.length; i++) {
                            dt += "<ul>";

                            dt += "<li><a href=''>" + result[i]['name'] + "</a></li>";

                            dt += "</ul>";
                        }
                        $("#list").show();
                        $("#list").append(dt);
                    } else {
                        $("#list").hide();
                    }

                },
                error: function (request) {
                    //alert(request);
                }
            });
            return false;
        });
    });
</script>

<style>
    #search{
        position: relative;
    }
    #list{
        position: absolute;
        min-width: 171px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-bottom: none;
        display: none;

    }
    #list ul, #list ul li{
        padding: 0;
        margin: 0;
    }
    #list ul li{
        list-style: none;
    }
    #list ul li a{
        line-height: 30px;
        border-bottom: 1px solid #ccc;
        text-decoration: none;
        display: block;
        padding: 0 10px;
        font-size: 14px;
    }
    #list ul li a:hover{
        background-color: #eee;
    }
    .loding {
        margin-left: 750px;

    }
</style>





















<?php
if(!isset($title)){
    header("Location: index.html");
}
?>
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
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
                } else if (strlen($_POST['pass1']) < 5) {
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
                    "Picture" => $ext,
                );
                if ($d->insert("patient", $data)) {
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
                    <input type="text" class="form-control" id="name" name="fn" placeholder="Name" value="<?php if (isset($_POST['fn'])) echo $_POST['fn'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" autocomplete="off"  name="em" placeholder="Email" value="<?php if (isset($_POST['em'])) echo $_POST['em'] ?>">
                    <span id="ava"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control"   id="form_password" name="pass1" placeholder="Password"><span style="color: red"  class="error_form" id="password_error_message">At least 8 characters</span>
                </div>

                <div class="progress" style="display: none;">
                    <div class="progress-bar" role="progressbar" style="width: 0%;"></div>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword2">Retype Password</label>
                    <input type="password" class="form-control" id="form_retype_password" name="pass2" placeholder="Retype Password"><span style="color: red" class="error_form" id="retype_password_error_message">Password don't match</span>
                </div>
                <div class="form-group">
                    <label for="name">Address</label>
                    <input type="text" class="form-control" id="address" name="addr" placeholder="Address" value="<?php if (isset($_POST['addr'])) echo $_POST['addr'] ?>">
                </div>
                <div class="form-group">
                    <label for="cnt">Country</label>
                    <select name="cntid" class="form-control">
                        <option value="0">Choose Country</option>
                        <?php
                        $allcnt = $d->view("country", array("name", "asc"));
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
                    <select name="ctid" class="form-control">
                        <option value="0">Choose Country First</option>
                        <?php
                        if (isset($_POST['ctid']) && $_POST['ctid'] > 0) {
                            $allct = $d->view("city", array("name", "asc"), array("countryid" => $_POST['cntid']));

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
                    <input type="text" class="form-control" id="contact" name="con" placeholder="Contact Number" value="<?php if (isset($_POST['con'])) echo $_POST['con'] ?>">
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label><br />
                    <input type="radio" name="gen" id="gen1" value="1"> Male
                    <input type="radio" name="gen" id="gen2" value="2"> Female
                    <input type="radio" name="gen" id="gen3" value="3"> Other
                </div>
				
                <div class="form-group">
                    <label for="name">Age</label>
                    <input type="text" class="form-control" id="datepicker" name="ag" placeholder="Age" value="<?php if (isset($_POST['ag'])) echo $_POST['ag'] ?>">
                </div>
                <div class="form-group">
                    <label for="dob">Date of birth</label>
                    <input type="date" class="form-control" id="bod" name="birth" placeholder="Date of birth" value="<?php if (isset($_POST['birth'])) echo $_POST['birth'] ?>">
                </div>
                <div class="form-group">

                    <div class="form-group">
                        <label for="exampleInputFile">Picture</label>
                        <input type="file" id="exampleInputFile" name="pic">
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="chec"> Check me out
                        </label>
                    </div>
                    <input type="submit" class="btn btn-info" name="sub" value="Submit" />

            </form>
            <h4 style="color: darkred">Already have an account? <a href="index.php?f=login">Click Here</a></h4>
        </div>
    </div>
</section>
<?php
$allcnt = $d->view("country", array("name", "asc"));
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
            if (p.length > 8) {
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
    $allct = $d->view("city", array("name", "asc"), array("countryid" => $cnt->id));
    while ($ct = $allct->fetch_object()) {
        echo "$(\"select[name = 'ctid']\").append(\"<option value='$ct->id'>$ct->name</option>\");";
    }
    echo "}";
}
?>
            /*
             else if(cnt == 1){
             $("select[name = 'ctid']").append("<option value='1'>ABC</option>");  
             }
             else if(cnt == 2){
             $("select[name = 'ctid']").append("<option value='1'>ABCD</option>");
             $("select[name = 'ctid']").append("<option value='1'>ABCE</option>");
             $("select[name = 'ctid']").append("<option value='1'>ABCF</option>");
             
             }
             */
        });
    });
</script>




