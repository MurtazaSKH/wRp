angular.module('dataService', [])
    .factory('dataService', function($http){
        
        var dataObj = {
                quizQuestions: {},
                categoriesData: categoriesData,
                postScore: function(score){
                    return $http({
                        method: 'POST',
                        url: '/api/postscore',
                        data: {score}
                    })
                },
                getCategories: function(){
                    return $http.get('api/categories');
                    /*.success(function(data){
                        return this.categoriesData = data;
                    });*/
                },
                getQuestions: function(id){
                    return $http({
                        method: 'POST',
                        url: '/api/questions',
                        data: {id}
                    }).success(function(data){
                        quizQuestions =  data.data;
                        console.log(quizQuestions);
                    })
            }
        }
        
        return dataObj;
        
        var categoriesData = {};
    })
    
    /*
    correctAnswers: [1, 2, 3, 0, 2, 0, 3, 2, 0, 3],
                 quizQuestions: [
                    {
                        type: "text",
                        text: "How much can a loggerhead weigh?",
                        possibilities: [
                            {
                                answer: "Up to 20kg"
                            },
                            {
                                answer: "Up to 115kg"
                            },
                            {
                                answer: "Up to 220kg"
                            },
                            {
                                answer: "Up to 500kg"
                            }
                        ],
                        selected: null,
                        correct: null
                    },
                    {
                        type: "text",
                        text: "What is the typical lifespan of a Green Sea Turtle?",
                        possibilities: [
                            {
                                answer: "150 years"
                            },
                            {
                                answer: "10 years"
                            },
                            {
                                answer: "80 years"
                            },
                            {
                                answer: "40 years"
                            }
                        ],
                        selected: null,
                        correct: null
                    },
                    {
                        type: "text",
                        text: "Where does the Kemp's Ridley Sea Turtle live?'",
                        possibilities: [
                            {
                                answer: "Tropical waters all around the world"
                            },
                            {
                                answer: "Eastern Australia"
                            },
                            {
                                answer: "Coastal North Atlantic"
                            },
                            {
                                answer: "South pacific islands"
                            }
                        ],
                        selected: null,
                        correct: null
                    },
                    {
                        type: "text",
                        text: "What is the most common turtle in US waters?",
                        possibilities: [
                            {
                                answer: "Loggerhead turtle"
                            },
                            {
                                answer: "Leatherback turtle"
                            },
                            {
                                answer: "Hawksbill Turtle"
                            },
                            {
                                answer: "Alligator Snapping Turtle"
                            }
                        ],
                        selected: null,
                        correct: null
                    },
                    {
                        type: "text",
                        text: "What is the largest sea turtle on earth?",
                        possibilities: [
                            {
                                answer: "Eastern Snake Necked Turtle"
                            },
                            {
                                answer: "Olive Ridley Sea Turtle"
                            },
                            {
                                answer: "Kemp's Ridley Sea Turtle'"
                            },
                            {
                                answer: "Leatherback"
                            }
                        ],
                        selected: null,
                        correct: null
                    },
                    {
                        type: "text",
                        text: "How Heavy can a leatherback turtle be?",
                        possibilities: [
                            {
                                answer: "900kg"
                            },
                            {
                                answer: "40kg"
                            },
                            {
                                answer: "110kg"
                            },
                            {
                                answer: "300kg"
                            }
                        ],
                        selected: null,
                        correct: null
                    },
                    {
                        type: "text",
                        text: "Which of these turtles are herbivores?",
                        possibilities: [
                            {
                                answer: "Loggerhead Turtle"
                            },
                            {
                                answer: "Hawksbill Turtle"
                            },
                            {
                                answer: "Leatherback Turtle"
                            },
                            {
                                answer: "Green Turtle"
                            }
                        ],
                        selected: null,
                        correct: null
                    }
                ],*/