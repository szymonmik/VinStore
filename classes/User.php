<?php

class User {

    const STATUS_USER = 1;
    const STATUS_ADMIN = 2;

    protected $userName;
    protected $passwd;
    protected $fullName;
    protected $email;
    protected $date;
    protected $status;

    function __construct($userName, $fullName, $email, $passwd) {
        $this->status = User::STATUS_USER;
        $this->userName = $userName;
        $this->passwd = password_hash($passwd, PASSWORD_DEFAULT);
        $this->fullName = $fullName;
        $this->email = $email;
        $this->date = new DateTime('NOW');
    }

    public function show() {
        echo '<p>Nazwa użytkownika: ' . $this->userName . '</p>';
        echo '<p>Hasło: ' . $this->passwd . '</p>';
        echo '<p>Imię i nazwisko: ' . $this->fullName . '</p>';
        echo '<p>Email: ' . $this->email . '</p>';
        echo '<p>Data utworzenia konta: ' . $this->date->format('Y-m-d H:i:s') . '</p>';
        echo '<p>Status konta: ' . $this->status . '</p>';
        echo '<p>-----------------------------------</p>';
    }

    public function getUserName() {
        return $this->userName;
    }

    public function setUserName($userName) {
        $this->userName = $userName;
    }

    public function getPasswd() {
        return $this->passwd;
    }

    public function setPasswd($passwd) {
        $this->passwd = password_hash($passwd, PASSWORD_DEFAULT);
    }

    public function getFullName() {
        return $this->fullName;
    }

    public function setFullName($fullName) {
        $this->fullName = $fullName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getDate() {
        return $this->date;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    static function getAllUsers($plik) {
        $tab = json_decode(file_get_contents($plik));
        echo "<ul>";
        foreach ($tab as $val) {
            echo "<li>" . $val->userName . " " . $val->fullName . " " . $val->email . " " . $val->status . " " . $val->date . "</li>";
        }
        echo "</ul>";
    }

    function toArray() {
        $arr = [
            "userName" => $this->userName,
            "fullName" => $this->fullName,
            "email" => $this->email,
            "passwd" => $this->passwd,
            "date" => $this->date->format("Y-m-d"),
            "status" => $this->status,
        ];
        return $arr;
    }

    function save($plik) {
        $tab = json_decode(file_get_contents($plik), true);
        array_push($tab, $this->toArray());
        file_put_contents($plik, json_encode($tab));
    }

    function saveXML($plik) {
        $xml = simplexml_load_file($plik);
        $xmlCopy = $xml->addChild("user");
        $xmlCopy->addChild("userName", $this->userName);
        $xmlCopy->addChild("fullName", $this->fullName);
        $xmlCopy->addChild("email", $this->email);
        $xmlCopy->addChild("passwd", $this->passwd);
        $xmlCopy->addChild("date", $this->date->format('Y-m-s'));
        $xmlCopy->addChild("status", $this->status);
        $xml->asXML($plik);
    }

    static function getAllUsersFromXML($plik) {
        $allUsers = simplexml_load_file($plik);
        echo "<ul>";
        foreach ($allUsers as $user) :
            $userName = $user->userName;
            $date = $user->date;
            $fullName = $user->fullName;
            $email = $user->email;
            $status = $user->status;
            echo "<li>$userName, $fullName, $email, $status, $date </li>";
        endforeach;
        echo "</ul>";
    }

    function saveDB($db) {
        $dane = $this->toArray();
        $sql = "INSERT INTO users VALUES (NULL, '".$dane['userName']."','".$dane['fullName']."','".$dane['email']."','".$dane['passwd']."','".$dane['status']."','".$dane['date']."')";
        if($db->query($sql)){
            echo "Dodano pomyslnie";
        }
        else{
            echo "Blad dodawania";
        }
    }

    static function getAllUsersFromDB($db) {
        $sql = "SELECT * FROM users";
        if ($result = $db->query($sql)) {
            $tresc = "";
            $row_count = $result->num_rows;
            $field_count = $result->field_count;
            $tresc .= "<table border='1'><tbody>";
            $tresc .= "<tr><th>ID</th><th>User Name</th><th>Full Name</th><th>Email</th><th>Status</th><th>Date</th></tr>";
            while ($row = mysqli_fetch_array($result)) {
                $tresc .= "<tr>";
                $tresc .= "<td>" . $row['id'] . "</td><td>". $row['userName'] ."</td><td>". $row['fullName'] ."</td><td>". $row['email'] ."</td><td>"/*. $row['passwd'] ."</td><td>"*/. $row['status'] ."</td><td>". $row['date'] ."</td>";
                $tresc .= "</tr>";
            }
            $tresc .= "</table></tbody>";
            $result->close();
            echo $tresc;
        } else {
            echo "Błąd pobierdania danych";
        }
    }

}
