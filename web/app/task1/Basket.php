<?php

namespace Task1\Basket;

function getBasketItems(): array
{
    $basketItems = [
        [
            'name' => 'Товар №1',
            'article' => '43240909',
            'price' => 546.45
        ],
        [
            'name' => 'Товар №2',
            'article' => '96570950',
            'price' => 3900,
            'discount' => 10
        ],
        [
            'name' => 'Товар №3',
            'article' => 'NFK-1232112',
            'price' => 10020,
            'discount' => 15
        ],
        [
            'name' => 'Товар №4',
            'article' => '5786686',
            'price' => 0
        ],
        [
            'name' => 'Товар №5',
            'article' => '7678901',
            'price' => 5665
        ]
    ];

    return prepareBasketItems($basketItems);
}

function prepareBasketItems(array $basketItems): array
{
    return array_map(function ($item) {
        ['name' => $name, 'article' => $article,'price' => $price] = $item;

        $newItem = ['name' => $name, 'article' => $article];
        if ($price === 0) {
            return $newItem;
        }

        $newItem['price'] = formatPrice($price);
        if (!array_key_exists('discount', $item)) {
            return $newItem;
        }

        $discountInPercentages = $item['discount'] / 100;
        $priceAfterDiscount = $price - $price * $discountInPercentages;
        $newItem['priceAfterDiscount'] = formatPrice($priceAfterDiscount);

        return $newItem;
    }, $basketItems);
}

function formatPrice(int $price): string
{
    return number_format($price, 2, '.', ' ') . ' ₽';
}

function isUnavailableItem(array $item): bool
{
    return !array_key_exists('price', $item);
}

function isDiscountItem(array $item): bool
{
    return array_key_exists('priceAfterDiscount', $item);
}
