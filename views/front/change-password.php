<?php
if(!isset($title)){
    header("Location: index.html");
}
?>
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <h1 style="color: darkred">Change Password</h1>
            <?php
       
            if (isset($_POST['change_pass'])) {
                $where = array(
                    "password" => md5($_POST['pass1'])
                );

                $result = $d->view("patient", "*", "", $where);
                if ($result->num_rows > 0) {
                    while ($value = $result->fetch_object()) {
                        if ($value->password) {
                            $where = array(
                                "password" => md5($_POST['pass2'])
                            );
                            $p = $d->update("patient", $where, array("id" => $_SESSION['id']));
                            Redirect("index.php?u=profile");
                        } 
                    }
                }else {
                            echo "<h4>Invalid email or password</h4>";
                        }
            }
                    ?>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="exampleInputPassword1">Current Password</label>
                    <input type="password" class="form-control form-_text"   id="form_password" name="pass1" placeholder="Current Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">New Password</label>
                    <input type="password" class="form-control form-_text"   id="form_password" name="pass2" placeholder="New Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Retype Password</label>
                    <input type="password" class="form-control form-_text"   id="form_password" name="pass3" placeholder="Retype Password">
                </div>
                <input type="submit" class="btn btn-info" name="change_pass" value="Change Password" />

            </form>

        </div>
    </div>
</section>
