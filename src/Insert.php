<?php

declare(strict_types=1);

namespace QueryBuilder;

/**
 * Inserindo comentário apenas para testes
 */
class Insert{

    private $queryBuilt = null;

    protected function getFields($arr): string
    {
        $_fields = '';
        $fields = '';

        if (isset($arr[0])) {
            if (is_array($arr[0])) {
                $_fields = array_map(function($element){
                    return implode(', ', array_keys($element));
                }, $arr);
            }
        }

        if (is_array($_fields)) {
            foreach ($_fields as $_field) {
                if ($_field != $fields ) {
                    $fields.= $_field;
                }
            }
        }

        if (empty($fields)) {
            $fields .= implode(', ', array_keys($arr));
        }

        return $fields;
    }

    protected function getValues($arr): string
    {
        $values = '';

        if (isset($arr[0])) {
            if (is_array($arr[0])) {
                $values = array_map(function($element){
                    return '(' . implode(', ', array_values($element)) . ')';
                }, $arr);
            }
            $values = implode(', ', array_values($values));
        }

        if (empty($values)) {
            $values .= '(' . implode(', ', array_values($arr)) . ')';
        }

        return $values;
    }

    public function buildInsert(string $table, array $body): Insert
    {
        $insert = "INSERT INTO {$table}";
        $fields = $this->getFields($body);
        $values = $this->getValues($body);

        $insert.= " ({$fields}) VALUES {$values};";

        $this->queryBuilt = $insert;

        return $this;
    }
}
