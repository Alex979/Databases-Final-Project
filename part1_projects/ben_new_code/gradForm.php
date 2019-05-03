<html>

<head>
  <title>ADS</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
  <?php
  include('../FlatEarthSociety/public_html/navbar.php');
  ?>
  <div class="container mt-3">
    <h1 class="text-primary">Apply to Graduate</h1>
    <form action="applyToGraduate.php" method="post" style="max-width: 500px">
      <div class="form-group">
        <label>Student Number</label>
        <input class="form-control" type="text" name="uid" required>
      </div>
      <div class="form-group">
        <label>Degree Type</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="degree" value="masters">
          <label class="form-check-label">Masters</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="degree" value="phd">
          <label class="form-check-label">PhD</label>
        </div>
      </div>
      <input class="btn btn-primary" type="submit" value="Apply" />
    </form>
     </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
