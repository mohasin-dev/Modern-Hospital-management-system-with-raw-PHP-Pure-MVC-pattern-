<section id="blogArchive">
    <div class="container">
        <div class="col-md-6">
            <?php
            $d = new Database();
            if (isset($_GET['id'])){
                $d->delete("specialist", $_GET['id']);
            }
            ?>
            <h1>view</h1>
            <a href="index.php?e=specialist" class="btn btn-danger">specialist-Insert</a>
            <a href="index.php?e=specialist-view" class="btn btn-info">specialist-view</a>
            <br><br>
            <table border="1" class="table table-striped table-hover">

                <tr>
                    <th>specialist-view</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                $data = $d->view("specialist");
                while ($value = $data->fetch_object()) {
                    echo "<tr>";
                    echo "<td>{$value->name}</td>";
                    echo "<td><a href='index.php?e=specialist-edit&id={$value->id}' class='btn btn-info'>Edit</a></td>";
                    echo "<td><a href='index.php?e=specialist-view&id={$value->id}' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>






            </table>


        </div>

    </div>



</section>
