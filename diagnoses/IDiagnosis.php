<?php 
/**
 ** Interface for diagnoses from input rows
 **/
abstract class IDiagnosis 
{
    protected $diagnoses;
    // set one diagnosis into array $diagnoses
    abstract protected function setDiagnosis($diagnosis);
    // set all diagnoses from inputs into array $diagnoses
    abstract public function setDiagnoses($diagnosisName);
    // return imploded string from array $diagnoses
    abstract public function getDiagnoses();
}
?>