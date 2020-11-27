
<script>
        $("select[name='cntid']").change(function () {
            $("select[name='ctid']").html("");
            var cnt = $(this).val();
            if (cnt == 0) {
                $("select[name='ctid']").append("<option value='0'>Choose Country First</option>");
            }


<?php
$allcnt2 = $d->view("country", array("name", "asc"));

while ($country2 = $allcnt2->fetch_object()) {
    echo "else if (cnt == $country2->id) {";
    $cityAgain = $d->view("city", array("name", "asc"), array("countryid" => $country2->id));
    while ($city2 = $cityAgain->fetch_object()) {
        echo "$(\"select[name = 'ctid']\").append(\"<option value='$city2->id'>$city2->name</option>\");";
    }
    echo "}";
}
?>
            /*
             else if(cnt == 1){
             $("select[name = 'ctid']").append("<option value='1'>ABC</option>");  
             }
             else if(cnt == 2){
             $("select[name = 'ctid']").append("<option value='1'>ABCD</option>");
             $("select[name = 'ctid']").append("<option value='1'>ABCE</option>");
             $("select[name = 'ctid']").append("<option value='1'>ABCF</option>");
             
             }
             */
        });
    });
</script>

