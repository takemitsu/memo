<!DOCTYPE html>
<html lang="ja" ng-app="mainApp">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>管理画面</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="/css/admin.css">
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" >
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#/dashboard">Brand</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="#">foo</a></li>
        <li><a href="#">bar</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#users">ユーザ一覧</a></li>
        <li class="btn-group" dropdown>
          <a href class="dropdown-toggle" dropdown-toggle>
            {{$user->name}} <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="auth/logout">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div id="message" class="hidden">
    <div class="alert">
    </div>
</div>

<div class="container-fluid" ng-view>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-route.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.13.0/ui-bootstrap-tpls.min.js"></script>
<script type="text/javascript" src="/js/admin.js"></script>
</body>
</html>
