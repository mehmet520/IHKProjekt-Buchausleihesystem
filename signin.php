<?php
require_once 'themes/aheader.php';
require_once 'core/init.php';
// require_once $_SEVER["DOCUMENT_ROOT"].'/IHK_PRJ/core/init.php';  
// require_once $_SEVER["DOCUMENT_ROOT"].'/core/init.php';  // Uzk Server

?>

<!-- 
  Custom form layout and design for a simple sign in form.
  https://getbootstrap.com/docs/5.0/examples/sign-in/
 -->

<body class="text-center">
  <div class="container">
    <!-- Navbar Interne-Buchausleihe-System -->
    <nav class="navbar navbar-light bg-light ">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          Rechtwissenschaftliche Fakültät Interne-Buchausleihe-System
        </a>
      </div>
    </nav>
  </div>

  <div class="container">
    <!-- form login -->
    <main class="form-signin">
      <form method="post" action="<?php echo htmlspecialchars("result.php"); ?>">
        <img class="mb-4" src="images\001_university-of-cologne-logo-freelogovectors.net_-400x202.png" alt="" width="113" height="57" />
        <h3 class="text-primary text-center mb-5">Willkommen beim Buchausleihsystem!</h3>
        <h1 class="h3 mb-3 fw-normal">Bitte melden Sie sich an</h1>
        <div class="form-floating">
          <input type="text" class="form-control" id="username" name="username" placeholder="name@example.com" />
          <label for="floatingInput">Benutzernahme</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
          <label for="floatingPassword">Passwort</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Anmelden</button>
      </form>
    </main>
  </div>


  <?php require_once "themes/footer.php"; ?>