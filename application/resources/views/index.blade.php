<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Penny Catcher</title>

    <!-- Fonts -->
    <link href="css/app.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="app">
      <topnav></topnav>
      
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <budget-categories type="expenses"></budget-list>
          </div>
          <div class="col">
            <budget-categories type="income"></budget-list>
          </div>
        </div> <!-- /.row -->
      </div> <!-- /.container-fluid -->

    </div>
  </body>
  <script src="/js/app.js"></script>
</html>
