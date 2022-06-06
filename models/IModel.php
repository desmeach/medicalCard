<?php

interface IModel
{
    public function entryBy(string $field, $value);

    public function createEntry(array $params);

    public function deleteEntryById(int $id);
}