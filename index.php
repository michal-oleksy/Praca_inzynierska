<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Książki</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4 offset-lg-4 text-center my-5">
                <h1>Zaloguj się</h1>
                <form action="index.php" method = "post">
                        <div class="form-group text-start">
                            <label for="emailInputLogin">Adres e-mail:</label>
                            <input type="email" class="form-control" name="email" id="emailInputLogin" aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">Nie przekazujemy twojego adresu e-mail innym podmiotom.</small>
                        </div>
                        <div class="form-group text-start">
                            <label for="passwordInputLogin">Hasło:</label>
                            <input type="password" class="form-control" name="password" id="passwordInputLogin">
                        </div>
                        <div class="form-group form-check text-start">
                            <input type="checkbox" class="form-check-input" id="rememberMeButton">
                            <label class="form-check-label" for="rememberMeButton">Zapamiętaj mnie</label>
                            
                        </div>
                        <input type="hidden" name="action" value="login"></input>
                        <div class="d-grid gap-2 my-2">
                            <button type="submit" class="btn btn-primary btn-block">Zaloguj</button>
                        </div>
                </form>
            </div>
        </div>
        <!-- Rejestracja poniżej -->
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4 offset-lg-4 text-center my-5">
                    <h1>Zarejestruj się</h1>
                        <form action="index.php" method="post">
                            <div class="form-group text-start">
                                <label for="emailInputRegister">Email:</label>
                                <input type="email" class="form-control" name="email" id="emailInputRegister" required>
                                <small id="emailHelp" class="form-text text-muted">Nie przekazujemy twojego adresu e-mail innym podmiotom.</small>
                            </div>
                            <div class="form-group text-start">
                                <label for="passwordInputRegister">Hasło:</label>
                                <input pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{8,16}" type="password" class="form-control" name="password" id="passwordInputRegister" required>
                            </div>
                            <div class="form-group text-start">
                                <label for="passwordRepeatInput">Hasło ponownie:</label>
                                <input pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{8,16}" type="password" class="form-control" name="passwordRepeat" id="passwordRepeatInput" required>
                            </div>                     
                                <input type="hidden" name="action" value="register"></input>
                            <!--  -->
                            <div class="form-group text-start">
                                <label for="firstNameInput">Imię:</label>
                                <input type="text" class="form-control" name="firstName" id="firstNameInput" required>
                            </div>
                            <div class="form-group text-start">
                                <label for="lastNameInput">Nazwisko:</label>
                                <input type="text" class="form-control" name="lastName" id="lastNameInput" required>
                            </div>
                            <div class="form-group text-start">
                                <label for="nicknameInput">Pseudonim:</label>
                                <input type="text" class="form-control" name="nickname" id="nicknameInput" required>
                            </div>
                            <!-- data urodzenia -->
                            <div class="form-group text-start">
                                <label for="birthDateInput">Data urodzenia:</label>
                                <input type="date" class="form-control my-2" name="birthDate" id="birthDateInput" required>
                            </div>
                            <!-- plec -->
                            <div class="form-group text-start">
                                <label for="sexSelect">Wybierz płeć: </label>
                                <select class="form-select" name="sexSelect" aria-label="Default select example" id="sexSelect" required>
                                    <option value="1">Mężczyzna</option>
                                    <option value="2">Kobieta</option>
                                </select>
                            </div>
                            <div class="d-grid gap-2 my-2">
                                <button type="submit" class="btn btn-primary btn-block">Zarejestruj</button>
                            </div>

                        </form> 
                </div>
                <div class="col-12 col-lg-4 align-self-center text-start ">
                    <p class="py-7">Wymagania hasła:<br>- Jedna cyfra od 0 do 9<br>- Jedna mała litera<br> - Jedna wielka litera<br>
                    - Jeden znak specjalny<br>- Bez spacji<br>- Od 8 do 16 znaków</p>
                    

                </div>
            </div>
            
        </div>
    </div>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>


<?php
if(isset($_REQUEST['action']) && $_REQUEST['action']=="login"){
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];

$email = filter_var($email, FILTER_SANITIZE_EMAIL); //ważna linijka - wyklucza SQL injection z pola email, drugie zabezpieczenie po polu email

$db = new mysqli('localhost','root','','auth');


//prepared statements
$q = $db->prepare("SELECT * FROM user WHERE email = ? LIMIT 1"); //limit do jednego wiersza
//podstaw wartosci
$q->bind_param("s",$email);
//wykonaj
$q->execute();
$result_login = $q -> get_result();

$userRow = $result_login->fetch_assoc();
if($userRow == null){
    echo "Błędny login lub hasło <br>"; //konto nie istnieje lub błędny login/hasło
}else{
    //konto istnieje
    if(password_verify($password, $userRow['passwordHash'])){ //password_verify sprawdza hashe
        //haslo poprawne
        echo "Zalogowano poprawnie <br>";
    }
    else{
        echo "Błędny login lub hasło <br>";
    }

}}
// rejestracja
if(isset($_REQUEST['action']) && $_REQUEST['action']=="register"){
    $db = new mysqli('localhost','root','','auth');
    $email = $_REQUEST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $password = $_REQUEST['password']; 
    $passwordRepeat = $_REQUEST['passwordRepeat'];
    //
    $firstName = $_REQUEST['firstName'];
    $lastName = $_REQUEST['lastName'];
    $nickname = $_REQUEST['nickname'];
    $birthDate = $_REQUEST['birthDate'];
    $sex = $_REQUEST['sexSelect'];

    if($password=$passwordRepeat){//hasła są identyczne kontynuuj
        $passwordHash = password_hash($password,PASSWORD_ARGON2I);
        $q = $db->prepare("INSERT INTO user VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");
        $q->bind_param("sssssss",$email,$passwordHash,$firstName,$lastName,$nickname,$birthDate,$sex);
        $result = $q->execute();
        if($result){
            echo "Zarejestrowano poprawnie";
        } else{
            echo "Coś poszło nie tak";
        }
    } else {
        echo "Hasła nie są identyczne";
    }
    
}

// email michal2001@czytaj.pl
// hasło tajneHaslo
?>