<?php require_once 'getdata.php';
if (isset($_POST['submit']))
{
    require('word.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="js/jquery-ui.min.css">
    <link rel="stylesheet" href="css/style.css?v=1.0">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <title>MedicalCard</title>
</head>
<body>
    <nav class="navbar navbar-light">
    <a class="navbar-brand" href="#">
        <img src="img/favicon.ico" width="60" height="30" class="d-inline-block align-top" alt="">
        <span id="logo-text">MedicalCard</span>
    </a>
    </nav>
    <form method='POST' name="form-submit" id="form-submit">
        <label for="patient" class="form-label"><span id="header-font">Найти пациента</span></br><small>Мы не сохраняем персональные данные  пациентов, они </br> появятся только в необходимых строках истории болезни</small></label>
        <div class="input-group mb-3" id="patient">
            <table class="table" id="pation-field">
                <tr>
                    <td><input type="text" class="form-control rounded-pill" placeholder="ФИО" id="patient-name" name="patient-name"></td>
                    <td><input type="text" class="form-control rounded-pill" placeholder="Дата рождения" id="patient-birthday" name="patient-birthday"></td>
                    <td><input type="text" class="form-control rounded-pill" placeholder="ID пациента" id="patient-id" name="patient-id"></td>
                    <td width="5%"><input type="image" width="35px" class="rounded-pill" src="<? $_SERVER["DOCUMENT_ROOT"] ?>/medicalCard/img/button-search.png" id="button-search" name="button-search" onclick="return false;"></td>
                </tr>
            </table>
        </div>
        <label for="complaints" class="form-label"><span id="header-font">Введите жалобы пациента</span></br><small>Опишите, на что жалуется пациент</small></label>
        <div class="input-group mb-3" id="complaints">
            <table class="table" id="complaint-field">
                <tr>
                    <td><input type="text" class="form-control rounded-pill" placeholder="Глаз" id="eye-row" name="eye-row-complaints[]" autocomplete="off"></td>
                    <td width="86%"><input type="text" class="form-control rounded-pill" placeholder="Жалоба" id="complaint-row" name="complaint-row[]" autocomplete="off"></td>
                    <td><input type="image" width="35px" class="rounded-pill" src="<? $_SERVER["DOCUMENT_ROOT"] ?>/medicalCard/img/button-add.png" id="button-add-complaint" name="button-add-complaint" onclick="return false;"></td>
                </tr>
            </table>
        </div>

        <label for="anamnesis" class="form-label"><span id="header-font">Введите анамнез пациента</span></br><small>Опишите кратко историю заболевания</small></label>
        <div class="input-group mb-3" id="anamnesis">
            <table class="table" id="anamnesis-field">
                <tr>
                    <td width="95%"><input type="text" class="form-control rounded-pill" placeholder="Анамнез" id="anamnesis-row" name="anamnesis-row[]" autocomplete="off"></td>
                    <td></td>
                </tr>
            </table>
        </div>

        <label for="diagnosis" class="form-label"><span id="header-font">Диагноз</span></br><small>Введите все диагнозы, которые нужно отразить в истории болезни, коды МКБ-10 добавятся автоматически</small></label>
        <div class="input-group mb-3" id="diagnosis" >
            <label for="diagnosis" class="form-label"><span id="diag-header-font">Основной диагноз</span></label>
            <div class="input-group mb-3" id="main-diagnosis">
                <table class="table" id="main-diagnosis-field">
                    <tr>
                        <td ><input type="text" class="form-control rounded-pill" placeholder="Глаз" id="eye-row" name="eye-row-diag[]" autocomplete="off"></td>
                        <td width="44%"><input type="text" class="form-control rounded-pill" placeholder="Диагноз" id="diagnosis-row" name="diagnosis-row[]" autocomplete="off"></td>
                        <td width="27%"><input type="text" class="form-control rounded-pill" placeholder="Степень тяжести" id="diag-severity-row" name="diagnosis-row-stage[]" autocomplete="off"></td>
                        <td width="15%"><input type="text" class="form-control rounded-pill" placeholder="МКБ-10" id="diag-code-row" name="diagnosis-code-row[]" autocomplete="off"></td>
                        <td><input type="image" width="35px" class="rounded-pill" src="<? $_SERVER["DOCUMENT_ROOT"] ?>/medicalCard/img/button-add.png" id="button-add-diagnosis" name="button-add-diagnosis" onclick="return false;"></td>
                    </tr>
                </table>
            </div>

            <label for="diagnosis" class="form-label"><span id="diag-header-font">Сопутствующий профильный диагноз</span></label>
            <div class="input-group mb-3" id="secondary-diagnosis">
                <table class="table" id="secondary-diagnosis-field">
                    <tr>
                        <td><input type="text" class="form-control rounded-pill" placeholder="Глаз" id="eye-row" name="eye-row-sec[]" autocomplete="off"></td>
                        <td width="71%"><input type="text" class="form-control rounded-pill" placeholder="Диагноз" id="secondary-diagnosis-row" name="sec-diagnosis-row[]" autocomplete="off"></td>
                        <td width="15%"><input type="text" class="form-control rounded-pill" placeholder="МКБ-10" id="secondary-diag-code-row" name="sec-diagnosis-code-row[]" autocomplete="off"></td>
                        <td><input type="image" width="35px" class="rounded-pill" src="<? $_SERVER["DOCUMENT_ROOT"] ?>/medicalCard/img/button-add.png" id="button-add-secondary" name="button-add-secondary" onclick="return false;"></td>
                    </tr>
                </table>
            </div>

            <label for="diagnosis" class="form-label"><span id="diag-header-font">Сопутствующий соматический диагноз</span></label>
            <div class="input-group mb-3" id="somatic-diagnosis">
                <table class="table" id="somatic-diagnosis-field">
                    <tr>
                        <td width="80%"><input type="text" class="form-control rounded-pill" placeholder="Диагноз" id="somatic-diag-row" name="somatic-diag-row[]" autocomplete="off"></td>
                        <td width="15%"><input type="text" class="form-control rounded-pill" placeholder="МКБ-10" id="somatic-code-row" name="somatic-code-row[]" autocomplete="off"></td>
                        <td><input type="image" width="35px" class="rounded-pill" src="<? $_SERVER["DOCUMENT_ROOT"] ?>/medicalCard/img/button-add.png" id="button-add-somatic" name="button-add-somatic" onclick="return false;"></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="container text-center">
            <button type="submit" name='submit' class="btn btn-primary btn-lg" id="generate_button">Сгенерировать выписку</button>
        </div>
    </form>
    <footer>
        </br>
    </footer>
</body>
</html>

<script type = "module">
"use strict";

import { setAutocmopleteActivity, setOnClickActivity, setOnChangeActivity } from "./js/jqueryActivity/jqueryActivity.js";

$(document).ready(function() { 
    var dataComplaints = [<?php foreach ($complaintData as $row) { echo "\"".$row['complaint']."\", "; } ?>];
    var dataAnamnesis = [<?php foreach ($anamnesisData as $row) { echo "\"".$row['anamnesis_name']."\", "; } ?>];
    var dataDiagnosisName = [<?php foreach ($diagnosisData as $row) { echo "\"".$row['diagnosis']."\", "; } ?>];
    var dataDiagnosisCode = [<?php foreach ($diagnosisData as $row) { echo "\"".$row['code']."\", "; } ?>];
    var dataSomaticDiagName = [<?php foreach ($somaticDiagData as $row) { echo "\"".$row['diagnosis']."\", "; } ?>];
    var dataSomaticDiagCode = [<?php foreach ($somaticDiagData as $row) { echo "\"".$row['code']."\", "; } ?>];

    // set autocomplete to all inputs
    setAutocmopleteActivity("#eye-row", ['OD','OS','OU']);
    setAutocmopleteActivity("#complaint-row", dataComplaints);
    setAutocmopleteActivity("#anamnesis-row", dataAnamnesis);
    setAutocmopleteActivity("#diagnosis-row", dataDiagnosisName);
    setAutocmopleteActivity("#secondary-diagnosis-row", dataDiagnosisName);
    setAutocmopleteActivity("#diag-severity-row", ["Лёгкая степень","Средняя степень","Тяжёлая степень"]);
    setAutocmopleteActivity("#somatic-diag-row", dataSomaticDiagName);
    
    let i = 1;
    i = setOnClickActivity('add', i, 'complaints');
    i = setOnClickActivity('add', i, 'mainDiagnosis');
    i = setOnClickActivity('add', i, 'secondaryDiagnosis');
    i = setOnClickActivity('add', i, 'somaticDiagnosis');
    i = setOnClickActivity('remove', i, '#button-remove');
    setOnChangeActivity("mainDiagnosis", dataDiagnosisCode[dataDiagnosisName.indexOf("Гиперметропия")]);
    setOnChangeActivity("secondaryDiagnosis", dataDiagnosisCode[dataDiagnosisName.indexOf("Гиперметропия")]);
    setOnChangeActivity("somaticDiagnosis", dataSomaticDiagCode[dataSomaticDiagName.indexOf("Сахарный диабет инсулиннезависимый")]);
})
</script>