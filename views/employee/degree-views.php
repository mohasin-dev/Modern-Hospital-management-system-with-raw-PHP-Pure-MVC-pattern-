<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <?php
            $d = new Database();
            if (isset($_GET['id'])) {
                $data = $d->delete("degrees", $_GET['id']);
                if ($data > 0) {
                    echo "Delete Successfull";
                } else {
                    echo $d->Error;
                }
            }
            ?>
            <h1>view</h1>
            <a href="index.php?e=degree" class="btn btn-danger">Degrees</a>
            <a href="index.php?e=degree-views" class="btn btn-info">Degrees Name</a>
            <br><br>

            <table border="2" style="border-color: crimson;" class="table table-striped table-hover">

                <tr>
                    <th>Degrees-view</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
                <?php
                $data = $d->View("degrees", "*", array("id", "asc"));
                while ($value = $data->fetch_object()) {

                    echo "<tr>";
                    echo "<td>{$value->name}</td>";
                    echo "<td><a href='index.php?e=degree-update&id={$value->id}' class='btn btn-danger'>Edit</a></td>";
                    echo "<td><a href='index.php?e=degree-views&id={$value->id}' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</section>
