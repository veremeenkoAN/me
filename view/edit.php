<div class="container">
    <div class="edit">
        <form class="edit__form" action="<?= $data['info']['url'] . "/update"?>" method="post">
            <div class="edit__title data__text">Edit</div>
            <ul class='edit__list'>
                <input type="hidden" name="original-id" value="<?= $data['data'][0]['id']  ?>">
                <?php foreach($data['data'][0] as $key => $value)  :?>
                    <li class="edit__list-item">
                        <label for="2" class="edit__label"><?= $key ?></label>
                        <input id="2" class="edit__input" name="<?= $key ?>" value="<?= $value ?>" type="text">
                    </li>
                <?php endforeach; ?>
                <?php if ((isset($data['list']))) :?>
                <li class="edit__list-item">
                    <label for="3" class="edit__label"><?= $data['listFields'][0] ?></label>
                    <select class="edit__input" id="3" name="<?= $data['listFields'][1] ?>" id="">
                        <?php foreach($data['list'] as $str) :?>
                        <option value="<?= $str['key'] ?>"><?= $str['value'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </li>
            </ul>
            <?php endif; ?>
            <button class="edit__button">Применить изменения</button>
        </form>
    </div>
</div>
