<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <?php
            $d = new Database();
            if (isset($_GET['id'])) {
                $data = $d->delete("customer", $_GET['id']);
                if ($data > 0) {
                    echo "Delete Successfull";
                } else {
                    echo $d->Error;
                }
            }
            ?>
            <h1>view</h1>
            <a href="index.php?e=customer" class="btn btn-danger">customer</a>
            <a href="index.php?e=customer-views" class="btn btn-info">customer Name</a>
            <br><br>

            <table border="2" style="border-color: crimson;" class="table table-striped table-hover">

                <tr>
                    <th>customer-view</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
                <?php
                $data = $d->view("customer");
                while ($value = $data->fetch_object()) {

                    echo "<tr>";
                    echo "<td>{$value->name}</td>";
                    echo "<td><a href='index.php?e=customer-update&id={$value->id}' class='btn btn-danger'>Edit</a></td>";
                    echo "<td><a href='index.php?e=customer-views&id={$value->id}' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</section>
