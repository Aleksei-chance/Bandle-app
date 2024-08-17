<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bandle</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/auth_functions.js') }}"></script>
</head>
<body class="auth">
    <div class="auth_content">
        <img src="{{ asset('svg/Logo-large.svg') }}">
        <div class="auth_container">
            <div class="auth_btn_groupe">
                <span class="btn_white text_btn">
                    <img src="{{ asset('svg/applelogo.svg') }}">
                    Sign in with Apple
                </span>
                <span class="btn_white">
                    <img src="{{ asset('svg/LOGO.svg') }}">
                    Sign in with Google
                </span>
            </div>
            <div id="inputs_zone" class="inputs_zone" style="transform: translateY(-140px)">
                <p class="text_grey">Sign in via your bandle account</p>
            
                <div class="auth_btn_groupe">
                    <div class="input_block" id="email_login_block">
                        <label class="auth_input_zone" for="login">
                            <img src="{{ asset('svg/lk.svg') }}">
                            <input type="text" placeholder="Enter your e-mail" name="login" id="login" oninput="input_valid(this)">
                        </label>
                        <p class="error_text">sdfsd</p>
                    </div>
                    <div class="input_block" id="password_login_block">
                        <label class="auth_input_zone">
                            <img src="{{ asset('svg/password.svg') }}">
                            <input type="password" placeholder="Enter your password" id="login_password" oninput="input_valid(this)">
                        </label>
                        <p class="error_text">sdfsd</p>
                    </div>
                    <button class="btn_clear">Forget your password?</button>
                    <div id="btns_zone" class="auth_btn_groupe" style="transform: translateY(0px)">
                        <button class="btn-main" onclick="login();">Sign in</button>
                        <button class="btn_clear" onclick="Registration();">Registration</button>
                    </div>
                </div>
            </div>
            

            
        </div>
    </div>
    <div class="hover" id="hover"></div>
    <div class="reg_modal" id="reg_modal">
        <div class="modal-hat">
            <span class="btn_back" onclick="hide();">
                <img src="{{ asset('svg/chevron.backward.svg') }}">
                Cancel
            </span>
            <h3>Registration</h3>
            <span style="width: 99px"></span>
        </div>
        <div class="reg_zone">
            @csrf

            <div class="input_block" id="email_block">
                <label class="auth_input_zone input_reg" for="email">
                    <input type="text" placeholder="E-mail" name="email" id="email" oninput="input_valid(this)">
                    <button class="input_btn" onclick="input_action(this);">
                        <i class="icon_small icon_send"></i>
                    </button>
                </label>
                <p class="error_text">sdfsd</p>
            </div>
            
            <div class="input_block" id="password_block">
                <label class="auth_input_zone input_reg" for="password">
                    <input type="password" placeholder="Password" name="password" id="password" oninput="input_valid(this)">
                    <button class="input_btn">
                        <i class="icon_small icon_send"></i>
                    </button>
                </label>
                <p class="error_text">sdfsd</p>
            </div>

            <div class="input_block" id="password_confirmation_block">
                <label class="auth_input_zone input_reg" for="password_confirmation">
                    <input type="password" placeholder="Repeat password" name="password_confirmation" id="password_confirmation" oninput="input_valid(this)">
                    <button class="input_btn">
                        <i class="icon_small icon_send"></i>
                    </button>
                </label>
            </div>
            <button onclick="Registration_send();" class="btn-main">Apply</button>
        </div>

        
    </div>
</body>
</html>