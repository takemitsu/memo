<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>register</title>

</head>
<body>

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
<div>
ユーザ名
<input type="text" name="name" value="{{ old('name') }}">
</div>
<div>
メールアドレス
<input type="email" name="email" value="{{ old('email')}}">
</div>
<div>
パスワード
<input type="password" name="password">
</div>
<div>
パスワード確認
<input type="password" name="password_confirmation">
</div>
<div>
<button type="submit">登録</button>
</div>
</form>

</body>
</html>
