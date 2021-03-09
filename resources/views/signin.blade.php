<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <!-- begin::Head -->
  <head>
    <meta charset="utf-8" />
    <title>ログイン</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
      WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>

    <!--end::Web font -->

    <!--begin::Global Theme Styles -->
    <link href="{{ asset('assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles -->
    <link rel="shortcut icon" href="{{ asset('assets/demo/default/media/img/logo/favicon.ico') }}" />
  </head>

  <!-- end::Head -->

  <!-- begin::Body -->
  <body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
      <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url({{ asset('assets/app/media/img//bg/bg-3.jpg') }});">
        <div class="m-grid__item m-grid__item--fluid  m-login__wrapper">
          <div class="m-login__container">
            <div class="m-login__logo">
              <a href="#">
                <img src="{{ asset('assets/app/media/img/logos/logo-1.png') }}">
              </a>
            </div>
            <div class="m-login__signin">
              <div class="m-login__head">
                <h3 class="m-login__title">ハルトコーティング</h3>
              </div>
              <form class="m-login__form m-form" action="{{ url('/do_login') }}" method="POST" data-toggle="validator">
                {{ csrf_field() }}
                <div class="form-group m-form__group">
                  <input class="form-control m-input" type="text" placeholder="メールアドレス" name="email" autocomplete="off"
                         required data-msg-required="メールアドレスを入力してください.">
                </div>
                <div class="form-group m-form__group">
                  <input class="form-control m-input m-login__form-input--last" type="password" placeholder="パスワード" name="password"
                         required data-msg-required="パスワードを入力してください.">
                </div>
                <div class="m-login__form-action">
                  <button type="submit" onclick="$(this).closest('form').submit()"
                          class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">ログイン</button>
                </div>
              </form>
            </div>
            <div class="m-login__signup">
              <div class="m-login__head">
                <h3 class="m-login__title">勘定登録</h3>
                <div class="m-login__desc">勘定情報を入力してください.</div>
              </div>
              <form class="m-login__form m-form" action="{{ url('/do_signup') }}" method="POST" data-toggle="validator">
                {{ csrf_field() }}
                <div class="form-group m-form__group">
                  <input class="form-control m-input" type="text" placeholder="性名" name="fullname" required
                         data-msg-required="名前を入力してください.">
                </div>
                <div class="form-group m-form__group">
                  <input class="form-control m-input" type="text" placeholder="メールアドレス" name="email" required
                         data-msg-required="メールアドレスを入力してください.">
                </div>
                <div class="form-group m-form__group">
                  <input class="form-control m-input" type="password" placeholder="パスワード" name="password" required
                         id="passwd" data-msg-required="パスワードを入力してください.">
                </div>
                <div class="form-group m-form__group">
                  <input class="form-control m-input m-login__form-input--last" type="password"
                         placeholder="パスワード(再度入力)" name="rpassword"
                         equalTo="#passwd" data-msg-equalto="パスワードをまた確認してください." required>
                </div>
                <div class="m-login__form-action">
                  <button type="submit"  onclick="$(this).closest('form').submit()"
                          class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn">勘定登録</button>&nbsp;&nbsp;
                  <button id="m_login_signup_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom  m-login__btn">キャンセル</button>
                </div>
              </form>
            </div>
            <div class="m-login__account">
              <a href="javascript:;" id="m_login_signup" class="m-link m-link--light m-login__account-link">勘定登録</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end:: Page -->

    <!--begin::Global Theme Bundle -->
    <script src="{{ asset('assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
    <!--end::Global Theme Bundle -->

    <!--begin::Page Scripts -->
    <script src="{{ asset('assets/snippets/custom/pages/user/login.js') }}" type="text/javascript"></script>
    <script>
        $(function() {
            $('form').each(function() {$(this).validate();});
        });
    </script>
    <!--end::Page Scripts -->
  </body>
  <!-- end::Body -->
</html>
