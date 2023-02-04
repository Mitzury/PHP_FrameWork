<?php
require_once('./core/config/db.php');

class Search {

    public static function searchselector ($searchquery, $searchoption) { 

        $pattern = array("<", ">", "\\", "/", ".", ",", "=", ";", ":", "-", "—", "–", "&", "%", "*");
        $input_text = trim(str_replace($pattern, '', $searchquery));
        
 switch ($searchoption) {
        case "page":
            $result = Search::searchbyall($input_text);
            break;
        case "teachers":
            $result = Search::searchbyuser($input_text);
            break;
        default: 
        $result = Search::searchbyall($input_text);
 }

 return $result;
    }

    public static function searchbyall ($input_text) { 
        
        $db = db::getConnection();
        $searchList = array ();

        $result = $db->query("SELECT name, url, description, keywords FROM pages");
        $result->execute();

        $i=0;
        while ($row = $result->fetch()) {
            $searchList[$i]['name'] = $row['name'];
            $searchList[$i]['url'] = $row['url'];
            $searchList[$i]['description'] = $row['description'];
            $searchList[$i]['keywords'] = $row['keywords'];
            $i++;
        }
        foreach ($searchList as &$sr) {
            $sr['index'] = "0";
        }
        $count = count($searchList) - 1;
        $i = 0;


    while ($i <= $count) {
        $string = $searchList[$i]['keywords']; 
        $sim = similar_text($string, $input_text, $perc);
        $searchList[$i]['index'] = $sim; 
        $i++;
    }
   function compare ($v1, $v2) {
        /* Сравниваем значение по ключу date_reg */
        if ($v1["index"] == $v2["index"]) return 0;
        return ($v1["index"] > $v2["index"])? -1: 1;
      }
    usort($searchList, "compare"); // Вызываем пользовательскую сортировку
    

    return $searchList; 
    } 

    public static function searchbyuser ($input_text) { 
        
        $db = db::getConnection();
        $searchList = array ();

        $result = $db->query("SELECT user_name, url, post, photo_url FROM users where user_name like '%".$input_text."%'");
        $result->execute();

        $i=0;
        while ($row = $result->fetch()) {
            $searchList[$i]['name'] = $row['user_name'];
            $searchList[$i]['url'] = $row['url'];
            $searchList[$i]['description'] = $row['post'];
            $searchList[$i]['photo_url'] = $row['photo_url'];
            $i++;
        }

    return $searchList; 
    } 
 }
?>
