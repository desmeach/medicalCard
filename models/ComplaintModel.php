<?php

use RedBeanPHP\OODBBean;

/**
 * Model for complaint table
 */
class ComplaintModel
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
    public function complaintById(int $id): ?OODBBean
    {
        return $this->entryBy('id', $id);
    }

    /**
     * @param string $value
     * @return OODBBean|null
     */
    public function complaintByValue(string $value): ?OODBBean
    {
        return $this->entryBy("complaint", $value);
    }

    /**
     * @param string $field
     * @param $value
     * @return OODBBean|null
     */
    private function entryBy(string $field, $value): ?OODBBean
    {
        $complaint = null;

        try {
            $this->database->openConnection();

            $complaint = R::findOne('complaints', $field.' = ?', [$value]);
        } catch (Exception $exception) {
            print("Can't connect to database: " . $exception->getMessage());
        } finally {
            $this->database->closeConnection();
        }

        return $complaint;
    }
}