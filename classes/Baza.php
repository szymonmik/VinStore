<?php

class Baza {

    private $mysqli;

    public function __construct($serwer, $user, $pass, $baza) {
        $this->mysqli = new mysqli($serwer, $user, $pass, $baza);
        if ($this->mysqli->connect_errno) {
            printf("Nie udało sie połączenie z serwerem: %s\n",
                    $mysqli->connect_error);
            exit();
        }
        if ($this->mysqli->set_charset("utf8")) {}
    }

    function __destruct() {
        $this->mysqli->close();
    }

    public function select($sql, $pola) {
        $tresc = "<div>";
        if ($result = $this->mysqli->query($sql)) {
            $ilepol = count($pola);
            $ile = $result->num_rows;
            $tresc .= "<table border='1'><tbody>";

            $tresc .= "<tr>";
            foreach($pola as $temp){
                $tresc .= "<th>".$temp."</th>";
            }
            $tresc .= "</tr>";

            while ($row = $result->fetch_object()) {
                $tresc .= "<tr>";
                for ($i = 0; $i < $ilepol; $i++) {
                    $p = $pola[$i];
                    $tresc .= "<td>" . $row->$p . "</td>";
                }
                $tresc .= "</tr>";
            }
            $tresc .= "</table></tbody></div>";
            $result->close();
        }
        return $tresc;
    }

    public function delete() {
        if(filter_input(INPUT_POST, 'usunId')){
            $sql = "DELETE FROM klienci WHERE Id=". $_REQUEST['usunId'];
            if($this->mysqli->query($sql)){
                return true;
            } else { return false; }
        }
    }

    public function deleteWpisy($userId) {
        $sql = "DELETE FROM logged_in_users WHERE userId ='".$userId."'";
        if($this->mysqli->query($sql)){
            return true;
        } else { return false; }
    }

    public function deleteUniversal($sql) {
        if($this->mysqli->query($sql)){
            return true;
        } else { return false; }
    }

    public function insert($sql) {
        if ($this->mysqli->query($sql))
            return true;
        else
            return false;
    }
    

    public function getMysqli() {
        return $this->mysqli;
    }

    public function selectUser($login, $passwd, $tabela){
        $id = -1;
        $sql = "SELECT * FROM ".$tabela." WHERE userName='".$login."'";
        if($result = $this->mysqli->query($sql)){
            $ile = $result->num_rows;
            if ($ile == 1) {
            $row = $result->fetch_object();
            $hash = $row->passwd;
            if (password_verify($passwd, $hash))
            $id = $row->id;
            }
        } else {
            echo "Blad zapytania w funkcji selectUser";
        }
        return $id;
    }
}