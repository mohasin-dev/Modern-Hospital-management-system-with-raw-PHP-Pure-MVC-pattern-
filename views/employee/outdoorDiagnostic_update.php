<?php
if(!isset($title)){
    header("Location: index.html");
}
?>

<?php

if (isset($_POST['sub'])) {
    $data = array(
        "patientid" => $d->VD($_POST['pid']),
        "diagnosticid" => $d->VD($_POST['did']),
        "amount" => $d->VD($_POST['amount'])
    );
     if ($d->update("outdoordiagnostic", $data, ['id'=>$_GET['id']])) {
         Redirect("index.php?e=outdoordiagnostic_view");
         
     } else {
        echo $d->Error;
     }
}
?>
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            
            <h1 style="color: darkred">Outdoor Dianostic's Informations Update</h1>
            <a href="index.php?e=outdoordiagnostic_view" class="btn btn-info">Outdoor Dianostic Info view</a>
            
            <?php
            if (isset($_GET['id'])) {
            $data = $d->view('outdoordiagnostic', '*', '', ['id' => $_GET['id']]);
             $value = $data->fetch_object();             
            }
            ?> 
            
            
            <form action="" method="post" enctype="multipart/form-data">
         
                               <div class="form-group">

                        <label for="cnt">Patientid</label>
                        <select name="pid" class="wp-form-control wpcf7-text">
                            <option value="0">Chose patientid</option>
                            <?php
                            $allpat = $d->view("patient", "*", array("name", "asc"));
                            while ($patient = $allpat->fetch_object()) {
                                if (isset($_POST['pid']) && $_POST['pid'] == $patient->id) {
                                    echo "<option selected value='$patient->id'>$patient->id - $patient->name</option> ";
                                } else {
                                    echo "<option value='$patient->id'>$patient->name</option> ";
                                }
                            }
                            ?>

                        </select>
                    </div>
                
                               <div class="form-group">

                        <label for="cnt">Dianosticid</label>
                        <select name="did" class="wp-form-control wpcf7-text">
                            <option value="0">Chose Dianosticid</option>
                            <?php
                            $allpat = $d->view("diagnostic", "*", array("name", "asc"));
                            while ($patient = $allpat->fetch_object()) {
                                if (isset($_POST['did']) && $_POST['did'] == $patient->id) {
                                    echo "<option selected value='$patient->id'>$patient->id - $patient->name</option> ";
                                } else {
                                    echo "<option value='$patient->id'>$patient->name</option> ";
                                }
                            }
                            ?>

                        </select>
                    </div>
                
                <div class="form-group">
                    <label for="name">Amount</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Generic name" name="amount" value="<?php echo $value->amount ?>">
                </div>
                    <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-upload"></i><span>Update</span></button>
                </div>
            </form>
        </div>
    </div>
</section>

