<?php

use RedBeanPHP\OODBBean;

/**
 * Model for complaint table
 */
class ComplaintModel
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
    public function complaintById(int $id): ?OODBBean
    {
        return $this->complaintBy('id', $id);
    }

    /**
     * @param string $value
     * @return OODBBean|null
     */
    public function complaintByValue(string $value): ?OODBBean
    {
        return $this->complaintBy("complaint", $value);
    }

    /**
     * @param string $field
     * @param $value
     * @return OODBBean|null
     */
    private function complaintBy(string $field, $value): ?OODBBean
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