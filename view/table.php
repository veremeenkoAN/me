
<div class="data">
    <div class="container">
        <div class="data__content">
            <div class="data__inner">
                <div class="data__text"><?= $data['info']['table_name'] ?></div>
                <ul class="data__list">
                    <li class="data__str-item-field">
                        <ul class="data__inner-list">
                            <?php foreach($data['data'][0] as $key => $value): ?>
                                <li class="data__inner-item"><?= "<b>$key</b>"?></li>
                            <?php endforeach; ?>
                            <li class="data__inner-item">Действие</li>
                        </ul>
                    </li>
                    <li class="data__table">
                        <ul class="data__table-inner">
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
                        </ul>
                    </li>
                </ul>
            </div>
            <form class="data__sort-filter" action="">
                <div class="data__sort-list">
                    <div class="data__sort-list-title">Sort</div>
                    <div class="data__sort-element">
                        <label for="order">Порядок сортировки</label>
                        <select class="data__order-field" id="order">
                            <option class="data__sort-select" value="asc">По возврастанию</option>
                            <option class="data__sort-select" value="desc">По убыванию</option>
                        </select>
                    </div>
                    <div class="data__sort-element">
                        <label for="sort">Сортировать по</label>
                        <select  id="sort" class="data__sort-field">
                            <option class="data__sort-select" value=""> --Не выбрано</option>
                            <?php foreach ($data['sortFields'] as $key => $value) :?>
                                <option class="data__sort-select" value="<?= $key ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="data__filter-list">
                    <div class="data__filter-list-title">Filter</div>
                    <div class="data__filter-element">
                        <label for="filter">Фильтровать по</label>
                        <select id="filter" class="data__filter-field">
                            <option class="data__filter-select" value=""> --Не выбрано</option>
                            <?php foreach ($data['filterFields'] as $key => $value) :?>
                                <option class="data__sort-select" value="<?= $key ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="text" placeholder="Введите то, что ищете" id="filter" class="data__filter-input">
                </div>
                <div class="data__filter-list">
                    <div class="data__filter-list-title">Add Record</div>
                    <a class="data__link" href="<?= $data['info']['url'] . '/create' ?>">ДОБАВИТЬ ЗАПИСЬ</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/../resources/js/ajax.php'; ?>

