<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">

         

            <h1 style="color: darkred">Medecine's Generic Informations view</h1>
            <a href="index.php?e=generic" class="btn btn-info">Generic Insert</a>
            <a href="index.php?e=generic_view" class="btn btn-info">Generic View</a>
            <br /><br /><br />
            <table class="table table-striped table-hover" border="1px" style="border: 1px solid #970001">
                <tr>
                    <th>Generic Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
         
                $data = $d->view("generic", "*");
                while ($value = $data->fetch_object()) {
                    echo "<tr>";
                    echo "<td>{$value->name}</td>";
                    echo "<td><a href='index.php?e=generic_edit&id={$value->id}' class='btn btn-success'>Edit</a></td>";
                    echo "<td><a href='index.php?e=generic_delete&id={$value->id}' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>


            </table>

        </div>
    </div>
</section>