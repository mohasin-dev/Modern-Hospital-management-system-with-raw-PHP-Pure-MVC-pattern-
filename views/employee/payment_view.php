<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <h1 style="color: darkred">Payment Method Available</h1>
            <a href="index.php?d=payment_insert" class="btn btn-info">Add Payment Method</a>
            <a href="index.php?d=payment_view" class="btn btn-info">Payment Method</a>
            <br /><br /><br /><br />

            <?php
            $d = new Database();
            if (isset($_GET['id'])) {
                $d->delete("payment", $_GET['id']);
            }
            ?>

            <table class="table table-striped table-hover" border="1px solid black">
                <tr>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                $data = $d->view("payment");
                while ($value = $data->fetch_object()) {
                    echo "<tr>";
                    echo "<td>{$value->name}</td>";
                    echo "<td><a href='index.php?d=payment_edit&id={$value->id}' class='btn btn-danger'>Edit</a></td>";
                    echo "<td><a href='index.php?d=payment_view&id={$value->id}' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>

        </div>
    </div>
</section>