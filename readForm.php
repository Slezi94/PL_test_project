<!-- Class -->
<?php
    require_once('classes/Project.class.php');

    $projectId = $_GET['id'];
    $project = new Project();
    $result = $project->readOneProject($projectId);
?>

<!-- Header -->
<?php
    include 'includes/header.inc.php';
?>

<!-- Navbar -->

<?php
    include 'includes/navbar.inc.php';
?>

<div class="container">
    <div class="row mt-3">
        <div class="col-lg-10">
            <h3><?php echo $result["title"]?></h3>
        </div>
        <div class="col-lg-2">
            <a href="index.php" class="btn btn-primary">Vissza</a>
        </div>
    </div>
    <div class="row mt-3">
        <h6><?php echo $result["status"]?></h6>
    </div>
    <div class="row mt-3">
        <h6 class="float-start"><?php echo $result["contact"]?> <?php echo $result["email"]?></h6>
    </div>
    <div class="row mt-3">
        <p><?php echo $result["description"]?></p>

    </div>
    <div class="row mt-3">
        <div class="col-lg-5">
            <a href="updateForm.php?id=<?php echo $projectId ?>" class="btn btn-primary edit">Szerkesztés</a>
            <button class="btn btn-danger delete" data-id="<?php echo $projectId ?>">Törlés</button>
        </div>
    </div>

</div>

<!-- Footer -->
<?php
    include 'includes/footer.inc.php';
?>