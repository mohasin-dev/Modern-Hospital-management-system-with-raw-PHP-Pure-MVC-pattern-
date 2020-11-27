<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <?php
            $d = new Database();
            if (isset($_GET['id'])) {
                $d->delete("admedicine", $_GET['id']);
            }
            ?>
            <h1>view</h1>
            <a href="index.php?e=admdicine" class="btn btn-danger">Insert</a>
            <a href="index.php?e=admdicine-view" class="btn btn-info">View</a>
            <br><br>
            <table border="1" class="table table-striped table-hover">

                <tr>
                    <th>admissionid</th>
                    <th>quantity</th>
                     <th>medicineid</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                $data = $d->view("admedicine", "*");
                while ($value = $data->fetch_object()) {
                    echo "<tr>";
                    echo "<td>{$value->admissionid}</td>";
                    echo "<td>{$value->quantity}</td>";
                      echo "<td>{$value->medicineid}</td>";
                    echo "<td><a href='index.php?e=admdicine-edit&id={$value->id}' class='btn btn-info'>Edit</a></td>";
                    echo "<td><a href='index.php?e=admdicine-view&id={$value->id}' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>

            </table>
        </div>
    </div>
</section>
