<?php

use RedBeanPHP\OODBBean;

class DiseaseCodeModel
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
    public function diseaseById(int $id): ?OODBBean
    {
        return $this->diseaseBy('id', $id);
    }


    /**
     * @param string $code
     * @return OODBBean|null
     */
    public function diseaseByCode(string $code): ?OODBBean
    {
        return $this->diseaseBy('code', $code);
    }


    /**
     * @param string $field
     * @param $value
     * @return OODBBean|null
     */
    private function diseaseBy(string $field, $value): ?OODBBean
    {
        $disease = null;

        try {
            $this->database->openConnection();

            $disease = R::findOne('disease_code', $field . ' = ?', $value);
        } catch (Exception $exception) {
            print ("Can't get disease: " . $exception->getMessage());
        } finally {
            $this->database->closeConnection();
        }

        return $disease;
    }
}