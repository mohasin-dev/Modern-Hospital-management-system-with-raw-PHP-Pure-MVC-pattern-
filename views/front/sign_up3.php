<?php
$d = new Database();
?>
<section id="blogArchive">

    <div class="container">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div style="margin-top: 25px">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist" >
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Patient</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Doctor</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Employee</a></li>
    
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
        
            <h2>Registration</h2>
            <?php
            if (isset($_POST['reg'])) {
                $ext1 = extension($_FILES['pic']['name']);
                $data = array(
                    "name" => $d->VD($_POST['nm']),
                    "email" => $d->VD($_POST['em']),
                    "age" => $d->VD($_POST['age']),
                    "contact" => $d->VD($_POST['con']),
                    "password" => md5($_POST['pass1']),
                    "status" => RandStr(20),
                    "cityid" => $d->VD($_POST['cityid']),
                    "picture" => $ext1
                );
                if ($d->insert("patient", $data)) {
                    //echo $d->Id;
                    if ($ext1) {
                        move_uploaded_file($_FILES['pic']['tmp_name'], "images/users/pic/" . md5("ab-1" . $d->Id . "idb") . $ext1);
                    }
                    $headers = "From: sales@rupantarbd.com\r\n";
         $headers .= "Reply-To: sales@rupantarbd.com\r\n";
         $headers .= "MIME-Version: 1.0\r\n";
         $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
                    $message = "<html><body>For active your Account,<a href='http://www.http://localhost/PHP-Project/index.php?verify$code={$data['status']}'>Click here</a></body></html>";
                    mail($data['email'], "Account Veryficition", $message);
//                   Redirect("index.php?f=con");
                } else {
                    echo $d->Error;
                }
            }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="nm" class="form-control"  placeholder="Name" value="<?php if (isset($_POST['nm'])) echo $_POST['nm'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" autocomplete="off" class="form-control" name="em" placeholder="Email" value="<?php if (isset($_POST['em'])) echo $_POST['em'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="pass1"  name="pass1" placeholder="Password">
                    <div class="progress" style=" display: none;">
                        <div class="progress-bar" role="progressbar" style=" display: none; "></div>
                    </div>
                    <label for="exampleInputPassword1">Retype Password</label>
                    <input type="password" class="form-control" id="pass2" placeholder="Retype Password">
                </div> <div class="form-group">
                    <label for="exampleInputPassword1">Gender</label>
                    <input type="radio" value="1" name="gen">Male
                    <input type="radio" value="2" name="gen">Female
                    <input type="radio" value="3" name="gen">Others
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Age</label>
                    <input type="text" class="form-control" name="age" <?php if (isset($_POST['age'])) echo $_POST['age'] ?>"  placeholder="age">
                </div>
                <div class="form-group">
                    <label for="cnt">Country</label>
                    <select name="cntid" class="form-control">
                        <option value="0">Chose country</option>
                        <?php
                        $allCnt = $d->view("country", array("name", "asc"));
                        while ($des = $allCnt->fetch_object()) {
                            if (isset($_POST['cntid']) && $_POST['cntid'] == $des->id) {
                                echo "<option selected value='$des->id'>$des->name</option> ";
                            } else {
                                echo "<option value='$des->id'>$des->name</option> ";
                            }
                        }
                        ?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="ct">City</label>
                    <select name="cityid" class="form-control">


                        <?php
                        if (isset($_POST['cityid']) && $_POST['cntid'] > 0) {
                            $allCt = $d->view("city", array("name", "asc"), array("countryid" => $_POST['cntid']));
                            while ($ct = $allCt->fetch_object()) {
                                if ($ct->id == $_POST['cityid']) {
                                    echo "<option selected value='$ct->id'>$ct->name</option> ";
                                } else {
                                    echo "<option value='$ct->id'>$ct->name</option> ";
                                }
                            }
                        } else {
                            echo '<option value="0">Chose country first</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">maritalstatus</label>
                    <input type="radio" value="1" name="mar">single
                    <input type="radio" value="2" name="mar">Couple
                    <input type="radio" value="3" name="mar">Others
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Contact</label>
                    <input type="text" class="form-control" name="con" <?php if (isset($_POST['con'])) echo $_POST['con'] ?>" placeholder="contact">
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">Picture</label>
                    <input type="file" name="pic">
                    <p class="help-block">Example block-level help text here.</p>
                </div>

                <input type="submit" name="reg" value="Submit" class=" btn btn-primary">
            </form>
       
    </div>
      <div role="tabpanel" class="tab-pane" id="profile">
         
            <h3>Doctor</h3>

            <div class="form-group">

                <?php
                $d = new Database();
                if (isset($_POST['reg'])) {
                    $ext1 = extension($_FILES['pic']['name']);
                    $data = array(
                        "name" => $d->VD($_POST['nm']),
                        "email" => $d->VD($_POST['em']),
                        "password" => $d->VD($_POST['pass1']),
                        "designationid" => $d->VD($_POST['digid']),
                        "fees" => $d->VD($_POST['fees']),
                        "contact" => $d->VD($_POST['con']),
                        "picture" => $ext1
                    );
                    if ($d->insert("doctor", $data)) {
                        if ($ext1) {
                            move_uploaded_file($_FILES['pic']['tmp_name'], "images/doctor/pic/" . md5("ab-1" . $d->Id . "idb") . ".$ext1");
                        }
                        echo "Save Successfully";
                    } else {
                        echo $d->Error;
                    }
                }
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="nm" class="form-control"  placeholder="Name"  >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email </label>
                        <input type="email"  class="form-control" name="em" placeholder="Email">
                        <span id="ava"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="pass1"  name="pass1" placeholder="Password">
                        <div class="progress" style=" display: none;">
                            <div class="progress-bar" role="progressbar" style=" display: none; "></div>
                        </div>

                    </div> 
                    <div class="form-group">
                        <label for="exampleInputPassword1">Fees</label>
                        <input type="text" class="form-control" name="fees" value="<?php if (isset($_POST['age'])) echo $_POST['age'] ?>"  placeholder="age">
                    </div>
                    <div class="form-group">
                        <label for="cnt">Designationid</label>
                        <select name="digid" class="form-control">
                            <option value="0">Chose designation</option>
                            <?php
                            $allCnt = $d->view("designation", array("name", "asc"));
                            while ($des = $allCnt->fetch_object()) {
                                if (isset($_POST['digid']) && ($_POST['digid'] == $des->id)) {
                                    echo "<option selected value='$des->id'>$des->name</option> ";
                                } else {
                                    echo "<option value='$des->id'>$des->name</option> ";
                                }
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Commission</label>
                        <input type="text" class="form-control" name="con" value="<?php if (isset($_POST['con'])) echo $_POST['con'] ?>" placeholder="contact">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Contact</label>
                        <input type="text" class="form-control" name="con" value="<?php if (isset($_POST['con'])) echo $_POST['con'] ?>" placeholder="contact">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Picture</label>
                        <input type="file" name="pic">
                        <p class="help-block">Example block-level help text here.</p>
                    </div>

                    <input type="submit" name="reg" value="Submit" class=" btn btn-primary">
                    <a href="index.php?d=doctor-view" class="btn btn-info">View</a>
                </form>
            </div>


      
          
      </div>
    <div role="tabpanel" class="tab-pane" id="messages">
   

            <h1 style="color: darkred">Employee's informations</h1>
            <a href="index.php?d=employee_view" class="btn btn-info">Employees informations view</a>

            <?php
            $d = new Database();

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
                        move_uploaded_file($_FILES['pic']['tmp_name'], "images/employee/pic/" . md5("ab-1" . $d->Id . "idb") . ".$ext");
                    }
                    echo "Save Successfully";
                } else {
                    echo $d->Error;
                }
            }
            ?>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Full name" name="name" value="">
                </div>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter email" name="em" value="">
                </div>
                <div class="form-group">
                    <label for="name">Password</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter password" name="pass" value="">
                </div>
                <div class="form-group">
                    <label for="cnt">Designationid</label>
                    <select name="digid" class="form-control">
                        <option value="0">Chose designation</option>
                        <?php
                        $allDes = $d->view("designation", array("name", "asc"));
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
                    <label for="name">Salary</label>
                    <input type="text" class="form-control" id="name" placeholder="Salary" name="salary" value="">
                </div>
                <div class="form-group">
                    <label for="name">Joining Date</label>
                    <input type="date" class="form-control" id="name" placeholder="" name="jdname" value="">
                </div>
                <div class="form-group">
                    <label for="name">Type</label>
                    <input type="text" class="form-control" id="name" placeholder="Employee type" name="type" value="">
                </div>

                <div class="form-group">
                    <label for="name">Contact</label>
                    <input type="text" class="form-control" id="name" placeholder="Employee type" name="contact" value="">
                </div>
                <div class="form-group">
                    <label for="name">Picture</label>
                    <input type="file" id="name" placeholder="Uplode your Picture" name="pic" value="">
                </div>
                <input type="submit" name="sub" class="btn btn-info" value="Submit" />
                <br /><br />

            </form>
       
    </div>
<!--    <div role="tabpanel" class="tab-pane" id="settings">...</div>-->
  </div>

</div>

 </div>

</div>
</section>
<h4>Already have an Account?<a href="index.php?f=login">click here</h4>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script>
<?php
$allCnt = $d->view("country", array("name", "asc"));
?>
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email.toLowerCase());
    }

    $(document).ready(function () {
        $("#pass1").focus(function () {
            $(".progress").show();
        });
        $("#pass1").blur(function () {
            $(".progress").hide();
        });
        $("#pass1").keyup(function () {
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
            if (p.match(/[!,@,#,$,%,*,]/)) {
                score++;
            }
            $(".progress-bar").removeClass("progress-bar-danger progress-bar-warning progress-bar-info progress-bar-success");
            $(".progress-bar").css({"width": "0%"});
            $(".progress-bar").show();
            $(".progress-bar").text("");
            if (score == 1) {
                $(".progress-bar").addClass("progress-bar-danger")
                $(".progress-bar").css({"width": "25%"});
                $(".progress-bar").text("Too weak'");
            } else if (score == 2) {
                $(".progress-bar").addClass("progress-bar-info")
                $(".progress-bar").css({"width": "50%"});
                $(".progress-bar").text("MEdium");
            } else if (score == 3) {
                $(".progress-bar").addClass("progress-bar-success")
                $(".progress-bar").css({"width": "75%"});
                $(".progress-bar").text("Strong");
            } else if (score == 4) {
                $(".progress-bar").addClass("progress-bar-warning")
                $(".progress-bar").css({"width": "100%"});
                $(".progress-bar").text("very Stromg");
            }
        });

        $("input[name='em']").blur(function () {
            if (validateEmail($(this).val())) {
                alert("ok");
            } else {
                alert("Invalied email");
            }
        });
        $("input[name='reg']").click(function () {
            var err = 0;
            if ($("input[name='nm']").val() == "") {
                err++;
                $("input[name='nm']").css({"border": "1px solid red"});
            } else {
                $("input[name='nm']").css({"border": "1px solid green"});
            }
            if ($("input[name='em']").val() == "") {
                err++;
                $("input[name='em']").css({"border": "1px solid red"});
            } else if (!validateEmail($("input[name='em']").val())) {
                err++;
                $("input[name='em']").css({"border": "1px solid #f00"});
            } else {
                $("input[name='em']").css({"border": "1px solid green"});
            }
            if ($("input[name='age']").val() == "") {
                err++;
                $("input[name='age']").css({"border": "1px solid red"});
            } else {
                $("input[name='age']").css({"border": "1px solid green"});
            }
            if ($("input[name='con']").val() == "") {
                err++;
                $("input[name='con']").css({"border": "1px solid red"});
            } else {
                $("input[name='con']").css({"border": "1px solid green"});
            }

            if (err > 0) {
                alert("Value missing in requered filed");
                return false;
            }
        });

        $("select[name='cntid']").change(function () {
            $("select[name='cityid']").html("");
            var cnt = $(this).val();
            if (cnt == 0) {
                $("select[name='cityid']").append("<option value='0'>Chose country First</option>");
            }
<?php
while ($des = $allCnt->fetch_object()) {
    echo "else if(cnt==$des->id) {";
    $allCt = $d->view("city", array("name", "asc"), array("countryid" => $des->id));
    while ($ct = $allCt->fetch_object()) {
        echo " $(\"select[name='cityid']\").append(\"<option value='$ct->id'>$ct->name</option>\");";
    }
    echo "}";
}
?>
            /* else if(cnt==1) {
             
             $("select[name='cityid']").append("<option value='2'>BB</option>");
             $("select[name='cityid']").append("<option value='3'>CCC</option>");
             $("select[name='cityid']").append("<option value='4'>EEE</option>");
             }
             else if(cnt==2) {
             $("select[name='cityid']").append("<option value='2'>155</option>");
             $("select[name='cityid']").append("<option value='3'>888</option>");
             $("select[name='cityid']").append("<option value='4'>69</option>");
             
             }
             else if(cnt==3) {
             $("select[name='cityid']").append("<option value='1'>yyy</option>");
             $("select[name='cityid']").append("<option value='2'>ppp</option>");
             $("select[name='cityid']").append("<option value='5'>dd</option>");
             
             }*/
        });
    });

</script>
