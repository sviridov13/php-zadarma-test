<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-3 well">
            <h3 class="text-center">Вход</h3>
            <form class="form" action="/account/login" method="post">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="email" name="login" class="form-control" placeholder="Введите email"/>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Введите пароль"/>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <input class="input" type="text" name="norobot" />
                        <img src="/code/views/account/captcha/captcha.php" />
                    </div>
                </div>
                <div class="text-center col-xs-12">
                    <input name="enter" type="submit" class="btn btn-default" value="Submit"/>
            </form>
        </div>
    </div>