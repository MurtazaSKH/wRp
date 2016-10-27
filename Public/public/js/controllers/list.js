angular.module('list', [])
    .controller('listCtrl', function(dataService){
        var vm = this;
        vm.testing = 'testing';
        //vm.quizMetrics = quizMetrics;
        vm.data = dataService.categoriesData;
        //console.log(vm.data);
        vm.search = "";
        vm.activeTurtle = {};
        //vm.activateQuiz = activateQuiz;
        //vm.changeActiveTurtle = changeActiveTurtle;
    })