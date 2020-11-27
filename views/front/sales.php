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
                        <h2>Sales</h2>
                        <div class="line"></div>
                    </div>
                    <?php
                    //session_destroy();
                    if (isset($_SESSION['price'])) {
                        print_r($_SESSION['mdid']);
                        print_r($_SESSION['qty']);
                         print_r($_SESSION['name']);
                          print_r($_SESSION['price']);
                    }
                    $d = new Database();
                 
                    ?>

                    <p>Fill out all required Field to send a Message. Please don't spam,Thank you!</p>
                    <form class="submitphoto_form" action="#" method="post" >
                        <div class="col-md-5 col-sm-5">

                            <input type="text" class="wp-form-control wpcf7-text" id="med" placeholder="Medicine Name">
                            <div id="medicinelist"></div>
                        </div>
                        <div class="col-md-3 col-sm-3">

                            <input type="number" class="wp-form-control wpcf7-text" id="qty" min="1" placeholder="Quantity">
                        </div>
                        <!--                        <div class="col-md-2 col-sm-2">
                                                    <input type="number" class="wp-form-control wpcf7-text" max="8" min="0" placeholder="Disc">
                                                </div>-->
                        <div class="col-md-2 col-sm-2">

                            <input type="button" class="wp-form-control wpcf7-text reply-btn" id="add" value="Add">
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

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Medicine</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Sub Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody id="addrow">
                            <?php
                            $total = 0;
                            if (isset($_SESSION['price'])) {

                                foreach ($_SESSION['price'] as $key => $price) {
                                    $total += ($_SESSION['qty'][$key] * $_SESSION['price'][$key]);
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $key + 1; ?></th>
                                        <td><?php echo $_SESSION['name'][$key]; ?></td>
                                        <td id="qty-<?php echo $_SESSION['mdid'][$key]; ?>"><?php echo $_SESSION['qty'][$key]; ?></td>
                                        <td><?php echo $_SESSION['price'][$key]; ?></td>
                                        <td id="total-<?php echo $_SESSION['mdid'][$key]; ?>"><?php echo ($_SESSION['qty'][$key] * $_SESSION['price'][$key]); ?></td>
                                        <td class="btn btn-info remove" id="<?php echo $_SESSION['mdid'][$key]; ?>">Del</td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">
                                    Total
                                </th>
                                <td id="gtotal"><?php echo $total; ?></td>
                            </tr>
                            <tr>
                                <th colspan="4">
                                    Discount(%): 
                                    <form method="get" action="#">
                                        <input type="number" name="disc" min="0" max="10" id="disc" value="0" />
                                        <input type="button" name="sub" value="Apply" />
                                    </form>
                                    
                                </th>

                                <td id="total-disc">0</td>
                            </tr>

                            <tr>
                                <th colspan="4">
                                    Discount
                                </th>

                                <td id="paytotal">0</td>
                            </tr>

                        </tfoot>
                        
                    </table>
<input type="button" id="bill" class="wp-form-control wpcf7-text reply-btn" value="Submit" />
                </div>
            </div>
        </div>
    </div>
</section>

<script>

    $(document).ready(function () {
        $('#med').keyup(function () {
            var query = $(this).val();
            if (query != '') {
                $.ajax({
                    type: 'GET',
                    url: 'ajax/medicinesearch.php',
                    data: {
                        query: query
                    },
                    success: function (data)
                    {
                        $('#medicinelist').fadeIn();
                        $('#medicinelist').html(data);
                    }

                });

            }

        });
        var r;
        $(document).on('click', '.list', function () {
            $('#med').val($(this).text());
            $('#medicinelist').fadeOut();
            r = $(this).attr('id')
        });

        $(document).on('click', '#add', function () {
            var id = parseInt(r.substr(2));
            var qty = $('#qty').val();
           //alert(qty);
            $.ajax({
                type: 'GET',
                url: 'ajax/medicineprice.php',
                data: {
                    id: id,
                    qty: qty
                },
                success: function (data)
                {
                    alert(data);
                    if (parseInt(data['status']) == 2) {
                        alert(data['status']);
                        $("#qty-" + id).text(qty);
                        $("#total-" + id).text(data['stotal']);

                        //alert("Cart Updated");
                    } else if (parseInt(data['status']) == 1) {
                        var sl = $("#addrow tr").length + 1;
                        var html = "";
                        html += '<tr>';

                        html += '<th scope="row">' + sl + '</th>';

                        html += '<td>' + data['name'] + '</td>';
                        html += '<td>' + qty + '</td>';
                        html += '<td>' + data['price'] + '</td>';
                        html += '<td id="total-' + id + '">' + data['stotal'] + '</td>';
                        html += '<td id="' + id + '" class="btn btn-info remove">' + 'Del</td>';

                        html += '</tr>';
                        $("#addrow").append(html);


                        alert(data['status']);

                        $("#gtotal").text(data['total']);
                        // alert("Cart Added");
                    }
                }

            });
        });

        $(document).on('click', '.remove', function () {
            var did = $(this).attr('id');
            var remove = $(this).parent();
            if (did != '') {
                $.ajax({
                    type: 'GET',
                    url: 'ajax/medicinedelete.php',
                    data: {
                        did: did
                    },
                    success: function (data)
                    {
                        remove.remove();
                        alert(JSON.stringify(data['total']));
                        $("#gtotal").text(data['total']);

                        //$('#medicinelist').fadeIn();
                        //$('#medicinelist').html(data);
                    }

                });

            }
            //alert(did);
        });

        $(document).on('change', '#disc', function () {
            var disc = $('#disc').val();
            var gtotal = $('#gtotal').text();

            var discprice = gtotal * (disc / 100);
            var paytotal = gtotal - discprice;
            $('#total-disc').text(discprice);
            $('#paytotal').text(paytotal);
            //alert(discprice);

        });
        
        $(document).on('click', '#bill', function () {
            var disc = $('#disc').val();
            
           
                $.ajax({
                    type: 'GET',
                    url: 'ajax/checkout.php',
                    data: {
                        disc: disc
                    },
                    success: function (data)
                    {
                        alert(data);
                    }

                });

           
        });

    });

</script>

