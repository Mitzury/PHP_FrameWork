<?php
include_once './core/models/search.php';

class SearchController {

    public function actionindex() {
        define ('TEMPLATE', './public/templates/default');
        $pagetitle = "Поиск";
        $pagedescription = "Страница поиска по сайту школы №290 Красносельского района г. Санкт Петербург";
        if(isset($_POST['searchquery'])) {
            $searchquery = $_POST['searchquery'];
            $searchoption = $_POST['searchoption'];
            $searchResult = Search::searchselector($searchquery, $searchoption);
        } 
        
        require_once (TEMPLATE.'/Search.tpl');
        return true;
 }
}

?>
