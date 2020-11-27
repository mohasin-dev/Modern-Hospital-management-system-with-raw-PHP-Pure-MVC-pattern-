<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <?php
            $d = new Database();
            if (isset($_GET['id'])) {
                $d->delete("ambulance", $_GET['id']);
            }
            ?>
            <h1>Ambulance veiw</h1>
            <a href="index.php?e=ambulance" class="btn btn-danger">ambulance</a>
            <a href="index.php?e=ambulance-view" class="btn btn-info">ambulance Name</a>
            <br><br>

            <table border="1" class="table table-striped table-hover">

                <tr>
                    <th>ID Number</th>
                    <th>Mobile Number</th>
                    <th>Distance</th>
                    <th>Ambulance Fees</th>
                    <th>Minimum Fees</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
                <?php
                $data = $d->view("ambulance");
                while ($value = $data->fetch_object()) {

                    echo "<tr>";
                    echo "<td>{$value->id}</td>";
                    echo "<td>{$value->contactnumber}</td>";
                    echo "<td>{$value->distance}</td>";
                    echo "<td>{$value->fees}</td>";
                    echo "<td>{$value->minimumfees}</td>";
                    echo "<td><a href='index.php?e=ambulance-edit&id={$value->id}' class='btn btn-success'>Edit</a></td>";
                    echo "<td><a href='index.php?e=ambulance-view&id={$value->id}' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>

            </table>


        </div>

    </div>



</section>
