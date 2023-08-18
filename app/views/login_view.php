<h1>Авторизация</h1>

<p>
<div class="container">
            <div class="row justify-content-left">
                <div class="col-4">
                    <form id="login">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Введите email">
                            <div class="form-control-feedback"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
                            <div class="form-control-feedback"></div>
                        </div>
                        
                        <div class="checkbox">
                            <label>
                            <input type="checkbox" name="remember"> Запомнить меня
                            </label>
                        </div>

                        <input type="hidden" name="token" value="<?=$data?>">      
                        
                        <button type="submit" class="btn btn-primary">Авторизоваться</button>

                    </form>

                    <br>

                    <?php
                    $params = array(
                        'client_id'     => '51730988',
                        'redirect_uri'  => 'http://localhost:8000/login/checkLoginVK',
                        'response_type' => 'code'
                    );
                    ?>

                    <?php $url = 'http://oauth.vk.com/authorize?' . urldecode(http_build_query($params)) ?>

                    <form id="loginVK" action="' . <?=$url?> . '" target="_blank">
                        <button type="submit" class="btn btn-primary">Войти через VK</button>
                    </form>

                </div>
            </div>
</div>
</p>









