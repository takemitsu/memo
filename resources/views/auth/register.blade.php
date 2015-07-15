<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>register</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="/css/admin.css">
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <h3>register</h3>

@if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
@endif

      <form method="POST" action="/auth/register">
        {!! csrf_field() !!}
        <div class="form-group">
          <label>ユーザ名</label>
          <input type="text" class="form-control" name="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
          <label>メールアドレス</label>
          <input type="email" class="form-control" name="email" value="{{ old('email')}}">
        </div>
        <div class="form-group">
          <label>パスワード</label>
          <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
          <label>パスワード確認</label>
          <input type="password" class="form-control" name="password_confirmation">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">登録</button>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
