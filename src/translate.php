<?php

namespace smartcaps;

class translate
{
    private $language;
    private $currentPage;

    public function __construct()
    {
        $this->currentPage =  ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));
        if(isset($_GET['language'])) {
            $this->language = $_GET['language'];

            echo $this->language . "<br>";
            setcookie("language", $this->language);
            header("Refresh:0; url=".$this->currentPage);
        }

        if(!isset($_COOKIE['language'])){
            setcookie("language", 'nl');
            header("Refresh:0; url=".$this->currentPage);
        }
    }

    public function getHTML($page, $contentID){
        $db = new db;
        $result = $db->getContent('SELECT `html` FROM `content` WHERE `language` = "'.$_COOKIE['language'].'" AND `page` = "'.$page.'" AND `contentID` = "'.$contentID.'"');
        echo $result;
    }
}

?>