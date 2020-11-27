<?php
$data = $d->view("admission", "*", "", array("id" => $_GET['id']));
while ($value = $data->fetch_object()) {
    $releaseDate = $value->releasedate;
}
if ($releaseDate == '') {
    ?>

    <section id="blogArchive">      
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="blog-breadcrumbs-area">
                    <div class="container">
                        <div class="blog-breadcrumbs-left">
                            <h2>Release Info</h2>
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

        <div class="container">
            <div class="col-lg-9 col-md-9 col-sm-9">
                <div class="section-heading">
                    <h2>Release Receipt</h2>
                    <div class="line"></div>
                </div>


                <div><span class="name">Admission ID</span>:<span class="info">
                        <?php
                        $relData = $d->view("admission", "*", "", array("id" => $_GET['id']));
                        while ($value = $relData->fetch_object()) {
                            echo "<tr>";
                            echo "<td>{$value->id}</td>";
                            ?>
                        </span></div>
                    <div> <span class="name">Patient Name</span>:<span class="info">
                            <?php
                            if ($value->patientid) {
                                $allPat = $d->view("patient", "*", '', ['id' => $value->patientid]);
                                while ($row = $allPat->fetch_object()) {
                                    ?>
                                    <td><?php echo $row->name ?></td>
                                    <?php
                                }
                            }
                            ?>
                        </span></div>
                    <div><span class="name">Doctor Name</span>:<span class="info">
                            <?php
                            if ($value->doctorid) {
                                $allDoc = $d->view("doctor", "*", '', ['id' => $value->doctorid]);
                                while ($row = $allDoc->fetch_object()) {
                                    ?>
                                    <td><?php echo $row->name ?></td>
                                    <?php
                                }
                            }
                            ?>
                        </span></div>
                    <div><span class="name">Admission Date</span>:<span class="info">
                            <?php echo "<td>{$value->admissiondate}</td>" ?>
                        </span></div>

                    <table class="table table-striped table-hover">

                        <tr>
                            <td>Admission fees<span style="float: right">:</span></td>

                            <td> <?php
                                $adfees = $value->admissionfees;
                                echo $adfees
                                ?>
                            </td>                   
                        </tr>

                        <?php
//                    $date_expire = $value->admissiondate;
//                    $date = new DateTime($date_expire);
//                    $now = new DateTime();
//                    $day = $date->diff($now)->format("%d");
//                    echo $day;
//                        echo $date->diff($now)->format("%d days, %h hours and %i minuts");
                        ?>


                        <tr>
                            <td>seat<span style="float: right">:</span></td>
                            <td><?php
                                $date_expire = $value->admissiondate;
                                $date = new DateTime($date_expire);
                                $now = new DateTime();
                                $day = $date->diff($now)->format("%d");
                                //echo $day;

                                if ($value->seatid) {
                                    $dataDeg = $d->view("seat", "*", "", ['id' => $value->seatid]);
                                    while ($valueDeg = $dataDeg->fetch_object()) {
                                        $seat = $valueDeg->amount;
                                        //echo $seat;
                                        $seatrent = $seat * $day;
                                        echo $seatrent;
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Doctor fees<span style="float: right">:</span></td>
                            <td><?php
                                $dfees = 1000;
                                $socfees = $dfees * $day;
                                echo $socfees;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Medicine Charge<span style="float: right">:</span></td>
                            <td><?php
                                $id = $value->id;
                                $dataDeg = $d->admfees($id);
                                while ($valueDeg = $dataDeg->fetch_object()) {
                                    $medicharge = $valueDeg->total;
                                    echo $medicharge;
                                }
                                ?>
                            </td> 

                        </tr>
                        <tr>
                            <td>Diagnostic Charge<span style="float: right">:</span></td>
                            <td><?php
                                $id = $value->id;
                                $diag = $d->addfees($id);
                                while ($dia = $diag->fetch_object()) {
                                    $diagCharge = $dia->total;
                                    echo $diagCharge;
                                }
                                ?>
                            </td> 

                        </tr>
                        <tr>
                            <td>Total <span style="float: right">:</span></td>
                            <td>
                                <?php
                                $total = ($adfees + $seatrent + $socfees + $medicharge + $diagCharge);
                                echo $total;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Paid <span style="float: right">:</span></td>
                            <td>
                                <?php
                                $id = $value->id;
                                $tpaid = $d->totalPaid($id);
                                while ($paid = $tpaid->fetch_object()) {
                                    $totalPaid = $paid->total;
                                    echo $totalPaid;
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Due<span style="float: right">:</span></td>
                            <td>
                                <?php
                                $due = $total - $totalPaid;
                                echo $due;
                                ?>
                            </td>
                        </tr>

                        <?php
                    }
                    ?>
                </table>

                <?php
                if (isset($_POST['sub'])) {
                    if ($total == $totalPaid) {
                        $release = date("Y-m-d H:i:s");
                        $data = array(
                            "releasedate" => $release
                        );
                        //print_r($data);
                        if ($d->update("admission", $data, array("id" => $_GET['id']))) {
                            //Redirect("index.php?e=generic_view");
                            echo "<h3>The patient is Released</h3>";
                        }
                    } else {
                        echo "<h3>Please pay your patment<h3>";
                    }
                }
                ?>

                <form action="" method="post">

                    <input class="btn btn-success" type="submit" name="sub"  value="Release"/>
                </form><br><br>


            </div>
        </div>
    </section>

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

<?php } else {
    ?>
    <section id="blogArchive">      
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="blog-breadcrumbs-area">
                    <div class="container">
                        <div class="blog-breadcrumbs-left">
                            <h2>Release Info</h2>
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
    <section id="">      
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <p>you are released</p>
            </div>        
        </div>      
    </section>


<?php }
?>
