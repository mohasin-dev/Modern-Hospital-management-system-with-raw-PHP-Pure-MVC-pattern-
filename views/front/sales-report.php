<section id="blogArchive">      
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="blog-breadcrumbs-area">
                <div class="container">
                    <div class="blog-breadcrumbs-left">
                        <h2>Contact</h2>
                    </div>
                    <div class="blog-breadcrumbs-right">
                        <ol class="breadcrumb">
                            <li>You are here</li>
                            <li><a href="#">Home</a></li>                  
                            <li class="active">Sales</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>        
    </div>      
</section>  

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="contact-form">
                    <div class="section-heading">
                        <h2>Medicine Sales Report</h2>
                        <div class="line"></div>
                    </div>


                    <p>Fill out all required Field to send a Message. Please don't spam,Thank you!</p>
                    <form class="submitphoto_form" action="#" method="post" >
                        <div class="col-md-4 col-sm-4">

                            <input type="text" name="from" class="wp-form-control wpcf7-text" id="from" placeholder="Start Date">
                            <div id="medicinelist"></div>
                        </div>
                        <div class="col-md-4 col-sm-4">

                            <input type="text" name="to" class="wp-form-control wpcf7-text" id="to" placeholder="End Date">
                        </div>

                        <div class="col-md-2 col-sm-2">

                            <input type="submit" name="sub" class="wp-form-control wpcf7-text reply-btn" id="search" value="Search">
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</section>

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="blog-content blog-details">
                    <div class="section-heading">
                        <h2>Medicine Recipt</h2>
                        <div class="line"></div>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sales date</th>
                                <th>Medicine</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Sub Total</th>
                                <th>Remove</th>
                            </tr>
                            <?php
                            $d = new Database();
                            if (isset($_POST['sub'])) {
                                $date = array(
                                    date('y-m-d', strtotime($_POST['from'])),
                                    date('y-m-d', strtotime($_POST['to']))
                                );
                               
                           
                                $a = $d->datesearch("sales_report", "date", $date);
                                while ($xx = $a->fetch_assoc()) {
                                    print_r($xx);
                                   
                                    echo "<tr>";
                                     echo "<td>$xx->name</td>";
                                     echo "</tr>";
                                }
                              
                            }
                            ?>

                        </thead>
                        <tbody>


                        </tbody>


                    </table>

                </div>
            </div>
        </div>
    </div>
</section>

<script>

    $(document).ready(function () {
        $('#from').change(function () {
            var query = $(this).val();
            alert(query);

        });



    });

</script>
<script>
    $(function () {
        var dateFormat = "yy-mm-dd",
                from = $("#from")
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1
                })
                .on("change", function () {
                    to.datepicker("option", "minDate", getDate(this));
                }),
                to = $("#to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1
        })
                .on("change", function () {
                    from.datepicker("option", "maxDate", getDate(this));
                });

        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }

            return date;
        }
    });
</script>

