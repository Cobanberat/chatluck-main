<?php 
$conn = new PDO("mysql:host=localhost;dbname=chatluck", "root", "");
$kullanicilar = $conn->query("select * from kullanicilar")->fetchAll(PDO::FETCH_ASSOC);


?>