<?php 
include_once 'IDiagnosis.php';

/**
 ** Decorator for diagnoses rows
 **/
abstract class DiagnosisDecorator extends IDiagnosis
{
    protected $diagnosis;
    public function __construct(IDiagnosis $diagnosis)
    {
        $this->diagnosis = $diagnosis;
    }
    protected function getDiagnosis()
    {
        return $this->diagnosis;
    }
    protected function setDiagnosis($diagnosis)
    {
        return $this->getDiagnosis()->setDiagnosis($diagnosis);
    }
    public function setDiagnoses($diagnosisName, $eye = null, $diagnosisStage = null)
    {
        return $this->getDiagnosis()->setDiagnoses($diagnosisName, $eye, $diagnosisStage);
    }
    public function getDiagnoses() 
    {
        return $this->getDiagnosis()->getDiagnoses();
    }
}
?>