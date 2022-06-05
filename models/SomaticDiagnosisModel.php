<?php

use RedBeanPHP\OODBBean;

/**
 *  Model of somatic_diag table
 */
class SomaticDiagnosisModel
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
    public function diagnosisById(int $id): ?OODBBean
    {
        return $this->diagnosisBy('id', $id);
    }


    /**
     * @param int $code
     * @return OODBBean|null
     */
    public function diagnosisByCode(int $code): ?OODBBean
    {
        return $this->diagnosisBy('code', $code);
    }


    /**
     * @param string $field
     * @param $value
     * @return OODBBean|null
     */
    private function diagnosisBy(string $field, $value): ?OODBBean
    {
        $diagnosis = null;

        try {
            $this->database->openConnection();

            $diagnosis = R::findOne('somatic_diag', $field . ' = ?', $value);
        } catch (Exception $exception) {
            print ("Cant get somatic diagnosis: " . $exception->getMessage());
        } finally {
            $this->database->closeConnection();
        }

        return $diagnosis;
    }
}