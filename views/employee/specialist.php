<?php
$d=new Database();
if(isset($_POST['sub'])) {
    $data = array(
        "name"=> $d->VD($_POST['spe'])
    );
    if($d->insert("specialist", $data)) {
        echo "Save Successfully";
    }
 else {
        echo $d->Error;
    }
}

?>

<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
          
            
            <div class="form-group">
                <form method="post" action="" class="form-group">
                      <h1>input</h1>
                 
                    <label for="exampleInputEmail1">Specialist</label>
                    <input type="text" class="wp-form-control wpcf7-email" name="spe" id="exampleInputEmail1" placeholder="Name">
                    </div>
                    


                    <input type="submit" name="sub" value="Post" class="btn btn-success">
                    <a href="index.php?e=specialist-view" class="btn btn-info">view</a>
                </form>
                
            </div>
            
        </div>



</section>
