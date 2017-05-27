<?php
use app\components\LangUrlManager;
use app\models\Lang;
use yii\helpers\Url;

$names = array(
    'ISTJ' => 'Максим Горький',
    'ISTP' => 'Габен',
    'ESTP' => 'Жуков',
    'ESTJ' => 'Штирлиц',
    'INFJ' => 'Достоевский',
    'INFP' => 'Есенин',
    'ENFP' => 'Гексли',
    'ENFJ' => 'Гамлет',
    'ISFJ' => 'Драйзер',
    'ISFP' => 'Дюма',
    'ESFP' => 'Наполеон',
    'ESFJ' => 'Гюго',
    'INTJ' => 'Робеспьер',
    'INTP' => 'Бальзак',
    'ENTP' => 'Дон Кихот',
    'ENTJ' => 'Джек Лондон',
);
$descriptions = array(
    'ISTJ' => 'систематик, попечитель. Делать то, что должно быть сделано, любовь – достойная цель. Прирожденные организаторы жизни.',
    'ISTP' => 'Мастер, Джаконда. Легкие на подъем. Дела говорят больше, чем слова. Просто делай.',
    'ESTP' => 'организатор, поощритель, Македонский. Реалисты до мозга костей. Отношения не должны быть скучными. Главное – поймать момент.',
    'ESTJ' => 'администратор, Шерлок Холмс. Хозяева жизни. Обопрись на меня. Прирожденные руководители.',
    'INFJ' => 'гуманист, писатель. Вдохновляющие окружающих. Сердце, разум и дух. Вдохновляющий лидер и последователь.',
    'INFP' => 'Тутанхомон, лирик. Благородная служба обществу. Вдохновляющий идеализм. Сделать жизнь приятнее.',
    'ENFP' => 'советник, инициатор, журналист. Да здравствует жизнь! Слишком большой близости не бывает. Результат – люди.',
    'ENFJ' => 'артист, наставник, педагог. Сладкоречивый увещеватель. Отношение – это все.',
    'ISFJ' => 'хранитель, Клайд. Высокое чувство долга. Служение, прежде всего. Преданные своему делу.',
    'ISFP' => 'посредник, художник. Все видит, но не во что не вмешивается. Неужели человек может быть таким непритязательным. Дела говорят красноречивее слов.',
    'ESFP' => 'Цезарь,  лидер, политик. Живем ведь только раз. Любовь – получение максимума от каждой минуты. Сделаем работу веселее.',
    'ESFJ' => 'оптимист, продавец. Повелители мира. Будь рядом с тем, кого любишь. Друзья всех и каждого.',
    'INTJ' => 'аналитик, ученый. Все можно улучшить. Любые отношения можно улучшить. Вольные мыслители жизни.',
    'INTP' => 'критик, созидатель, фельдмаршал. Любовь к решению проблем. В любви важен разум. Осмыслители жизни.',
    'ENTP' => 'искатель, новатор. Одно увлекательное дело за другим. Отношения – еще один вызов. Результат – это прогресс.',
    'ENTJ' => 'предприниматель. Вожди по натуре. Хороших отношений без лидера не может быть. Прирожденные лидеры.',
);
?>

<html ng-app="TestingApp" ng-controller="testingController">
<head>
    <base href="/">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <meta charset=utf-8>
    <title>Тест</title>
    <!-- Open Graph Protocol Tags -->
    <?php if ($symbol = Yii::$app->request->get('symbol')): ?>
        <meta property="og:title" content="<?= Yii::t('app', 'My psychological portrait')?> - <?php echo $names[$symbol]; ?>"
              metaproperty="title">
        <meta property="og:image" content="http://urway.kz/testing/avatars/<?php echo $symbol; ?>.jpg"
              metaproperty="image">
        <meta property="og:description" content="<?php echo $descriptions[$symbol]; ?>"
              metaproperty="description">
    <?php endif; ?>

    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <!-- <link href='https://fonts.googleapis.com/css?family=Ubuntu+Condensed&subset=latin,cyrillic' rel='stylesheet' type='text/css'> -->
    <link href='/css/style.css' rel='stylesheet' type='text/css'>
</head>
<body>
<div>
    <header class="footer">
        <center>
            <a href="<?= Yii::$app->getHomeUrl().Lang::getCurrent()->url.'/'?>" target="_self"
               style="text-decoration: none; color:#f39c12; size: 48px;">
                <h2>URWAY.KZ</h2>
            </a>
        </center>
    </header>
    <div class="container filter-gradient blue">
        <div class="content">
            <h1 class="text-bold">{{title}}</h1>
            <p ng-if="subtitle" class="tagline">{{subtitle}}</p>
            <div ng-hide="testStarted">
                <div ng-bind-html="renderHtml(description)" style="padding: 0 50px; text-align: center"></div>
                <div class="row">
                    <button class="startButton" ng-click="testStarted=!testStarted">
                        <?= Yii::t('app', 'Start the test')?><i class="fa fa-play-circle icon"></i>
                    </button>
                </div>
            </div>
            <form ng-show="testStarted && !testEnded">
                <div class="row">
                    <p>
                        <b>
                            {{counter+1}}/{{questionsCount}}
                        </b>
                    </p>
                </div>
                <p ng-if="questions[counter]" class="text-center" style="padding: 0 50px;">{{questions[counter]}}</p>
                <ul class="answerList">
                    <li class="answerItem">
                        <label>
                            <input type="radio" ng-model="answers[counter].answer" ng-value="true"
                                   class="answerCheckbox">
                            {{answers[counter].first}}
                        </label>
                    </li>
                    <li class="answerItem">
                        <label>
                            <input type="radio" ng-model="answers[counter].answer" ng-value="false"
                                   class="answerCheckbox">
                            {{answers[counter].second}}
                        </label>
                    </li>
                </ul>
                <div class="row">
                    <button class="backButton" ng-click="back()"><i class="fa fa-arrow-left icon"></i><?= Yii::t('app', 'Back')?></button>
                    <button class="nextButton" ng-click="counter = counter + 1"
                            ng-disabled="answers[counter].answer==undefined" ng-hide="counter+1==questionsCount">
                        <?= Yii::t('app', 'Next')?><i class="fa fa-arrow-right icon"></i></button>
                    <button class="finishButton" ng-click="finish()" ng-disabled="answers[counter].answer==undefined"
                            ng-show="counter+1==questionsCount"><?= Yii::t('app', 'Complete')?><i class="fa fa-check-circle icon"></i>
                    </button>
                </div>
            </form>
            <div ng-if="testEnded && !stage" class="text-center">
                <p style="padding: 0 50px;">
                    <img src="/img/avatars/{{tableSymbol}}.jpg" style="width: 100%;"/>
                </p>
                <p class="text-bold">
                    {{results[tableSymbol].name}}
                </p>
                <p style="padding: 0 50px;">
                    - {{results[tableSymbol].description}}
                </p>
                <p style="padding: 0 50px;">
                    {{results[tableSymbol].content}}
                </p>

                <p style="text-decoration: underline">
                    <span class="text-bold"><?= Yii::t('app', 'For a detailed result on your personality type,')?></span><br/>
                    <?= Yii::t('app', 'You need to pass')?>
                </p>
                <div class="row">
                    <button class="nextTestButton" ng-click="nextStage()"><?= Yii::t('app', 'Basic test')?></button>
                </div>
            </div>

            <div ng-if="stageEnded" class="text-center">
                <p><?= Yii::t('app', 'Thank you for completing the complete test')?></p>
                <p><?= Yii::t('app', 'Please enter your name, e-mail, pay the test and get your result by e-mail.')?></p>
                <form>
                    <div class="form-group">
                        <label for="form-name"><?= Yii::t('app', 'Name:')?></label>
                        <input type="text" id="form-name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="form-email"><?= Yii::t('app', 'E-mail:')?></label>
                        <input type="email" id="form-email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="form-form-email-repeat"><?= Yii::t('app', 'Repeat e-mail:')?></label>
                        <input type="email" id="form-email-repeat" class="form-control">
                    </div>
                    <p><?= Yii::t('app', 'The payment is 990 tenge')?></p>
                    <button type="submit" class="btn btn-default"><?= Yii::t('app', 'Proceed to checkout')?></button>
                </form>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div style="margin-bottom: 10px"><?= Yii::t('app', 'Tell a friend about the test')?>:</div>
        <div id="vk_temp" style="display:-webkit-inline-box;">
            <a ng-show="testEnded" target="_blank" title="<?= Yii::t('app', 'Share')?>"
               href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fwww.urway.kz%2Ftest.php%3Fsymbol%3D{{tableSymbol}}"><img
                        style="height:21px; margin-right:10px;" src="/img/facebook_ru.png"></a>
            <a ng-show="!testEnded" target="_blank" title="<?= Yii::t('app', 'Share')?>"
               href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fwww.urway.kz%2F"><img
                        style="height:21px; margin-right:10px;" src="/img/facebook_ru.png"></a>
            <div ng-show="!testEnded">
                <script type="text/javascript">
                    document.write(VK.Share.button({
                        url: 'http://www.urway.kz/',
                    }, {type: 'round', text: '<?= Yii::t('app', 'Share')?>'}));
                </script>
            </div>
        </div>
        <script type="text/javascript">
            function showVk(value) {
                $('#vk_temp').append(VK.Share.button({
                    url: 'http://www.urway.kz/test.php?symbol=' + value,
                }, {type: 'round', text: '<?= Yii::t('app', 'Share')?>'}));
                return;
            }
        </script>
    </footer>
</div>

<script src='/js/jquery.min.js'></script>
<script src='/js/angular.min.js'></script>
<script src="/js/angular-route.js"></script>
<script src='/js/testing.js'></script>
<script type="text/javascript" src="http://vk.com/js/api/share.js?90" charset="windows-1251"></script>
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
