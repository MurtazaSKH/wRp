angular.module('results', [])
    .controller('resultsCtrl', function ResultsController(quizMetrics, dataService) {
        var vm = this;
        vm.quizMetrics = quizMetrics;
        vm.dataService = dataService;
        vm.setActiveQuestion = setActiveQuestion;
        vm.getAnswerClass = getAnswerClass;
        vm.calculatePercentage = calculatePercentage;
        vm.reset = reset;
        vm.activeQuestion = 0;
        
        function getAnswerClass(index){
            if(index === dataService.quizQuestions[vm.activeQuestion].correct) {
                return "green";
            }else if(index === dataService.quizQuestions[vm.activeQuestion].selected){
                return "red";
            }
        }
        
        function setActiveQuestion(index){
            vm.activeQuestion = index;
        }
        
        function calculatePercentage(){
            return quizMetrics.numCorrect / dataService.quizQuestions.length * 100;
        }
        
        function reset(){
            
            var score = calculatePercentage();
            dataService.postScore(score);
            
            quizMetrics.changeState('results', false);
            quizMetrics.numCorrect = 0;
            
            for(var i; i < dataService.quizQuestions.length; i++){
                data.selected = null;
                data.iscorrect = null;
            }
            
        }
    });