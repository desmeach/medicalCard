<?php 
require_once $_SERVER["DOCUMENT_ROOT"].'/medicalCard/vendor/autoload.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/medicalCard/diagnoses/Diagnosis.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/medicalCard/diagnoses/MainDiagnosis.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/medicalCard/diagnoses/SecondaryDiagnosis.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/medicalCard/diagnoses/ComplaintDiagnosis.php';

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

$complaintDiagnosis = new СomplaintDiagnosis(new Diagnosis());
$complaintDiagnosis->setDiagnoses("complaint-row", "eye-row-complaints", "OD");
$OD = $complaintDiagnosis->getDiagnoses();

$complaintDiagnosis = new СomplaintDiagnosis(new Diagnosis());
$complaintDiagnosis->setDiagnoses("complaint-row", "eye-row-complaints", "OS");
$OS = $complaintDiagnosis->getDiagnoses();

$mainDiagnosis = new MainDiagnosis(new Diagnosis());
$mainDiagnosis->setDiagnoses("diagnosis-row", "diagnosis-row-stage", "eye-row-diag");
$mainDiag = $mainDiagnosis->getDiagnoses();


$secDiagnosis = new SecondaryDiagnosis(new Diagnosis());
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