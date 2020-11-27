<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">

            <?php
//            if (isset($_GET['id'])) {
//                $d->delete("employee", $_GET['id']);
//            }
            ?>

            <h1 style="color: darkred">Employee's Informations View</h1>
            <a href="index.php?e=employee" class="btn btn-info">Employee Informations Insert</a>
            <a href="index.php?e=employee_view" class="btn btn-info">Employee Informations View</a>
            <br /><br /><br />
            <table class="table table-striped table-hover" border="1px" style="border: 1px solid #970001">
                <tr>
                    <th >Employee Name</th>
                    <th>Employee Email</th>
                    <th>Employee designationid</th>
                    <th>Employee Salary</th>
                    <th>Employee joiningdata</th>
                    <th>Employee Type</th>
                    <th>Employee Contact</th>
                    <th>Employee Picture</th>                   
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                $data = $d->view("employee", "*");
                while ($value = $data->fetch_object()) {
                    echo "<tr>";
                    echo "<td>{$value->name}</td>";
                    echo "<td>{$value->email}</td>";
                    if ($value->designationid) {
                        $dataDeg = $d->view("designation", "*", '', ['id' => $value->designationid]);
                        while ($valueDeg = $dataDeg->fetch_object()) {
                            ?>
                            <td>
                                <?php echo $valueDeg->name
                                ?>
                            </td>
                            <?php
                        }
                    }
                    echo "<td>{$value->salary}</td>";
                    echo "<td>{$value->joiningdata}</td>";
                    echo "<td>{$value->type}</td>";
                    echo "<td>{$value->contact}</td>";
                    echo "<td>";
                    if ($value->picture) {
                        ?>
                        <img src='images/employee/pic/<?php echo md5("ab-1" . $value->id . "idb") ?>.<?php echo ($value->picture) ?>' width='100' />

                        <?php
                    } else {
                        echo "<img src='images/employee/pic/no-image.png' width='100' />";
                    }
                    echo "</td>";
                    echo "<td><a href='index.php?e=employee_edit&id={$value->id}' class='btn btn-success'>Edit</a></td>";
                    echo "<td><a href='index.php?e=employee_delete&id={$value->id}' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>


            </table>

        </div>
    </div>
</section>