<?php
    $filter = new Project();
    $statuses = $filter->selectStatus();
?>

<nav class="navbar navbar-expand-lg navbar-fixed-top bg-dark" id="navbar">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a href="#" class="nav-link">WeLove Test</a></li>
        <li class="nav-item"><a href="/Projects/PamutLabor/index.php" class="nav-link active">Projektlista</a></li>
        <li class="nav-item"><a href="createForm.php" class="nav-link active" aria-current="page">Szerkesztés/Létrehozás</a></li>
        <li class="nav-item">
            <select id="filter" class="float-end mt-2 ms-3">
                <option selected value="">Válasszon</option>
                <?php
                    foreach($statuses as $status){
                        echo "<option value='" . $status['key'] . "'>" . $status['name'] . "</option>";
                    }
                ?>
            </select>
        </li>
    </ul>
</nav>