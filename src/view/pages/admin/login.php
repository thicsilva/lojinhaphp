<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?=$base?>/assets/css/admin.css">
</head>
<body>
  <div id="login">
  <?php if (isset($_SESSION['flash'])): ?>
    <div class="notification">
      <div class="message <?=$_SESSION['flash']['type']; ?>">
        <?=$_SESSION['flash']['message']; ?>
      </div>
    </div>
  <?php 
    unset($_SESSION['flash']);
    endif 
  ?>
    <main>
      <div class="form-container">
        <h2>Acesse sua conta</h2>
        <form action="<?=$base?>/admin/login" method="post">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password">
            <button type="submit" class="btn">Entrar</button>
        </form>  
      </div>
  </main>

  
    
  </div>
      
</body>
</html>