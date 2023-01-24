<div class="mFeedBack">
    <form id="formTestDrive">
        <input type="hidden" name="action" value="formTestDrive" />
        <div class="mFeedBackForm">
            <div class="mFeedBackForm__field">
                <div class="mFeedBackForm__label">
                    <input type="text" class="mFeedBackForm__input" name="name" placeholder="Ваше имя" value="" />
                </div>
            </div>
            <div class="mFeedBackForm__field">
                <div class="mFeedBackForm__label">
                    <input type="text" class="mFeedBackForm__input" name="phone" placeholder="Номер телефона" value="" />
                </div>
            </div>
            <div class="mFeedBackForm__footer">
                <button type="submit" value="Отправить заявку" class="mFeedBackForm__submit">Отправить заявку</button>
            </div>
        </div>
    </form>
    <div class="mFeedBack__send" id="formTestDriveSend">
        <h4>Ваша заявка принята!</h4>
        <p>Наш менеджер свяжется с Вами и обсудит детали.</p>
    </div>
</div>
<script>
$().ready(function() {
    $('#formTestDrive').validate({
        rules: {
            name: 'required',
            phone: 'required',
        },
        submitHandler: function(form) {

            $('#formTestDrive').hide();
            $('#formTestDriveSend').show();

            $.ajax({
                url: '/local/components/ninja/feed_back/ajax.php',
                method: 'POST',
                data: $(form).serialize(),
                success: function(data){
                    // alert(data);
                }
            });
        }
    });
});
</script>
