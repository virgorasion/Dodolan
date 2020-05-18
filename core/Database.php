<?php
date_default_timezone_set("Asia/jakarta");

class Database
{
    public $koneksi;

    public function __construct()
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "dodolan";
        $this->koneksi = mysqli_connect($host,$user,$password,$db);

        if (!$this->koneksi) {
            throw new Exception("Tidak dapat Konek ke Database", E_USER_ERROR);
        }
    }

    public function select($sql)
    {
        $query = mysqli_query($this->koneksi,$sql);
        if (!$query) {
            $error = mysqli_error($this->koneksi);
            throw new Exception($error);
        }else{
            $arrayReturn = array();
            foreach ($query as $data) {
                $arrayReturn[] = $data;
            }
            mysqli_free_result($query);
            return $arrayReturn;
        }
    }

    public function insert($table,$arrayData)
    {
        $fields = array_keys($arrayData);
        $values = array_values($arrayData);

        $escapeData = [];
        foreach ($values as $val) {
            if (!is_numeric($val)) {
                $val = "'". mysqli_escape_string($this->koneksi,$val) ."'";
            }
            $escapeData[] = $val;
        }

        $sql = "INSERT INTO $table (";
        $sql .= join(", ",$fields);
        $sql .= ") VALUES(";
        $sql .= join(", ", $escapeData).")";

        $query = mysqli_query($this->koneksi, $sql);
        if (!$query) {
            $error = mysqli_error($this->koneksi)."\n".$sql;
            throw new Exception($error);
            return False;
        }
        return True;
    }

    public function update($table, $arrayData, $arrayCondition)
    {
        $dataUpdate = [];
        foreach ($arrayData as $field => $val) {
            $val = "'". mysqli_escape_string($this->koneksi,$val) ."'";
            $dataUpdate[] = "$field = $val";
        }

        $dataCondition = [];
        foreach ($arrayCondition as $field => $val) {
            if (!is_numeric($val)) {
                $val = "'". mysqli_escape_string($this->koneksi,$val) ."'";
            }
            $dataCondition[] = "$field = $val";
        }

        $sql = "UPDATE $table SET ";
        $sql .= join(", ",$dataUpdate);
        $sql .= " WHERE ".join(" AND ", $dataCondition);

        $query = mysqli_query($this->koneksi, $sql);
        if (!$query) {
            $error = mysqli_error($this->koneksi)."\n".$sql;
            throw new Exception($error);
            return False;
        }
        return True;
    }

    public function delete($table, $arrayCondition)
    {
        $dataCondition = [];
        foreach ($arrayCondition as $field => $val) {
            if(!is_numeric($val)){
                $val = "'". mysqli_escape_string($this->koneksi, $val) ."'";
            }
            $dataCondition[] = "$field = $val";
        }
        $sql = "DELETE FROM $table WHERE ".join(" AND ",$dataCondition);
        $query = mysqli_query($this->koneksi,$sql);
        if (!$query) {
            $error = mysqli_error($this->koneksi). "\n" .$query;
            throw new Exception($query);
            return False;
        }
        return True;
    }

    public function query($sql)
    {
        $query = mysqli_query($this->koneksi, $sql);
        if (!$query) {
            $error = mysqli_error($this->koneksi). "\n" .$query;
            var_dump($error);
            throw new Exception($query);
        }
        return $query;
    }
}
