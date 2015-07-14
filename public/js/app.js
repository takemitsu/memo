(function() {
  var mainApp, mainControllers, networkError, showErrorMessage, showMessage, showSuccessMessage;

  mainApp = angular.module('mainApp', ['mainControllers']);

  mainApp.config([
    '$httpProvider', function($httpProvider) {
      $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    }
  ]);

  mainControllers = angular.module('mainControllers', []);

  mainControllers.controller('SheetsController', function($scope, $http, $log) {
    $scope.detail = false;
    $scope.loadSheets = function() {
      $http.get("/api/sheet", {
        cache: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }).success(function(json) {
        return $scope.sheets = json;
      }).error(networkError);
    };
    $scope.loadSheets();
    $scope.sheet = {
      title: '',
      text: ''
    };
    $scope.add = function() {
      $scope.sheet = {
        id: null,
        title: '',
        text: ''
      };
      $scope.detail = true;
    };
    $scope.edit = function(sheet) {
      $scope.sheet = {
        id: sheet.id,
        title: sheet.title,
        text: sheet.text
      };
      $scope.detail = true;
    };
    $scope.back = function() {
      return $scope.detail = false;
    };
    $scope.remove = function(sheet) {
      if (confirm('本当に削除しますか\n' + sheet.title)) {
        $http({
          method: 'delete',
          url: '/api/sheet/' + sheet.id
        }).success(function(json) {
          $scope.loadSheets();
          return alert('削除しました');
        }).error(networkError);
      }
      return false;
    };
    $scope.save = function() {
      var method, url;
      method = 'post';
      url = '/api/sheet';
      if ($scope.sheet.id) {
        method = 'put';
        url += '/' + $scope.sheet.id;
      }
      $http({
        method: method,
        url: url,
        data: $scope.sheet,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }).success(function(json) {
        $scope.sheet = json;
        return $scope.loadSheets();
      }).error(networkError);
      return false;
    };
  });

  showMessage = function(type, message, autoclose) {
    if (autoclose == null) {
      autoclose = true;
    }
    $('#message .alert').addClass('alert-' + type).empty().append(message);
    $('#message').removeClass('hidden').show('fade');
    if (autoclose) {
      return setTimeout(function() {
        return $('#message').hide('fade', function() {
          return $('#message .alert').removeClass('alert-' + type);
        });
      }, 2000);
    }
  };

  showSuccessMessage = function(message) {
    return showMessage('success', message);
  };

  showErrorMessage = function(message) {
    return showMessage('danger', message);
  };

  networkError = function(json, status) {
    if (status !== 401) {
      return showErrorMessage(json.message);
    } else {
      return location.href = '/';
    }
  };

}).call(this);

//# sourceMappingURL=app.js.map