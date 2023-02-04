<?php
include_once './core/models/Users.php';

class UsersController {

    public function actionindex() {
        define ('TEMPLATE', './public/templates/default');
        $pagename = "users";
        $userItem = array();
        $userItem = Users::getAllUsers();
        $pagetitle = "Педагогический состав";
        require_once (TEMPLATE.'/AllUsersList.tpl');
        return true;
    }

    public function actionByName($pagename) {
        define ('TEMPLATE', './public/templates/default');
        
        $userItem = array();
        $userItem = Users::getUserByName($pagename);
        $pagetitle = $userItem['user_name'];
        require_once (TEMPLATE.'/UserPage.tpl');
        return true;
    }

    public function actionmo($pagename) {
        define ('TEMPLATE', './public/templates/default');
        
        $userItem = array();
        $userItem = Users::getMoUsers($pagename);
        $pagetitle = $userItem[0]['group'];
        $group = $userItem[0]['group'];
        require_once (TEMPLATE.'/UsersList.tpl');
        return true;
    }
}
?>
