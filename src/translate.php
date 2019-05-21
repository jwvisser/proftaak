<?php

namespace smartcaps;

class translate
{
    private $language;
    private $currentPage;

    public function __construct()
    {
        if(isset($_GET['language'])) {
            $this->currentPage =  ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));
            $this->language = $_GET['language'];

            echo $this->language . "<br>";
            setcookie("language", $this->language);
            header("Refresh:0; url=".$this->currentPage);
        }
    }

    public function getHTML($page, $contentID){
        $db = new db;
        $result = $db->runQuery('SELECT `html` FROM `content` WHERE `language` = "'.$_COOKIE['language'].'" AND `page` = "'.$page.'" AND `contentID` = "'.$contentID.'"');
        echo $result;
    }
}

?>