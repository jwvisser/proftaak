<?php

namespace smartcaps;

class auth
{   
    public function __construct()
    {
        
    }

    public function checkAuth(){
        if(!$_SESSION['login_Status'] == true){
            header("location: ./");
        }
    }

    public function login($username, $password){
        if($username == "" || $password == ""){
            echo "credentials not filled in correctly";
        }else{
            $db = new db;
            $result = $db->getRowCount("SELECT ID FROM `user` WHERE `username` = '$username' and `password` = md5('$password')");
            if($result > 0){
                $result = $db->getQuery("SELECT ID, username FROM `user` WHERE `username` = 'admin' and `password` = md5('admin')");
                foreach ($result as $row) {
                    $_SESSION["user_ID"]=$row['ID'];
                    $_SESSION['login_Status']= true;
                    $_SESSION["user_Name"]=$row['username'];
                }
                header("location: ./dashboard");
            }else{
                echo "User does not exist";
            }
        }
    }
}

?>