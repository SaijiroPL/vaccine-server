<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <p>
      {{ $data['shop_name'] }}識別番号{{ $data['device_id'] }}の端末へのアクセスが{{ $data['allow'] == 1 ? '許可' : '禁止' }}されました。
    </p>
  </body>
</html>
