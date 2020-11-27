<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <h1 style="color: darkred">Diagnostic Available</h1>
            <a href="index.php?e=diagnostic" class="btn btn-info">Add New Diagnostic Info</a>
            <a href="index.php?e=diagnostic-view" class="btn btn-info">Diagnostic Info View</a> <br><br>


            <table class="table table-striped table-hover" border="1px solid black">
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Doctor Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                $data = $d->view("diagnostic");
                while ($value = $data->fetch_object()) {
                    echo "<tr>";
                    echo "<td>{$value->name}</td>";
                    echo "<td>{$value->amount}</td>";
                    if ($value->doctorid) {
                        $allDoc = $d->view("doctor", "*", '', ['id' => $value->doctorid]);
                        while ($row = $allDoc->fetch_object()) {
                            ?>
                            <td><?php echo $row->name ?></td>
                            <?php
                        }
                    }

                    echo "<td><a href='index.php?e=diagnostic-edit&id={$value->id}' class='btn btn-success'>Edit</a></td>";
                    echo "<td><a href='index.php?e=diagnostic-delete&id={$value->id}' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>

        </div>
    </div>
</section>