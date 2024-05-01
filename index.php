<?php

include_once 'KoneksiDatabase.php';


// Mendapatkan instance Database
$db1 = DatabaseConnection::getInstance();
var_dump($db1);
echo "<br>";

// Mendapatkan instance Database (sekali lagi)
$db2 = DatabaseConnection::getInstance();
var_dump($db2);
echo "<br>";

// Mendapatkan instance Database (sekali lagi)
$db3 = DatabaseConnection::getInstance();
var_dump($db3);
echo "<br>";

// Mendapatkan instance Database (sekali lagi)
$db4 = DatabaseConnection::getInstance();
var_dump($db4);
echo "<br>";

// Mendapatkan instance Database (sekali lagi)
$db5 = DatabaseConnection::getInstance();
var_dump($db5);
echo "<br><br>";

// Membuat instance baru dari kelas Sepatu
$sepatuManager = new Sepatu();

// Menambahkan data sepatu
$sepatuManager->addSepatu(1, "Nike", "Sneakers", "42");

// Menampilkan data sepatu
$sepatuManager->getSepatu(1);

// Mengubah data sepatu
$sepatuManager->updateSepatu(1, "Adidas", "Running", "43");
$sepatuManager->getSepatu(1);

// Menghapus data sepatu
$sepatuManager->hapusSepatu(1);

?>
