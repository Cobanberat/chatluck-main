<?php
session_start();
include "../../connect/db.php";

$id = $_POST["ust"];
$name = $_POST["name"];

if ($id || $name) {
    $sorgu = $conn->prepare("INSERT INTO parent (name, ust) VALUES (:name, :ust)");
    $sorgu->bindParam(":name", $name, PDO::PARAM_STR);
    $sorgu->bindParam(":ust", $id, PDO::PARAM_INT);

    if ($sorgu->execute()) {
        $_SESSION["message"] = [
            "durum" => "true",
            "text" => "Kategori Başarıyla Eklendi"
        ];
        header("Location: ../kategoriaddform.php");
    } else {
        $_SESSION["message"] = [
            "durum" => "false",
            "text" => "Bir hata oluştu. Lütfen tekrar deneyiniz."
        ];
        header("Location: ../kategoriaddform.php");
    }
} else {
    $_SESSION["message"] = [
        "durum" => "false",
        "text" => "Lütfen Ürün İsmi Giriniz"
    ];
    header("Location: ../kategoriaddform.php");
}
