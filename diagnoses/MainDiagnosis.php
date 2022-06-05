<?php
include_once 'DiagnosisDecorator.php';

/**
 ** Decorated diagnosis for main diagnoses
 **/
class MainDiagnosis extends DiagnosisDecorator
{
    protected function setDiagnosis($diagnosis, $eye = null, $diagnosisStage = null)
    {
        $diagnosis = $diagnosis." (".$diagnosisStage.", ".$eye.")";
        parent::setDiagnosis($diagnosis);
    }

    public function setDiagnoses($diagnosisName, $eye = null, $diagnosisStage = null)
    {
        for ($i = 0; $i < count($_POST[$diagnosisName]); $i++)
        {
            $this->setDiagnosis($_POST[$diagnosisName][$i], $_POST[$eye][$i], $_POST[$diagnosisStage][$i]);
        }
    }

    public function getDiagnoses()
    {
        return parent::getDiagnoses();
    }
}
?>