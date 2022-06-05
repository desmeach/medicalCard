<?php
include_once 'DiagnosisDecorator.php';

/**
 ** Decorated diagnosis for left eye complaints
 **/
class СomplaintOSDiagnosis extends DiagnosisDecorator
{
    protected function setDiagnosis($diagnosis, $eye = null, $diagnosisStage = null)
    {
        parent::setDiagnosis($diagnosis);
    }

    public function setDiagnoses($diagnosisName, $eye = null, $diagnosisStage = null)
    {
        for ($i = 0; $i < count($_POST[$eye]); $i++)
        {
            if ($_POST[$eye][$i] != "OD")
                $this->setDiagnosis($_POST[$diagnosisName][$i]);
        }
    }
    
    public function getDiagnoses()
    {
        return parent::getDiagnoses();
    }
}
?>