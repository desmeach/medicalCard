<?php
include_once 'DiagnosisDecorator.php';

/**
 ** Decorated diagnosis for left eye complaints
 **/
class СomplaintDiagnosis extends DiagnosisDecorator
{
    protected function setDiagnosis($diagnosis, $eye = null, $eyeName = null)
    {
        parent::setDiagnosis($diagnosis);
    }

    public function setDiagnoses($diagnosisName, $eyeRow = null, $eyeName = null)
    {
        for ($i = 0; $i < count($_POST[$eyeRow]); $i++)
        {
            if ($_POST[$eyeRow][$i] === $eyeName || $_POST[$eyeRow][$i] === "OU")
                $this->setDiagnosis($_POST[$diagnosisName][$i]);
        }
    }
    
    public function getDiagnoses()
    {
        return parent::getDiagnoses();
    }
}
?>