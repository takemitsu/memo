(function() {
  var mainApp, mainControllers, networkError, showErrorMessage, showMessage, showSuccessMessage;

  mainApp = angular.module('mainApp', ['mainControllers', 'ngRoute', 'ui.bootstrap']);

  mainApp.config([
    '$routeProvider', function($routeProvider) {
      return $routeProvider.when('/dashboard', {
        templateUrl: '/partials/dashboard/index.html',
        controller: 'DashboardController'
      }).when('/users', {
        templateUrl: '/partials/users/index.html',
        controller: 'UsersController'
      }).otherwise({
        redirectTo: '/dashboard'
      });
    }
  ]);

  mainControllers = angular.module('mainControllers', []);

  mainControllers.controller('DashboardController', function($scope, $http, $log) {});

  mainControllers.controller('UsersController', function($scope, $http, $log, $modal) {
    $scope.loadUsers = function() {
      return $http.get("/api/user", {
        cache: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }).success(function(json) {
        return $scope.users = json;
      }).error(networkError);
    };
    $scope.loadUsers();
    $scope.addUser = function() {
      return $scope.editUser();
    };
    $scope.editUser = function(user) {
      var instance;
      instance = $modal.open({
        templateUrl: '/partials/users/modal/editUser.html',
        controller: 'UserEditController',
        resolve: {
          user: function() {
            if (user) {
              return user;
            } else {
              return {
                name: "",
                email: "",
                password: "",
                is_admin: 0
              };
            }
          }
        }
      });
      return instance.result.then(function(selectedItem) {
        return $scope.loadUsers();
      }, function() {
        return $log.info('dismiss editUser');
      });
    };
    $scope.removeUser = function(user) {
      if (confirm('本当に削除しますか\n' + user.name)) {
        return $http({
          method: 'delete',
          url: '/api/user/' + user.id
        }).success(function(json) {
          $scope.loadUsers();
          return alert('削除しました');
        }).error(networkError);
      }
    };
  });

  mainControllers.controller('UserEditController', function($scope, $http, $log, $modalInstance, user) {
    $scope.user = $.extend({}, user);
    $scope.user.password = '';
    $scope.user.password_confirmation = '';
    $scope.save = function() {
      var method, url;
      if ($scope.user.password !== $scope.user.password_confirmation) {
        return;
      }
      method = 'post';
      url = '/api/user';
      if (user.id) {
        method = 'put';
        url += '/' + user.id;
      }
      return $http({
        method: method,
        url: url,
        data: $scope.user,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }).success(function(json) {
        return $modalInstance.close(json);
      }).error(networkError);
    };
    return $scope.cancel = function() {
      return $modalInstance.dismiss('cancel');
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

//# sourceMappingURL=admin.js.map