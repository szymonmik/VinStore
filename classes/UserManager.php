<?php
class UserManager {
    public function loginForm(){
    ?>
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <form action="login.php" onsubmit="return sprawdz()" method="post">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputLogin" name="login" type="text" placeholder="Login..." required />
                        <label for="inputName">Login</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputPasswd" name="passwd" type="password" placeholder="Hasło..." required />
                        <label for="inputEmail">Hasło</label>
                    </div>
                    <div class="form-floating mb-3 d-flex justify-content-center">
                        <input class="btn btn-primary" type="submit" value="Zaloguj" name="zaloguj">
                    </div>
                </form>
            </div>
        </div>
<?php
    }
    
    public function login($db){
        $args = [
            'login' => FILTER_SANITIZE_STRING,
            'passwd' => FILTER_SANITIZE_STRING
        ];
        $dane = filter_input_array(INPUT_POST, $args);
        $login = $dane["login"];
        $passwd = $dane["passwd"];
        $userId = $db->selectUser($login, $passwd, "users");
        if ($userId >= 0) {
            session_start();
            if($db->deleteWpisy($userId)){
            } else {echo "Blad usuwania starych wpisow";}
            echo session_id();
            $sql = "INSERT INTO logged_in_users VALUES ('".session_id()."','".$userId."','')";
            if($db->insert($sql)){
            } else {echo "Blad dodawania wpisu";}
        }
        return $userId;
    }
    
    public function logout($db){
        session_start();
        $sessid = session_id();
        if(isset($_COOKIE[session_name()])){
            setcookie(session_name(),'',time() - 3600, '/');
        }
        session_destroy();
        $sql = "DELETE FROM logged_in_users WHERE sessionId ='".$sessid."'";
        $db->deleteUniversal($sql);
        header("location:index.php");
    }
    
    public function getLoggedInUser($db, $sessionId){
        $id = -1;
        $sql = "SELECT * FROM logged_in_users WHERE sessionId='".$sessionId."'";
        
        if($result = $db->getMysqli()->query($sql)){
            if ($result->num_rows == 1) {
            $row = $result->fetch_object(); 
            $id = $row->userId;
            }
        } else {
            echo "Blad zapytania w funkcji selectUser";
        }
        return $id;
    }
}
