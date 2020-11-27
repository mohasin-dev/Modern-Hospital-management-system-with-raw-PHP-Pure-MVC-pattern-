<section id="blogArchive">
    <div class="container">
        <div class="col-md-12">
            <h1 style="color: darkred">Payment Method Available</h1>
            <a href="index.php?e=ambulancecharge" class="btn btn-info">Add Ambulance Charge</a>
            <a href="index.php?e=ambulancecharge-view" class="btn btn-info">All Ambulance Charge</a>
            <br /><br /><br /><br />

            <?php
            $d = new Database();
            if (isset($_GET['id'])) {
                $d->delete("ambulancecharge", $_GET['id']);
            }
            ?>

            <table class="table table-striped table-hover" border="1px solid black">
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Contact</th>
                    <th>Ambulance Type</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                $data = $d->view("ambulencecharge");
          
                while ($value = $data->fetch_object()) {
                    echo "<tr>";
                    echo "<td>{$value->name}</td>";
                    echo "<td>{$value->date}</td>";
                    echo "<td>{$value->amount}</td>";
                    echo "<td>{$value->contact}</td>";
                    if ($value->ambulanceid) {
                        $dataDeg = $d->view("ambulance", '', ['id' => $value->ambulanceid]);
                        while ($valueDeg = $dataDeg->fetch_object()) {
                            ?>
                            <td>
                                <?php echo $valueDeg->type
                                ?>
                            </td>
                            <?php
                        }
                    }
                    
                    echo "<td><a href='index.php?d=ambulancecharge-edit&id={$value->id}' class='btn btn-danger'>Edit</a></td>";
                    echo "<td><a href='index.php?d=ambulancecharge-view&id={$value->id}' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>

        </div>
    </div>
</section>