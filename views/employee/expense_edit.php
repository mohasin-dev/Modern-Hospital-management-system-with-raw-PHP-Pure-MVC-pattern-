<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <h1 style="color: darkred">Hospital Expenses Update</h1>

            <?php
            
            if (isset($_POST['sub'])) {
                $data = array(
                    "title" => $d->VD($_POST['title']),
                    "amount" => $d->VD($_POST['aname']),
                    "date" => $d->VD($_POST['dname'])
                );

                if ($d->update("expense", $data, array("id" => $_GET['id']))) {
                    Redirect("index.php?e=expense_view");
                } else {
                    echo $d->Error;
                }
            }
            ?>
            
            <?php
            $color = $d->view('expense', '*', '', ['id' => $_GET['id']]);
            ($row = $color->fetch_object());

            ?>

            <form action="" method="post" enctype="multipart/form-data">
         
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" class="form-control" id="name" placeholder="Expense issue" name="title" value="<?Php echo $row->title ?>">
                </div>
                <div class="form-group">
                    <label for="name">Amount</label>
                    <input type="text" class="form-control" id="name" placeholder="Amount" name="aname" value="<?Php echo $row->amount ?>">
                </div>
                <div class="form-group">
                    <label for="name">Date</label>
                    <input type="date" class="form-control" id="name" placeholder="Expense name" name="dname" value="<?Php echo $row->date ?>">
                </div>
                    <input type="submit" name="sub" class="btn btn-info" value="Update" />
                </div>
            </form>
    </div>
</div>
</section>