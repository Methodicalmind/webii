<?php
class DB{

    $db = pg_connect("host=localhost dbname=photosite user=postgres password=Spiderman11");
    if (!$db){
      echo "An error occurred.\n";
      exit;
    }
    function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with postgres: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }

    function getRows(){
        $query = $this->db->query("SELECT * FROM ".$this->imgTbl." WHERE  ORDER BY img_order ASC");
        if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
                $result[] = $row;
            }
        }else{
            $result = FALSE;
        }
        return $result;
    }

    function updateOrder($id_array){
        $count = 1;
        foreach ($id_array as $id){
            $update = $this->db->query("UPDATE ".$this->imgTbl." SET img_order = $count WHERE id = $id");
            $count ++;
        }
        return TRUE;
    }
}
?>
