<?php

class Database {

    protected $db;
    public $Error;
    public $Id;

    function __construct() {
        $this->db = new mysqli("localhost", "root", "", "hospital");
    }

    public function VD($data) {
        return htmlentities(strip_tags(trim(mysqli_real_escape_string($this->db, $data))));
    }

    public function insert($table, $arr) {
        $sql = "";
        foreach ($arr as $key => $value) {
            if ($sql != "") {
                $sql .= ", ";
            }
            $sql .= "{$key}='{$value}'";
        }

        $sql = "insert into {$table} set " . $sql;

        if ($this->db->query($sql)) {
            $this->Id = $this->db->insert_id;
            return TRUE;
        } else {
            $this->Error = $this->db->error;
            return FALSE;
        }
    }

    public function update($table, $arr, $where) {
        $sql = "";
        foreach ($arr as $key => $value) {
            if ($sql != "") {
                $sql .= ", ";
            }
            $sql .= "{$key}='{$value}'";
        }

        $sql = "update {$table} set " . $sql;

        $temp = "";
        if ($where) {
            foreach ($where as $key => $value) {
                if ($temp != "") {
                    $temp .= " and ";
                }
                $temp .= "{$key}='{$value}'";
            }
            $sql .= " where $temp";
        }

        if ($this->db->query($sql)) {
            echo "Password Change Successful";
        } else {
            //echo $this->db->error;
            echo "Server too busy";
        }
    }

    public function view($table, $order = NULL, $where = NULL) {
        $sql = "SELECT * FROM $table";

        $temp = "";
        if ($where) {
            foreach ($where as $key => $value) {
                if ($temp != "") {
                    $temp .= " and ";
                }
                $temp .= "{$key}='{$value}'";
            }
            $sql .= " where $temp";
        }
        if ($order) {
            $sql .= " order by {$order[0]} {$order[1]}";
        }
        return $this->db->query($sql);
    }

    public function delete($table, $id) {
        $sql = "delete from $table where id = $id";
        $this->db->query($sql);
        return $this->db->affected_rows;
    }
    
    public function wildcard($table, $sel, $card) {
        $sql = "SELECT $sel FROM $table WHERE {$card[0]} LIKE '%{$card[1]}%'";
        //echo $sql;
        return $this->db->query($sql);
       
    }
    public function datesearch($table, $field, $date) {
        $sql = "SELECT * FROM $table WHERE $field BETWEEN '{$date[0]}' AND '{$date[1]}'";
        //echo $sql;
        return $this->db->query($sql);
       
    }

}
//SELECT
//    medicine.name,
//   sales.id,
//    sum(salesdetails.quantity) sqty
//FROM
//    medicine,
//    sales,
//    salesdetails
//WHERE
//    medicine.id = salesdetails.medicineid AND sales.id = salesdetails.salesid
//    AND sales.date LIKE '%2018-05-25%'
//    GROUP BY medicine.name
//SELECT * FROM `sales_report` WHERE date BETWEEN '2018-06-02' AND '2018-06-09' 

//CREATE view sales_report AS SELECT medicine.name,medicine.price,medicine.purchaseprice, sales.date,
// sum(salesdetails.quantity) sqty FROM medicine, sales, salesdetails WHERE medicine.id = salesdetails.medicineid AND
// sales.id = salesdetails.salesid GROUP BY medicine.name 