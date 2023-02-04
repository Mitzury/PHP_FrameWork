<?php
include_once './core/models/News.php';
include_once './core/Pagination.php';

class NewsController {
    public $total;
    public $pagesCount;
    public $page;
    public $currentPage;

    public function actionIndex($page = 1) {
        
        define ('TEMPLATE', './public/templates/default');

        $newsList = array();
        $newsList = News::getNewsList($page);
        $this->total = News::getTotalNews();
        $this->pagesCount = $this->getCountPages();
        $pagetitle = "Новости";


        $cp = ($this->currentPage - 1) * 5;
        $pagesCount = $this->pagesCount;
        if($page > 1)  {
            $back = intval($page - 1);
        } else {
            $back = 1;
        }
        if($page < $this->pagesCount) {
            $forward = intval($page + 1);
        } else $forward = $pagesCount;


        require_once (TEMPLATE.'/NewsList.tpl');
        return true;
    }

    public function actionView($id) {
        define ('TEMPLATE', './public/templates/default');
        $newsItem = array();
        $newsItem = News::getNewsItemById($id);
        $pagetitle = $newsItem['title'];
        require_once (TEMPLATE.'/OneNewsList.tpl');
        return true;
    }
    public function getCountPages() {
        return ceil ($this->total / 5);
    }

    public function getCurrentPage($page)
    {
        if (!$page || $page < 1) $page = 1;
        if($page > $this->countPages) $page = $this->countPages;
        return $page;
    }
}
?>
