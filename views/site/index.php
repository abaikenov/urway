<?php
use yii\bootstrap\Html;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>НАЙДИ СВОЕ ПРИЗВАНИЕ</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <meta property="og:image" content="/img/header.jpg">
    <meta property="og:description" content="Тест разработан группой психологов для определения Вашего призвания.">

    <link href="/css/bootstrap.css" rel="stylesheet"/>
    <link href="/css/landing-page.css" rel="stylesheet"/>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body class="landing-page">

<nav class="navbar navbar-transparent navbar-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button id="menu-toggle" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example">
                <span class="sr-only">Раскрыть навигацию</span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <a href="<?= \yii\helpers\Url::base()?>">
                <div class="logo-container">
                    <div class="logo">
                        <!-- you logо img -->
                    </div>
                    <div class="brand">
                        UrWay.kz
                    </div>
                </div>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="example">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#">
                        Главная
                    </a>
                </li>
                <li>
                    <a href="#about">
                        Целевая аудитория
                    </a>
                </li>
                <li>
                    <a href="#reviews">
                        Отзывы
                    </a>
                </li>
                <li>
                    <a href="#test">
                        Тест
                    </a>
                </li>

                <li>
                    <a target="_blank" href="https://www.instagram.com/urway.kz/">
                        <i class="fa fa-instagram"></i>
                    </a>
                </li>

                <?php foreach ($langs as $lang): ?>
                    <li>
                        <?= Html::a($lang->short_name, '/' . $lang->url . Yii::$app->getRequest()->getLangUrl(), ['style' => 'color: red']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>

<div class="parallax filter-gradient blue" data-color="blue">
    <div class="parallax-background">
        <!-- <img src="/img/landing-page-1/bg.jpg"> -->
        <img src="/img/header.jpg">
    </div>
    <div class="container">
        <div class="row">
            <!-- <div class="col-sm-5 hidden-xs">
                <div class="parallax-image">
                    <img src="/img/landing-page-1/iphone.png"/>
                </div>
            </div> -->
            <div class="center">
                <center>
                    <div class="description">
                        <h2>Найди свое ПРИЗВАНИЕ!</h2>
                        <!-- <br>
                        <h5>Профессиональное тестирование поможет определиться с будущей профессией. На основе ваших ответов на вопросы мы определим сферы ваших интересов, ваши личные и профессиональные особенности и предложим вам список наиболее подходящих профессий.</h5> -->
                    </div>
                    <div class="buttons">
                        <a href="#test">
                            <button class="btn btn-neutral btn-lg">
                                <i class="fa fa-lg fa-play-circle"></i> Пройти ТЕСТ
                            </button>
                        </a>
                    </div>
                </center>

            </div>
        </div>
    </div>
</div>

<div class="section section-features section-no-padding">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 grayblock2">
                <div class="card card-blue">
                    <div class="icon">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <div class="text">
                        <h4>Статистика</h4>
                        <p style="padding:0px 20px;">Почти 73% людей по всему миру работают не по своему призванию.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grayblock">
                <div class="card card-blue">
                    <div class="icon">
                        <i class="fa fa-university"></i>
                    </div>
                    <h4>Упущенные возможности</h4>
                    <p style="padding:0px 20px;">Из них 90% желали бы иначе потратить 4 года в университетах.<br></p>
                </div>
            </div>
            <div class="col-md-4 grayblock2">
                <div class="card card-blue">
                    <div class="icon">
                        <i class="fa fa-trophy"></i>
                    </div>
                    <h4>Хобби</h4>
                    <p style="padding:0px 20px;">Люди, работающие по призванию, успешнее и счастливее других.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="about" class="section section-presentation">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="description">
                    <center>
                        <br>
                        <h4 class="header-text">Тест ориентирован на тех, кто:</h4>
                    </center>
                    <br>
                    <h6><i class="fa fa-check"></i> находится у истоков выбора профессии</h6>
                    <h6><i class="fa fa-check"></i> хочет лучше узнать себя, свои способности</h6>
                    <h6><i class="fa fa-check"></i> хочет открыть свой бизнес, но не знает в какой сфере</h6>
                    <h6><i class="fa fa-check"></i> желает раскрыть свои (скрытые) таланты</h6>
                    <h6><i class="fa fa-check"></i> ищет хобби / занятие, которое приносило бы удовольствие</h6>
                </div>
            </div>
            <div class="col-md-5 col-md-offset-1 hidden-xs">
                <img src="/img/landing-page-1/mac2.jpg"/>
            </div>
        </div>
    </div>
</div>

<!-- <div class="section section-demo">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div id="description-carousel" class="carousel fade" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item">
                            <img src="/img/examples/home_3.png" alt="">
                        </div>
                        <div class="item active">
                            <img src="/img/examples/home_2.png" alt="">
                        </div>
                        <div class="item">
                            <img src="/img/examples/home_1.png" alt="">
                        </div>
                    </div>

                    <ol class="carousel-indicators carousel-indicators-blue">
                        <li data-target="#description-carousel" data-slide-to="0" class=""></li>
                        <li data-target="#description-carousel" data-slide-to="1" class="active"></li>
                        <li data-target="#description-carousel" data-slide-to="2" class=""></li>
                    </ol>
                </div>
            </div>
            <div class="col-md-5 col-md-offset-1">
                <h4 class="header-text">Easy to integrate</h4>
                <p>
                    With all the apps that users love! Make it easy for users to share, like, post and tweet their favourite things from the app. Be sure to let users know they continue to remain connected while using your app!
                </p>
                <a href="codedesign.elkind.net/themes/bootstrap-theme-basic-app/" id="Demo" class="btn btn-lg btn-info btn-fill" data-button="info">Get Free Demo</a>
            </div>
        </div>
    </div>
</div> -->

<div id="reviews" class="section section-testimonial">
    <div class="container">
        <h4 class="header-text text-center">Отзывы</h4>
        <div id="carousel-example-generic" class="carousel fade" data-interval="10000" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox" style="position: initial;">
                <div class="item">
                    <div class="mask">
                        <img src="/img/faces/face-4.jpg">
                    </div>
                    <div class="carousel-testimonial-caption">
                        <p>Надежда Ромашова, 24 года</p>
                        <h3>После окончания университета работала в различных сферах, но ни в одной не чувствовала
                            удовлетворения от работы. Пройдя тест, отметила для себя "склонность к экстремальным видам
                            спорта". Решила попробовать. Сейчас я инструктор по сноубордингу.</h3>

                    </div>
                </div>
                <div class="item active">
                    <div class="mask">
                        <img src="/img/faces/face-3.jpg">
                    </div>
                    <div class="carousel-testimonial-caption">
                        <p>Дмитрий Макаров, 28 лет</p>
                        <h3>С 8-го класса я мечтал поступить на факультет "Радио электротехники". Так и случилось, я
                            окончил его с отличием, однако по специальности не проработал ни дня. Пройдя тест, узнал
                            некоторые интересные вещи о себе, тест выявил мои маркетинговые способности и помог
                            вспомнить юношескую любовь к театру. Сейчас я продолжаю работать в зарубежной компании, но
                            уже в сфере продаж. Записался на курсы актерского мастерства.</h3>

                    </div>
                </div>
                <div class="item">
                    <div class="mask">
                        <img src="/img/faces/face-2.jpg">
                    </div>
                    <div class="carousel-testimonial-caption">
                        <p>Елизавета Комарова, 20 лет</p>
                        <h3>В 11-м классе я готовилась поступать на бухгалтера, потому что отлично разбиралась в цифрах.
                            Однако тест расширил мои способности, определив склонность к точным наукам и абстрактному
                            мышлению. После теста я изменила свое решение и поступила на архитектора. Сейчас учусь на
                            3-м курсе и ни сколько не жалею.</h3>

                    </div>
                </div>
            </div>
            <ol class="carousel-indicators carousel-indicators-blue">
                <li data-target="#carousel-example-generic" data-slide-to="0"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
        </div>
    </div>
</div>

<div id="test" class="section section-no-padding">
    <div class="full-background filter-gradient blue" style="background-image:url('/img/landing-page-1/bg1.jpg')">
        <div class="info">
            <center>
                <h3>Тест разработан группой психологов для определения Вашего призвания.</h2>
                    <p>Тест состоит из 2 последовательных разделов.</p>
                    <h6>
                        1. Первый раздел включает Опросник (28 вопросов), которые помогут определить Ваш тип личности.
                    </h6>
                    <h6 style="max-width:700px;">
                        2. Второй раздел включает Тест (280 вопросов), после которого Вы сможете получить подробное
                        описание своих сильных и слабых сторон, перечень профессий, на которые Вам стоит обратить
                        внимание, учитывая Ваши таланты и способности.
                        <br><span style="color:red;">Данный раздел находится на доработке.</span>
                    </h6>
                    <p style="max-width:700px;line-height:18px;">
                        Временных ограничений нет. Запомнив e-mail и пароль, Вы сможете продолжить тест в любое удобное
                        для Вас время. Мы рекомендуем не тратить более 7-10 секунд на 1 вопрос. В среднем тест занимает
                        от 35 до 50 минут. Желаем Вам удачи!
                    </p>
                    <a href="<?= \yii\helpers\Url::toRoute('test')?>" class="btn btn-neutral btn-lg"><i class="fa fa-lg fa-play-circle"></i>
                        Пройти ТЕСТ</a>
            </center>
        </div>
    </div>
</div>

<div class="section section-contact" style="padding:0px;padding-bottom:30px;">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <p>Расскажите о нас своим друзьям через социальные сети.</p>
                <div class="ya-share2"
                     data-services="vkontakte,facebook,whatsapp,odnoklassniki,moimir,gplus,twitter,lj,pocket,surfingbird,tumblr"
                     data-size="m" data-limit="3"></div>
                <p style="padding-top:0px;">
                    &copy; 2016 <a href="<?= \yii\helpers\Url::base()?>">urway.kz</a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- <footer class="footer">
    <div class="container">
        <nav class="copyright">
            &copy; 2016 <a href="urway.com">urway.com</a>
        </nav>
    </div>
</footer> -->

<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="https://yastatic.net/share2/share.js" async="async"></script>
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
<script src="/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>

<script src="/js/bootstrap.js" type="text/javascript"></script>

<script type="text/javascript">
    var big_image;
    $(document).ready(function () {
        responsive = $(window).width();

        // $(window).on('scroll', gsdk.checkScrollForTransparentNavbar);

        if (responsive >= 768) {
            big_image = $('.parallax-background').find('img');
            console.log(big_image);
            $(window).on('scroll', function () {
                parallax();
            });
        }

    });

    var parallax = function () {
        var current_scroll = $(this).scrollTop();

        oVal = ($(window).scrollTop() / 3);
        big_image.css('top', oVal);
    };
</script>
<script src="/js/SmoothScroll.js"></script>
</body>
</html>