<!DOCTYPE html>

<html ng-app="MetaClockApp">
	<head>
        <meta charset="utf-8">

        <title><?= $this->pageTitle ?> - LiteClock.com</title>

        <meta name="description" content="A modal concept which aims to give a sense of depth between the page and modal layers">
        <meta name="author" content="Hakim El Hattab">

<!--        <meta name="viewport" content="width=800, user-scalable=no">-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js" type="text/javascript"></script>


        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="<?= $this->getRootPath() ?>css/bootstrap-clockpicker.min.css">
        <script type="text/javascript" src="<?= $this->getRootPath() ?>js/libs/bootstrap-clockpicker.min.js"></script>

        <script type="text/javascript" src="<?= $this->getRootPath() ?>js/libs/jquery.avgrund.js"></script>
        <script type="text/javascript" src="<?= $this->getRootPath() ?>js/libs/jquery.simpleWeather.js"></script>
        <link type="text/css" rel="stylesheet" href="<?= $this->getRootPath() ?>css/jplayer.blue.monday.css">
        <script type="text/javascript" src="<?= $this->getRootPath() ?>js/libs/jquery.jplayer.min.js"></script>
        <script type="text/javascript" src="<?= $this->getRootPath() ?>js/libs/jquery.cookie.js"></script>


        <script src="<?= $this->getRootPath() ?>js/controllers/app.js" type="text/javascript"></script>
        <script src="<?= $this->getRootPath() ?>js/controllers/clock.js" type="text/javascript"></script>
        <script src="<?= $this->getRootPath() ?>js/controllers/settings.js" type="text/javascript"></script>
        <script src="<?= $this->getRootPath() ?>js/controllers/alarm.js" type="text/javascript"></script>

        <link type="text/css" rel="stylesheet" href="<?= $this->getRootPath() ?>css/avgrund.css">
        <link type="text/css" rel="stylesheet" href="<?= $this->getRootPath() ?>css/common.css">
        <link type="text/css" rel="stylesheet" href="<?= $this->getRootPath() ?>css/clock.css">
        <link type="text/css" rel="stylesheet" href="<?= $this->getRootPath() ?>css/layout.css">
        <link type="text/css" rel="stylesheet" href="<?= $this->getRootPath() ?>css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="<?= $this->getRootPath() ?>css/weather-icons.min.css">
        <link type="text/css" rel="stylesheet" href="<?= $this->getRootPath() ?>css/fontello.css">

        <link href='http://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
	</head>
	<body data-ng-app="MetaClockApp">
        <div class="site_container">
            <div class="header">
                <h1>
                    <i class="fa fa-leaf"></i>&nbsp;<span>lite</span>clock
                </h1>
                <div class="banner_cont">
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- LiteClock header 4 -->
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:468px;height:60px"
                         data-ad-client="ca-pub-6056202160838970"
                         data-ad-slot="9915398074"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
                <div style="clear: both"></div>
            </div>