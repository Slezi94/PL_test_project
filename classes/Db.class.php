<?php
class Db {
    private $username = "root";
    private $password = "";
    private $dbName = "welove_test";
    public function connect() {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=' . $this->dbName, $this->username, $this->password);
            return $dbh;
        } catch (PDOException $e) {
            print "Error!: ".$e->getMessage()."<br>";
            die();
        }
    }
}
