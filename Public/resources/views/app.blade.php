<!DOCTYPE html>
<html>
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>@yield('title') | Quiz</title>
        
        <!-- CSS  -->
        
        <!-- Compiled and minified CSS -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
        
        <!-- Compiled and minified JavaScript -->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
        <script src="js/function.js"></script>
        
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    
    </head>
    <body>
    
        @include('partials/header')
        <div class="container">
            @yield('content')
        </div>    
        
        
        <!-- Compiled and minified JavaScript -->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
        
        <!-- third party js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular-route.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular-animate.min.js"></script>
        <script src="js/function.js"></script>
        <!-- Our application scripts -->
        <script src="js/app.js"></script>
        <script src="js/controllers/load.js"></script>
        <script src="js/controllers/list.js"></script>
        <script src="js/controllers/quiz.js"></script>
        <script src="js/controllers/results.js"></script>
        <script src="js/factories/quizMetrics.js"></script>
        <script src="js/factories/dataService.js"></script>
    </body>
</html>
