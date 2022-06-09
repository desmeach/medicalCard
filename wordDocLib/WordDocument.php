<?php

use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;

require_once $_SERVER["DOCUMENT_ROOT"].'/medicalCard/vendor/autoload.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/medicalCard/diagnoses/Diagnosis.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/medicalCard/diagnoses/MainDiagnosis.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/medicalCard/diagnoses/SecondaryDiagnosis.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/medicalCard/diagnoses/ComplaintDiagnosis.php';

class WordDocument
{
    private $document;
    private $uploadDir;
    private $fileName;     
	private $docNum = 1;

    /**
     * @throws CopyFileException
     * @throws CreateTemporaryFileException
     */
    public function __construct(string $templatePath, string $uploadDir)
    {
        $this->document = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);
        $this->uploadDir = $_SERVER["DOCUMENT_ROOT"] . $uploadDir;
        $this->fileName = 'Выписка'.date('YmdHis').'.docx';
    }

	public function getDocNum()
	{
		return $this->docNum;
	}
	
	public function getCurrentDate()
	{
		return date('d.m.Y');
	}
	
    public function getDataFromInputs($component, string $diagnosisRow, string $eyeRow = null, string $diagnosisStageRow = null)
    {
		$component->setDiagnoses($diagnosisRow, $eyeRow, $diagnosisStageRow);
        return $component->getDiagnoses();
    }
	
	public function setValueIntoDoc(string $varName, string $value)
	{
		$this->document->setValue($varName, $value);
	}
	
	public function saveDoc()
	{
		$this->document->saveAs($this->uploadDir.$this->fileName);
	}
}
?>