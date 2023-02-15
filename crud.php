<?php

require_once(__DIR__."/classes/Project.class.php");
require_once(__DIR__."/traits/ProjectDao.trait.php");

$project = new Project();

if(isset($_POST["action"]) && ($_POST["action"] == "insert")){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $owner = $_POST['owner'];
    $email = $_POST['email'];
    
    

    echo json_encode($project->validateProject($title, $description, $owner, $email, $status));

}

if(isset($_POST["action"]) && ($_POST["action"] == "update")){
    $projectId = $_POST["id"];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $owner = $_POST['owner'];
    $email = $_POST['email'];
    
    echo json_encode($project->validateupdate($projectId, $title, $description, $owner, $email, $status));

} 

if(isset($_POST["action"]) && ($_POST["action"] == "delete")){
    $projectId = $_POST["id"];

    $project->deleteProject($projectId);

} 



