<?php

namespace Task2;

use Task2\EditorCommands\AbstractEditorCommand;

class EditorCommandFactory
{
    /**
     * @param string $rawCommands
     *
     * @return array
     */
    public static function create(string $rawCommands): array
    {
        $commandStrings = explode("\n", $rawCommands);
        $filteredCommandStrings = array_filter($commandStrings, fn($commandString) => $commandString !== '');
        $trimmedCommandStrings = array_map('trim', $filteredCommandStrings);

        return array_map(function ($commandString) {
            return self::getCommandByCommandString($commandString);
        }, $trimmedCommandStrings);
    }


    /**
     * @param string $commandString
     *
     * @return AbstractEditorCommand
     */
    private static function getCommandByCommandString(string $commandString): AbstractEditorCommand
    {
        $commandsData = [
            [
                'className' => 'Task2\EditorCommands\InsertCommand',
                'pattern' => '/^insert "(?P<param1>.*)" (?P<param2>(0|[1-9]\d*))$/'
            ],
            [
                'className' => 'Task2\EditorCommands\DeleteCommand',
                'pattern' => '/^delete (?P<param1>(0|[1-9]\d*)) (?P<param2>(0|[1-9]\d*))$/'
            ],
            [
                'className' => 'Task2\EditorCommands\CopyCommand',
                'pattern' => '/^copy (?P<param1>(0|[1-9]\d*)) (?P<param2>(0|[1-9]\d*))$/'
            ],
            [
                'className' => 'Task2\EditorCommands\PasteCommand',
                'pattern' => '/^paste (?P<param1>(0|[1-9]\d*))$/'
            ],
            [
                'className' => 'Task2\EditorCommands\UndoCommand',
                'pattern' => '/^undo$/'
            ],
            [
                'className' => 'Task2\EditorCommands\RedoCommand',
                'pattern' => '/^redo$/'
            ],
        ];

        foreach ($commandsData as ['className' => $className, 'pattern' => $pattern]) {
            $matches = [];
            if (preg_match($pattern, $commandString, $matches)) {
                $params = array_filter($matches, function ($key) {
                    return !is_numeric($key);
                }, ARRAY_FILTER_USE_KEY);

                return new $className(...array_values($params));
            }
        }

        throw new \Exception("Command '{$commandString}' is invalid command");
    }
}
