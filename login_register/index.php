<?php

session_start();

$errors = [
  'login' => $_SESSION['login_error'] ?? '',
  'register' => $_SESSION['register_error'] ?? ''
];
$active_form = $_SESSION['active_form'] ?? 'login';

session_unset();

function showError($error) {
  return !empty($error) ? "<p class='error-message show'>$error</p>" : '';
}

function isActiveForm($formName, $active_form) {
  return $formName === $active_form ? 'active' : '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full-Stack Login & Register Form With User & Admin Page | Codehal</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <script src="script.js"></script>

 <div class="container">

   <img id="bg-gif" src="images/globalize.gif" alt="Background">
    <div class="container">
        <div class="form-box <?= isActiveForm('login', $active_form) ?>" id="login-form">
            <form action="login_register.php" method="post">
    <input type="hidden" name="login" value="1">
    <h2>Login</h2>
    <?= showError($errors['login']); ?>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
    <p>Don't have an account? <a href="#" onclick="showForm('register-form')">Register</a></p>
  </form>
  </div>

  <div class="form-box <?= isActiveForm('register', $active_form) ?>" id="register-form">
  <form action="login_register.php" method="post">
    <input type="hidden" name="register" value="1">
    <h2>Register</h2>
    <?= showError($errors['register']); ?>
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <select name="role" required>
      <option value="">--Select Role--</option>
      <option value="user">User</option>
      <option value="admin">Admin</option>
    </select>
    <button type="submit">Register</button>
    <p>Already have an account? <a href="#" onclick="showForm('login-form')">Login</a></p>
  </form>
  </div>
 </div>

    <script src="script.js"></script>
</body>

</html>