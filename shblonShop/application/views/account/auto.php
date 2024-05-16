<div class="container" style="max-width: 50rem">
    <div style="width: 100%;display: flex;justify-content: end; padding-top: 1rem">
        <a href="/registration" style="text-align: right">Зарегистрироваться</a>
    </div>

    <form class="row g-3" action="/auto"  method="post">
        <div class="col-md-4" style="width: 100%">
            <label for="validationServer01" class="form-label">логин</label>
            <input type="text" class="form-control" name="login" id="validationServer01" value="" required>
        </div>
        <div class="col-md-4" style="width: 100%">
            <label for="validationServer02" class="form-label">Пароль</label>
            <input type="password" class="form-control" name="password" id="validationServer02" value="" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-12"  style="width: 100%">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </form>
</div>
