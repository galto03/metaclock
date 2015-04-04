<!DOCTYPE html>
<html data-ng-app="">
<head>
    <script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js' type='text/javascript'></script>
    <script src='/js/controllers/clock.js' type='text/javascript'></script>
    <link href='/css/commin.css' rel='stylesheet' type='text/css' />
</head>
<body>
<div data-ng-init="names=['asd','b','c']">
    <div data-ng-repeat="name in names | filter:someText" data-ng-model="repeatNames">{{ name }}</div>
    <input type="text" data-ng-model="someText"> {{ someText }}
</div>

</body>
</html>