<?php

namespace Task2\DbManager;

define('DB_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../storage/db');

const UNIQUE_FIELD_NAME = 'login';
const ROW_FIELDS_NAMES = ['login', 'password'];

function getAllRows(): array
{
    $fileRows = file(DB_PATH);
    return array_map(fn($row) => json_decode($row, true), $fileRows);
}

function insertRow($data): void
{
    if (!checkStructure($data)) {
        throw new \RuntimeException('DbManager: inserting data has invalid structrure');
    }

    if (!checkUnique($data)) {
        throw new \RuntimeException('DbManager: one of the fields is not unique');
    }

    file_put_contents(DB_PATH, json_encode($data) . "\n", FILE_APPEND);
}

function getRowsWhere(array $required)
{
    if ($required === []) {
        return [];
    }

    $rows = getAllRows();

    $selectedRows = array_filter($rows, function ($row) use ($required) {
        $intersection = array_intersect_key($row, $required);
        return $intersection === $required;
    });

    return array_values($selectedRows);
}

function canInsertRow($row): bool
{
    return checkStructure($row) && checkUnique($row);
}

function checkStructure($data): bool
{
    $fieldsNames = array_keys($data);

    $diff1 = array_diff(ROW_FIELDS_NAMES, $fieldsNames);
    $diff2 = array_diff($fieldsNames, ROW_FIELDS_NAMES);

    return $diff1 === [] && $diff2 === [];
}

function checkUnique($row): bool
{
    $rows = getRowsWhere([UNIQUE_FIELD_NAME => $row[UNIQUE_FIELD_NAME]]);
    return $rows === [];
}
