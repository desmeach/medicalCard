<?php
include_once 'IDiagnosis.php';
/**
 ** Component of diagnoses interface
 **/
class Diagnosis extends IDiagnosis
{
    protected $diagnoses;
    public function __construct()
    {
        $this->diagnoses = [];
    }

    protected function setDiagnosis($diagnosis)
    {
        array_push($this->diagnoses, $diagnosis);
    }

    public function setDiagnoses($diagnosisName)
    {
        for ($i = 0; $i < count($_POST[$diagnosisName]); $i++)
        {
            $this->setDiagnosis($_POST[$diagnosisName][$i]);
        }
    }

    public function getDiagnoses()
    {
        return implode(', ', $this->diagnoses);
    }
}
?>