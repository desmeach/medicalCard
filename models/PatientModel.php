<?php

use RedBeanPHP\OODBBean;

/**
 *  Model for patient table
 */
class PatientModel
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
    public function patientById(int $id): ?OODBBean
    {
        return $this->patientBy('id', $id);
    }


    /**
     * @param string $fullName
     * @return array
     */
    public function patientsByFullName(string $fullName): array
    {
        $patients = null;

        try {
            $this->database->openConnection();

            $patients = R::findAll('patients', 'FIO = ?', [$fullName]);
        } catch (Exception $redException) {
            print('Cant get patient by birthdate: ' . $redException->getMessage());
        } finally {
            $this->database->closeConnection();
        }

        return $patients;
    }

    /**
     * @param DateTime $date
     * @return array
     */
    public function patientsByBirthdate(DateTime $date): array
    {
        $patients = null;

        try {
            $this->database->openConnection();

            $patients = R::findAll('patients', 'birthdate = ?', [$date]);
        } catch (Exception $redException) {
            print('Cant get patient by birthdate: ' . $redException->getMessage());
        } finally {
            $this->database->closeConnection();
        }

        return $patients;
    }


    /**
     * @param $field string
     * @param $value
     * @return OODBBean|null
     */
    private function patientBy(string $field, $value): ?OODBBean
    {
        $patient = null;

        try {
            $this->database->openConnection();

            $patient = R::findOne('patients', $field.' = ?', [$value]);
        } catch (Exception $redException) {
            print("Can't get anamnesis: " . $redException->getMessage());
        } finally {
            $this->database->closeConnection();
        }

        return $patient;
    }
}