//Define angular app
var app = angular.module('TestingApp', ['ngRoute', 'ngCookies']).config(function ($routeProvider, $locationProvider) {
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
        if (response && response.data.is_paid) {
            $ctrl.paymentEnd = true;
            $cookies.remove('orderId');
        } else {
            $http({
                method: 'GET',
                url: '/' + lang + '/site/test-data'
            }).then(function (response) {
                console.log(response.data);
                allTests = response.data;
                initStage(0);
            });
        }
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
        } else if($ctrl.answers[$ctrl.counter].answer !== undefined){
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
                        url: $location.protocol() + '://' + $location.host(),
                        title: $('#share-translate').text() + ' - ' + $ctrl.results[$ctrl.tableSymbol].name,
                        description: $ctrl.results[$ctrl.tableSymbol].description,
                        image: $location.protocol() + '://' + $location.host() + '/img/avatars/' + $ctrl.tableSymbol + '.jpg'
                    }
                });
                allResults.push({code: $ctrl.tableSymbol});
                break;
            case 1:
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
        console.log(more);
        return more > 0 ? a : b;
    };

    $ctrl.nextStage = function () {
        initStage($ctrl.stage + 1);
    };

    $ctrl.renderHtml = function (htmlCode) {
        return $sce.trustAsHtml(htmlCode);
    };

    $ctrl.payment = function () {
        if ($ctrl.order.email !== $ctrl.order.emailConfirm) {
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
            url: $location.protocol() + '://' + $location.host(),
            title: 'ВАШ ПСИХОЛОГИЧЕСКИЙ ПОРТРЕТ',
            image: $location.protocol() + '://' + $location.host() + '/img/header.jpg'
        }
    });
}]);