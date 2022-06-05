<?php

use RedBeanPHP\OODBBean;

/**
 * Model of diagnoses table
 */
class DiagnoseModel
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
    public function diagnoseById(int $id): ?OODBBean
    {
        return $this->diagnoseBy('id', $id);
    }

    /**
     * @param int $code
     * @return OODBBean|null
     */
    public function diagnoseByCode(int $code): ?OODBBean
    {
        return $this->diagnoseBy('code', $code);
    }

    /**
     * @param string $field
     * @param $value
     * @return OODBBean|null
     */
    private function diagnoseBy(string $field, $value): ?OODBBean
    {
        $diagnose = null;

        try {
            $this->database->openConnection();

            $diagnose = R::findOne('diagnoses', $field . ' = ?', $value);
        } catch (Exception $exception) {
            print ("Can't get diagnose: " . $exception->getMessage());
        } finally {
            $this->database->closeConnection();
        }

        return $diagnose;
    }
}