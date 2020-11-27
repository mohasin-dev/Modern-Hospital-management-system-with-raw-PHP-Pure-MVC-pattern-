<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>

<section id="blogArchive">
    <div class="container">
        <div class="col-md-8">

            <h1 style="color: darkred">Admission Form</h1>
            <a href="index.php?e=admission_view" class="btn btn-info">Employees informations view</a>

            <?php
            if (isset($_POST['sub'])) {

                $data = array(
                    "patientid" => $d->VD($_POST['name']),
                    "doctorid" => $d->VD($_POST['docid']),
                    "seatid" => $d->VD($_POST['seatid']),
                    "admissiondate" => $d->VD($_POST['adate']),
                    "releasedate" => $d->VD($_POST['rdate']),
                    "admissionfees" => $d->VD($_POST['fees']),
                    "disease" => $d->VD($_POST['disease']),
                    "relativecontact" => $d->VD($_POST['rcontact'])
                );

                if ($d->insert("admission", $data)) {

                    echo "Save Successfully";
                } else {
                    echo $d->Error;
                }
            }
            ?>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">

                    <label for="cnt">Patient Name</label>
                    <div id="search">
                        <!--                        <form method="get">-->
                        <input class="wp-form-control wpcf7-text" type="text" name="name" id="name" /> 
                        <img class="loding" src="images/loading.gif" width="50" id="loading" style="display: none" />
                        <span id="list">

                        </span>
                        <!--                        </form>-->
                    </div>
            <!--                    <select name="pid" class="wp-form-control wpcf7-text">
                                    <option value="0">Chose patientid</option>
                    <?php
//                        $allpat = $d->view("patient", "*", array("name", "asc"));
//                        while ($patient = $allpat->fetch_object()) {
//                            if (isset($_POST['pid']) && $_POST['pid'] == $patient->id) {
//                                echo "<option selected value='$patient->id'>"
//                                . "$patient->id - $patient->name</option> ";
//                            } else {
//                                echo "<option value='$patient->id'>$patient->id - $patient->name</option> ";
//                            }
//                        }
                    ?>
            
                                </select>-->
                </div>
                <div class="form-group">
                    <label for="docid">Doctor Name</label>
                    <select name="docid" class="wp-form-control wpcf7-text">
                        <option value="0">Chose doctorid</option>
                        <?php
                        $doc = $d->view("doctor", "*", array("name", "asc"));
                        while ($did = $doc->fetch_object()) {
                            if (isset($_POST['docid']) && $_POST['docid'] == $did) {
                                echo "<option selected value='$did->id'>$did->name</option";
                            } else {
                                echo "<option value='$did->id'>$did->name</option> ";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="seatid">Seat</label>

                    <select name="seatid" class="wp-form-control wpcf7-text">
                        <option value="0">Chose seatid</option>
                        <?php
                        $seat = $d->view("seat", "*", array("name", "asc"));
                        while ($sid = $seat->fetch_object()) {
                            if (isset($_POST['seatid']) && $_POST['seatid'] == $sid) {
                                echo "<option selected value='$sid->id'>$sid->name</option";
                            } else {
                                echo "<option value='$sid->id'>$sid->name</option> ";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Admission Date</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="datepicker" placeholder="Admission Date" name="adate" value="">
                </div>
                <div class="form-group">
                    <label for="name">Release Date</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="datepicker2" placeholder="Release Date" name="rdate" value="">
                </div>
                <div class="form-group">
                    <label for="name">Admission Fees</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Admission Fees" name="fees" value="">
                </div>
                <div class="form-group">
                    <label for="name">Relative Contact</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Relative Contact" name="rcontact" value="">
                </div>
                <div class="form-group">
                    <label for="name">Disease</label>
                    <input type="text" class="wp-form-control wpcf7-text" id="name" placeholder="Disease Name" name="disease" value="">
                </div>

                <button class="wpcf7-submit button--itzel" type="submit" name="sub"><i class="button__icon fa fa-save"></i><span>Submit</span></button>               

            </form><br /><br />
        </div>
    </div>
</section>


<!--<script src="jquery-3.2.1.min.js"></script>-->
<script>
    $(document).ready(function (e) {
        $("body").on("click", ".mydata", function () {
            var mh = $(this).text();
            $("#name").val(mh);
            $("#list ul").remove();
            $("#list").hide();
            return false;
        });

        $("#name").keyup(function () {
            //$("#list").html("");
            $("#list ul").remove();
            $("#loading").show();
            $.ajax({
                type: 'POST',
                data: {
                    "name": $(this).val()
                },
                url: "ajax/search.php",
                success: function (result) {
                    $("#loading").hide();
                    var dt = "";
                    if (result.length > 0) {
                        for (i = 0; i < result.length; i++) {
                            dt += "<ul>";

                            dt += "<li><a href='' class = 'mydata'>" + result[i]['name'] + "</a></li>";

                            dt += "</ul>";
                        }
                        $("#list").show()
                        $("#list").append(dt);
                    } else {
                        $("#list").hide();
                    }

                },
                error: function (request) {
                    //alert(request);
                }
            });
            return false;
        });
    });
</script>

<style>
    #search{
        position: relative;
    }
    #list{
        position: absolute;
        min-width: 300px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-bottom: none;
        display: none;

    }
    #list ul, #list ul li{
        padding: 0;
        margin: 0;
    }
    #list ul li{
        list-style: none;
    }
    #list ul li a{
        line-height: 30px;
        border-bottom: 1px solid #ccc;
        text-decoration: none;
        display: block;
        padding: 0 10px;
        font-size: 14px;
    }
    #list ul li a:hover{
        background-color: #eee;
    }
    .loding {
       margin-left: 750px;
      
    }
</style>