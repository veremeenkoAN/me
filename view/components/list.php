<?php foreach($data['data'] as $str): ?>
    <li class="data__str-item">
        <ul class="data__inner-list">
            <?php foreach($str as $key => $value): ?>
                <li class="data__inner-item"><?= $value?></li>
            <?php endforeach; ?>
            <ul class="data__menu-links data__inner-item">
                <li class="data__delete"><a class="data__delete-link" data-id="<?= $str['id'] ?>" href=""><img src="images/delete.png" class="img-del" title="Удалить" alt=""></a></li>
                <li class="data__edit"><a class="data__edit-link" href="<?= $data['info']['url'] . "/edit?id={$str['id']}" ?>"><img alt="" width="20" height="20" title="Редактировать" src="images/editt.png"></a></li>
            </ul>
        </ul>
    </li>

<?php endforeach; ?>