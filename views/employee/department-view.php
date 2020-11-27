<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>



<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">

            <br><br><a href="index.php?e=department" class="btn btn-info">Add New Department</a>
            <a href="index.php?e=department-view" class="btn btn-info">Department View</a>
            <table class="table table-hover widefat" style="background-color: #fff; border: 1px solid #ccc; margin-top: 10px">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = $d->view("department");
                    while ($value = $data->fetch_object()) {
                        echo "<tr>";
                        echo "<td>$value->name</td>";
                        echo "<td>";
                        echo "<a href='index.php?e=department-update&id={$value->id}' class='btn btn-success'>Update</a>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='index.php?e=department-delete&id={$value->id}' class='btn btn-danger'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

