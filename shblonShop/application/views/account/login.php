<div class="container">
    <form class="row g-3">
        <div class="col-md-4">
            <label for="validationServer01" class="form-label">email</label>
            <input type="email" class="form-control" id="validationServer01" value="" required>
        </div>
        <div class="col-md-4">
            <label for="validationServer02" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="validationServer02" value="" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </form>
</div>
<script>
    function postAuthorization(formId) {
        alert(formId);
        // $.ajax({
        //     type: "POST",
        //     url: "/parent/create/create.php",
        //     data: $('#'+formId).serialize(),
        //     success: function (response) {
        //         $('.error-alert').each((index, item) => {
        //             $(item).remove();
        //         })
        //         if (JSON.parse(response).error) {
        //             $('.create-order-content').append(`<p class="error-alert">${JSON.parse(response).error}</p>`)
        //         } else {
        //             window.location.reload();
        //         }
        //     },
        //     error: function (res) {
        //         alert('Что-то пошло не так, попробуйте позже');
        //     }
        // })
    }

</script>