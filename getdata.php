<?php
require_once('dbdata.php');
try {
    $db = new PDO('mysql:host='.$dbHost.';dbname='.$dbName.'', $dbUser, $dbPass);
    $sql = 'SELECT complaint FROM complaints';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $complaintData = $stmt->fetchAll();

    $sql = 'SELECT anamnesis_name FROM anamnesis';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $anamnesisData = $stmt->fetchAll();

    $sql = 'SELECT d.diagnosis, dc.code FROM diagnoses as d, disease_code as dc WHERE d.code = dc.id';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $diagnosisData = $stmt->fetchAll();

    $sql = 'SELECT sd.diagnosis, dc.code FROM somatic_diag as sd, disease_code as dc WHERE sd.code = dc.id';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $somaticDiagData = $stmt->fetchAll();
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage();
    die();
}
?>