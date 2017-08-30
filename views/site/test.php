<?php
use app\models\Lang;
use yii\helpers\Url;
?>

<html ng-app="TestingApp" ng-controller="testingController as $ctrl">
<head>
    <base href="/">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <meta charset=utf-8>
    <title>Тест</title>
    <link href="/css/bootstrap.css" rel="stylesheet"/>
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <!-- <link href='https://fonts.googleapis.com/css?family=Ubuntu+Condensed&subset=latin,cyrillic' rel='stylesheet' type='text/css'> -->
    <link href='/css/style.css' rel='stylesheet' type='text/css'>

    <meta property="og:url" content="http://urway.kz<?= Yii::$app->request->url?>" />
    <meta property="og:image" content="http://urway.kz<?= $image?>" />
    <meta property="og:title" content="<?= $title?>" />
    <meta property="og:description" content="<?= $description?>" />
</head>
<body lang="<?= Lang::getCurrent()->url ?>" class="stage-{{$ctrl.stage}}">
<div>
    <header class="footer">
        <center>
            <a href="<?= Yii::$app->getHomeUrl() . Lang::getCurrent()->url . '/' ?>" target="_self"
               style="text-decoration: none; color:#f39c12; size: 48px;">
                <h2>URWAY.KZ</h2>
            </a>
        </center>
    </header>
    <div class="container filter-gradient blue">
        <div class="content" ng-if="!$ctrl.paymentEnd">
            <h1 class="text-bold">{{$ctrl.title}}</h1>
            <p ng-if="$ctrl.subtitle" class="tagline">{{$ctrl.subtitle}}</p>
            <div ng-hide="$ctrl.testStarted">
                <div ng-bind-html="$ctrl.renderHtml($ctrl.description)" style="text-align: center"></div>
                <div class="row">
                    <button class="startButton" ng-click="$ctrl.testStarted=!$ctrl.testStarted">
                        <?= Yii::t('app', 'Start the test') ?><i class="fa fa-play-circle icon"></i>
                    </button>
                </div>
            </div>
            <form ng-show="$ctrl.testStarted && !$ctrl.testEnded">
                <div class="row">
                    <p>
                        <b>
                            {{$ctrl.counter + 1}}/{{$ctrl.questionsCount}}
                        </b>
                    </p>
                </div>
                <p ng-if="$ctrl.questions[$ctrl.counter]" class="text-center" style="margin-bottom: 20px;">{{$ctrl.questions[$ctrl.counter]}}</p>
                <ul class="answerList">
                    <li class="answerItem">
                        <label>
                            <input type="radio" ng-model="$ctrl.answers[$ctrl.counter].answer" ng-value="true"
                                   class="answerCheckbox">
                            {{$ctrl.answers[$ctrl.counter].first}}
                        </label>
                    </li>
                    <li class="answerItem">
                        <label>
                            <input type="radio" ng-model="$ctrl.answers[$ctrl.counter].answer" ng-value="false"
                                   class="answerCheckbox">
                            {{$ctrl.answers[$ctrl.counter].second}}
                        </label>
                    </li>
                </ul>
                <div class="row">
                    <button type="button" class="backButton" ng-click="$ctrl.back()"><i
                                class="fa fa-arrow-left icon"></i><?= Yii::t('app', 'Back') ?></button>
                    <button type="submit" class="nextButton" ng-click="$ctrl.next()"
                            ng-disabled="$ctrl.answers[$ctrl.counter].answer==undefined"
                            ng-hide="$ctrl.counter + 1 == $ctrl.questionsCount">
                        <?= Yii::t('app', 'Next') ?><i class="fa fa-arrow-right icon"></i></button>
                    <button type="button" class="finishButton" ng-click="$ctrl.finish()"
                            ng-disabled="$ctrl.answers[$ctrl.counter].answer==undefined"
                            ng-show="$ctrl.counter+1==$ctrl.questionsCount"><?= Yii::t('app', 'Complete') ?><i
                                class="fa fa-check-circle icon"></i>
                    </button>
                </div>
            </form>
            <div ng-if="$ctrl.testEnded && !$ctrl.stage && !$ctrl.firstStageEnd" class="text-center">
                <span id="share-translate" class="hidden"><?= Yii::t('app', 'My psychological portrait')?></span>
                <p>
                    <img src="/img/avatars/{{$ctrl.tableSymbol}}.jpg" style="width: 100%;"/>
                </p>
                <p class="text-bold">
                    {{$ctrl.results[$ctrl.tableSymbol].name}}
                </p>
                <p>
                    - {{$ctrl.results[$ctrl.tableSymbol].description}}
                </p>
                <div ng-bind-html="$ctrl.results[$ctrl.tableSymbol].content"></div>
                <br/>
                <!--                <p style="text-decoration: underline">-->
                <!--                    <span class="text-bold">--><?//= Yii::t('app', 'For a detailed result on your personality type,') ?><!--</span><br/>-->
                <!--                    --><?//= Yii::t('app', 'You need to pass') ?>
                <!--                </p>-->
                <div class="row">
                    <button class="nextTestButton"
                            ng-click="$ctrl.getResult()"><?= Yii::t('app', 'Result') ?></button>
                    <button class="nextTestButton"
                            ng-click="$ctrl.nextStage()"><?= Yii::t('app', 'Basic test') ?></button>
                </div>
                <p><a href="<?= Url::to('example')?>" target="_blank" style="text-decoration: underline; font-size: 14px; text-transform: uppercase;">Пример результата</a></p>
            </div>

            <div ng-if="$ctrl.stageEnded || $ctrl.firstStageEnd" class="text-center">
                <p ng-if="!$ctrl.firstStageEnd"><?= Yii::t('app', 'Thank you for completing the complete test') ?></p>
                <p><?= Yii::t('app', 'Please enter your name, e-mail, pay the test and get your result by e-mail.') ?></p>
                <p ng-if="$ctrl.firstStageEnd"><?= Yii::t('app', 'Thank you for completing the complete questionnaire') ?></p>
                <form class="payment" action="https://epay.kkb.kz/jsp/process/logon.jsp">
                    <!-- https://epay.kkb.kz/jsp/process/logon.jsp -->
                    <div class="form-group">
                        <label for="form-name"><?= Yii::t('app', 'Name:') ?></label>
                        <input type="text" id="form-name" class="form-control" ng-model="$ctrl.order.name"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="form-email"><?= Yii::t('app', 'E-mail:') ?></label>
                        <input type="text" id="form-email" class="form-control" ng-model="$ctrl.order.email"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="form-form-email-repeat"><?= Yii::t('app', 'Repeat e-mail:') ?></label>
                        <input type="text" id="form-email-repeat" class="form-control"
                               ng-model="$ctrl.order.emailConfirm"
                               required>
                    </div>
                    <p ng-if="$ctrl.firstStageEnd"><?= Yii::t('app', 'The payment is 490 tenge') ?></p>
                    <p ng-if="!$ctrl.firstStageEnd"><?= Yii::t('app', 'The payment is 990 tenge') ?></p>
                    <input type="hidden" name="Signed_Order_B64"/>
                    <input type="hidden" name="Language" value="rus"/>
                    <input type="hidden" name="BackLink" value="<?= Url::to(['test'], true) ?>"/>
                    <input type="hidden" name="FailureLink" value="<?= Url::to(['test'], true) ?>"/>
                    <input type="hidden" name="PostLink" value="<?= Url::to(['post-link/index'], true) ?>"/>
                    <button type="button" ng-click="$ctrl.payment()"
                            class="startButton"><?= Yii::t('app', 'Proceed to checkout') ?></button>
                    <button type="button" ng-click="$ctrl.backToResult()" ng-if="$ctrl.firstStageEnd"
                            class="backButton"><i class="fa fa-arrow-left icon"></i><?= Yii::t('app', 'Back') ?></button>
                    <p style="font-size: 14px" ng-if="$ctrl.firstStageEnd"><?= Yii::t('app', 'Также тест оплатить можно позже на этой же странице')?></p>
                </form>
            </div>
        </div>
        <div class="content after-payment" ng-if="$ctrl.paymentEnd" style="text-align: center">
            <h1 class="text-bold"><?= Yii::t('app', 'TEST') ?></h1>
            <p class="tagline"><?= Yii::t('app', '«ВАШЕ ПРИЗВАНИЕ»') ?></p>
            <p><?= Yii::t('app', 'Мы благодарим Вас за потраченное время на прохождение UrWay.kz. Результат придет в течение 5 минут на указанную почту.') ?></p>
            <p ng-if="$ctrl.needNextPart"><?= Yii::t('app', 'Для определения Вашего типа мышления, профессиональных склонностей и профессионального самоопределения мы рекомендуем пройти Основной тест') ?></p>
            <button ng-if="$ctrl.needNextPart" class="nextTestButton"
                    ng-click="$ctrl.initNextPart()"><?= Yii::t('app', 'Basic test') ?></button>
            <img style="max-width: 100%; margin-top: 15px" src="/img/thank_you.jpg">
        </div>

        <footer class="footer">
            <div ng-if="($ctrl.stage === 0 && !$ctrl.testEnded) || $ctrl.stage > 0" style="margin-bottom: 10px; font-size: 14px"><?= Yii::t('app', 'Share the test with friends') ?>:</div>
            <div ng-if="$ctrl.stage === 0 && $ctrl.testEnded" style="margin-bottom: 10px; font-size: 14px"><?= Yii::t('app', 'Tell a friend about the test') ?>:</div>
            <div id="share"></div>
        </footer>
    </div>
</div>

<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="https://yastatic.net/share2/share.js"></script>
<script src='/js/jquery.min.js'></script>
<script src='/js/angular.min.js'></script>
<script src='/js/angular-sanitize.js'></script>
<script src='/js/angular-cookies.min.js'></script>
<script src="/js/angular-route.js"></script>
<script src='/js/testing.js'></script>


<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-80077141-1', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>
