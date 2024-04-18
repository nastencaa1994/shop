<?php
require_once '../template/user/header.php';?>
<main>
    <a href='/'>Вернутся к покупкам</a>
    <div class="main-cart"></div>

    <div class="email-field">
        <p>Имя: <input type="text" id='ename/'></p>
        <p>Email: <input type="text" id='email'/></p>
        <p>Телефон: <input type="text" id='ephone'/></p>
        <p>Коментарий к заказу<br/>
            <textarea id='koment' cols='30px' rows='5px'></textarea>
        </p>
        <p><button class="send-email">Заказать</button></p>
    </div>
</main>
<?php require_once '../template/user/footer.php' ?>

