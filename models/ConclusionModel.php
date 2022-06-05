<?php

use RedBeanPHP\OODBBean;

/**
 * Model of conclusions table
 */
class ConclusionModel
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
    public function conclusionById(int $id): ?OODBBean
    {
        $conclusion = null;
        try {
            $this->database->openConnection();

            $conclusion = R::findOne('conclusions', 'id = ?', [$id]);
        } catch (Exception $exception) {
            print ("Can't get conclusion: " . $exception->getMessage());
        } finally {
            $this->database->openConnection();
        }

        return $conclusion;
    }
}