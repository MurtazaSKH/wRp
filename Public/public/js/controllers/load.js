angular.module('load', ['ngRoute'])
    .config(['$routeProvider', function($routeProvider){
        $routeProvider
            .when('/', {
                templateUrl: 'js/templates/quiz.html',
                controller: 'loadCategories'
            })
    }])
    
    .controller('loadCategories', function(quizMetrics, dataService){
        load();
        var vm = this;
        
        vm.dataService = dataService;
        vm.quizMetrics = quizMetrics;
        vm.data = dataService.turtlesData;
        vm.search = "";
        vm.activeQuestion = {};
        vm.activateQuiz = activateQuiz;
        vm.changeActiveQuestion = changeActiveQuestion;
        
        vm.categoryData = {};
        function load(){
            dataService.getCategories()
                .success(function(data){
                    vm.categoryData = data.data;
                     console.log(vm.categoryData);
                });
        }
        
        function changeActiveQuestion(index){
            vm.activeTurtle = index;
        }
        
        function activateQuiz(id) {
            setTimeout(function(){
                alert('Time\'s Up');
                quizMetrics.changeState('quiz', false);
                quizMetrics.changeState('results', true);
                quizMetrics.markQuiz();
            },60000);
            console.log(id);
            dataService.getQuestions(id)
                .success(function(data){
                    vm.dataService.quizQuestions = data.data;
                });
            vm.quizMetrics.changeState('quiz', true);
        }
    })
    