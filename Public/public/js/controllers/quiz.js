angular.module('quizC', [])
    .controller('quizCtrl', function(quizMetrics, dataService){
        var vm = this;
        vm.quizMetrics = quizMetrics;
        vm.dataService = dataService;
        vm.activeQuestion = 0;
        vm.setActiveQuestion = setActiveQuestion;
        vm.selectAnswer = selectAnswer;
        vm.questionAnswered = questionAnswered;
        vm.finaliseAnswers = finaliseAnswers;
        vm.error = false;
        vm.finalise = false;
        
        var numQuestionAnswered = 0;
        
        function setActiveQuestion(index){
            if(index === undefined){
                var breakOut = false;
                var quizLength = dataService.quizQuestions.length - 1;
                while(!breakOut){
                    vm.activeQuestion = vm.activeQuestion < quizLength?++vm.activeQuestion:0;
                    if(vm.activeQuestion === 0) {
                        vm.error = true;
                    }
                    if(dataService.quizQuestions[vm.activeQuestion].selected === null){
                        breakOut = true;
                    }
                }
            }else{
                vm.activeQuestion = index;
            }
        }
        
        function questionAnswered() {
            var quizLength = dataService.quizQuestions.length;
            if(dataService.quizQuestions[vm.activeQuestion].selected !== null){
                numQuestionAnswered++;
                if(numQuestionAnswered >= quizLength){
                    for(i = 0; i < quizLength; i++){
                        if(dataService.quizQuestions[i].selected === null){
                            setActiveQuestion(i);
                            return;
                        }
                    } 
                    vm.error = false;
                    vm.finalise = true;
                    return;
                }
            }    
            
            vm.setActiveQuestion();
        }
        
        function selectAnswer(index) {
            dataService.quizQuestions[vm.activeQuestion].selected = index;
        }
        
        function finaliseAnswers() {
            vm.finalise = 0;
            vm.activeQuestion = 0;
            numQuestionAnswered = 0;
            quizMetrics.changeState('quiz', false);
            quizMetrics.changeState('results', true);
            quizMetrics.markQuiz();
        }
    })