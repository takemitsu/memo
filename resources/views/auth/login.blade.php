<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>login</title>

</head>
<body>

<h3>login</h3>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/auth/login">
{!! csrf_field() !!}
<div>
メールアドレス
<input type="email" name="email" value="{{ old('email')}}">
</div>
<div>
パスワード
<input type="password" name="password" id="password">
</div>
<div>
<input type="checkbox" name="remember"> ログインを継続する
</div>
<div>
<button type="submit">ログイン</button>
</div>
</form>
<div>
<a href="/auth/register">新規ユーザ登録</a>
</div>

</body>
</html>
