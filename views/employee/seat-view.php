<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <?php
            $d = new Database();
            if (isset($_GET['id'])) {
                $d->delete("seat", $_GET['id']);
            }
            ?>
            <h1>view</h1>
            <a href="index.php?e=seat" class="btn btn-info">Add New Seat</a>
            <a href="index.php?e=seat-view" class="btn btn-info">Seat View</a>
            <br><br>
            <table border="1" class="table table-striped table-hover">

                <tr>
                    <th>Seat-view</th>
                    <th>Amount</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                //index.php?e=seat-view&id={$value->id}
                $data = $d->view("seat", "*");
                while ($value = $data->fetch_object()) {
                    echo "<tr class='del-{$value->id}'>";
                    echo "<td>{$value->name}</td>";
                    echo "<td>{$value->amount}</td>";
                    echo "<td><a href='index.php?e=seat-edit&id={$value->id}' class='btn btn-success'>Edit</a></td>";
                    echo "<td><a href='' id='{$value->id}' class='btn btn-danger remove'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>

            </table>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(".remove").click(function () {
        var id = $(this).attr("id");
        
        if (confirm('Are you sure to remove this record ?'))
        {
            $.ajax({
                url: 'ajax/delete.php',
                type: 'GET',
                data: {id: id},
                error: function () {
                    alert('Something is wrong');
                },
                success: function (data) {
                    alert(data);
                    $("#" + id).remove();
                    alert("Record removed successfully");
                }
            });
        }
    });


</script>
