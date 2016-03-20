<div class = "admin-auth">
    <form method="post" action="/login/auth" class = "admin-auth-form">
        <table class = "admin-auth-table">
            <tr>
                <td>
                    <h1>Авторизация</h1>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" value="" name = "lp_login" placeholder="Login"/>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="password" value="" name = "lp_pswd" placeholder="Password"/>
                </td>
            </tr>
            <tr>
                <td>
                    <div class = "error-container">
                        <p class="error-text"></p>
                    </div>

                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Логин" name = "auth"/>
                </td>
            </tr>
        </table>
    </form>
</div>

