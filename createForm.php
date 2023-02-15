<!-- Class -->
<?php
    require_once('classes/Project.class.php');
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

    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
        <p id="error-message"></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        <p id="success-message"></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <form action="../crud.php" method="post" class="mt-3" id="createform">
        <div class="mb-3">
            <label for="" class="form-label">Cím</label>
            <input type="text" class="form-control" id="title">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Leírás</label>
            <input type="text" class="form-control" id="description">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Státusz</label>
            <select id="status-insert" class="form-select form-select-sm" aria-label=".form-select-sm">
                <?php
                    $status = new Project();
                    $statuses = $status->selectStatus();
                    foreach($statuses as $s){
                        echo "<option value='".$s['id']."'>".$s['name']."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Kapcsolattartó neve</label>
            <input type="text" class="form-control" id="owner">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Kapcsolattartó e-mail címe</label>
            <input type="text" class="form-control" id="email">
        </div>
        <div>
            <button class="btn btn-primary" type="button" id="save">Mentés</button>
        </div>
    </form>
</div>

<!-- Footer -->
<?php
    include 'includes/footer.inc.php';
?>