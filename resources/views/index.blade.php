<!DOCTYPE html>
<html lang="ja" ng-app="mainApp">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>めも</title>
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
      <span class="navbar-brand">memo</span>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class="btn-group" dropdown>
          <a href class="dropdown-toggle" dropdown-toggle>
            {{ $user->name }} <span class="caret"></span>
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

<div class="container-fluid" ng-controller="SheetsController">

        <div class="" ng-hide="detail">
            <h3>一覧</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>title</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="sheet in sheets">
                        <td ng-click="edit(sheet)">@{{sheet.title}}</td>
                        <td ng-click="edit(sheet)">@{{sheet.created_at}}</td>
                        <td ng-click="edit(sheet)">@{{sheet.updated_at}}</td>
                        <td><button class="btn btn-default btn-xs" ng-click="remove(sheet)">削除</button></td>
                    </tr>
                </tbody>
            </table>
            <div class="btn-group">
                <button type="button" class="btn btn-default" ng-click="add()">追加</button>
            </div>
        </div>

        <div class="" ng-show="detail">
            <h3 ng-show="sheet.id">編集</h3>
            <h3 ng-hide="sheet.id">追加</h3>
            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" class="form-control" id="title" placeholder="title" ng-model="sheet.title">
            </div>
            <div class="form-group">
                <label for="text">本文</label>
                <textarea class="form-control" rows="5" id="text" placeholder="text" ng-model="sheet.text"></textarea>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-default" ng-click="back()">戻る</button>
                <button type="button" class="btn btn-default" ng-click="add()">リセット</button>
                <button type="button" class="btn btn-primary" ng-click="save()">保存</button>
            </div>
        </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-route.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.13.0/ui-bootstrap-tpls.min.js"></script>
<script type="text/javascript" src="/js/app.js"></script>
</body>
</html>
