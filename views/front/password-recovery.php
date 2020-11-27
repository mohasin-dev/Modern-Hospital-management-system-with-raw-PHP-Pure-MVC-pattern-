<?php
if(!isset($title)){
    header("Location: index.html");
}
?>
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <h1 style="color: darkred">Password Recovery</h1>

            <?php
           
            if (isset($_POST['sub']) && strlen($_POST['code']) == 5) {
                $where = array(
                    "code" => $d->VD($_POST['code'])
                );
                $result = $d->view("patient", "*", "", $where);

                if ($result->num_rows > 0) {
                    while ($value = $result->fetch_object()) {
                        if ((time() - $value->time) <= 600) {
                            $temp = array(
                                "code" => "",
                                "time" => ""
                            );
                            $d->update("patient", $temp, array("id" => $value->id));
                            $_SESSION['id'] = $value->id;
                            $_SESSION['type'] = $value->type;
                            $_SESSION['session_code'] = 1;
                            
                            Redirect("index.php?f=new-password");
                        } else {
                            echo "Time out";
                        }
                    }
                    //Redirect("index.php?f=password-recovery");
                } else {
                    echo "Invalid Code";
                }
            }
            ?>



            <form action="" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Code</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="code" placeholder="Enter code">
                </div>
                <input type="submit" class="btn btn-info" name="sub" value="Send" />
            </form>

            <h4 style="color: darkred">Don't have an account? <a href="index.php?f=sign_up">Click Here</a></h4>
        </div>
    </div>
</section>     
