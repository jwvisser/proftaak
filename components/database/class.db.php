<?php

class db
{

    private $db;
    private $conn;
    private $pdo;

    public function __construct()
    {
        include('dbCredentials.php');

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
        try {
            $pdo = new PDO($dsn, $user, $pass, $options);

        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        $this->pdo = $pdo;
    }


    // Generate a HTML table from table name and (optional) fields
    public function returnTable($table, $fields, $filter)
    {

        $fieldArray = "";

        if ($filter !== "") {
            $filter = " WHERE " . $filter;
        }

        $sql = "SELECT count(*) FROM " . $table;
        $result = $this->pdo->prepare($sql);
        $result->execute();
        $count = $result->fetchColumn();

        if ($fields !== "") {
            $sql = 'SELECT ' . $fields . ' FROM `' . $table . '`' . @$filter;
            $fieldArray = explode(',', $fields);
        } else {
            $sql = 'SELECT * FROM `' . $table . '`' . @$filter;
        }

        if ($count > 0) {
            if ($fieldArray !== "") {
                // Starting HTML of table
                echo '<table cellpadding="0" cellspacing="0" class="db-table">';
                // Create dynamic header for each column name. 
                echo '<tr>';
                foreach ($fieldArray as $key => $value) {
                    echo "<th>" . $value . "</th>";
                }
                echo '</tr>';
            } else {
                $fieldArray = $this->getColumnNames($table);
                // Starting HTML of table
                echo '<table cellpadding="0" cellspacing="0" class="db-table">';
                // Create dynamic header for each column name. 
                echo '<tr>';
                foreach ($fieldArray as $key => $value) {
                    echo "<th>" . $value . "</th>";
                }
                echo '</tr>';
            }
            foreach ($this->pdo->query($sql) as $row) {
                echo '<tr>';
                foreach ($row as $key => $value) {
                    echo '<td>', $value, '</td>';
                }
                echo '</tr>';
            }
            echo '</table><br />';
        } else {
            echo "No rows found...";
        }
        $this->DBClose();
    }

    function getColumnNames($table)
    {
        $sql = 'select column_name from information_schema.columns where lower(table_name)=lower(\'' . $table . '\')';

        $stmt = $this->pdo->prepare($sql);

        try {
            if ($stmt->execute()) {
                $raw_column_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($raw_column_data as $outer_key => $array) {
                    foreach ($array as $inner_key => $value) {
                        if (!(int)$inner_key) {
                            $this->column_names[] = $value;
                        }
                    }
                }
            }

            return $this->column_names;
        } catch (Exception $e) {
            return $e->getMessage(); //return exception 
        }
    }

    public function getQuery()
    {

    }

    public function updateQuery($table, $fields)
    {

    }

    public function deleteQuery($table, $fields)
    {

    }

    private function DBClose()
    {
        $this->pdo = null;
    }
}

?>