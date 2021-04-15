<?php
class GebruikDB {

    private $conn;

    //connectie naar database maken, functie gaat er van uit dat de DB en het gebruik-bestand zich op hetzelfde domein bevinden
    // waardoor een port connectie niet nodig is
    public function setConn($host, $user, $password, $database){

        $this->conn = mysqli_connect($host, $user, $password, $database);
        if ($this->conn -> connect_errno) {
            echo "Failed to connect to MySQL: " . $this->conn -> connect_error;
            exit();
        }
        //ping naar de server sturen om te kijken of er connectie is
        if ($this->conn->ping()) {
            return $this->conn;
        } else {
            return "Error: %s\n".$this->conn->error;
        }
    }

    /**
     * @param mysqli $connection
     * @param array $object
     * @param string $table
     */
    public function makeObject(mysqli $connection, array $object, $table){
        $coloms = implode(", ", array_keys($object));
        $values = implode("','", array_values($object));
        $query = "INSERT INTO $table ($coloms) VALUES ('$values')";
        if ($stmt = $connection->prepare($query))   {
            $stmt->execute();
            if (!$stmt->affected_rows > 0) {
                exit('object niet aangemaakt');
            }
        }else{
            exit($connection->error);
        }
    }

    /**
     * @return mixed
     */
    public function getConn()
    {
        return $this->conn;
    }
}