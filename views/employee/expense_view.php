<?php
if (!isset($title)) {
    header("Location: index.html");
}
?>
<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            
             <?php
             
                if(isset($_GET['id'])){
                    $d->delete("expense", $_GET['id']);
                }
                ?>
            
            <h1 style="color: darkred">Hospital's Expenses Details View</h1>
            <a href="index.php?e=expense" class="btn btn-info">Expenses Insert</a>
            <a href="index.php?e=expense_view" class="btn btn-info">Expenses View</a>
            <br /><br /><br />
            <table class="table table-striped table-hover" border="1px" style="border: 1px solid #970001">
                <tr>
                    <th>Expense Issue</th>
                    <th>Expense Amount</th>
                    <th>Expense Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
        
                $data = $d->view("expense", "*");
                while ($value = $data->fetch_object()) {
                    echo "<tr>";
                    echo "<td>{$value->title}</td>";
                    echo "<td>{$value->amount}</td>";
                    echo "<td>{$value->date}</td>";
                    echo "<td><a href='index.php?e=expense_edit&id={$value->id}' class='btn btn-success'>Edit</a></td>";
                    echo "<td><a href='index.php?e=expense_delete&id={$value->id}' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
                
               
            </table>

        </div>
    </div>
</section>