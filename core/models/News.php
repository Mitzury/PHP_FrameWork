<?php

require_once('./core/config/db.php');

class News {

    public static function getNewsItemById($id) {

        $db = db::getConnection();
        $result = $db->query('SELECT title, date, short_content, full_content, users.url, users.user_name FROM news join users on news.author = users.id WHERE news.id='.$id);
        $result->setFetchMode(PDO::FETCH_ASSOC);
  
        return $result->fetch();
    }

    public static function getNewsList($page) {
        $page = intval($page);
        $offset = ($page - 1) * 5;
       $db = db::getConnection();

        $newsList = array ();
        $result = $db->query('SELECT id, title, date, short_content FROM news ORDER BY date DESC LIMIT 5 OFFSET '.$offset);

        $i=0;
        while ($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['short_content'] = $row['short_content'];
            $i++;
        }
        return $newsList;
    }
    public static function getTotalNews() {

        $db = db::getConnection();
        $result = $db->query('SELECT count(id) AS count FROM news');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
      
        return $row['count'];
    }
}
?>
