<?php
use yii\bootstrap\Html;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title><?= Yii::t('app', 'FIND YOUR CALL')?></title>

    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
    <meta name="viewport" content="width=device-width"/>
    <meta property="og:image" content="http://urway.kz/img/header.jpg">
    <meta property="og:description" content="<?= Yii::t('app', 'The test was developed by a group of psychologists to determine your vocation.')?>">

    <link href="/css/bootstrap.css" rel="stylesheet"/>
    <link href="/css/landing-page.css" rel="stylesheet"/>
    <link href="/css/font-awesome.min.css" rel="stylesheet">
</head>

<body class="landing-page">

<nav class="navbar navbar-transparent navbar-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button id="menu-toggle" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example">
                <span class="sr-only"><?= Yii::t('app', 'Expand navigation')?></span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <a href="<?= \yii\helpers\Url::base() ?>">
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
                        <?= Yii::t('app', 'Home')?>
                    </a>
                </li>
                <li>
                    <a href="#about">
                        <?= Yii::t('app', 'The target audience')?>
                    </a>
                </li>
                <li>
                    <a href="#reviews">
                        <?= Yii::t('app', 'Reviews')?>
                    </a>
                </li>
                <li>
                    <a href="#test">
                        <?= Yii::t('app', 'Test')?>
                    </a>
                </li>

                <li>
                    <a target="_blank" href="https://www.instagram.com/urway.kz/">
                        <i class="fa fa-instagram"></i>
                    </a>
                </li>

                <?php foreach (array_reverse($langs) as $lang): ?>
                    <li class="pull-right hidden-xs hidden-sm">
                        <?= Html::a('', '/' . $lang->url . Yii::$app->getRequest()->getLangUrl(), ['class' => 'lang-icon lang-icon-'.$lang->url]) ?>
                    </li>
                <?php endforeach; ?>
                <?php foreach ($langs as $lang): ?>
                    <li class="hidden-md hidden-lg">
                        <?= Html::a('', '/' . $lang->url . Yii::$app->getRequest()->getLangUrl(), ['class' => 'lang-icon lang-icon-'.$lang->url]) ?>
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
                        <h2><?= Yii::t('app', 'Find your Vocation!')?></h2>
                        <!-- <br>
                        <h5>Профессиональное тестирование поможет определиться с будущей профессией. На основе ваших ответов на вопросы мы определим сферы ваших интересов, ваши личные и профессиональные особенности и предложим вам список наиболее подходящих профессий.</h5> -->
                    </div>
                    <div class="buttons">
                        <a href="#test">
                            <button class="btn btn-neutral btn-lg">
                                <i class="fa fa-lg fa-play-circle"></i> <?= Yii::t('app', 'Pass the TEST')?>
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
                        <h4><?= Yii::t('app', 'Statistics')?></h4>
                        <p style="padding:0px 20px;"><?= Yii::t('app', 'Almost 73% of people around the world do not work according to their vocation.')?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grayblock">
                <div class="card card-blue">
                    <div class="icon">
                        <i class="fa fa-university"></i>
                    </div>
                    <h4><?= Yii::t('app', 'Lost Opportunities')?></h4>
                    <p style="padding:0px 20px;"><?= Yii::t('app', 'Of these, 90% would otherwise spend 4 years in universities.')?></p>
                </div>
            </div>
            <div class="col-md-4 grayblock2">
                <div class="card card-blue">
                    <div class="icon">
                        <i class="fa fa-trophy"></i>
                    </div>
                    <h4><?= Yii::t('app', 'Hobby')?></h4>
                    <p style="padding:0px 20px;"><?= Yii::t('app', 'People who work by vocation are more successful and happier than others.')?></p>
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
                        <h4 class="header-text"><?= Yii::t('app', 'The test is aimed at those who:')?></h4>
                    </center>
                    <br>
                    <h6><i class="fa fa-check"></i> <?= Yii::t('app', 'is at the source of the choice of profession')?></h6>
                    <h6><i class="fa fa-check"></i> <?= Yii::t('app', 'wants to know yourself better, your abilities')?></h6>
                    <h6><i class="fa fa-check"></i> <?= Yii::t('app', 'wants to open a business, but does not know in which area')?></h6>
                    <h6><i class="fa fa-check"></i> <?= Yii::t('app', 'wants to reveal his (hidden) talents')?></h6>
                    <h6><i class="fa fa-check"></i> <?= Yii::t('app', 'looking for a hobby / occupation that would bring pleasure')?></h6>
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
        <h4 class="header-text text-center"><?= Yii::t('app', 'Reviews')?></h4>
        <div id="carousel-example-generic" class="carousel fade" data-interval="10000" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox" style="position: initial;">
                <div class="item">
                    <div class="mask">
                        <img src="/img/faces/face-4.jpg">
                    </div>
                    <div class="carousel-testimonial-caption">
                        <p><?= Yii::t('app', 'Nadezhda Romashova, 24 years old')?></p>
                        <h3><?= Yii::t('app', 'After graduation, she worked in various fields, but in no one felt Satisfaction from work. Having passed the test, she noted for herself "a tendency to extreme types I decided to try it, now I\'m a snowboarding instructor.')?></h3>

                    </div>
                </div>
                <div class="item active">
                    <div class="mask">
                        <img src="/img/faces/face-3.jpg">
                    </div>
                    <div class="carousel-testimonial-caption">
                        <p><?= Yii::t('app', 'Dmitry Makarov, 28 years old')?></p>
                        <h3><?= Yii::t('app', 'Since the 8th grade I dreamed of enrolling in the department of Radio Electrical Engineering. So it happened, I Graduated with honors, but he did not work for a day. Having passed the test, I found out Some interesting things about myself, the test revealed my marketing abilities and helped Remember the youthful love of the theater. Now I continue to work in a foreign company, but Already in the field of sales. I registered for acting courses.')?></h3>

                    </div>
                </div>
                <div class="item">
                    <div class="mask">
                        <img src="/img/faces/face-2.jpg">
                    </div>
                    <div class="carousel-testimonial-caption">
                        <p><?= Yii::t('app', 'Elizaveta Komarova, 25 years old')?></p>
                        <h3><?= Yii::t('app', 'In the 11th grade I was preparing to enter an accountant, because I was well versed in numbers. However, the test expanded my abilities, determining the inclination to exact sciences and abstract Thinking. After the test, I changed my mind and entered the architect. Now I\'m studying at 3rd year and no I do not regret.')?></h3>

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

<div class="section section-no-padding">
    <div class="full-background filter-gradient blue" style="background-image:url('/img/landing-page-1/bg1.jpg')">
        <div class="info">
            <center>
                <h3 id="test" style="padding-top: 20px; margin-top: 0px"><?= Yii::t('app', 'The test was developed by a group of psychologists to determine your vocation.')?></h3>
                <p><?= Yii::t('app', 'The test consists of 2 consecutive sections.')?></p>
                <p><?= Yii::t('app', '1. The first section includes a questionnaire (28 questions) that will help determine your personality type.')?></p>
                <p style="max-width:700px;"><?= Yii::t('app', '2. The second section includes the Test (280 questions), after which you can get a detailed Description of your strengths and weaknesses, a list of professions that you should pay attention to Considering your talents and abilities.')?></p>
                <p style="max-width:700px;line-height:18px;"><?= Yii::t('app', 'Temporary restrictions are not present. Remembering the e-mail and password, you can continue the test at any convenient For you time. We recommend that you do not spend more than 7-10 seconds on 1 question. The average test takes From 35 to 50 minutes. We wish you good luck!')?></p>
                <p style="max-width:700px;line-height:18px;"><?= Yii::t('app', 'On average, the passage of the Questionnaire and 3 Tests takes <strong><u>10 to 15 minutes.</u></strong><br/>We wish you good luck!')?></p>
                <a href="<?= \yii\helpers\Url::toRoute('test') ?>" class="btn btn-neutral btn-lg"><i
                            class="fa fa-lg fa-play-circle"></i>
                    <?= Yii::t('app', 'Pass the TEST')?></a>
            </center>
        </div>
    </div>
</div>

<div class="section section-contact" style="padding:0px;padding-bottom:30px;">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <p><?= Yii::t('app', 'Tell us about your friends through social networks.')?></p>
                <div class="ya-share2"
                     data-services="vkontakte,facebook,whatsapp"
                     data-size="m" data-limit="3"></div>
                <p style="padding-top:0px;">
                    &copy; 2016 <a href="<?= \yii\helpers\Url::base() ?>">urway.kz</a>
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