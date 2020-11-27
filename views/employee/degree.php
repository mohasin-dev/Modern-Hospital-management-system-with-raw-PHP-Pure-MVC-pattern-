

<br/><br/><br/><br/><br/>
<section id="blogArchive">
    <?php
$d = new Database();
$alldg = $d->view("degrees", "*", array("name", "asc"));

if(isset($_POST['sub'])){
    $data = array(
        "name"=>$d->VD($_POST['nm'])
    );
    if($d->insert("degrees", $data)){
        echo "Save Successful";
    }
    else{
        echo $d->Error;
    }
}
?>

    <div class="container">
        <div class="col-md-6">
            <h1 style="color: darkred">Imployee's Informations</h1>
            
            <form action="" method="post" enctype="multipart/form-data" style="">
         
                <div class="form-group">
                <label for="dg">Degree</label>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="wp-form-control" id="nm" placeholder="Degree Select" name="nm" value="">
                </div>
            </div>
                    <input type="submit" name="sub" class="btn btn-info" value="Save" />
                    <a href="index.php?e=degree-views" class="btn btn-info">degree view</a>
                </div>
            </form>
        </div>
    </div>
</section>