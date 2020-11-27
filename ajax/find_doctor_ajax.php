
<?php
	require '../models/database.php';
	header('Content-Type: application/json');
		
	$arr = array();	
//	$search = " where name like '%{$_GET['name']}%'";			
//	$sql = $db->query("select id, name from doctor $search order by id desc limit 10");
        $d->wildcard("doctor", "*", "name");
	while($d = $sql->fetch_object()){
		$arr[] = $d;
	}
	
	echo json_encode($arr);
?>

<!--public function wildcard($table, $sel, $card) {
        $sql = "select $sel from $table where {$card[0]} LIKE '%{$card[1]}%'";
        return $this->db->query($sql);
    }-->