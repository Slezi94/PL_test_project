<?php
require_once("classes/Db.class.php") ;

class Test extends Db{
    //use Owner;

    function readOneProject(){
        try{
            $stmt = $this->connect()->prepare('SELECT projects.id AS projectId, title, `description`, `owners`.`name` AS contact, `email`, statuses.name AS `status`
            FROM projects
            LEFT JOIN project_owner_pivot ON project_owner_pivot.project_id = projects.id
            LEFT JOIN owners ON owners.id = project_owner_pivot.owner_id
            LEFT JOIN project_status_pivot ON project_status_pivot.project_id = projects.id
            LEFT JOIN statuses ON statuses.id = project_status_pivot.status_id
            WHERE statuses.key = todo;');
            $stmt->execute();
            $result = $stmt->fetchAll();

            return $result;


        }catch (PDOException $e){
            echo "Error!: ".$e->getMessage()."<br>";
        }
    }
}

$t = new Test();
$faszom = $t->readOneProject();

foreach ($faszom as $fasz){
    echo $fasz['title']. ", " . $fasz['status'];
}

