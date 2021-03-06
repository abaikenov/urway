//Define angular app
var app = angular.module('TestingApp', ['ngRoute', 'ngCookies', 'ngSanitize']).config(function ($routeProvider, $locationProvider) {
    // use the HTML5 History API
    $locationProvider.html5Mode(true);
});

//controllers
app.controller('testingController', ['$http', '$scope', '$location', '$sce', '$cookies', function ($http, $scope, $location, $sce, $cookies) {
    var $ctrl = this;
    var allTests = [];
    var allResults = [];

    var lang = $('body').attr('lang');

    var initStage = function (stage) {
        console.log('Init stage: ' + stage);
        var test = allTests[stage];
        $ctrl.stage = stage;
        $ctrl.testStarted = false;
        $ctrl.testEnded = false;
        $ctrl.stageEnded = false;
        $ctrl.payByKey = false;
        $ctrl.firstStageEnd = false;
        $ctrl.counter = 0;
        $ctrl.title = test.title;
        $ctrl.subtitle = test.subtitle;
        $ctrl.description = test.description;
        $ctrl.questionsCount = test.answers.length;
        $ctrl.tableSymbol = undefined;
        $ctrl.questions = test.questions;
        $ctrl.answers = test.answers;
        $ctrl.results = test.results;
    };

    var start = function (response) {
        // $ctrl.paymentEnd = true;
        // $cookies.set('orderId', 7);
        $http({
            method: 'GET',
            url: '/' + lang + '/site/test-data'
        }).then(function (resp) {
            // console.log(response.data);
            allTests = resp.data;
            if (response && response.data.is_paid) {
                if (JSON.parse(response.data.result).length === 1) {
                    allResults = JSON.parse(response.data.result);
                    $ctrl.needNextPart = true;
                    $ctrl.paymentEnd = true;
                    $cookies.remove('questionnaire');
                } else {
                    $ctrl.paymentEnd = true;
                    $cookies.remove('orderId');
                }
            } else {
                initStage(0);
                // if (undefined !== $cookies.getObject('questionnaire')) {
                //     allResults = $cookies.getObject('questionnaire');
                //     $ctrl.testStarted = true;
                //     $ctrl.testEnded = true;
                //     $ctrl.stage = 0;
                //     $ctrl.firstStageEnd = true;
                //     $ctrl.title = allTests[$ctrl.stage].title;
                //     $ctrl.subtitle = allTests[$ctrl.stage].subtitle;
                // } else {
                //     initStage(0);
                // }
            }
        });
    };

    $ctrl.init = function () {
        if ($location.search().symbol) {
            $ctrl.tableSymbol = $location.search().symbol;
        }
        console.log($ctrl.tableSymbol);
    };

    $ctrl.back = function () {
        if ($ctrl.counter > 0) {
            $ctrl.counter = $ctrl.counter - 1;
        }
        else {
            $ctrl.counter = 0;
            $ctrl.testStarted = false;
        }
    };

    $ctrl.next = function () {
        if ($ctrl.counter + 1 == $ctrl.questionsCount) {
            $ctrl.finish();
        } else if ($ctrl.answers[$ctrl.counter].answer !== undefined) {
            $ctrl.counter = $ctrl.counter + 1;
        }
    };

    $ctrl.finish = function () {
        switch ($ctrl.stage) {
            case 0:
                $ctrl.tableSymbol = getTableCode();
                $location.search('symbol', $ctrl.tableSymbol);
                $ctrl.testEnded = true;
                // console.log($ctrl.table[$ctrl.tableSymbol]);
                Ya.share2(shareElement, {
                    theme: {
                        services: 'facebook,vkontakte',
                        counter: true,
                        lang: 'ru',
                        limit: 3,
                        size: 'm',
                        bare: false
                    },
                    content: {
                        url: $location.protocol() + '://' + $location.host() + $location.path() + '?symbol=' + $ctrl.tableSymbol,
                        title: 'Мой психологический портрет - ' + $ctrl.results[$ctrl.tableSymbol].name,
                        description: $ctrl.results[$ctrl.tableSymbol].description,
                        image: $location.protocol() + '://' + $location.host() + '/img/avatars/' + $ctrl.tableSymbol + '.jpg'
                    }
                });
                allResults.push({code: $ctrl.tableSymbol});
                break;
            case 1:
                $cookies.remove('questionnaire');
                initStage(2);
                break;
            case 2:
                initStage(3);
                break;
            case 3:
                $ctrl.testEnded = true;
                $ctrl.stageEnded = true;
                allTests.forEach(function (test, i) {
                    if (i) {
                        allResults.push(test.answers);
                    }
                });
                // console.log(allResults);
                break;
        }

    };

    var getTableCode = function () {
        // console.log("getTableCode");
        return getSymbol(0, "E", "I") + getSymbol(1, "S", "N") + getSymbol(2, "T", "F") + getSymbol(3, "J", "P");
    };

    var getSymbol = function (start, a, b) {
        // console.log("getTableSymbol");
        var more = 0;
        for (var i = start; i < $ctrl.answers.length; i += 4) {
            if ("answer" in $ctrl.answers[i]) {
                more += $ctrl.answers[i].answer ? 1 : -1;
            }
        }
        ;
        return more > 0 ? a : b;
    };

    $ctrl.getResult = function () {
        $cookies.putObject('questionnaire', allResults);
        $ctrl.firstStageEnd = true;
        window.scrollTo(0, 0);
    };

    $ctrl.backToResult = function () {
        allResults = $cookies.getObject('questionnaire');
        $ctrl.firstStageEnd = false;
        initStage(0);
        $ctrl.testStarted = true;
        $ctrl.testEnded = true;
        $ctrl.tableSymbol = allResults[0].code;
        Ya.share2(shareElement, {
            theme: {
                services: 'facebook,vkontakte',
                counter: true,
                lang: 'ru',
                limit: 3,
                size: 'm',
                bare: false
            },
            content: {
                url: $location.protocol() + '://' + $location.host() + $location.path() + '?symbol=' + $ctrl.tableSymbol,
                title: 'Мой психологический портрет - ' + $ctrl.results[$ctrl.tableSymbol].name,
                description: $ctrl.results[$ctrl.tableSymbol].description,
                image: $location.protocol() + '://' + $location.host() + '/img/avatars/' + $ctrl.tableSymbol + '.jpg'
            }
        });
        window.scrollTo(0, 0);
    };

    $ctrl.initNextPart = function () {
        $ctrl.needNextPart = false;
        $ctrl.paymentEnd = false;
        initStage(1);
    };

    $ctrl.nextStage = function () {
        initStage($ctrl.stage + 1);
    };

    $ctrl.renderHtml = function (htmlCode) {
        return $sce.trustAsHtml(htmlCode);
    };

    $ctrl.payment = function () {
        if (!$ctrl.order.email || ($ctrl.order.email !== $ctrl.order.emailConfirm)) {
            alert('Email-ы должны совпадать');
        } else {
            $ctrl.order.result = allResults;
            $.ajax({
                method: 'POST',
                url: '/order/create',
                data: $ctrl.order
            }).then(function (response) {
                if (response.id) {
                    $cookies.put('orderId', response.id);
                    var form = $('form.payment');
                    form.find('input[name="Signed_Order_B64"]').val(response.sign);
                    form.submit();
                }
            });
        }
    };


    $ctrl.key = function () {
        if (!$ctrl.order.email || ($ctrl.order.email !== $ctrl.order.emailConfirm)) {
            swal('Email-ы должны совпадать');
        } else if(!$ctrl.order.key) {
            swal('Введите ключ')
        } else {
            $ctrl.order.result = allResults;
            $.ajax({
                method: 'POST',
                url: '/' + lang + '/order/create-with-key',
                data: $ctrl.order
            }).then(function (response) {
                if (response.success) {
                    $cookies.put('orderId', response.id);
                    location.reload();
                } else {
                    swal(response.error);
                }
            });
        }
    };

    var orderId = $cookies.get('orderId');
    if (orderId) {
        $http({
            method: 'GET',
            url: '/order/get?id=' + orderId
        }).then(start);
    } else {
        start();
    }

    var shareElement = document.getElementById('share');
    Ya.share2(shareElement, {
        theme: {
            services: 'facebook,vkontakte',
            counter: true,
            lang: 'ru',
            limit: 3,
            size: 'm',
            bare: false
        },
        content: {
            url: $location.protocol() + '://' + $location.host() + $location.path(),
            title: 'НАЙДИ СВОЕ ПРИЗВАНИЕ',
            description: 'Тест разработан группой психологов для определения Вашего призвания.',
            image: $location.protocol() + '://' + $location.host() + '/img/header.jpg'
        }
    });
}]);