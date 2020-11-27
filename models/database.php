<?php

class Database {

    protected $db;
    public $Error;
    public $Id;

    function __construct() {
        $this->db = new mysqli("localhost", "root", "", "hospital");
    }

    public function minutes($time) {
        $time = explode(':', $time);
        return ($time[0] * 60) + ($time[1]) + ($time[2] / 60);
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

        $sql = "insert into $table set " . $sql;

        //echo $sql;
        if ($this->db->query($sql)) {
            $this->Id = $this->db->insert_id;
            return true;
        } else {
            $this->Error = $this->db->error;
            return false;
        }
    }

    public function update($table, $arr, $where = NULL) {
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
//        return $sql;
        if ($this->db->query($sql)) {
            //echo "<h3 style='color:#029241'>Password changed successfully</h3>";
            return true;
        } else {
            //echo $this->db->error;
            //echo "<h3 style='color:#FAB005'>Server is too busy</h3>";
            return false;
        }
    }

    public function view($table, $sel = NULL, $order = NULL, $where = NULL) {

        if ($sel == TRUE) {
            $sql = "select $sel from $table";
        } else {
            $sql = "select * from $table";
        }


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
        //echo $sql;
        //return $sql;


        return $this->db->query($sql);
    }

    public function viewTwoTable($table, $order = NULL, $where = NULL, $select = NULL, $rel = NULL) {
        $select = ($select == NULL) ? "*" : $select;
        $sql = "SELECT $select FROM $table";

        $temp1 = "";
        if ($rel) {
            foreach ($rel as $key => $value) {
                if ($temp1 != "") {
                    $temp1 .= " and ";
                }
                $temp1 .= "{$key}={$value}";
            }
        }
        $temp2 = "";
        if ($where) {
            foreach ($where as $key => $value) {
                if ($temp2 != "") {
                    $temp2 .= " and ";
                }
                $temp2 .= "{$key}='{$value}'";
            }
        }
        if ($temp1 != "" || $temp2 != "") {
            if ($temp1 != "" && $temp2 != "") {
                $sql .= " where $temp1 and $temp2";
            } else if ($temp1 != "") {
                $sql .= " where $temp1";
            } else if ($temp2 != "") {
                $sql .= " where $temp2";
            }
        }
        if ($order) {
            $sql .= " order by {$order[0]} {$order[1]}";
        }
        //echo $sql;
        return $this->db->query($sql);
    }

    public function delete($table, $id = NULL) {
        $sql = "delete from $table where id = $id";
        $this->db->query($sql);
        return $this->db->affected_rows;
    }

    public function wildcard($table, $sel, $card) {
        $sql = "select $sel from $table where {$card[0]} LIKE '%{$card[1]}%'";
        return $this->db->query($sql);
    }

    public function admfees($id) {
        $sql = "SELECT sum(admedicine.quantity * medicine.price) as total 
FROM admedicine, medicine
WHERE admedicine.medicineid = medicine.id AND
admedicine.admissionid = $id";
        //echo $sql;
        return $this->db->query($sql);
    }

    public function addfees($id) {
        $sql = "SELECT sum(diagnostic.amount) as total 
FROM addiagnostic, diagnostic
WHERE addiagnostic.diagnosticid = diagnostic.id AND
addiagnostic.admissionid = $id";
        //echo $sql;
        return $this->db->query($sql);
    }

    public function totalPaid($id) {
        $sql = "SELECT sum(installment.amount) as total 
FROM installment, payment
WHERE installment.paymentid = payment.id AND
installment.admissionid = $id";
        //echo $sql;
        return $this->db->query($sql);
    }

    public function vieww($sel, $table, $field) {
        $sql = "SELECT $sel 
FROM $table 
WHERE $field IS NOT NULL";
        //echo $sql;
        return $this->db->query($sql);
    }

    public function query($query) {
        return $this->db->query($query);
    }

    public function search($searchq){
        $sql = "select * from doctor WHERE name Like '%$searchq%' OR email Like '%$searchq%' OR fees Like '%$searchq%' OR institute Like '%$searchq%' OR designationid Like '%$searchq%'";
        //echo $sql;
        return $this->db->query($sql);
    }

}
