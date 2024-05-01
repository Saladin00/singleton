<?php

class DatabaseConnection
{
    private static ?PDO $instance = null;

    private function __construct()
    {
        // Konstruktor privat untuk mencegah pembuatan instance langsung
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            $host = 'localhost';
            $dbname = 'sepatu';
            $username = 'root';
            $password = '';
            try {
                self::$instance = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Koneksi Gagal: ' . $e->getMessage();
                self::$instance = null; // Pastikan instance tetap null jika koneksi gagal
            }
        }
        return self::$instance;
    }
}

class Sepatu
{
    private $db;

    public function __construct()
    {
        $this->db = DatabaseConnection::getInstance();
        if ($this->db === null) {
            throw new Exception("Database connection is not established.");
        }
    }
    public function addSepatu($id_sepatu, $merk_sepatu, $jenis_sepatu, $no_sepatu)
    {
        $stmt = $this->db->prepare("INSERT INTO tb_sepatu (id_sepatu, merk_sepatu, jenis_sepatu, no_sepatu) VALUES (?, ?, ?, ?)");
        $stmt->execute([$id_sepatu, $merk_sepatu, $jenis_sepatu, $no_sepatu]);
        echo "Data sepatu berhasil ditambahkan.<br>";
    }

    public function getSepatu($id_sepatu)
    {
        $stmt = $this->db->prepare("SELECT * FROM tb_sepatu WHERE id_sepatu = ?");
        $stmt->execute([$id_sepatu]);
        $sepatu = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($sepatu) {
            echo "Merek : " . $sepatu['merk_sepatu'] . "<br>Jenis : " . $sepatu['jenis_sepatu'] . "<br>Nomor : " . $sepatu['no_sepatu'] . "<br>";
        } else {
            echo "Data sepatu tidak ditemukan.<br>";
        }
    }

    public function updateSepatu($id_sepatu, $merk_sepatu, $jenis_sepatu, $no_sepatu)
    {
        $stmt = $this->db->prepare("UPDATE tb_sepatu SET merk_sepatu = ?, jenis_sepatu = ?, no_sepatu = ? WHERE id_sepatu = ?");
        $stmt->execute([$merk_sepatu, $jenis_sepatu, $no_sepatu,$id_sepatu ]);
        echo "Data sepatu berhasil diubah.<br>";
    }

    public function hapusSepatu($id_sepatu)
    {
        $stmt = $this->db->prepare("DELETE FROM tb_sepatu WHERE id_sepatu = ?");
        $stmt->execute([$id_sepatu]);
        echo "Data sepatu berhasil dihapus.<br>";
    }
}
?>