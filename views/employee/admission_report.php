
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script>

    $(document).ready(function () {

        $(".btn").click(function () {
            var fdate = $(".fromdate").val();
            //alert (fdate);
            var tdate = $(".todate").val();
            //alert (tdate);
            if (fdate != '' && tdate != '') {
                $.ajax({
                    type: 'GET',
                    url: 'ajax/admission_report.php',
                    data: {
                        "fdate": fdate,
                        "tdate": tdate

                    },
                    success: function (data)
                    {
                        alert(data);
                       $(".m").remove();
                       
                       $(".hm").after(data);
                       //$(".hm").insertAfter(data);
                        
                    }
                    //alert(data);
//                        $('#search').fadeIn();
//                        $('#search').html(data);
//                    }

                });

            } else {
                alert('data de fokinni');
            }


        });

//        $(document).on('click', 'li', function(){
//           $('#med').val($(this).text());
//           $('#medicinelist').fadeOut();
//        });
//        
//         $(document).on('click', '#add', function(){
//           $('#med').val($(this).text());
//           $('#medicinelist').fadeOut();
//        });

    });

</script>
<script>
    $(document).ready(function () {
        $(".btn").click(function () {
            //alert("ok");
    var fdate = ($(".fromdate").val());
    var tdate = ($(".todate").val());
            $.ajax({
                type: "GET",
                data: {
                    "fdate": 'fdate';
                    "tdate": 'tdate';
                },
                url: "ajax/admission_report.php",
                success: function (data) {
                    //alert(data);
                    $(".success").html(data)
                }



            });
        })
    }
    );</script>

<section id="blogArchive">      
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="blog-breadcrumbs-area">
                <div class="container">
                    <div class="blog-breadcrumbs-left">
                        <h2>Admission Release Report</h2>
                    </div>
                    <div class="blog-breadcrumbs-right">
                        <ol class="breadcrumb">
                            <li>You are here</li>
                            <li><a href="#">Home</a></li>                  
                            <li class="active">Release Info</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>        
    </div>      
</section>

<section id="blogArchive">      
    <div class="row">
        <div class="col-lg-12 col-md-12">




            <form action="" method="get">
                <!-- Customer -->
                <div class="form-group">                 
                    <!-- From Date -->
                    <input type="text" name="fromdate" class="fromdate" id="datepicker" >

                    <!-- To Date -->
                    <input type="text" name="todate" class="todate" id="datepicker2">
                    <button type="button" id="btn" class="btn btn-success btn-sm" name="sub" >View</button>
                </div>
            </form>

            <br>
            <?php
//            $command = "SELECT * FROM `admission` WHERE releasedate BETWEEN '2018-05-20' and '2018-05-24'";
//            $test = $d->query($command);
//            print_r($test);
            ?>
            <br>
            <table class="table table-striped table-hover" border="1px" style="border: 1px solid #970001">
                <tr class="hm">
                    <th>Admission ID</th>
                    <th>Patient name and ID</th>
                    <th>Doctor name</th>                  
                    <th>Seat name</th>
                    <th>Admission Date</th>
                    <th>Relese Date</th>
                    <th>Admission Fees</th>
                    <th>Doctor Fees</th>
                    <th>Medicine Fees</th>                   
                    <th>Diagnostic Fees</th>
                    <th>Total</th> 


                </tr>
                <?php
                $data = $d->vieww("*", "admission", "releasedate");
                $grandtotal = 0;
                while ($value = $data->fetch_object()) {
                    echo "<tr class= 'm'>";
                    echo "<td>{$value->id}</td>";
                    if ($value->patientid) {
                        $allPat = $d->view("patient", "*", '', ['id' => $value->patientid]);
                        while ($row = $allPat->fetch_object()) {
                            ?>
                            <td><?php echo $row->id . " - " . $row->name ?></td>
                            <?php
                        }
                    }
                    //echo "<td>{$value->doctorid}</td>";
                    if ($value->doctorid) {
                        $allDoc = $d->view("doctor", "*", "", ['id' => $value->doctorid]);
                        while ($rows = $allDoc->fetch_object()) {
                            ?>
                            <td><?php echo $rows->name ?></td>
                            <?php
                        }
                    }
                    //echo "<td>{$value->seatid}</td>";


                    $date_expire = $value->admissiondate;
                    $date = new DateTime($date_expire);
                    $now = new DateTime();
                    $day = $date->diff($now)->format("%d");
                    //echo $day;

                    if ($value->seatid) {
                        $dataDeg = $d->view("seat", "*", "", ['id' => $value->seatid]);
                        $seattotal = 0;
                        while ($valueDeg = $dataDeg->fetch_object()) {
                            $seatrent = 0;
                            $seatrent = ($valueDeg->amount * $day);
                            echo "<td>$valueDeg->amount x  $day = $seatrent</td>";
                            $seattotal += $seatrent;
                        }
                    }


                    echo "<td>{$value->admissiondate}</td>";
                    echo "<td>{$value->releasedate}</td>";

                    $adfees = $value->admissionfees;
                    //echo $adfees;
                    echo "<td>{$adfees}</td>";


                    $dfees = 1000;
                    $socfees = $dfees * $day;
                    //echo $socfees;
                    echo "<td>{$socfees}</td>";


                    $id = $value->id;

                    $dataDeg = $d->admfees($id);
                    $amf = 0;
                    while ($valueDeg = $dataDeg->fetch_object()) {
                        $medicharge = $valueDeg->total;
                        //echo $medicharge;
                        echo "<td>{$medicharge}</td>";
                        $amf += $medicharge;
                    }

                    $id = $value->id;
                    $diag = $d->addfees($id);
                    while ($dia = $diag->fetch_object()) {
                        $diagCharge = $dia->total;
                        //echo $diagCharge;
                        echo "<td>{$diagCharge}</td>";
                    }

                    $total = ($adfees + $seatrent + $socfees + $medicharge + $diagCharge);
                    //echo $total;
                    echo "<td>{$total}</td>";
                    $grandtotal += $total;

                    echo "</tr>";
                }
                echo "<tr class= 'm'>";
                echo "<td>Grand Total</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td>$seattotal</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td>$amf</td>";
                echo "<td></td>";
                echo "<td>$grandtotal</td>";
                echo "</tr>";
                ?>



            </table>


        </div>
    </div>
</section>
<!--<script src="assets/js/jquery-3.2.1.min.js"></script>-->



<style>
    span.name {
        width: 25%;
        display: inline-block;
        margin: 25px;
        font-weight: bold
    }

    span.info {
        padding-left: 20px;
        width: 65%;
        margin: 25px;
    }

</style>

<?php echo $seattotal; ?>