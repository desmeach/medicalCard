<?php
include_once 'DiagnosisDecorator.php';

/**
 ** Decorated diagnosis for secondary diagnoses
 **/
class SecondaryDiagnosis extends DiagnosisDecorator
{
    protected function setDiagnosis($diagnosis, $eye = null, $diagnosisStage = null)
    {
        $diagnosis = $diagnosis." (".$eye.")";
        parent::setDiagnosis($diagnosis);
    }

    public function setDiagnoses($diagnosisName, $eye = null, $diagnosisStage = null)
    {
        for ($i = 0; $i < count($_POST[$diagnosisName]); $i++)
        {
            $this->setDiagnosis($_POST[$diagnosisName][$i], $_POST[$eye][$i]);
        }
    }

    public function getDiagnoses()
    {
        return parent::getDiagnoses();
    }
}
?>