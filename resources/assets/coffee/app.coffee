
mainApp = angular.module 'mainApp', [
    'mainControllers'
]

mainApp.config ['$httpProvider', ($httpProvider) ->
    $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
    return
]

#-----------------------------
# mainControllers
#-----------------------------

mainControllers = angular.module 'mainControllers', []

mainControllers.controller 'SheetsController', ($scope, $http, $log) ->
    # ユーザ一覧取得
    $scope.loadSheets = ->
        $http.get "/api/sheet",
            cache: false
            headers:
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        .success (json) ->
            $scope.sheets = json
        .error networkError
        return
    $scope.loadSheets()

    $scope.sheet =
        title: ''
        text: ''
    $scope.add = () ->
        $scope.sheet =
            id: null
            title: ''
            text: ''
        return
    $scope.edit = (sheet) ->
        $scope.sheet =
            id: sheet.id
            title: sheet.title
            text: sheet.text
        return

    $scope.remove = (sheet) ->
        if confirm('本当に削除しますか\n' + sheet.title)
            $http
                method: 'delete'
                url: '/api/sheet/' + sheet.id
            .success (json) ->
                $scope.loadSheets()
                alert '削除しました'
            .error networkError
        return false

    $scope.save = ->
        method = 'post'
        url = '/api/sheet'
        if $scope.sheet.id
            method = 'put'
            url += '/' + $scope.sheet.id
        $http
            method: method
            url: url
            data: $scope.sheet
            headers:
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        .success (json) ->
            # $log.info(json)
            $scope.sheet = json
            $scope.loadSheets()
        .error networkError
        return false
    return

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
