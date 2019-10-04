<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-3 well">
            <h3 class="text-center">Регистрация</h3>
            <form class="form" action="/account/register" method="post">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="email" name="login" class="form-control" placeholder="Введите Имя"/>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control" placeholder="Введите пароль"
                        title="Пароль должен содержать только латинские буквы: минимум одну цифру, одну заглавную и строчную букву, 8 и более символов" required/>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <input class="input" type="text" name="norobot" />
                        <img src="/code/views/account/captcha/captcha.php" />
                    </div>
                </div>
                <div class="text-center col-xs-12">
                    <input name="submit" type="submit" class="btn btn-default" value="Submit"/>
            </form>
        </div>
    </div>
</div>