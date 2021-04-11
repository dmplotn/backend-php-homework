<?php

namespace Task2\Cities;

function getSortedCities(): array
{
    $cities = [
        [
            'name' => 'Пермь',
            'sort' => 400
        ],
        [
            'name' => 'Омск',
            'sort' => 500
        ],
        [
            'name' => 'Москва',
            'sort' => 50
        ],
        [
            'name' => 'Ярославль',
            'sort' => 300
        ],
        [
            'name' => 'Краснярск',
            'sort' => 400
        ],
        [
            'name' => 'Санкт-Петербург',
            'sort' => 100
        ],
        [
            'name' => 'Владивосток',
            'sort' => 200
        ],
        [
            'name' => 'Сочи',
            'sort' => 300
        ],
    ];

    usort($cities, function ($city1, $city2) {
        $cmpBySort = $city1['sort'] <=> $city2['sort'];
        $cmpByName = $city1['name'] <=> $city2['name'];
        return $cmpBySort !== 0 ? $cmpBySort : $cmpByName;
    });

    return $cities;
}
