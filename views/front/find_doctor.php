<section id="blogArchive">
    <div class="container">
        <div class="col-md-12">

            <h1 style="color: darkred">Find Your Doctor</h1>
            <form action="search.php" method="post">
                <input type="text" name="search" placeholder="I am looking for..." onkeydown="searchq();">
                <input type="submit" value=">>"
            </form>
        </div>
    </div>
</section>

<div id="output">

</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<script>
                    function searchq() {
                        var searchTxt = $("input[name='search']").val();
                        $.post("ajax/ajax_search.php", {searchVal: searchTxt}, function (output) {
                            $("#output").html(output);
                        });
                        return false;
                    }
</script>
