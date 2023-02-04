<?php
include_once './core/models/Page.php';
include_once './core/mailer.php';

class MainController {

    public function actionIndex() {
        define ('TEMPLATE', './public/templates/default');
        $pagetitle = "Главная страница";
        $pagedescription = "Официальный сайт школы №290 Красносельского района г. Санкт Петербург"; 
        require_once (TEMPLATE.'/MainIndex.tpl');
        return true;
    }

    
    public function actionPage($pagename) {
        define ('TEMPLATE', './public/templates/default');
        
        $pageItem = array();
        $pageItem = Page::getPageByName($pagename);
        If($pageItem != '') {
        $pagetitle = $pageItem['name'];
        $pagedescription = $pageItem['description'];
        require_once (TEMPLATE.'/StaticPage.tpl');
        return true;
        } else 
        {
            define ('TEMPLATE', './public/templates/default');
            $pagetitle = "Страница не найдена";
            require_once (TEMPLATE.'/404.tpl');
            return true;
        }
    }

    public function actionProject($pagename) {
        define ('TEMPLATE', './public/templates/default');
        
        $pageItem = array();
        $pageItem = Page::getPageByName($pagename);
        If($pageItem != '') {
        $pagetitle = $pageItem['name'];
        $pagedescription = $pageItem['description'];
        require_once (TEMPLATE.'/StaticPage.tpl');
        return true;
        } else 
        {
            define ('TEMPLATE', './public/templates/default');
            $pagetitle = "Страница не найдена";
            require_once (TEMPLATE.'/404.tpl');
            return true;
        }
    }

    public function actionContacts() {
        define ('TEMPLATE', './public/templates/default');
        $pagetitle = "Контакты";
        if($_POST['cap'] == "290")

{
        if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message']) && isset($_POST['mailto'])) {

            if ($_POST['sesid'] == session_id() And $_SESSION['sch'] == session_id()) {
                $name = strip_tags(trim($_POST['name']));
                $email = strip_tags(trim($_POST['email']));
                $mailto = strip_tags(trim($_POST['mailto']));
                $subject = $mailto;
                $subject .= ": Тема: ";
                $subject .= strip_tags(trim($_POST['subject']));
                $message = "Вам пришло письмо от: $name, <B>".$email."</B>, с сайта школы sch290.ru\r\n";
                $message .= "<BR>Содержание письма: \r\n<BR>";
                $message .= wordwrap(strip_tags($_POST['message']), 70, "\r\n");
                
                $to = "\r\n";
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= "Content-type: text/html; charset=UTF-8\r\n"; 
                $headers .= "From: \r\n"; 
                $headers .= "Reply-To: ".$email."\r\n"; 
                $headers .= "X-Mailer: PHP\r\n"; 
                $headers .= "Bcc: \r\n"; 
                $headers .= "Errors-To: \r\n"; 
   
                
                $mail = mail($to, $subject, $message, $headers);
                header("Location: ".$_SERVER['REQUEST_URI']);
            }
        } 
    }
        require_once (TEMPLATE.'/ContactsPage.tpl');
        return true;
    }

    public function actionNotfound() {
        define ('TEMPLATE', './public/templates/default');
        $pagetitle = "Страница не найдена";
        require_once (TEMPLATE.'/404.tpl');
        return true;
    }
}
?>
