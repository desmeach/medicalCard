<?php

use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;

require_once $_SERVER["DOCUMENT_ROOT"].'/medicalCard/wordDocLib/WordDocument.php';

try {
    $document = new WordDocument($_SERVER["DOCUMENT_ROOT"] . '/medicalCard/templates/template.docx', '/medicalCard/docs/');

    $document->setValueIntoDoc('patientName', $_POST["patient-name"]);
    $document->setValueIntoDoc('patientBirthday', implode(".", (array_reverse(explode("-", $_POST["patient-birthday"])))));
    $document->setValueIntoDoc('OD', $document->getDataFromInputs(new СomplaintDiagnosis(new Diagnosis()), "complaint-row", "eye-row-complaints", "OD"));
    $document->setValueIntoDoc('OS', $document->getDataFromInputs(new СomplaintDiagnosis(new Diagnosis()), "complaint-row", "eye-row-complaints", "OS"));
    $document->setValueIntoDoc('mainDiag', $document->getDataFromInputs(new MainDiagnosis(new Diagnosis()), "diagnosis-row", "eye-row-diag", "diagnosis-row-stage"));
    $document->setValueIntoDoc('secDiag', $document->getDataFromInputs(new SecondaryDiagnosis(new Diagnosis()), "sec-diagnosis-row", "eye-row-sec"));
    $document->setValueIntoDoc('somaticDiag', $document->getDataFromInputs(new Diagnosis(), "somatic-diag-row"));
    $document->setValueIntoDoc('anamneses', $document->getDataFromInputs(new Diagnosis(), "anamnesis-row"));
    $document->setValueIntoDoc('numDoc', $document->getDocNum());
    $document->setValueIntoDoc('curDate', $document->getCurrentDate());
    $document->saveDoc();
} catch (CopyFileException|CreateTemporaryFileException $e) {
    print ("Word error: " . $e->getMessage());
}

