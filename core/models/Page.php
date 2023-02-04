<?php

require_once('./core/config/db.php');

class Page {

    public static function getPageByName($pagename) {

        $db = db::getConnection();
        $result = $db->prepare("SELECT name, text, p.description, user_name, post, u.url, photo_url FROM pages as p LEFT JOIN users as u on p.user_id = u.id WHERE p.url= :pagename");
        $result->bindParam(':pagename', $pagename);
        $result->execute();
        $pageItem = $result->fetch();
        return $pageItem;
        
    }
}
?>
