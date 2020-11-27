<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <h1 style="color: darkred">Generic Name Update</h1>

            
            <?php
            if (isset($_GET['id'])) {
            $data = $d->view('generic', '*', '', ['id' => $_GET['id']]);
             $value = $data->fetch_object();             
            }
            ?> 
            
            
            <?php
            if (isset($_POST['sub'])) {
                $data = array(
                    "name" => $d->VD($_POST['gname'])
                );

                if ($d->update("generic", $data, array("id" => $_GET['id']))) {
                    Redirect("index.php?e=generic_view");
                } else {
                    echo $d->Error;
                }
            }
            ?> 

            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Generic name" name="gname" value="<?php if (isset($_GET['id'])) echo $value->name ?>">
                </div>
                <input type="submit" name="sub" class="btn btn-info" value="Update" />
        </div>
        </form>
    </div>
</div>
</section>