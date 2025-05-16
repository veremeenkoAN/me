
    <div class="instruction"></div>
    <div class="container">
        <div class="instruction__inner">
            <ul class="instruction__card-list">
                <li class="instruction__card">
                    <img class="instruction__card-img"   src="/images/card1.jpg" alt="">
                    <div class="instruction__card-text">
                        <div class="instruction__title">ШАГ 1</div>
                        <p>В правом углу вы видите кнопочки</p>
                    </div>
                </li>
                <li class="instruction__card">
                    <img class="instruction__card-img"  src="/images/card2.jpg" alt="">
                    <div class="instruction__card-text">
                        <div class="instruction__title">ШАГ 2</div>
                        <p>Просто наведитесь и вы увидите эффект наведения</p>
                    </div>
                </li>
                <li class="instruction__card">
                    <img class="instruction__card-img" src="/images/card3.jpg" alt="">
                    <div class="instruction__card-text">
                        <div class="instruction__title">ШАГ 3</div>
                        <p>Нажмите на нужную вам кнопочку и вы перейдете на страницу с данными</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
<script>


    button = document.querySelector('.rr')

    button.addEventListener('click',  async () => {
        response = await fetch('/filter')
        data = await response.text()
        document.querySelector('.menu').innerHTML = data
    })

</script>
