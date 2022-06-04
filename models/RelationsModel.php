<?php

use RedBeanPHP\OODBBean;

/**
 *  Model for relations table
 */
class RelationsModel
{
    /**
     * @var Database
     */
    private Database $database;

    /**
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }


    /**
     * @param int $id
     * @return OODBBean|null
     */
    public function anamnesisId(int $id): ?OODBBean
    {
        return $this->relationById('id_anamnesis', $id);
    }


    /**
     * @param int $id
     * @return OODBBean|null
     */
    public function complaintId(int $id): ?OODBBean
    {
        return $this->relationById('id_complaint', $id);
    }


    /**
     * @param int $id
     * @return OODBBean|null
     */
    public function diagnosisId(int $id): ?OODBBean
    {
        return $this->relationById('id_diagnosis', $id);
    }


    /**
     * @param string $name
     * @param int $id
     * @return OODBBean|null
     */
    private function relationById(string $name, int $id): ?OODBBean
    {
        $relation = null;

        try {
            $this->database->openConnection();

            $relation = R::findOne($name, 'id = ?', $id);
        } catch (Exception $exception) {
            print ("Can't get relation: " . $exception->getMessage());
        } finally {
            $this->database->closeConnection();
        }

        return $relation;
    }
}