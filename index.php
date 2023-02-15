<?php require_once('classes/Db.class.php'); ?>
<?php require_once('classes/Project.class.php'); ?>
<?php require_once('traits/ProjectDao.trait.php'); ?>


<!--Header-->
<?php include 'includes/header.inc.php'; ?>

<!--Navbar-->
<?php include 'includes/navbar.inc.php'; ?>

<div class="container">
    <div>
        <?php
            $perPage = 10;

            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }else{
                $page = "";
            }

            if($page == "" || $page == 1){
                $pageOne = 0;
            }else{
                $pageOne = ($page * $perPage) - $perPage;
            }

            $project = new Project();
            $count = $project->pagination($perPage);
            $projects = $project->readProject($pageOne, $perPage);

            if(isset($_GET["status"])){
                $matches = $project->search($_GET["status"]);
            }

            if(empty($matches) && empty($projects)){
                echo "<h1>Nincs megjeleníthető tartalom</h1>";
            }elseif(!empty($matches)){
                foreach ($matches as $match) {
                    echo "<div class='card mt-3 project'>
                            <div class='card-body'>
                                <div class='row'>
                                    <div class='col-lg-10'>
                                        <input class='project-id' value='" . $match["projectId"] . "'></input>
                                        <h3><a href='readForm.php?id=". $match["projectId"] ."'>". $match["title"] ."</a></h3>
                                    </div>
                                    <div class='col-lg-2'>
                                        <p class='float-end'>". $match["status"] . "</p>
                                    </div>
                                </div>
                
                                <div class='row'>
                                    <p>" . $match["contact"] . " " . $match["email"] . "</p>
                                </div>
                
                                <div class='row'>
                                    <div class='col-lg-5'>
                                        <a href='updateForm.php?id=" . $match["projectId"] . "' class='btn btn-primary edit'>Szerkesztés</a>
                                        <button class='btn btn-danger delete' data-id=". $match["projectId"] .">Törlés</button>
                                    </div>
                                </div>
                            </div>
                        </div>";
                }
            }else{
                foreach($projects as $p){
                    echo "<div class='card mt-3 project'>
                            <div class='card-body'>
                                <div class='row'>
                                    <div class='col-lg-10'>
                                        <input class='project-id' value='" . $p["projectId"] . "'></input>
                                        <h3><a href='readForm.php?id=". $p["projectId"] ."'>". $p["title"] ."</a></h3>
                                    </div>
                                    <div class='col-lg-2'>
                                        <p class='float-end'>". $p["status"] . "</p>
                                    </div>
                                </div>
                
                                <div class='row'>
                                    <p>" . $p["contact"] . " " . $p["email"] . "</p>
                                </div>
                
                                <div class='row'>
                                    <div class='col-lg-5'>
                                        <a href='updateForm.php?id=" . $p["projectId"] . "' class='btn btn-primary edit'>Szerkesztés</a>
                                        <button class='btn btn-danger delete' data-id=". $p["projectId"] .">Törlés</button>
                                    </div>
                                </div>
                            </div>
                        </div>";
                }
            }
        ?>
        <ul class="pagination d-flex justify-content-center mt-3">
            <?php
                for($i = 1; $i <= $count; $i++){
                    echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                }
            ?>
            <li></li>
        </ul>
    </div>
</div>

<!--Footer-->
<?php include 'includes/footer.inc.php'; ?>