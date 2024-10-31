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
// $q->bind_param("s",);
//wykonaj
$q->execute();
$result_login = $q -> get_result();

$userRow = $result_login->fetch_assoc();
if($userRow == null){
    echo "Błędny login lub hasło <br>"; //konto nie istnieje lub błędny login/hasło
}else{
    //konto istnieje
    if(password_verify($password, $userRow['passwordHash'])){
        //haslo poprawne
        echo "Zalogowano poprawnie <br>";
    }
    else{
        echo "Błędny login lub hasło <br>";
    }

}}

if(isset($_REQUEST['action']) && $_REQUEST['action']=="register"){
    $db = new mysqli('localhost','root','','auth');
    $email = $_REQUEST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = $_REQUEST['password'];
    $passwordRepeat = $_REQUEST['passwordRepeat'];

    if($password=$passwordRepeat){//hasła są identyczne kontynuuj
        $passwordHash = password_hash($password,PASSWORD_ARGON2I);
        $q = $db->prepare("INSERT INTO user VALUES (NULL, ?, ?)");
        $q->bind_param("ss",$email,$passwordHash);
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
//


// email michal2001@czytaj.pl
// hasło tajneHaslo
?>
<title>Książki</title>
<h1>Zaloguj się</h1>
<form action="index.php" method = "get">
    <label for="emailInput">Email:</label>
    <input type="email" name="email" id="emailInput"><br>
    <label for="passwordInput">Hasło:</label>
    <input type="password" name="password" id="passwordInput"><br>
    <input type="hidden" name="action" value="login"></input>
    <input type="submit" value="Zaloguj">
</form>

<h1>Zarejestruj się</h1>
<form action="index.php" method="post">
    <label for="emailInput">Email:</label>
    <input type="email" name="email" id="emailInput"><br>

    <label for="passwordInput">Hasło:</label>
    <input type="password" name="password" id="passwordInput"><br>

    <label for="passwordRepeatInput">Hasło ponownie:</label>
    <input type="password" name="passwordRepeat" id="passwordRepeatInput"><br>

    <input type="hidden" name="action" value="register"></input>
    <input type="submit" value="Zarejestruj">
</form>


