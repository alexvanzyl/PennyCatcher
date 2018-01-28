<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="css/app.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div class="container mx-auto px-4">
      @if (Route::has('login'))
        <div class="top-right links">
          @auth
            <a href="{{ url('/home') }}">Home</a>
          @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
          @endauth
        </div>
      @endif

      <div class="content">
        <div class="title m-b-md">
          Test2
        </div>

        <ul class="list-reset flex">
          <li class="mr-6">                    
            <a class="text-blue hover:text-blue-darker" href="https://laravel.com/docs">Documentation</a>
          </li>
          <li class="mr-6">                    
            <a class="text-blue hover:text-blue-darker" href="https://laracasts.com">Laracasts</a>
          </li>
          <li class="mr-6">                    
            <a class="text-blue hover:text-blue-darker" href="https://laravel-news.com">News</a>
          </li>
        </ul>
      </div>
    </div>
  </body>
</html>
