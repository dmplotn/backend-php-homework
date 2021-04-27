<?php

define('DB_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../storage/db');

class Db
{
    private const UNIQUE_FIELD_NAME = 'login';
    private const ROW_FIELDS_NAMES = ['login', 'password'];

    public static function getAllRows(): array
    {
        set_error_handler(function ($errno, $errstr) {
            throw new \RuntimeException($errstr);
        });
        $fileRows = file(DB_PATH);
        restore_error_handler();

        return array_map(fn($row) => json_decode($row, true), $fileRows);
    }

    public static function insertRow(array $data): void
    {
        if (!self::checkStructure($data)) {
            throw new DbException('Inserting data has invalid structrure');
        }

        if (!self::checkUnique($data)) {
            throw new DbException('One of the fields is not unique');
        }

        set_error_handler(function ($errno, $errstr) {
            throw new \RuntimeException($errstr);
        });
        file_put_contents(DB_PATH, json_encode($data) . "\n", FILE_APPEND);
        restore_error_handler();
    }

    public static function getRowsWhere(array $required): array
    {
        if ($required === []) {
            return [];
        }

        $rows = self::getAllRows();

        $selectedRows = array_filter($rows, function ($row) use ($required) {
            $intersection = array_intersect_key($row, $required);
            return $intersection === $required;
        });

        return array_values($selectedRows);
    }

    private static function checkStructure(array $data): bool
    {
        $fieldsNames = array_keys($data);

        $diff1 = array_diff(self::ROW_FIELDS_NAMES, $fieldsNames);
        $diff2 = array_diff($fieldsNames, self::ROW_FIELDS_NAMES);

        return $diff1 === [] && $diff2 === [];
    }

    private static function checkUnique(array $data): bool
    {
        $rows = self::getRowsWhere([self::UNIQUE_FIELD_NAME => $data[self::UNIQUE_FIELD_NAME]]);
        return $rows === [];
    }
}
