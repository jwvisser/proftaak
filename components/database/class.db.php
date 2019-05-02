<?php

class db {

    private $db;
    private $conn;

    public function __construct() {
        include('dbCredentials.php');
        
        // Create connection
        $this->conn = new mysqli($servername, $username, $password,$db);
        
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        } 
        echo "Database connected succesfully!"."<br><br>";
    }

    // Generate a HTML table from table name and (optional) fields
    public function returnTable($table, $fields){
        
        // Check if custom field selection is empty or not.
        if($fields == ""){
            // Run query to get field names from table. 
            $query = mysqli_query($this->conn,"SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='smartcaps' AND `TABLE_NAME`='$table';");
            $result = mysqli_query($this->conn,"SELECT * FROM `$table`");
            
            // Check if table is empty.  
            if(mysqli_num_rows($result) > 0) {
                
                // Convert column names to array
                while($row = $query->fetch_assoc()){
                    $columns[] = $row;
                }
                $columnArr = array_column($columns, 'COLUMN_NAME');
                // Starting HTML of table
                echo '<table cellpadding="0" cellspacing="0" class="db-table">';
                // Create dynamic header for each column name. 
                echo '<tr>';
                foreach ($columnArr as $key => $value) {
                    echo "<th>".$value."</th>";
                }
                echo '</tr>';
                while($row = mysqli_fetch_row($result)) {
                    echo '<tr>';
                    foreach($row as $key=>$value) {
                        echo '<td>',$value,'</td>';
                    }
                    echo '</tr>';
                }
                echo '</table><br />';
            }else{
                echo "No rows found...";
            }
        }else{
            // Convert string to array, sepperated by comma
            $fieldArray = explode(',', $fields);

            // Run query with specific fields. 
            $result = mysqli_query($this->conn,"SELECT $fields FROM `$table`");
            // Check if table is empty. 
            if(mysqli_num_rows($result) > 0) {
                
                echo '<table cellpadding="0" cellspacing="0" class="db-table">';
                echo '<tr>';
                foreach ($fieldArray as $key => $value) {
                    echo "<th>".$value."</th>";
                }
                echo '</tr>';
                while($row = mysqli_fetch_row($result)) {
                    echo '<tr>';
                    foreach($row as $key=>$value) {
                        echo '<td>',$value,'</td>';
                    }
                    echo '</tr>';
                }
                echo '</table><br />';
            }else{
                echo "No rows found...";
            }
        }
    }
    
    public function getQuery(){

    }

    public function updateQuery($table,$fields){
        
    }

    public function deleteQuery($table,$fields){
        
    }

    public function DBClose(){
        $conn->close();
    }
}

?>