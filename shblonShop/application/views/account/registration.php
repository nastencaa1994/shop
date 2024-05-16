<div class="container" style="max-width: 50rem;padding-top: 1rem">
    <form class="row g-3" action="/reg"  method="post" id="formReg">
        <div class="col-md-4" style="width: 100%">
            <label for="validationServer01" class="form-label">Почта</label>
            <input type="email" class="form-control" name="login" value="" required>
        </div>
        <div class="col-md-4" style="width: 100%">
            <label for="validationServer02" class="form-label">Пароль</label>
            <input type="password" class="form-control" name="password" id="password" value="" required>
        </div>
        <div class="col-md-4" style="width: 100%">
            <label for="passwordCopy" class="form-label">Повторите пароль</label>
            <input type="password" class="form-control" name="passwordCopy" id="passwordCopy" value="" required>
            <div class="valid-feedback" id="validationPassword" style="color: darkred">
                Пароли не совпадают
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Зарегистрироваться</button>
        </div>
    </form>
</div>
<script>
    $('#formReg').submit(function (){
        event.preventDefault()
        password = document.querySelector("#password").value
        passwordCopy = document.querySelector("#passwordCopy").value
        if(password===passwordCopy){
            $(this).unbind('submit').submit()
        }else {
            $('#validationPassword').show()
        }

    })

</script>
