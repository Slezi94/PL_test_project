<!-- Header -->
<?php
    include '../includes/header.inc.php';
?>

<!-- Navbar -->

<?php
    include '../includes/navbar.inc.php';
?>

<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-10">
                    <h5 class="card-title">Card title</h5>
                    <!-- vissza gomb? -->
                </div>
                <div class="col-lg-2">
                    <p class="float-end">státusz</p>
                </div>
            </div>

            <div class="row">
                <p class="card-text">leírás</p>
                <p class="mt-3 float-start">contact</p>
            </div>

            <div class="row">
                <div class="col-lg-5">
                    <a href="#" class="btn btn-primary">Szerkesztés</a>
                    <button class="btn btn-danger">Törlés</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<?php
    include '../includes/footer.inc.php';
?>