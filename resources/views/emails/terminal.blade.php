<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <p>
      識別番号{{ $data['device_id'] }}の端末へのアクセスが{{ $data['allow'] == 1 ? '許可' : '禁止' }}されました。
    </p>
    <p>ID: {{ $data['login_id'] }}</p>
    <p>Password: {{ $data['login_password'] }}</p>
  </body>
</html>
