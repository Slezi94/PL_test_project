<?php
require_once(__DIR__.'/../traits/ProjectDao.trait.php');

class Project extends Db{
    use ProjectDAO;

    function validate($projectName, $description, $owner, $email, $status){
        $message = [];

        if($projectName == ''){
            $message[] = "A projekt neve kötelező! <br>";
        }

        if($description == ''){
            $message[] = "A projekt leírása kötelező! <br>";
        }

        if($description == ''){
            $message[] = "A projekt leírása kötelező! <br>";
        }

        if($owner == ''){
            $message[] = "A kapcsolattartó neve kötelező";
        }elseif(!preg_match('/^[a-zA-ZáéíóöőúüűÁÉÍÓÖŐÚÜŰ ]*$/', $owner)){
            $message[] = "A kapcsolattartó neve nem megfelelő! <br>";
        }

        if(empty($email)){
            $message[] = "A kapcsolattartó e-mail címe kötelező! <br>";
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $message[] = "A kapcsolattartó e-mail címe nem megfelelő!";
        }

        return $message;
    }
    function validateProject($projectName, $description, $owner, $email, $status)
    {
        $message = $this->validate($projectName, $description, $owner, $email, $status);

        if(empty($message)){
            $this->createProject($projectName, $description, $owner, $email, $status);
        }
        return $message;

    }

    function validateupdate($projectId, $projectName, $description, $owner, $email, $status)
    {
        $message = $this->validate($projectName, $description, $owner, $email, $status);

        if(empty($message)){
            $this->updateProject($projectId, $projectName, $description, $owner, $email, $status);
        }
        return $message;

    }
}