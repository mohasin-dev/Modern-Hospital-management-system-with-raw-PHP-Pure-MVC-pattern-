
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">

            <?php
                $d = new Database();
                if(isset($_GET['id'])){
                    $data =$d->view("payment", array("id", "asc"), ["id" => $_GET['id']]);
                    $value = $data->fetch_object();
                }
                if (isset($_POST['sub'])){
                    $data = array(
                      "name" => $d->VD($_POST['pypal'])
                    );
                    if ($d->update("payment", $data, array("id"=> $_GET['id']))){
                        redirect("index.php?d=payment_view");
                    }
                    else{
                        echo $d->Error;
                    }
                }
            ?>

            <div class="form-group">
                <form method="post" action="" class="form-group">
                    <h1><i>Update Payment</i></h1>

                    <label for="exampleInputEmail1">Payment</label>
                    <input type="text" class="wp-form-control" name="pypal" id="exampleInputEmail1" value="<?php if(isset($_GET['id'])) echo $value->name; ?>" placeholder="New Name">
            </div>
            <input type="submit" name="sub" value="Update" class="btn btn-success">
            <a href="index.php?d=index.php?d=payment_view" class="btn btn-info" >Cancel</a>
            </form>

        </div>

    </div>



</section>
