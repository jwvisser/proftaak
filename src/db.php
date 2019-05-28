<?php

namespace smartcaps;

class db
{

    private $db;
    private $conn;
    private $pdo;
    private $page;

    public function __construct()
    {
        $this->page = ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));
        include('dbCredentials.php');

        $this->db = $db;

        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
        try {
            $pdo = new \PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        $this->pdo = $pdo;
    }

    public function returnProducts()
    {
        $html = "";
        $prices = "";
        $productNames = "";
        if ($this->page == "Winkelwagen") {
            if (isset($_COOKIE['cart'])) {
                $products = explode(',', rtrim($_COOKIE['cart'],','));
                if (empty($products) || !$products[0] == "") {
                    foreach ($products as $index => $value) {
                        $sql = "SELECT * FROM `product` WHERE `ID` = '$value'";
                        foreach ($this->pdo->query($sql) as $row) {
                            $html .=
                                "<div class='product'>
                          <h3 class='title' style='text-transform:capitalize;'>" . $row['name'] . "</h3>
                          <span class='price'>€" . $row['price'] . ",-</span>
                          <button id='removeButton" . $row['ID'] . "' class='removeButton' onclick='removeProduct(" . $row['ID'] . ");'>Verwijder</button>
                        </div>";
                            $productNames .= $row['name'] . ",";
                            $prices .= $row['price'] . ",";
                        }
                    }
                    echo $this->returnPriceTable($prices, $productNames);
                    return $html;
                }else{
                    return "<style>.container-grid{display:initial !important;}</style>
                        <h1>Geen producten in winkelwagen</h1>
                        <a href='./shop'>Ga naar de winkel</a>";
                }
            } else {
                return "<style>.container-grid{display:initial !important;}</style>
                        <h1>Geen producten in winkelwagen</h1>
                        <a href='./shop'>Ga naar de winkel</a>";
            }

        } else {
            $sql = "SELECT * FROM `product`";

            foreach ($this->pdo->query($sql) as $row) {
                $html .=
                    "<div class='product'>
              <h3 class='title' style='text-transform:capitalize;'>" . $row['name'] . "</h3>
              <span class='price'>€" . $row['price'] . ",-</span>
              <button id='addToCart" . $row['ID'] . "' onclick='addProduct(" . $row['ID'] . ");'>Koop nu!</button>
            </div>";
            }

            return $html;
        }
    }

    public function returnPriceTable($prices, $names)
    {
        $nameArray = explode(",", rtrim($names, ","));
        $priceArray = explode(",", rtrim($prices, ","));
        echo "<div id='pricetable'>";
        foreach ($priceArray as $index => $price) {
            echo "<p>" . $nameArray[$index] . " - €" . $priceArray[$index] . ",-</p>";
        }
        echo "<p>Total: €" . array_sum($priceArray) . ",-</p>";
        echo "<input type='submit' value='Betaal nu'/></div>";
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
                if (@$_SESSION['login_Status'] == true) {
                    echo '<th> Edit </th>';
                    echo '<th> Delete </th>';
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
                if (@$_SESSION['login_Status'] == true) {
                    echo '<th> Edit </th>';
                    echo '<th> Delete </th>';
                }
                echo '</tr>';
            }

            foreach ($this->pdo->query($sql) as $row) {

                echo '<tr>';
                foreach ($row as $key => $value) {
                    echo '<td>', $value, '</td>';
                }
                if (@$_SESSION['login_Status'] == true) {
                    echo '<td> <a class="editButton" href="?table=' . $table . '&id=' . $row['ID'] . '#' . $table . '"><i class="material-icons">edit</i></a> </td>';
                    echo '<td> <a class="deleteButton" onclick="return confirm(\'Are you sure?\')" href="./delete?table=' . $table . '&id=' . $row['ID'] . '"><i class="material-icons">cancel</i></a></td>';
                }
                echo '</tr>';
            }

            echo '</table><br />';
        } else {
            echo "No rows found...";
        }
    }

    function getColumnNames($table)
    {
        $sql = 'select column_name 
        from information_schema.columns 
        where lower(table_name)=lower(\'' . $table . '\') and lower(table_schema)=lower(\'' . $this->db . '\')';

        $stmt = $this->pdo->prepare($sql);

        try {
            if ($stmt->execute()) {
                $raw_column_data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

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

    public function getContent($query)
    {
        $executedQuery = $this->pdo->prepare($query);
        foreach ($this->pdo->query($query) as $row) {
            $result = $row['html'] . "\t";
        }

        return $result;
    }

    public function runQuery($query)
    {
        $executedQuery = $this->pdo->prepare($query);
        $executedQuery->execute();

        return $executedQuery;
    }

    public function getRowCount($query)
    {
        $executedQuery = $this->pdo->prepare($query);
        $executedQuery->execute();

        $count = $executedQuery->rowCount();

        return $count;
    }

    public function insertQuery($table, $fields, $values)
    {
        $executedQuery = $this->pdo->prepare("");
        $executedQuery->execute();
    }

    public function updateQuery($table, $fields)
    {
        $inputs = "";
        $updatedFields = "";

        $fieldArray = explode(',', $fields);

        $id = (int)(isset($_POST['ID']) ? $_POST['ID'] : $_GET['id']);

        if (isset($_POST['update' . $table])) {
            unset($_POST['ID']);
            unset($_POST['update' . $table]);

            foreach ($_POST as $key => $v) {
                if ($_POST[$key] == "") {
                    unset($_POST[$key]);
                }
            }

            $lastElement = end($_POST);

            foreach ($_POST as $key => $v) {
                if ($v !== $lastElement) {
                    $updatedFields .= "`$key` = '$v',";
                } else {
                    $updatedFields .= "`$key` = '$v'";
                }
            }

            $executedQuery = $this->pdo->prepare("UPDATE `$table` SET $updatedFields WHERE `$table`.`ID` = :id");
            $executedQuery->bindParam(':id', $id, \PDO::PARAM_INT);
            $executedQuery->execute();

            $this->currentPage = ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));
            header("Refresh:0; url=" . $this->currentPage);
        }

        $executedQuery = $this->pdo->prepare("SELECT * FROM `$table` WHERE `ID`=:id");
        $executedQuery->bindParam(':id', $id, \PDO::PARAM_INT);
        $executedQuery->execute();
        $row = $executedQuery->fetch(\PDO::FETCH_ASSOC);
        $inputs .= "Selected: " . $id;
        foreach ($fieldArray as $field) {
            $inputs .= '<input style="text-transform:capitalize" placeholder="' . $field . '" value="' . ((!empty($row) && isset($row[$field])) ? $row[$field] : '') . '" name="' . $field . '" type="text">';
        }
        $inputs .= '<input style="text-transform:capitalize" value="Update" name="update' . $table . '" type="submit">';
        echo $inputs;
    }

    public function deleteQuery($table, $id)
    {
        $executedQuery = $this->pdo->prepare("DELETE FROM `$table` WHERE `ID`=:id");
        $executedQuery->bindParam(':id', $id, \PDO::PARAM_INT);
        $executedQuery->execute();

        echo "
            <script>
                javascript:window.history.back();
            </script>
        ";
    }

    private function DBClose()
    {
        $this->pdo = null;
    }
}

?>