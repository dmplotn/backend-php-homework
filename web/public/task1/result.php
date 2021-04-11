<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task1/Basket.php';

use function Task1\Basket\{getBasketItems, isUnavailableItem, isDiscountItem};

$basketItems = getBasketItems();

?>

<div class="basket-table">
    <div class="basket-table__head">
        <div class="basket-table__col basket-table__col--article">Артикул</div>
        <div class="basket-table__col basket-table__col--title">Название</div>
        <div class="basket-table__col basket-table__col--price">Цена за шт.</div>
    </div>
    <div class="basket-table__body">
        <?php foreach ($basketItems as $item) : ?>
            <div class="basket-table__row js-basket-row">
                <div class="basket-table__col basket-table__col--article">
                    <p class="basket-table__article"><?= $item['article'] ?></p>
                </div>
                <div class="basket-table__col basket-table__col--title">
                    <p class="basket-table__title">
                        <?= $item['name'] ?>
                    </p>
                </div>
                <?php if (isUnavailableItem($item)) : ?>
                    <div class="basket-table__col basket-table__col--empty">
                        <div class="basket-table__empty-wrap">
                            <p class="basket-table__empty">Не поставляется или снят с производства</p>
                        </div>
                    </div>
                <?php elseif (isDiscountItem($item)) : ?>
                    <div class="basket-table__col basket-table__col--price">
                        <div class="basket-table__col-content js-basket-price">
                            <p class="basket-table__price"><?= $item['priceAfterDiscount'] ?></p>
                            <p class="basket-table__old-price"><?= $item['price'] ?></p>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="basket-table__col basket-table__col--price">
                        <div class="basket-table__col-content js-basket-price">
                            <p class="basket-table__old-price"><?= $item['price'] ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>