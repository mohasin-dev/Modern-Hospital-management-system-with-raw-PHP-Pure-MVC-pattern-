<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>

<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <h1 style="color: darkred">Login</h1>
            <br />
            <?php
//if (isset($_POST['sub'])) {
//    $where = array(
//        "email" => $d->VD($_POST['em']),
//        "password" => md5($_POST['pass1']),
//    );
//
//    $result = $d->view("patient", "*", "", $where);
//
//    if ($result->num_rows > 0) {
//        while ($value = $result->fetch_object()) {
//            if ($value->status) {
//                echo "Please verify your account.";
//            } else {
//                $_SESSION['id'] = $value->id;
//                $_SESSION['type'] = $value->type;
//                if($value->type==3){
//                    Redirect("index.php?a=report");
//                }
//                else if($value->type==2){
//                    Redirect("index.php?e=news");  
//                }
//                else{
//                   Redirect("index.php?u=profile"); 
//                }
//            }
//        }
//    } else {
//        echo "Invalid Email or Password";
//    }
//}

            if (isset($_POST['sub'])) {

                //if(isset($_POST['table']) {
                if ($_POST['table'] == 1)
                    $tableName = 'patient';
                if ($_POST['table'] == 2)
                    $tableName = 'doctor';
                if ($_POST['table'] == 3)
                    $tableName = 'employee';

                $where = array(
                    "email" => $d->VD($_POST['em']),
                    "password" => md5($_POST['pass1'])
                );
                $result = $d->view($tableName, "id, email, password, type,status", "", $where);

                if ($result->num_rows > 0) {
                    while ($value = $result->fetch_object()) {
                        if ($value->status) {
                            echo "Please verify your account.";
                        } else {
                            $_SESSION['id'] = $value->id;
                            $_SESSION['type'] = $value->type;
                            if ($tableName = 'patient') {
                                Redirect("index.php?f=home");
                            }
                            if ($tableName = 'doctor') {
                                Redirect("index.php?f=home");
                            }
                            if ($tableName = 'employee') {
                                Redirect("index.php?f=home");
                            }
                        }
                    }
                } else {
                    echo "Invalid Email or Password";
                }
            } //else {
            //echo "no table info";
            //}
            //}
            ?>

            <form action="" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="em" value="admin@gmail.com" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" id="password" value="123" class="form-control" name="pass1" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="radio" id="password" name="table" value='1'> Patiant
                    <input type="radio" id="password" name="table" value='2'> doctor
                    <input type="radio" id="password" name="table" value='3'> employee
                </div>
                <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-sign-in"></i><span>Login</span></button><br><br><br>
            </form>
            <h5>Forget password? <a href="index.php?f=forget-password">Click Here</a></h5>

            <h4 style="color: darkred">Don't have an account? <a href="index.php?f=sign_up">Click Here</a></h4>
        </div>
    </div>
</div>
</div>
</div>
</div>

</section>     
