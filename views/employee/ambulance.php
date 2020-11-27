

<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            
            <?php
            $allm = $d->view("ambulance");

            if (isset($_POST['sub'])) {
                $data = array(
                    "contactnumber" => $d->VD($_POST['con']),
                    "type" => $d->VD($_POST['type']),
                    "distance" => $d->VD($_POST['dis']),
                    "fees" => $d->VD($_POST['abf']),
                    "minimumfees" => $d->VD($_POST['abmf'])
                );
                if ($d->insert("ambulance", $data)) {
                    echo "Save Successful";
                } else {
                    echo $d->Error;
                }
            }
            ?>
             

            <h1 style="color: darkred">Ambulance Informations</h1>


            <form class="submitphoto_form" action="#" method="post">

                <div class="wp-form-group">
                    <label for="con">Contact</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Mobile/Phone Number" name="con" value="" required="">
                    </div>
                    <div>
                    <label for="cata">Ambulance Cetagory</label>
                    </div>
                    <div class="wp-form-control wpcf7-text">
                        <input type="radio" id="name" name="type" value="1"> AC
                        <input type="radio" id="name" name="type" value="2"> Non-AC
                    </div>
                    
                    <div>
                    <label for="dista">Distance</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" name="dis" value="" required="">
</div>
                    <div>
                    <label for="fes">Ambulace Fees</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" name="abf" value="" required="">
                    </div>
                    
<div>
                    <label for="min-fes">Minimum Fees</label>
                    <select name="abmf" required="" class="wp-form-control wpcf7-text">
                        <option value="0">Choose Fees</option>
                        <option value="1000">AC(1000 Tk)</option>
                        <option value="500">Non-AC(500 Tk)</option>
                    </select>
                </div>
                <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-envelope"></i><span>Save</span></button>
                
                <a href="index.php?e=ambulance-view" class="wpcf7-submit button--itzel aaa"><i class="button__icon fa fa-envelope"></i><span>Ambulance view</span></a>
               

            </form>
        </div>

    </div>

</section>

