<?php 
require 'vendor/autoload.php';

$document = new \PhpOffice\PhpWord\TemplateProcessor('./templates/template.docx');

$uploadDir = __DIR__;
$outputFile = 'Выписка'.date('YmdHis').'.docx';

$numDoc = 1;
$anamneses = implode(',', $_POST["anamnesis-row"]);

$OD = [];
$OS = [];
$complaintRows = $_POST["complaint-row"];
$eyeRows = $_POST["eye-row-complaints"];
for ($i = 0; $i < count($eyeRows); $i++){
    if ($eyeRows[$i] === "OD")
        array_push($OD, $complaintRows[$i]);
    elseif ($eyeRows[$i] === "OS")
        array_push($OS, $complaintRows[$i]);
    else 
    {
        array_push($OD, $complaintRows[$i]);
        array_push($OS, $complaintRows[$i]);
    }
}
$OD = implode(',', $OD);
$OS = implode(',', $OS);

$mainDiag = [];
$mainDiags = $_POST["diagnosis-row"];
$eyeDiags = $_POST["eye-row-diag"];
$mainDiagsStages = $_POST["diagnosis-row-stage"];
for ($i = 0; $i < count($mainDiags); $i++){
    array_push($mainDiag, $mainDiags[$i]." (Степень: ".$mainDiagsStages[$i].", Глаз: ".$eyeDiags[$i].")");
}
$mainDiag = implode(',', $mainDiag);
$mainDiag = "Основной диагноз: ".$mainDiag;

$secDiag = [];
$secDiags = $_POST["sec-diagnosis-row"];
$eyeSecDiags = $_POST["eye-row-sec"];
for ($i = 0; $i < count($secDiags); $i++){
    array_push($secDiag, $secDiags[$i]." (Глаз: ".$eyeSecDiags[$i].")");
}
$secDiag = implode(',', $secDiag);
$secDiag = "Сопутствующий профильный диагноз: ".$secDiag;

$somaticDiag = [];
$somaticDiags = $_POST["somatic-diag-row"];
for ($i = 0; $i < count($somaticDiags); $i++){
    array_push($somaticDiag, $somaticDiags[$i]);
}
$somaticDiag = implode(',', $somaticDiag);
$somaticDiag = "Сопутствующий соматический диагноз: ".$somaticDiag;

$curDate = date('d.m.Y');

$document->setValue('numDoc', $numDoc);
$document->setValue('OD', $OD);
$document->setValue('OS', $OS);
$document->setValue('anamneses', $anamneses);
$document->setValue('mainDiag', $mainDiag);
$document->setValue('secDiag', $secDiag);
$document->setValue('somaticDiag', $somaticDiag);
$document->setValue('curDate', $curDate);

$document->saveAs($outputFile);

?>