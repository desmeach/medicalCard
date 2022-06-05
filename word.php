<?php 
require 'vendor/autoload.php';

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

/**
 ** Decorated diagnosis for secondary diagnoses
 **/
class SecondDiagnosis extends DiagnosisDecorator
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

/**
 ** Decorated diagnosis for somatic diagnoses
 **/
class SomaticDiagnosis extends DiagnosisDecorator
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

/**
 ** Decorated diagnosis for right eye complaints
 **/
class СomplaintODDiagnosis extends DiagnosisDecorator
{
    protected function setDiagnosis($diagnosis, $eye = null, $diagnosisStage = null)
    {
        parent::setDiagnosis($diagnosis);
    }

    public function setDiagnoses($diagnosisName, $eye = null, $diagnosisStage = null)
    {
        for ($i = 0; $i < count($_POST[$eye]); $i++)
        {
            if ($_POST[$eye][$i] != "OS")
                $this->setDiagnosis($_POST[$diagnosisName][$i]);
        }
    }

    public function getDiagnoses()
    {
        return parent::getDiagnoses();
    }
}

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

// class WordDocument
// {
//     private \PhpOffice\PhpWord\TemplateProcessor $templatePath;
//     private string $uploadDir;
//     private string $fileName;     

//     public function __construct(string $templatePath, string $uploadDir)
//     {
//         $this->templatePath = \PhpOffice\PhpWord\TemplateProcessor($templatePath);
//         $this->uploadDir = $_SERVER["DOCUMENT_ROOT"] . $uploadDir;
//         $this->fileName = 'Выписка'.date('YmdHis').'.docx';
//     }

//     public function getDiagnosis(string $diagnosisRow, string $diagnosisStageRow, string $eyeRow)
//     {
//         $diagnosis = [];
//         $diagnoses = $_POST[$diagnosisRow];
//         $diagnosisStage = $_POST[$diagnosisStageRow];
//         $eye = $_POST[$eyeRow];
//         for ($i = 0; $i < count($diagnoses); $i++){
//             array_push($mainDiag, $mainDiags[$i]." (".$mainDiagsStages[$i].", Глаз: ".$eyeDiags[$i].")");
//         }
//         $mainDiag = implode(',', $mainDiag);
//         return $diagnosis;
//     }
// }

$document = new \PhpOffice\PhpWord\TemplateProcessor('./templates/template.docx');

$uploadDir = $_SERVER["DOCUMENT_ROOT"] . "/medicalCard/docs/";
$outputFile = 'Выписка'.date('YmdHis').'.docx';

$numDoc = 1;

$complaintDiagnosis = new СomplaintODDiagnosis(new Diagnosis());
$complaintDiagnosis->setDiagnoses("complaint-row", "eye-row-complaints");
$OD = $complaintDiagnosis->getDiagnoses();

$complaintDiagnosis = new СomplaintOSDiagnosis(new Diagnosis());
$complaintDiagnosis->setDiagnoses("complaint-row", "eye-row-complaints");
$OS = $complaintDiagnosis->getDiagnoses();

$mainDiagnosis = new MainDiagnosis(new Diagnosis());
$mainDiagnosis->setDiagnoses("diagnosis-row", "diagnosis-row-stage", "eye-row-diag");
$mainDiag = $mainDiagnosis->getDiagnoses();


$secDiagnosis = new SecondDiagnosis(new Diagnosis());
$secDiagnosis->setDiagnoses("sec-diagnosis-row", "eye-row-sec");
$secDiag = $secDiagnosis->getDiagnoses();

$somaticDiagnosis = new Diagnosis();
$somaticDiagnosis->setDiagnoses("somatic-diag-row");
$somaticDiag = $somaticDiagnosis->getDiagnoses();

$anamnesesData = new Diagnosis();
$anamnesesData->setDiagnoses("anamnesis-row");
$anamneses = $anamnesesData->getDiagnoses();

$curDate = date('d.m.Y');

$document->setValue('numDoc', $numDoc);
$document->setValue('OD', $OD);
$document->setValue('OS', $OS);
$document->setValue('anamneses', $anamneses);
$document->setValue('mainDiag', $mainDiag);
$document->setValue('secDiag', $secDiag);
$document->setValue('somaticDiag', $somaticDiag);
$document->setValue('curDate', $curDate);

$document->saveAs($uploadDir.$outputFile);

?>