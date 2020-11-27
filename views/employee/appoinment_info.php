
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
                <h2>APPOINMENT CONFIRMATION MESSAGE</h2>
                <div class="line"></div>
            </div>



            <?php
            $relData = $d->view("apointment", "*", "", array("patientid" => $_SESSION['id']));
            while ($value = $relData->fetch_object()) {
                echo "<tr>";
                ?>
                </span></div>
            <div><span class="name">Name</span>:<span class="info">
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
                    <td><?php echo strtoupper($row->name) ?></td>
                            <?php
                        }
                    }
                    ?>
                </span></div>
            <div><span class="name">Booking Date</span>:<span class="info">
                    <?php echo "<td>{$value->ap_date}</td>" ?>
                </span></div>

            <div><span class="name">Booking Time</span>:<span class="info">
                    <?php echo "<td>{$value->slot}</td>" ?>
                </span></div>

            <div><span class="name">Email</span>:<span class="info">
                    <?php
                    if ($value->patientid) {
                        $allPat = $d->view("patient", "*", '', ['id' => $value->patientid]);
                        while ($row = $allPat->fetch_object()) {
                            ?>
                            <td><?php echo $row->email ?></td>
                            <?php
                        }
                    }
                    ?>
                </span></div>

            <div><span class="name">Mobile Number</span>:<span class="info">
                    <?php
                    if ($value->patientid) {
                        $allPat = $d->view("patient", "*", '', ['id' => $value->patientid]);
                        while ($row = $allPat->fetch_object()) {
                            ?>
                            <td><?php echo $row->contact ?></td>
                            <?php
                        }
                    }
                    ?>
                </span></div>

            <div><span class="name">Total Amount</span>:<span class="info">
                    <?php
                    if ($value->doctorid) {
                        $allDoc = $d->view("doctor", "*", '', ['id' => $value->doctorid]);
                        while ($row = $allDoc->fetch_object()) {
                            ?>
                            <td><?php echo $row->fees ?></td>
                            <?php
                        }
                    }
                    ?>
                </span></div>


        <br><a href="" class="btn btn-primary btn-sm">Back</a>
        <a href="" class="btn btn-success btn-sm">CONFIRM</a><br><br>
            <?php
            break;
        }
        ?>         
    </div>
</div>
</section>

<style>
    span.name {
        width: 25%;
        display: inline-block;
        margin: 5px;
        font-weight: bold
    }

    span.info {
        padding-left: 20px;
        width: 65%;
        margin: 5px;
    }

</style>

