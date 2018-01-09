<?php

use yii\helpers\Url;

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title><?= Yii::t('app', 'FIND YOUR CALL') ?></title>

    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
    <meta name="viewport" content="width=device-width"/>
    <link href="/css/bootstrap.css" rel="stylesheet"/>
    <link href="/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12 text-center">
            <h3>Оплата прошла успешно!</h3>
            <p>Ключи для теста были отправлены на указанную вами почту</p>
            <a href="<?= URL::toRoute('/')?>">Перейти на главную страницу</a>
        </div>
    </div>
</div>
</body>
