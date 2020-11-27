<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <h1 style="color: darkred">Account Status</h1>
            <?php
            
            if (isset($_GET['send'])) {

                if (isset($_GET['code']) && strlen($_GET['code']) == 20) {
                    $data = $d->view("patient", "*", "", array("status" => $d->VD($_GET['code'])));
                    if ($data->num_rows > 0) {
                        while ($value = $data->fetch_object()) {
                            $d->update("patient", array("status" => ""), array("id=>$value->id"));
                            $_SESSION['id'] = $value->id;
                            $_SESSION['type'] = $value->type;
                            Redirect("index.php?u=profile");
                        }
                    } else {
                        echo "<h4>Invalid Code</h4>";
                    }
                }
            }
            ?>
            <!--<form action="" method="get">
                <div class="form-group">
                    <label for="exampleInputEmail1">Varification Code</label>
                    <input type="text" class="form-control" name="code" placeholder="Enter your verification code">
                </div>

                <input type="submit" class="btn btn-info" name="send" value="Submit" />
            </form>-->

            <form role="form" class="login-form cf-style-1" method="get">
                <input type="hidden" name="f" value="verify">
                <div class="field-row">
                    <label>Varification Code</label>
                    <input type="text" class="form-control" name="code" placeholder="Enter your verification code">
                </div><!-- /.field-row -->
                <br />

                <div class="buttons-holder">
                    <input type="submit" class="btn btn-info" name="send" value="Submit">
                </div>
            </form>

            <h4 style="color: darkred">Already have an account? <a href="index.php?f=login">Click Here</a></h4>
            <br />
        </div>
    </div>
</section>
