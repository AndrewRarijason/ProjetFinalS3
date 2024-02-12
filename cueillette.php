<?php 
    include('Fonctions.php');
    $table1="Cueilleurs";
    $table2="Parcelles";
    $cueilleurs=getAll($table1);
    $parcelles=getAll($table2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Thé</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/user.css" rel="stylesheet" />
    <script type="text/javascript">
        function getXhr()
        {
            var xhr;
            try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
            catch (e) 
            {
                try {   xhr = new ActiveXObject('Microsoft.XMLHTTP'); }
                catch (e2) 
                {
                try {  xhr = new XMLHttpRequest();  }
                catch (e3) {  xhr = false;   }
                }
            }
	        return xhr;
        }
        window.addEventListener("load", function () 
        {
          var form=document.getElementById("harvestForm");
          function sendData(form) 
          {
                var xhr=getXhr(); 
                var formData = new FormData(form);

                xhr.addEventListener("load", function(event) {
                });

                // Definissez ce qui se passe en cas d'erreur
                xhr.addEventListener("error", function(event) {
                    alert('Oups! Quelque chose s\'est mal passé.');
                });

                // Configurez la requête
                xhr.open("POST", "validation.php"); xhr.send(formData);
          }
          function receiveMessage() 
          {
              var xhr = getXhr();
              xhr.onreadystatechange = function() { 
                  if (xhr.readyState == 4) {
                      if (xhr.status == 200) 
                      {
                          var retour = xhr.responseText;
                          alert(retour);
                      } else {
                          console.error('La requête a échoué avec un statut : ' + xhr.status);
                      }
                  } 	
              }
              xhr.open("GET", "validFinal.php", true);
              xhr.send(null);
          }
          form.addEventListener("submit", function (event) 
          {
            sendData(form);
            receiveMessage();
  	      });
      });
    </script>
</head>
<body>
  <div class="container">
    <h2 class="my-4">Saisie des cueillettes</h2>
    <form id="harvestForm">
      <div class="form-group">
        <label for="date">Date</label>
        <input type="date" class="form-control" id="date" name="dateCueillete" required>
      </div>
      <div class="form-group">
        <label for="cueilleur">Choix cueilleur</label>
        <select class="form-control" id="cueilleur" name="cueilleur" required >
          <?php foreach ($cueilleurs as $row) { ?>
            <option value="<?php echo($row['id']) ?>"><?php echo($row['nom']) ?></option>
          <?php }?>
          <!-- Add options for cueilleurs dynamically using JavaScript or load from database -->
        </select>
      </div>
      <div class="form-group">
        <label for="parcelle">Choix parcelle</label>
        <select class="form-control" id="parcelle"  name="parcelle" required>
          <?php foreach ($parcelles as $row) { ?>
            <option value="<?php echo($row['id']) ?>"><?php echo($row['id']) ?></option>
          <?php }?>
          <!-- Add options for parcelles dynamically using JavaScript or load from database -->
        </select>
      </div>
      <div class="form-group">
        <label for="poids">Poids cueilli (kg)</label>
        <input type="number" class="form-control" id="poids" min="0" step="0.01" name="poids" required>
      </div>
      <button type="submit" class="btn btn-primary">Valider</button>
    </form>
  </div>

  <!-- JavaScript for AJAX validation will go here -->

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<footer class="py-5">
  <div class="container px-4 px-lg-5">
      <div class="small text-center text-muted">ETU002515 ETU002742 ETU001647</div>
  </div>
</footer>
</html>