<?php
require_once(__DIR__.'/../classes/Db.class.php') ;

trait ProjectDAO{
    function createProject($projectName, $description, $owner, $email, $status){
        try{
            $connect = $this->connect();

            $stmt = $connect->prepare('INSERT INTO projects (title, `description`) VALUES (?,?);');
            $stmt->execute([$projectName, $description]);

            $projectId =  $connect->lastInsertId();
 
            $this->insertOwner($projectId, $owner, $email);
            $this->insertStatus($projectId, $status);
 
        } catch (PDOException $e) {
            echo "Error!: ".$e->getMessage()."<br>";
        }
    }

    function insertOwner($projectId, $owner, $email){
        try{
            $connect = $this->connect();
           
           $selectOwner = $connect->prepare('SELECT * FROM owners WHERE name = ? AND email = ?;');
           $selectOwner->execute([$owner, $email]);
           $results = $selectOwner->fetchAll();
           
           if(empty($results)){
               $insertOwner = $connect->prepare("INSERT INTO owners (name, email) VALUES(?,?);");
               $insertOwner->execute([$owner, $email]);
               
               $ownerId = $connect->lastInsertId();
            }else{
                $ownerId = $results[0]['id'];
            }

            $insertRelationship = $connect->prepare('INSERT INTO project_owner_pivot (project_id, owner_id) VALUES (?,?);');

            $insertRelationship->execute([$projectId, $ownerId]);
        }catch (PDOException $e){
            echo "Error!: ".$e->getMessage()."<br>";
        }
    }

    function insertStatus($projectId, $status)
    {
        try{
            $statusInsert = $this->connect()->prepare('INSERT INTO project_status_pivot (project_id, status_id) VALUES (?,?)');

            $statusInsert->execute([$projectId, $status]);

        } catch (PDOException $e) {
            echo "Error!: ".$e->getMessage()."<br>";
        }
    }

    function readProject($pageOne, $perPage){
        try{
            $stmt = $this->connect()->prepare('SELECT projects.id AS projectId, title, `owners`.`name` AS contact, `email`, statuses.name AS `status`
            FROM projects
            LEFT JOIN project_owner_pivot ON project_owner_pivot.project_id = projects.id
            LEFT JOIN owners ON owners.id = project_owner_pivot.owner_id
            LEFT JOIN project_status_pivot ON project_status_pivot.project_id = projects.id
            LEFT JOIN statuses ON statuses.id = project_status_pivot.status_id
            LIMIT ?, ?
            ;');

            $stmt->bindParam(1, $pageOne, PDO::PARAM_INT);
            $stmt->bindParam(2, $perPage, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll();

        } catch (PDOException $e) {
            echo "Error!: ".$e->getMessage()."<br>";
        }

    }

    function pagination($perPage){
        try{
            

            $projectCount = $this->connect()->prepare('SELECT COUNT(*) FROM projects');
            $projectCount->execute();
            $count = $projectCount->fetchColumn();
            $count = ceil($count / $perPage);
            
            return $count;

        }catch (PDOException $e){
            echo "Error!: ".$e->getMessage()."<br>";
        }
    }

    function readOneProject($projectId){
        try{
            $stmt = $this->connect()->prepare('SELECT title, `description`, `owners`.`name` AS contact, `email`, statuses.name AS `status`
            FROM projects
            LEFT JOIN project_owner_pivot ON project_owner_pivot.project_id = projects.id
            LEFT JOIN owners ON owners.id = project_owner_pivot.owner_id
            LEFT JOIN project_status_pivot ON project_status_pivot.project_id = projects.id
            LEFT JOIN statuses ON statuses.id = project_status_pivot.status_id
            WHERE projects.id = ?
            ;');

            $stmt->execute([$projectId]);

            return $stmt->fetch();

        }catch (PDOException $e){
            echo "Error!: ".$e->getMessage()."<br>";
        }
    }

    function updateProject($projectId, $projectName, $description, $owner, $email, $status){
        try{
            $connect = $this->connect();
            $stmt = $connect->prepare('UPDATE projects SET title = ?, `description` = ? WHERE id = ?');
            $stmt->execute([$projectId, $projectName, $description]);

            $this->updateOwner($projectId, $owner, $email);
            $this->updateStatus($projectId, $status);

        }catch (PDOException $e){
            echo "Error!: ".$e->getMessage()."<br>";
        }
    }

    function updateOwner($projectId, $owner, $email){
        try{
            $connect = $this->connect();

            $selectOwner = $connect->prepare('SELECT * FROM owners WHERE name = ? AND email = ?;');
            $selectOwner->execute([$owner, $email]);
            $results = $selectOwner->fetchAll();

            foreach ($results as $result) {
                $updateRelationship = $connect->prepare('UPDATE project_owner_pivot SET owner_id = ? WHERE project_id = ?;');
                $updateRelationship->execute([$result["id"], $projectId]);

            }
            
            if(empty($results)){
                $insertOwner = $connect->prepare("INSERT INTO owners (name, email) VALUES(?,?);");
                $insertOwner->execute([$owner, $email]);

                $updateOwner = $connect->prepare('UPDATE owners SET name = :owner , email = ? WHERE id = ?;');
                $updateOwner->execute([$owner, $email, $result["id"]]);
            }
        }catch(PDOException $e){
            echo "Error!: ".$e->getMessage()."<br>";
        }
    }

    function updateStatus($projectId, $status){
        try {
            $stmt = $this->connect()->prepare("UPDATE project_status_pivot SET status_id = ? WHERE project_id = ?;");
            $stmt->execute([$status, $projectId]);

        }catch(PDOException $e){
            echo "Error!: ".$e->getMessage()."<br>";
        }
    }



    function deleteProject($projectId){
        try{
            $connect = $this->connect();
            

            $selectOwner = $connect->prepare('SELECT * FROM owners
            LEFT JOIN project_owner_pivot ON project_owner_pivot.owner_id = owners.id
            WHERE project_owner_pivot.project_id = ?;');

            $selectOwner->execute([$projectId]);
            $results = $selectOwner->fetch();

            $deleteOwnerRelationship = $connect->prepare("DELETE FROM project_owner_pivot WHERE project_id = ?;");
            $deleteStatusRelationship = $connect->prepare("DELETE FROM project_status_pivot WHERE project_id = ?;");

            $deleteOwnerRelationship->execute([$projectId]);
            $deleteStatusRelationship->execute([$projectId]);
            
            $deleteOwner = $connect->prepare("DELETE FROM owners WHERE id = ".$results['id'].";");

            $deleteProject = $connect->prepare("DELETE FROM projects WHERE id = ?;");

            $deleteProject->execute([$projectId]);
            $deleteOwner->execute([$results['id']]);

            $result = [$deleteProject->fetchAll(), $deleteOwnerRelationship->fetchAll(), $deleteStatusRelationship->fetchAll(), $deleteOwner->fetchAll()];

            return $result;
        } catch (PDOException $e) {
            echo "Error!: ".$e->getMessage()."<br>";
        }
    }

    function selectStatus(){
        try{
            $stmt = $this->connect()->query('SELECT * FROM statuses;');

            return $stmt->fetchAll();

        } catch (PDOException $e) {
            echo "Error!: ".$e->getMessage()."<br>";
        }
    }

    function search($search){
        try{
            $stmt = $this->connect()->prepare('SELECT projects.id AS projectId, title, `description`, `owners`.`name` AS contact, `email`, statuses.name AS `status`
            FROM projects
            LEFT JOIN project_owner_pivot ON project_owner_pivot.project_id = projects.id
            LEFT JOIN owners ON owners.id = project_owner_pivot.owner_id
            LEFT JOIN project_status_pivot ON project_status_pivot.project_id = projects.id
            LEFT JOIN statuses ON statuses.id = project_status_pivot.status_id
            WHERE statuses.key = ?;');
            $stmt->execute([$search]);
            $result = $stmt->fetchAll();

            return $result;

        } catch (PDOException $e) {
            echo "Error!: ".$e->getMessage()."<br>";
        }
    }

}
