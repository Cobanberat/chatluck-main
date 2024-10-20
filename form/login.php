<?php
include "../connect/db.php";

session_start();

$email = $_POST["email"];
$password = $_POST["password"];

if ($email && $password) {
    $sorgu = $conn->prepare("select * from kullanicilar where mail = :mail");
    $sorgu->execute(['mail' => $email]);
    $Kc = $sorgu->fetch(PDO::FETCH_ASSOC);
    if ($Kc) {
        if ($Kc["password"] == sha1(md5(crc32(sha1(md5(crc32($password))))))) {
            $_SESSION["user"] = [
                "user_id" => $Kc["id"],
                "name" => $Kc["name"],
                "surname" => $Kc["surname"],
                "username" => $Kc["username"],
                "mail" => $Kc["mail"]
            ];

            $_SESSION["message"] = [
                "durum" => "true",
                "text" => "Başarıyla Giriş Yapıldı"
            ];
            header("Location:../index/index.php");
        } else {
            $_SESSION["message"] = [
                "durum" => "false",
                "text" => "Girdiğiniz Şifre Hatalı! Lütfen Tekrar Deneyiniz."
            ];
            header("Location:../login/login.php");
        }
    } else {
        $_SESSION["message"] = [
            "durum" => "false",
            "text" => "Eposta Adresiniz Hatalı! Lütfen Tekrar Deneyiniz."
        ];
        header("Location:../login/login.php");
    }
} else {
    $_SESSION["message"] = [
        "durum" => "false",
        "text" => "Lütfen tüm alanları doldurun."
    ];
    header("Location:../login/login.php");
}
