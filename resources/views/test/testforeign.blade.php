<html>
<head><meta charset="utf-8"></head>
<body><p>It works!</p>
<form method="POST" action="/indexTesDb" autocomplete="off">
  @csrf
  <div class="form-group">
    <label  type="email"  for="email">books</label>
    <input name="books" class="form-control" placeholder="Введите books">
  </div>
  <div class="form-group">
    <label for="password">author</label>
    <input name="author" type="password" class="form-control" id="password" placeholder="Введите пароль">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="save">
    <label name="save" class="form-check-label" for="save">запомнить меня</label>
  </div>
  <button type="submit" class="btn btn-primary">Войти</button>
</form>

<!-- <form>
  <form method="GET" autocomplete="off">
    <input placeholder="click"></input>
   <button onclick="redirect();">Войти</button>

</form> -->
  </body>

  <script>

  </script>
</html>