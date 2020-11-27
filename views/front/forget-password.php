<?php
if(!isset($title)){
    header("Location: index.html");
}
?>
<?php

if (isset($_POST['sub'])) {
    $where = array(
        "email" => $d->VD($_POST['em'])
    );
    $result = $d->view("patient", "*", "", $where);

    if ($result->num_rows > 0) {
        $temp = array(
            "code" => rand(10000, 99999),
            "time" => time()
        );
        $d->update("patient", $temp, array("email" => $d->VD($_POST['em'])));
        
        $headers = "From: sales@rupantarbd.com\r\n";
        $headers .= "Reply-To: sales@rupantarbd.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message = "<html><body>Password recocvery code is: {$temp['code']}</body></html>";

        mail($where['email'], "Password Recovery", $message, $headers);

        Redirect("index.php?f=password-recovery");
    } else {
        echo "Invalid Email or Password";
    }
}
?>

<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <h1 style="color: darkred">Forget Password</h1>
            <br />
            <form action="" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="em" placeholder="Email">
                </div>
                <input type="submit" class="btn btn-info" name="sub" value="Send" />
            </form>

            <h4 style="color: darkred">Don't have an account? <a href="index.php?f=sign_up">Click Here</a></h4>
        </div>
    </div>
</section>     
