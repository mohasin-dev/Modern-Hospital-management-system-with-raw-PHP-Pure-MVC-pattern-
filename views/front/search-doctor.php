<section id="blogArchive">
    <div class="container">
        <div class="col-sm-8">
            <h1 style="color: darkred">Search Doctor</h1>

            <form class="appointment-form" method="post">                
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <label class="control-label">Select Department <span class="required">*</span>
                        </label>
                        <select name="deptid" class="wp-form-control wpcf7-select depid">
                            <option value="0">Chose Department</option>
                            <?php
                            $allDept = $d->view("department", "*", array("name", "asc"));
                            while ($dept = $allDept->fetch_object()) {
                                if (isset($_POST['deptid']) && $_POST['deptid'] == $dept->id) {
                                    echo "<option selected value='$dept->id'>$dept->name</option> ";
                                } else {
                                    echo "<option value='$dept->id'>$dept->name</option> ";
                                }
                            }
                            ?>
                        </select> 
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <label class="control-label">Select Doctor <span class="required">*</span>
                        </label>
                        <select name="docid" id="docid" class="wp-form-control wpcf7-select">
                            <option val="0">Chose Department First</option>                            
                        </select> 
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <label class="control-label">Appointment Date<span class="required">*</span>
                        <input class="form-control wp-form-control wpcf7-select apdate" type='text' name='ap_date' id='datepicker' /></div>
<!--                    <div class="col-md-6 col-sm-6">
                        <label class="control-label">UHID<span class="required">*</span>
                        <input class="form-control wp-form-control wpcf7-select apdate" type='text' name='uhid' id="uhid"/></div>                     -->

<!--                    <div class="form-group">                        
                        <input type="radio" selected name="gen" id="gen1" value="1"> Old Patient
                    </div>-->

                    <div class="col-sm-12">

                        <div class="slot" id="uzzal"></div>
                    </div>
                </div>            
                <button id="appoinment" name="sub" class="wpcf7-submit button--itzel" type="submit"><i class="button__icon fa fa-share"></i><span>Book Appointment</span></button> 
                <h4 style="color: darkred">For new patient please? <a href="index.php?f=sign_up">Click Here</a></h4>
            </form>
        </div>
    </div>
</section> 

<?php
$alldept = $d->view("department", "*", array("name", "asc"));
?>
<script>
    $(document).ready(function () {

        $("body").on("change", "#docid", function () {
            var docid = parseInt($(this).val());
            if (docid > 0) {
                $.ajax({
                    type: 'GET',
                    data: {
                        "ids": docid
                    },
                    url: "ajax/appoinment.php",
                    success: function (data) {
                        $("#uzzal").html(data);
                    }
                });
            }
        });

        $("body").on("click", ".schedule", function () {
            if (!$(this).hasClass("active")) {
                if ($(this).hasClass("current")) {
                    $(this).removeClass("current");
                } else {
                    $(".schedule").removeClass("current");
                    $(this).addClass("current");
                }
                var slot = parseInt($(this).attr("id"));
                $("#slot").val(slot);
            }
        });

        $("select[name='deptid']").change(function () {
            $("select[name='docid']").html("");
            var dep = $(this).val();
            if (dep == 0) {
                $("select[name='docid']").append("<option value='0'>Choose Country First</option>");
            }


<?php
while ($dept = $alldept->fetch_object()) {
    echo "else if (dep == $dept->id) {";
    echo "$(\"select[name = 'docid']\").append(\"<option value='0'>Choose Doctor</option>\");";
    $alldoc = $d->view("doctor", "*", array("name", "asc"), array("departmentid" => $dept->id));
    while ($doc = $alldoc->fetch_object()) {
        echo "$(\"select[name = 'docid']\").append(\"<option value='$doc->id'>$doc->name</option>\");";
    }
    echo "}";
}
?>
        });
    });

</script>


<script>

//    $(document).ready(function () {
//        $("#appoinment").click(function () {
////            var depid = $(".depid").val();
////            alert (depid);
////            var docid = $("#docid").val();
////            alert (docid);
////            var apdate = $(".apdate").val();
////            alert (apdate);
////            var slot = $("#uzzal").html();
////            alert (slot);
//            $("#uzzal").click(function(){
//                
//            });
////            if (fdate != '' && tdate != '') {
////                $.ajax({
////                    type: 'GET',
////                    url: 'ajax/admission_report.php',
////                    data: {
////                        "fdate": fdate,
////                        "tdate": tdate
////
////                    },
////                    success: function (data)
////                    {
////                        alert(data);
////                       $(".m").remove();
////                       
////                       $(".hm").after(data);                    
////                    }
////                });
////
////            } else {
////                alert('data de fokinni');
////            }
//        });
//    });

</script>

<!--<script>
    $(document).ready(function(){
        var uhid = $(".uhid").val();
        $("#uhid").mouseleave(function () {
        
           alert (uhid);
           
       });
    });
</script>-->


<style>
    .schedule{
        float: left;
        padding: 5px 10px;
        margin: 0 10px 10px 0;
        background-color: #286090;
        color: #FFF;
        cursor: pointer;
    }
    .schedule:hover, .schedule.current{
        background-color: green;        
    }
    .schedule.active{
        background-color: #F00;
        cursor: default;
    }
</style>

