<?php

use RedBeanPHP\OODBBean;

/**
 * Model for anamnesis table
 */
class AnamnesisModel
{
    /**
     * @var IDatabase
     */
    private IDatabase $database;

    /**
     * @param IDatabase $database
     */
    public function __construct(IDatabase $database)
    {
        $this->database = $database;
    }

    /**
     * @param int $id
     * @return OODBBean|null
     */
    public function anamnesisById(int $id): ?OODBBean
    {
        return $this->entryBy('id', $id);
    }

    /**
     * @param string $name
     * @return OODBBean|null
     */
    public function anamnesisByName(string $name): ?OODBBean
    {
        return $this->entryBy('name', $name);
    }

    /**
     * @param string $field
     * @param $value
     * @return OODBBean|null
     */
    private function entryBy(string $field, $value): ?OODBBean
    {
        $anamnesis = null;

        try {
            $this->database->openConnection();

            $anamnesis = R::findOne('anamenesis', $field . ' = ?', [$value]);
        } catch (Exception $redException) {
            print ("Can't get anamnesis: " . $redException ->getMessage());
        } finally {
            $this->database->closeConnection();
        }

        return $anamnesis;
    }
}