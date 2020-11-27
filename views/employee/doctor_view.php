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
//                $d->delete("doctor", $_GET['id']);
//            }
            ?>


            <h1 style="color: darkred">Doctor's Informations View</h1>
            <a href="index.php?e=doctor" class="btn btn-info">Doctor's Informations Insert</a>
            <a href="index.php?e=doctor_view" class="btn btn-info">Doctor's Informations View</a>
            <br /><br /><br />

            <table class="table table-striped table-hover" border="1px" style="border: 1px solid #970001">
                <tr>
                    <th>Doctor Name</th>
                    <th>Doctor Email</th>
                    <th>Doctor designationid</th>
                    <th>Doctor departmentid</th>
                    <th>Doctor Fees</th>                
                    <th>Doctor Contact</th>
                    <th>Institute</th>
                    <th>Doctor Picture</th>                   
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                $data = $d->view("doctor", "*");
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

                    if ($value->departmentid) {
                        $dataDept = $d->view("department", "*", '', ['id' => $value->departmentid]);
                        while ($valueDept = $dataDept->fetch_object()) {
                            ?>
                            <td>
                                <?php echo $valueDept->name
                                ?>
                            </td>
                            <?php
                        }
                    }
                    echo "<td>{$value->fees}</td>";
                    echo "<td>{$value->contact}</td>";
                    echo "<td>{$value->institute}</td>";
                    echo "<td>";
                    if ($value->picture) {
                        ?>
                        <img src='images/doctor/pic/<?php echo md5("ab-1" . $value->id . "idb") ?>.<?php echo ($value->picture) ?>' width='100' />

                        <?php
                    } else {
                        echo "<img src='images/doctor/pic/no-image.png' width='100' />";
                    }
                    echo "</td>";
                    echo "<td><a href='index.php?e=doctor_edit&id={$value->id}' class='btn btn-success'>Edit</a></td>";
                    echo "<td><a href='index.php?e=doctor_delete&id={$value->id}' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>


            </table>

        </div>
    </div>
</section>
