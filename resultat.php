<?php
    include('Fonctions.php');
    $debut=$_GET['debut'];
    $fin=$_GET['fin'];
    $totalCueillete=totalCueillete($debut, $fin);
    $totalRestant=poidRestant($debut, $fin);
    $revient=getCoutDeRevient($debut, $fin);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de résultat</title>
    <!-- Bootstrap CSS -->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/depense.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="my-4">Page de résultat</h2>
            <h4 class="mt-4">Global</h4>
            <div class="form-group">
                <label for="poidsTotal">Poids total cueillette</label>
                <input type="number" class="form-control" id="poidsTotal" min="0" step="0.01" required readonly value="<?php echo($totalCueillete)?>">
            </div>
            <div class="form-group">
                <label for="poidsRestant">Poids restant sur les parcelles à la date fin</label>
                <input type="number" class="form-control" id="poidsRestant" min="0" step="0.01" required readonly value="<?php echo($totalRestant)?>">
            </div>
            <div class="form-group">
                <label for="coutRevient">Coût de revient / kg</label>
                <input type="number" class="form-control" id="coutRevient" min="0" step="0.01" required readonly value="<?php echo($revient)?>">
            </div>
    </div>
    <footer class="footer-box">
        <div class="container px-4 px-lg-5">
          <div class="small text-center text-muted">ETU002515 ETU002742 ETU001647</div>
        </div>
      </footer>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>