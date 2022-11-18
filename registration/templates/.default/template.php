<? if ($arResult['ACTIVE'] == 'Y'): ?>
    <form method="POST" id="register-form-submit" class="popup-auth__form">
        <label class="ui-label ui-label__required" for="register-surname">Фамилия</label>
        <input id="register-surname" class="ui-input-eqville popup-auth__input" name="register-surname" type="text"
               placeholder="Введите фамилию" required/>

        <label class="ui-label ui-label__required" for="register-name">Имя</label>
        <input id="register-name" class="ui-input-eqville popup-auth__input" name="register-name" type="text"
               placeholder="Введите имя" required/>

        <label class="ui-label" for="register-second-name">Отчество (необязательно)</label>
        <input id="register-second-name" class="ui-input-eqville popup-auth__input" name="register-second-name"
               type="text" placeholder="Введите отчество"/>

        <label class="ui-label ui-label__required" for="register-email">E-mail</label>
        <input id="register-email" class="ui-input-eqville popup-auth__input" name="register-email" type="email"
               placeholder="E-mail *" required/>

        <label class="ui-label ui-label__required" for="register-tel">Номер телефона</label>
        <input id="register-tel" class="ui-input-eqville popup-auth__input" name="register-tel" type="tel"
               placeholder="Номер телефона *" required/>

        <label class="ui-label ui-label__required" for="register-password">Пароль</label>
        <input id="register-password" class="ui-input-eqville popup-auth__input" name="register-password"
               type="password" placeholder="Придумайте пароль *" required minlength="6"/>

        <div class="popup-auth__buttons-block popup-auth__buttons-block--registration">
            <input id="register-btn-submit" class="ui-button__eqville--big popup-auth__buttons-block-register-submit" type="submit" name="register-submit"
                   value="Зарегистрироваться" disabled>
            <div class="popup-auth__buttons-block-link-signin">Войти</div>
        </div>
    </form>
    <div class="popup-auth__info">
        Нажимая на кнопку «Зарегистрироваться», вы принимаете условия <a href="/pravila-publichnoy-oferty">оферты</a> и <a href="/politika-konfidentsialnosti">согласие на
            обработку персональных данных</a>
    </div>
<? endif; ?>