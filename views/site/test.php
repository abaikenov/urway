<?php
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

    <!-- Open Graph Protocol Tags -->
    <?php if ($symbol = Yii::$app->request->get('symbol')): ?>
        <meta property="og:title" content="Мой психологический портрет - <?php echo $names[$symbol]; ?>"
              metaproperty="title">
        <meta property="og:image" content="http://urway.kz/testing/avatars/<?php echo $symbol; ?>.jpg"
              metaproperty="image">
        <meta property="og:description" content="<?php echo $descriptions[$symbol]; ?>"
              metaproperty="description">
    <?php endif; ?>

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- <link href='https://fonts.googleapis.com/css?family=Ubuntu+Condensed&subset=latin,cyrillic' rel='stylesheet' type='text/css'> -->
    <link href='/css/style.css' rel='stylesheet' type='text/css'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js'></script>
    <script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.min.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-route.js"></script>
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
</head>
<div>
    <header class="footer">
        <center>
            <a href="<?= \yii\helpers\Url::base()?>" target="_self"
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
                        Начать тест<i class="fa fa-play-circle icon"></i>
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
                    <button class="backButton" ng-click="back()"><i class="fa fa-arrow-left icon"></i>Назад</button>
                    <button class="nextButton" ng-click="counter = counter + 1"
                            ng-disabled="answers[counter].answer==undefined" ng-hide="counter+1==questionsCount">
                        Дальше<i class="fa fa-arrow-right icon"></i></button>
                    <button class="finishButton" ng-click="finish()" ng-disabled="answers[counter].answer==undefined"
                            ng-show="counter+1==questionsCount">Завершить<i class="fa fa-check-circle icon"></i>
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

                <p>
                    <span class="text-bold">Для получения подробного результата по Вашему типу личности,</span><br/>
                    Вам необходимо пройти
                </p>
                <div class="row">
                    <button class="nextTestButton" ng-click="nextStage()">Основной тест</button>
                </div>
            </div>

            <div ng-if="stageEnded" class="text-center">
                <p>Благодарим за прохождение полного теста</p>
                <p>Пожалуйста, введите своё имя, e-mail, проплатите тест и получите свой результат на e-mail.</p>
                <form>
                    <div class="form-group">
                        <label for="form-name">Имя:</label>
                        <input type="text" id="form-name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="form-email">E-mail:</label>
                        <input type="email" id="form-email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="form-form-email-repeat">Повторите e-mail:</label>
                        <input type="email" id="form-email-repeat" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-default">Перейти к оплате</button>
                </form>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div id="vk_temp" style="display:-webkit-inline-box;">
            <a ng-show="testEnded" target="_blank" title="Поделиться"
               href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fwww.urway.kz%2Ftest.php%3Fsymbol%3D{{tableSymbol}}"><img
                        style="height:21px; margin-right:10px;" src="/img/facebook_ru.png"></a>
            <a ng-show="!testEnded" target="_blank" title="Поделиться"
               href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fwww.urway.kz%2F"><img
                        style="height:21px; margin-right:10px;" src="/img/facebook_ru.png"></a>
            <div ng-show="!testEnded">
                <script type="text/javascript">
                    document.write(VK.Share.button({
                        url: 'http://www.urway.kz/',
                    }, {type: 'round', text: 'Поделиться'}));
                </script>
            </div>
        </div>
        <script type="text/javascript">
            function showVk(value) {
                $('#vk_temp').append(VK.Share.button({
                    url: 'http://www.urway.kz/test.php?symbol=' + value,
                }, {type: 'round', text: 'Поделиться'}));
                return;
            }
        </script>
    </footer>
</div>

</body>
</html>
