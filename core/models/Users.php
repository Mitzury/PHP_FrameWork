<?php

require_once('./core/config/db.php');

class Users {

    public static function getUserByName($pagename) {

        $db = db::getConnection();
        $result = $db->prepare("SELECT * FROM users WHERE url= :pagename");
        $result->bindParam(':pagename', $pagename);
        $result->execute();
        $userItem = $result->fetch();
    
        return $userItem;    
    }

    public static function getAllUsers() {

       $db = db::getConnection();

        $usersList = array ();
        $result = $db->prepare("SELECT * from users as u order by priority");
        
        $result->execute();
     #   $result = $db->query("SELECT * FROM users where group_name like '%".$pagename."%'");
 
        $i=0;
        while ($row = $result->fetch()) {
            $usersList[$i]['user_name'] = $row['user_name'];
            $usersList[$i]['post'] = $row['post'];
            $usersList[$i]['url'] = $row['url'];
            $usersList[$i]['photo_url'] = $row['photo_url'];
            $usersList[$i]['group'] = $row['group_name'];
            $i++;
        }
        return $usersList;
    }

    public static function getMoUsers($pagename) {

        $db = db::getConnection();
 
         $usersList = array ();
         $result = $db->prepare('SELECT * from users as u left join groups as g on u.group_name LIKE CONCAT("%", g.group_name, "%") where g.group_name = :pagename');
         $result->bindParam(':pagename', $pagename);
         $result->execute();

         $i=0;
         while ($row = $result->fetch()) {
             $usersList[$i]['user_name'] = $row['user_name'];
             $usersList[$i]['post'] = $row['post'];
             $usersList[$i]['url'] = $row['url'];
             $usersList[$i]['photo_url'] = $row['photo_url'];
             $usersList[$i]['group'] = $row['group_desc'];
             $i++;
         }
         return $usersList;
     }
}
?>
