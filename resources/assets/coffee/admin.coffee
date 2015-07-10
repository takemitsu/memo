
mainApp = angular.module 'mainApp', [
    'mainControllers'
    'ngRoute'
    'ui.bootstrap'
]

mainApp.config ['$routeProvider', ($routeProvider) ->
    $routeProvider
    .when '/dashboard',
        templateUrl: '/partials/dashboard/index.html'
        controller: 'DashboardController'
    .when '/users',
        templateUrl: '/partials/users/index.html'
        controller: 'UsersController'

    .otherwise
        redirectTo: '/dashboard'
]

#-----------------------------
# mainControllers
#-----------------------------

mainControllers = angular.module 'mainControllers', []

mainControllers.controller 'DashboardController', ($scope, $http, $log) ->
    return

mainControllers.controller 'UsersController', ($scope, $http, $log, $modal) ->
    # ユーザ一覧取得
    $scope.loadUsers = ->
        $http.get "/api/user",
            cache: false
            headers:
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        .success (json) ->
            $scope.users = json
        .error networkError
    $scope.loadUsers()

    $scope.addUser = () ->
        $scope.editUser()
    $scope.editUser = (user) ->
        instance = $modal.open
            templateUrl: '/partials/users/modal/editUser.html'
            controller: 'UserEditController'
            resolve:
                user: ->
                    if user
                        return user
                    else
                        name: ""
                        email: ""
                        password: ""
                        is_admin: 0
        instance.result.then (selectedItem) ->
            $scope.loadUsers()
        , ->
            $log.info('dismiss editUser');

    $scope.removeUser = (user) ->
        if confirm('本当に削除しますか\n' + user.name)
            $http
                method: 'delete'
                url: '/api/user/' + user.id
            .success (json) ->
                $scope.loadUsers()
                alert '削除しました'
            .error networkError

    return

mainControllers.controller 'UserEditController', ($scope, $http, $log, $modalInstance, user) ->
    $scope.user = $.extend {}, user
    $scope.user.password = ''
    $scope.user.password_confirmation = ''

    $scope.save = ->
        if $scope.user.password != $scope.user.password_confirmation
            return;

        method = 'post'
        url = '/api/user'
        if user.id
            method = 'put'
            url += '/' + user.id
        $http
            method: method
            url: url
            data: $scope.user
            headers:
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        .success (json) ->
            # $log.info(json)
            $modalInstance.close(json)
        .error networkError

    $scope.cancel = ->
        $modalInstance.dismiss('cancel')

#-----------------------------
# utils
#-----------------------------

showMessage = (type, message, autoclose=true) ->
    $('#message .alert').addClass('alert-'+type).empty().append(message)
    $('#message').removeClass('hidden').show 'fade'
    if autoclose
        setTimeout ->
            $('#message').hide 'fade', ->
                $('#message .alert').removeClass('alert-'+type)
        , 2000
showSuccessMessage = (message) ->
    showMessage 'success', message
showErrorMessage = (message) ->
    showMessage 'danger', message

networkError = (json, status) ->
  if status != 401
    showErrorMessage json.message
  else
    location.href = '/'
