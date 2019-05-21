<?php

namespace smartcaps;

class translate
{
    private $language;
    private $currentPage;

    public function __construct()
    {
//        $db = new db;

        if(isset($_GET['language'])) {
            $this->currentPage =  ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));
            $this->language = $_GET['language'];

            echo $this->language . "<br>";
            setcookie("language", $this->language);
            header("Refresh:0; url=".$this->currentPage);
        }

        echo $_COOKIE['language'];
    }
}

?>