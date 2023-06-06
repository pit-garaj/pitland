<div class="mFeedBack bg">
    <div class="maxwidth-theme">
        <div class="sections_wrapper">
            <div class="row flexbox">
                <div class="col-md-7 col-sm-8 col-xs-12">
                    <div class="mFeedBack__text">
                        <h3 class="title_block">Запись на профессиональный мотосервис «ПитбайкЛенд»</h3>
                        <div class="mFeedBack__desc">Моточасы - это время проведенное с удовольствием, а не потраченное на ремонт твоего питбайка или мотоцикла.</div>

                        <form id="formFeedBack">
                            <input type="hidden" name="action" value="formFeedBack" />
                            <div class="mFeedBackForm">
                                <div class="mFeedBackForm__field">
                                    <div class="mFeedBackForm__label">
                                        <input type="text" class="mFeedBackForm__input" name="name" placeholder="Ваше имя" value="" />
                                    </div>
                                </div>
                                <div class="mFeedBackForm__field">
                                    <div class="mFeedBackForm__label">
                                        <input type="text" class="mFeedBackForm__input phone" name="phone" placeholder="Номер телефона" value="" />
                                    </div>
                                </div>
                                <div class="mFeedBackForm__field">
                                    <div class="mFeedBackForm__label">
                                        <input type="text" class="mFeedBackForm__input" name="date" placeholder="Удобная дата и время" value="" />
                                    </div>
                                </div>
								
								
                                <div class="mFeedBackForm__field">
									<?/*
                                    <div class="mFeedBackForm__label">
                                        <input type="text" class="mFeedBackForm__input" name="comment" placeholder="Комментарий" value="" />
                                    </div>
									*/?>
                                </div>
								

                                <div class="mFeedBackForm__footer">
                                    <button type="submit" value="Отправить заявку" class="mFeedBackForm__submit">Отправить заявку</button>
                                </div>
                            </div>
                        </form>
                        <div class="mFeedBack__send" id="formFeedBackSend">
                            <h4>Ваша заявка принята!</h4>
                            <p>Наш менеджер свяжется с Вами и обсудит детали.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$().ready(function() {
    $('#formFeedBack').validate({
        rules: {
            name: 'required',
            phone: 'required',
        },
        submitHandler: function(form) {

            $('#formFeedBack').hide();
            $('#formFeedBackSend').show();

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
