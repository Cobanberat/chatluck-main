<?php
include "../connect/db.php";

session_start();

$name = $_POST["name"];
$surname = $_POST["surname"];
$number = $_POST["number"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

if ($name && $number && $surname && $username && $email && $password) {

    $mailD = $conn->prepare(query: "SELECT * FROM kullanicilar WHERE mail = :email");
    $mailD->execute(params: ['email' => $email]);
    $mailKontrol = $mailD->fetch(mode: PDO::FETCH_ASSOC);

    if (!$mailKontrol) {
        $usernameD = $conn->prepare(query: "SELECT * FROM kullanicilar WHERE username = :username");
        $usernameD->execute(params: ['username' => $username]);
        $usernameKontrol = $usernameD->fetch(mode:  PDO::FETCH_ASSOC);

        if (!$usernameKontrol) {
            $sifre = sha1(string: md5(string: crc32(string: sha1(string: md5(crc32($password))))));

            $sorgu = $conn->prepare("INSERT INTO kullanicilar (name, surname, username, tel, mail, password) 
                                     VALUES (:name, :surname, :username, :tel, :mail, :password)");

            $sorgu->execute(params: [
                'name' => $name,
                'surname' => $surname,
                'username' => $username,
                'tel' => $number,
                'mail' => $email,
                'password' => $sifre
            ]);

            $_SESSION["message"] = [
                "durum" => "true",
                "text" => "Kullanıcı başarıyla eklendi."
            ];

            header("Location:../login/login.php");
        } else {
            $_SESSION["message"] = [
                "durum" => "false",
                "text" => "Bu kullanıcı adı zaten mevcut."
            ];
            header(header: "Location:../login/register.php");
        }
    } else {
        $_SESSION["message"] = [
            "durum" => "false",
            "text" => "Bu Epostaya ait Hesap Mevcut"
        ];
        header(header: "Location:../login/register.php");
    }
} else {
    $_SESSION["message"] = [
        "durum" => "false",
        "text" => "Lütfen tüm alanları doldurun."
    ];
    header(header: "Location:../login/register.php");
}