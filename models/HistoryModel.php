<?php

use RedBeanPHP\OODBBean;

/**
 * Model of histories table
 */
class HistoryModel
{
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
    public function historyByIdPatient(int $id): ?OODBBean
    {
        return $this->historyBy('id_patient', $id);
    }


    /**
     * @param int $id
     * @return OODBBean|null
     */
    public function historyByIdConclusion(int $id): ?OODBBean
    {
        return $this->historyBy('id_conclusion', $id);
    }


    /**
     * @param string $field
     * @param $value
     * @return OODBBean|null
     */
    private function historyBy(string $field, $value): ?OODBBean
    {
        $history = null;

        try {
            $this->database->openConnection();

            $history = R::findOne('histories', $field . ' = ?', $value);
        } catch (Exception $exception) {
            print ("Can't get history: " . $exception->getMessage());
        } finally {
            $this->database->closeConnection();
        }

        return $history;
    }
}