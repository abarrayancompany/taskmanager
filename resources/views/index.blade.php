<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task Manager</title>
    <link rel="stylesheet" href="{{url('assets/login.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>
<body>
    <div class="cont_principal">
        <div class="cont_centrar">
        <div class="cont_login">
          <form action="{{url('login-register')}}" method="POST">@csrf
          <div class="cont_tabs_login">
            <ul class='ul_tabs'>
              <li class="active"><a href="#" onclick="sign_in()">ورود</a>
              <span class="linea_bajo_nom"></span>
              </li>
              <li><a href="#up" onclick="sign_up()">ثبت نام</a><span class="linea_bajo_nom"></span>
              </li>
            </ul>
            </div>
        <div class="cont_text_inputs">
            @include('_alert')

            <input type="text" class="input_form_sign " placeholder="نام" name="name" id="name" />
            <input type="text" class="input_form_sign d_block active_inp" placeholder="ایمیل" name="email" id="email" />
            <input type="password" class="input_form_sign d_block  active_inp" placeholder="رمز عبور" name="password" />
            <input type="password" class="input_form_sign" placeholder="نکرار رمز عبور" name="confirm_password" />
          <a href="#" class="link_forgot_pass d_block" ></a>
      <div class="terms_and_cons d_none">
          <p><input type="checkbox" name="accept" id="accept" /> <label for="terms_and_cons">قبول قوانین و مقررات سیستم</label></p>
          </div>
            </div>
      <div class="cont_btn">
           <button class="btn_sign">ورود به سیستم</button>
            </div>
          </form>
          </div>
        </div>
      </div>
<script src="{{url ('assets/app.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
