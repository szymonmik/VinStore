<?php
class RegistrationForm
{
    protected $user;
    function __construct()
    { ?>
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <form action="register.php" method="post">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputUserName" name="userName" type="text" placeholder="Nazwa użytkownika..." required />
                        <label for="inputName">Nazwa użytkownika</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputFullName" name="fullName" type="text" placeholder="Imię i nazwisko..." required />
                        <label for="inputName">Imię i nazwisko</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputPasswd" name="passwd" type="password" placeholder="Hasło..." required />
                        <label for="inputEmail">Hasło</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputPasswd" name="email" type="email" placeholder="Email..." required />
                        <label for="inputEmail">Email</label>
                    </div>
                    <div class="form-floating mb-3 d-flex justify-content-center">
                        <input class="btn btn-primary" type="submit" value="Rejestruj" name="submit"><input class="btn btn-secondary" type="reset" value="Resetuj">
                    </div>
                </form>
            </div>
        </div>
<?php
    }
    function checkUser()
    {
        include_once('classes/User.php');
        $args = [
            'userName' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/']
            ],
            'fullName' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^.{2,}$/']
            ],
            'email' => [
                'filter' => FILTER_VALIDATE_EMAIL
            ],
            'passwd' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^.{8,}$/']
            ]
        ];
        $dane = filter_input_array(INPUT_POST, $args);
        
        $errors = "";
        foreach ($dane as $key => $val) {
        if ($val === false or $val === NULL) {
        $errors .= $key . " ";
        }
        }

        if ($errors === "") {
            echo "Poprawne dane";
            $this->user = new User(
                $dane['userName'],
                $dane['fullName'],
                $dane['email'],
                $dane['passwd']
            );
        } else {
            echo "<p>Błędne dane: $errors</p>";
            $this->user = NULL;
        }
        return $this->user;
    }
}
