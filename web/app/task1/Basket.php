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
        ['name' => $name, 'article' => $article, 'price' => $price] = $item;
        $discount = $item['discount'] ?? null;

        if ($price === 0) {
            return [
                'name' => $name,
                'article' => $article,
                'type' => 'unavailable'
            ];
        }

        if ($discount === null) {
            return [
                'name' => $name,
                'article' => $article,
                'price' => formatPrice($price),
                'type' => 'no_discount'
            ];
        }

        $discountInPercentages = $discount / 100;
        $priceAfterDiscount = $price - $price * $discountInPercentages;

        return [
            'name' => $name,
            'article' => $article,
            'price' => formatPrice($price),
            'priceAfterDiscount' => formatPrice($priceAfterDiscount),
            'type' => 'discount'
        ];
    }, $basketItems);
}

function formatPrice(int $price): string
{
    return number_format($price, 2, '.', ' ') . ' ₽';
}
