<div class="modals">
    <div id="signIn" class="modals-inner">
        <form action="/login" method="post" name="signIn-form form-validate">
            @csrf
            <p class="headtitle">@lang('generic.sing_in')</p>
            <label>
                <input type="email" placeholder="Login or Email Address" name="email" required>
            </label>
            <label>
                <input type="password" placeholder="Email Address" name="password" required>
            </label>
            <div class="clearfix row">
                <button type="submit" class="btn-main">SIGN IN</button>
            </div>
        </form><a href="#PasswordReset" class="forgot fancybox">Forgot password?</a>
        <p>Don't have an account? <a href="#signUp" class="fancybox">Sign Up</a>
        </p>
    </div>
    <div id="signUp" class="modals-inner">
        <form action="/register" method="post" name="signIn-form" class="form-validate">
            @csrf
            <p class="headtitle">Sign Up</p>
            <label>
                <input type="text" placeholder="Name" name="name" required>
            </label>
            <label>
                <input type="email" placeholder="Email Address" name="email" required>
            </label>
            <label>
                <input type="password" placeholder="Password" name="reg_password" required>
            </label>
            <label>
                <input type="password" placeholder="Repeat password" name="reg_password_confirmation" required>
            </label>
            <div class="clearfix row">
                <button type="submit" class="btn-main">Sign Up</button>
            </div>
        </form>
    </div>
    <div id="PasswordReset" class="modals-inner">
        <p class="headtitle">Reset Password</p>
        <form action="/" method="post" name="PasswordReset-form">
            <label>
                <input type="email" placeholder="Email Address" name="UserEmail" required>
            </label>
            <div class="clearfix row">
                <button type="submit" class="btn-main">Reset Password</button>
            </div>
            <p>Вам на почту будет отправлено письмо с инструкцией по восстановлению</p>
        </form>
    </div>
    <div id="confirmEmail" class="modals-inner">
        <div class="step1">
            <form action="/" method="post" name="signIn-form">
                <p class="headtitle">ВВЕДИТЕ ВАШУ ЭЛЕКТРОННУЮ ПОЧТУ</p>
                <label>
                    <input type="email" placeholder="Email Address" name="UserEmail" required>
                </label>
                <div class="warning">Пожалуйста, проверьте правильность введенных данных</div>
                <div class="btn-wrap">
                    <button type="button" class="btn-main">ПОДТВЕРДИТЬ</button>
                </div>
            </form>
        </div>
        <div class="step2">
            <p class="headtitle">НА ВАШУ ЭЛЕКТРОННУЮ ПОЧТУ ОТПРАВЛЕНО ПИСЬМО. АКТИВИРУЙТЕ ССЫЛКУ В ПИСЬМЕ</p>
        </div>
    </div>
    <div id="confirmPhone" class="modals-inner">
        <div class="step1">
            <form action="/" method="post" name="confirmPone">
                <p class="headtitle">ВВЕДИТЕ НОМЕР ТЕЛЕФОНА</p>
                <label>
                    <input type="tel" placeholder="" name="userPhone" required>
                </label>
                <div class="warning">Пожалуйста, проверьте правильность введенных данных</div>
                <div class="btn-wrap">
                    <button type="button" class="btn-main">ПОДТВЕРДИТЬ</button>
                </div>
            </form>
        </div>
        <div class="step2">
            <p class="headtitle">НА ВАШ НОМЕР ОТПРАВЛЕНО СМС С КОДОМ</p>
            <form action="/" method="post" name="confirmPone-code">
                <label>
                    <p class="btn-wrap">ВВЕДИТЕ КОД ИЗ СМС</p>
                    <input type="number" placeholder="" name="smscode" required>
                </label>
                <div class="btn-wrap">
                    <button type="submit" class="btn-main">ПОДТВЕРДИТЬ</button>
                </div>
            </form>
        </div>
    </div>
</div>
