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
    <meta property="og:title" content="Мой психологический портрет - <?php echo $names[$_GET['symbol']];?>" metaproperty="title">
    <meta property="og:image" content="http://urway.kz/testing/avatars/<?php echo $_GET['symbol'];?>.jpg" metaproperty="image">
    <meta property="og:description" content="<?php echo $descriptions[$_GET['symbol']];?>" metaproperty="description">

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- <link href='https://fonts.googleapis.com/css?family=Ubuntu+Condensed&subset=latin,cyrillic' rel='stylesheet' type='text/css'> -->
    <link href='../ru/testing/style.css' rel='stylesheet' type='text/css'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js'></script>
    <script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.min.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-route.js"></script>
    <script src='../ru/testing/testing.js'></script>
    <script type="text/javascript" src="http://vk.com/js/api/share.js?90" charset="windows-1251"></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-80077141-1', 'auto');
      ga('send', 'pageview');

    </script>
</head>
<body>
    <div>
        <header class="footer">
            <center>
                <a href="http://www.urway.kz" target="_self"
                    style="text-decoration: none; color:#f39c12; size: 48px;">
                    <h2>URWAY.KZ</h2>
                </a>
            </center>
        </header>
        <div class="container filter-gradient blue">
            <div class="content">
                <h1>
                    <b>
                        ОПРОСНИК
                    </b>
                </h1>
                <p class="tagline">
                    «Ваш психологический портрет»
                </p>
                <div ng-hide="testStarted">
                    <p>
                        <center style="padding: 0 50px;">
                            В каждой из 28 пар утверждений выберите одно (А или Б), которое больше подходит в отношении Вас. Помните, что среди них нет плохих или хороших, правильных или неправильных – все они равноценны.
                        </center>
                    </p>
                    <p>
                        <b>
                            <center>
                                Работайте быстро, недолго размышляя над ответами.
                            </center>
                        </b>
                    </p>
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
                    <ul class="answerList">
                        <li class="answerItem">
                            <label>
                                <input type="radio" ng-model="questions[counter].answer" ng-value="true" class="answerCheckbox">
                                {{questions[counter].first}}
                            </label>
                        </li>
                        <li class="answerItem">
                            <label>
                                <input type="radio" ng-model="questions[counter].answer" ng-value="false" class="answerCheckbox">
                                {{questions[counter].second}}
                            </label>
                        </li>
                    </ul>
                    <div class="row">
                        <button class="backButton" ng-click="back()"><i class="fa fa-arrow-left icon"></i>Назад</button>
                        <button class="nextButton" ng-click="counter=counter+1" ng-disabled="questions[counter].answer==undefined" ng-hide="counter+1==questionsCount">Дальше<i class="fa fa-arrow-right icon"></i></button>
                        <button class="finishButton" ng-click="finish()" ng-disabled="questions[counter].answer==undefined" ng-show="counter+1==questionsCount">Завершить<i class="fa fa-check-circle icon"></i></button>
                    </div>
                </form>
                <div ng-if="testEnded">
                    <p>
                        <center style="padding: 0 50px;">
                            <img src="/testing/avatars/{{tableSymbol}}.jpg" style="width: 100%;" />
                        </center>
                    </p>
                    <p>
                        <b>
                            <center>
                                {{table[tableSymbol].name}}
                            </center>
                        </b>
                    </p>
                    <p>
                        <center style="padding: 0 50px;">
                            - {{table[tableSymbol].description}}
                        </center>
                    </p>
                    <p>
                        <center style="padding: 0 50px;">
                            {{table[tableSymbol].content}}
                        </center>
                    </p>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div id="vk_temp" style="display:-webkit-inline-box;">
                <a ng-show="testEnded" target="_blank" title="Поделиться" href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fwww.urway.kz%2Ftest.php%3Fsymbol%3D{{tableSymbol}}"><img style="height:21px; margin-right:10px;" src="/img/facebook_ru.png"></a>
                <a ng-show="!testEnded" target="_blank" title="Поделиться" href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fwww.urway.kz%2F"><img style="height:21px; margin-right:10px;" src="/img/facebook_ru.png"></a>
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
                        url: 'http://www.urway.kz/test.php?symbol='+value,
                    }, {type: 'round', text: 'Поделиться'}));
                    return;
                }
            </script>
        </footer>
    </div>
</body>
</html>
