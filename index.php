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
        <label for="complaints" class="form-label"><span id="header-font">Введите жалобы пациента</span></br><small>Опишите, на что жалуется пациент</small></label>
        <div class="input-group mb-3" id="complaints">
            <table class="table" id="complaint-field">
                <tr>
                    <td><input type="text" class="form-control rounded-pill" placeholder="" id="eye-row" name="eye-row-complaints[]" autocomplete="off"></td>
                    <td width="87%"><input type="text" class="form-control rounded-pill" placeholder="" id="complaint-row" name="complaint-row[]" autocomplete="off"></td>
                    <td><input type="image" class="rounded-pill" src="img/button-add.png" id="button-add-complaint" name="button-add-complaint" onclick="return false;"></td>
                </tr>
            </table>
        </div>

        <label for="anamnesis" class="form-label"><span id="header-font">Введите анамнез пациента</span></br><small>Опишите кратко историю заболевания</small></label>
        <div class="input-group mb-3" id="anamnesis">
            <table class="table" id="anamnesis-field">
                <tr>
                    <td width="95%"><input type="text" class="form-control rounded-pill" placeholder="" id="anamnesis-row" name="anamnesis-row[]" autocomplete="off"></td>
                    <td></td>
                </tr>
            </table>
        </div>

        <label for="diagnosis" class="form-label"><span id="header-font">Диагноз</span></br><small>Введите все диагнозы, которые нужно отразить в истории болезни, коды МКБ-11 добавятся автоматически</small></label>
        <div class="input-group mb-3" id="diagnosis" >
            <label for="diagnosis" class="form-label"><span id="diag-header-font">Основной диагноз</span></label>
            <div class="input-group mb-3" id="main-diagnosis">
                <table class="table" id="main-diagnosis-field">
                    <tr>
                        <td><input type="text" class="form-control rounded-pill" placeholder="" id="eye-row" name="eye-row-diag[]" autocomplete="off"></td>
                        <td width="36%"><input type="text" class="form-control rounded-pill" placeholder="" id="diagnosis-row" name="diagnosis-row[]" autocomplete="off"></td>
                        <td width="36%"><input type="text" class="form-control rounded-pill" placeholder="" id="diag-severity-row" name="diagnosis-row-stage[]" autocomplete="off"></td>
                        <td width="15%"><input type="text" class="form-control rounded-pill" placeholder="" id="diag-code-row" name="diagnosis-code-row[]" autocomplete="off"></td>
                        <td><input type="image" class="rounded-pill" src="img/button-add.png" id="button-add-diagnosis" name="button-add-diagnosis" onclick="return false;"></td>
                    </tr>
                </table>
            </div>

            <label for="diagnosis" class="form-label"><span id="diag-header-font">Сопутствующий профильный диагноз</span></label>
            <div class="input-group mb-3" id="secondary-diagnosis">
                <table class="table" id="secondary-diagnosis-field">
                    <tr>
                        <td><input type="text" class="form-control rounded-pill" placeholder="" id="eye-row" name="eye-row-sec[]" autocomplete="off"></td>
                        <td width="72%"><input type="text" class="form-control rounded-pill" placeholder="" id="secondary-diagnosis-row" name="sec-diagnosis-row[]" autocomplete="off"></td>
                        <td width="15%"><input type="text" class="form-control rounded-pill" placeholder="" id="secondary-diag-code-row" name="sec-diagnosis-code-row[]" autocomplete="off"></td>
                        <td><input type="image" class="rounded-pill" src="img/button-add.png" id="button-add-secondary" name="button-add-secondary" onclick="return false;"></td>
                    </tr>
                </table>
            </div>

            <label for="diagnosis" class="form-label"><span id="diag-header-font">Сопутствующий соматический диагноз</span></label>
            <div class="input-group mb-3" id="somatic-diagnosis">
                <table class="table" id="somatic-diagnosis-field">
                    <tr>
                        <td width="80%"><input type="text" class="form-control rounded-pill" placeholder="" id="somatic-diag-row" name="somatic-diag-row[]" autocomplete="off"></td>
                        <td width="15%"><input type="text" class="form-control rounded-pill" placeholder="" id="somatic-code-row" name="somatic-code-row[]" autocomplete="off"></td>
                        <td><input type="image" class="rounded-pill" src="img/button-add.png" id="button-add-somatic" name="button-add-somatic" onclick="return false;"></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="container text-center">
            <button type="submit" name='submit' class="btn btn-primary btn-lg" id="generate_but">Сгенерировать выписку</button>
        </div>
    </form>
    <footer>
        </br>
    </footer>
</body>
</html>

<script>
$(document).ready(function() { 
    var dataComplaints = [<?php foreach ($complaintData as $row) { echo "\"".$row['complaint']."\", "; } ?>];
    var dataAnamnesis = [<?php foreach ($anamnesisData as $row) { echo "\"".$row['anamnesis_name']."\", "; } ?>];
    var dataDiagnosisName = [<?php foreach ($diagnosisData as $row) { echo "\"".$row['diagnosis']."\", "; } ?>];
    var dataDiagnosisCode = [<?php foreach ($diagnosisData as $row) { echo "\"".$row['code']."\", "; } ?>];
    var dataSomaticDiagName = [<?php foreach ($somaticDiagData as $row) { echo "\"".$row['diagnosis']."\", "; } ?>];
    var dataSomaticDiagCode = [<?php foreach ($somaticDiagData as $row) { echo "\"".$row['code']."\", "; } ?>];
    var i = 1;
    $('#button-add-complaint').click(function() {
        i++;
        $('#complaint-field').append('<tr id="row'+i+'"><td><input type="text" class="form-control rounded-pill" placeholder="" id="eye-row" name="eye-row-complaints[]" autocomplete="off"></td><td width="87%"><input type="text" class="form-control rounded-pill" placeholder="" id="complaint-row" name="complaint-row[]" autocomplete="off"></td><td><input type="image" class="rounded-pill" src="img/button-remove.png" id="button-remove" name="'+i+'" onclick="return false;"></td></tr>');
    });
    $('#button-add-diagnosis').click(function() {
        i++;
        $('#main-diagnosis-field').append('<tr id="row'+i+'"><td><input type="text" class="form-control rounded-pill" placeholder="" id="eye-row" name="eye-row-diag[]" autocomplete="off"></td><td width="36%"><input type="text" class="form-control rounded-pill" placeholder="" id="diagnosis-row" name="diagnosis-row[]" autocomplete="off"></td><td width="36%"><input type="text" class="form-control rounded-pill" placeholder="" id="diag-severity-row" name="diagnosis-row-stage[]" autocomplete="off"></td><td width="15%"><input type="text" class="form-control rounded-pill" placeholder="" id="diag-code-row" name="diagnosis-code-row[]" autocomplete="off"></td><td><input type="image" class="rounded-pill" src="img/button-remove.png" id="button-remove" name="'+i+'" onclick="return false;"></td></tr>');
    });
    $('#button-add-secondary').click(function() {
        i++;
        $('#secondary-diagnosis-field').append('<tr id="row'+i+'"><td><input type="text" class="form-control rounded-pill" placeholder="" id="eye-row" name="eye-row-sec[]" autocomplete="off"></td><td width="72%"><input type="text" class="form-control rounded-pill" placeholder="" id="secondary-diagnosis-row" name="sec-diagnosis-row[]" autocomplete="off"></td><td width="15%"><input type="text" class="form-control rounded-pill" placeholder="" id="secondary-diag-code-row" name="sec-diagnosis-code-row[]" autocomplete="off"></td><td><input type="image" class="rounded-pill" src="img/button-remove.png" id="button-remove" name="'+i+'" onclick="return false;"></td></tr>');
    });
    $('#button-add-somatic').click(function() {
        i++;
        $('#somatic-diagnosis-field').append('<tr id="row'+i+'"><td width="80%"><input type="text" class="form-control rounded-pill" placeholder="" id="somatic-diag-row" name="somatic-diag-row[]" autocomplete="off"></td><td width="15%"><input type="text" class="form-control rounded-pill" placeholder="" id="somatic-code-row" name="somatic-code-row[]" autocomplete="off"></td><td><input type="image" class="rounded-pill" src="img/button-remove.png" id="button-remove" name="'+i+'" onclick="return false;"></td></tr>');
    });
    $(document).on('click', '#button-remove', function() {
        var button_id = $(this).attr("name");
        $("#row"+button_id+"").remove();
        i--;
    });
    $(document).on("focus","#complaint-row",function(e) {
        if ( !$(this).data("autocomplete") ) { 
            $(this).autocomplete({          
                source: dataComplaints,
                width: 200,
                max: 10,  
            });
        }
    });
    $(document).on("focus","#anamnesis-row",function(e) {
        if ( !$(this).data("autocomplete") ) { 
            $(this).autocomplete({          
                source: dataAnamnesis,
                width: 200,
                max: 10,  
            });
        }
    });
    $(document).on("focus","#diagnosis-row",function(e) {
        if ( !$(this).data("autocomplete") ) { 
            $(this).autocomplete({          
                source: dataDiagnosisName,
                width: 200,
                max: 10,  
            });
        }
    });
    $(document).on("focus","#secondary-diagnosis-row",function(e) {
        if ( !$(this).data("autocomplete") ) { 
            $(this).autocomplete({          
                source: dataDiagnosisName,
                width: 200,
                max: 10,  
            });
        }
    });
    $(document).on("change", "#diagnosis-row", function(e) {
        $next = $(this).parent().next().next().find("#diag-code-row");
        $next.val(dataDiagnosisCode[dataDiagnosisName.indexOf($(this).val())]);
    })
    $(document).on("change", "#secondary-diagnosis-row", function(e) {
        $next = $(this).parent().next().find("#secondary-diag-code-row");
        $next.val(dataDiagnosisCode[dataDiagnosisName.indexOf($(this).val())]);
    })
    $(document).on("focus","#diag-severity-row",function(e) {
        if ( !$(this).data("autocomplete") ) { 
            $(this).autocomplete({          
                source: ["Лёгкая степень","Средняя степень","Тяжёлая степень"],
                width: 200,
                max: 10,  
            });
        }
    });
    $(document).on("focus","#somatic-diag-row",function(e) {
        if ( !$(this).data("autocomplete") ) { 
            $(this).autocomplete({          
                source: dataSomaticDiagName,
                width: 200,
                max: 10,  
            });
        }
    });
    $(document).on("change", "#somatic-diag-row", function(e) {
        $next = $(this).parent().next().find("#somatic-code-row");
        $next.val(dataSomaticDiagCode[dataSomaticDiagName.indexOf($(this).val())]);
    })
    $(document).on("focus","#eye-row",function(e) {
        if ( !$(this).data("autocomplete") ) {
            $(this).autocomplete({             
                source: ['OD','OS','OU'],
                width: 50,
                heigth: 10,
                max: 3, 
            });
        }
    });
})
</script>