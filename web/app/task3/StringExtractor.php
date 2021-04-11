<?php

namespace Task3\StringExtractor;

function getExtractedStrings(): array
{
    $data = [
        10,
        'John Smith',
        new \stdClass(),
        '121212',
        [
            34.123,
            'test',
            'sample@gmail.com',
            null,
            [
                new \stdClass(),
                94949494,
                null,
                '333-444-666'
            ]
        ],
        null
    ];

    return extractStrings($data);
}

function extractStrings(array $data): array
{
    return array_reduce($data, function ($acc, $item) {
        if (is_array($item)) {
            return array_merge($acc, extractStrings($item));
        }
        if (is_string($item)) {
            return array_merge($acc, [$item]);
        }
        return $acc;
    }, []);
}
