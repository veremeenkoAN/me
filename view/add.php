<div class="container">
    <div class="edit">
        <form class="edit__form" action="<?= $data['info']['url'] . "/save"?>" method="post">
            <div class="edit__title data__text">Add Record</div>
            <ul class='edit__list'>
                <?php foreach($data['createFields'] as $value)  :?>
                    <li class="edit__list-item">
                        <label for="2" class="edit__label"><?= $value ?></label>
                        <input id="2" class="edit__input" name="<?= $value ?>" type="text">
                    </li>
                <?php endforeach; ?>
                <?php if ((isset($data['list']))) :?>
                <li class="edit__list-item">
                    <label for="2" class="edit__label"><?= $data['listFields'][0] ?></label>
                    <select class="edit__input" id="2" name="<?= $data['listFields'][1] ?>" id="">
                        <?php foreach($data['list'] as $str) :?>
                            <option value="<?= $str['key'] ?>"><?= $str['value'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </li>
            </ul>
            <?php endif; ?>
            <button class="edit__button">Сохранить запись</button>
        </form>
    </div>
</div>

