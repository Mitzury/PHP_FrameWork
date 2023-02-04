<?php

class Pagination {

    public $total;
    public $page;
    public $perPage = 5;
    public $countPages;

        public function __construct($total, $page)
        {
            $this->total=$total;
            $this->page= $this->getCurrentPage($page);
            $this->countPages = $this->getCountPages();
        }

        public function getCountPages() {
            return ceil ($this->total / $this->perPage) ?: 1;
        }

        public function getCurrentPage($page)
        {
            if (!$page || $page < 1) $page = 1;
            if($page > $this->countPages) $page = $this->countPages;
            return $page;
        }
  
        public function getStart() {
            return ($this->currentPage - 1) * $this->perPage;
        }

        public function __toString()
        {
            return $this->getHtml();
        }

        public function getHtml() {
            $back = NULL;
            $forward = NULL;
            $startpage = NULL;
            $endpage = NULL;
        }
}
?>
