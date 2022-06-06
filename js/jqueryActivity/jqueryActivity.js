"use strict"

// input: string inputName (set name of html input) 
//        array source (set data from db to input autocomplete)
function setAutocmopleteActivity(inputName, source)
{
    $(document).on("focus", inputName, function(e) {
        if ( !$(this).data("autocomplete") ) { 
            $(this).autocomplete({          
                source: source,
                width: 200,
                max: 10,  
            });
        }
    });
};

// input: string activity
//        int rowNum 
//        string name 
function setOnClickActivity(activity, rowNum, name)
{
    let data = {
        button_add: {
            complaints: 
            {rowData: '<tr id="row'+rowNum+'"><td><input type="text" class="form-control rounded-pill" placeholder="Глаз" id="eye-row" name="eye-row-complaints[]" autocomplete="off"></td><td width="86%"><input type="text" class="form-control rounded-pill" placeholder="Жалоба" id="complaint-row" name="complaint-row[]" autocomplete="off"></td><td><input type="image" width="35px" class="rounded-pill" src="./img/button-remove.png" id="button-remove" name="'+rowNum+'" onclick="return false;"></td></tr>',
            tableName: '#complaint-field', 
            buttonName: '#button-add-complaint'},
            
            mainDiagnosis: 
            {rowData: '<tr id="row'+rowNum+'"><td><input type="text" class="form-control rounded-pill" placeholder="Глаз" id="eye-row" name="eye-row-diag[]" autocomplete="off"></td><td width="44%"><input type="text" class="form-control rounded-pill" placeholder="Диагноз" id="diagnosis-row" name="diagnosis-row[]" autocomplete="off"></td><td width="27%"><input type="text" class="form-control rounded-pill" placeholder="Степень тяжести" id="diag-severity-row" name="diagnosis-row-stage[]" autocomplete="off"></td><td width="15%"><input type="text" class="form-control rounded-pill" placeholder="МКБ-10" id="diag-code-row" name="diagnosis-code-row[]" autocomplete="off"></td><td><input type="image" width="35px" class="rounded-pill" src="./img/button-remove.png" id="button-remove" name="'+rowNum+'" onclick="return false;"></td></tr>',
            tableName: '#main-diagnosis-field', 
            buttonName: '#button-add-diagnosis'},
            
            secondaryDiagnosis: 
            {rowData: '<tr id="row'+rowNum+'"><td><input type="text" class="form-control rounded-pill" placeholder="Глаз" id="eye-row" name="eye-row-sec[]" autocomplete="off"></td><td width="71%"><input type="text" class="form-control rounded-pill" placeholder="Диагноз" id="secondary-diagnosis-row" name="sec-diagnosis-row[]" autocomplete="off"></td><td width="15%"><input type="text" class="form-control rounded-pill" placeholder="МКБ-10" id="secondary-diag-code-row" name="sec-diagnosis-code-row[]" autocomplete="off"></td><td><input type="image" width="35px" class="rounded-pill" src="./img/button-remove.png" id="button-remove" name="'+rowNum+'" onclick="return false;"></td></tr>',
            tableName: '#secondary-diagnosis-field', 
            buttonName: '#button-add-secondary'},

            somaticDiagnosis: 
            {rowData: '<tr id="row'+rowNum+'"><td width="80%"><input type="text" class="form-control rounded-pill" placeholder="Диагноз" id="somatic-diag-row" name="somatic-diag-row[]" autocomplete="off"></td><td width="15%"><input type="text" class="form-control rounded-pill" placeholder="МКБ-10" id="somatic-code-row" name="somatic-code-row[]" autocomplete="off"></td><td><input type="image" width="35px" class="rounded-pill" src="./img/button-remove.png" id="button-remove" name="'+rowNum+'" onclick="return false;"></td></tr>',
            tableName: '#somatic-diagnosis-field', 
            buttonName: '#button-add-somatic'},
        },
        
        button_remove: {
            buttonName: '#button-remove',
        }
    }
    switch (activity)
    {
        case "add":
            $(document).on('click', data.button_add[name].buttonName, function() {
                $(data.button_add[name].tableName).append(data.button_add[name].rowData);
                return rowNum++;
            });
            break;
        case "remove":
            $(document).on('click', '#button-remove', function() {
                var button_id = $(this).attr("name");
                $("#row"+button_id+"").remove();
                return rowNum--;
            });
            break;
    }
}

// input: string name
//        string code (code data from db for current diagnosis row) 
function setOnChangeActivity(name, code)
{
    let data = {
        mainDiagnosis: {
            rowName: "#diagnosis-row",
            codeName: "#diag-code-row",
        },
        secondaryDiagnosis: {
            rowName: "#secondary-diagnosis-row",
            codeName: "#secondary-diag-code-row",
        },
        somaticDiagnosis: {
            rowName: "#somatic-diag-row",
            codeName: "#somatic-code-row",
        },
    }

    $(document).on("change", data[name].rowName, function(e) {
        let codeRow = $(this).parent().next();
        while (codeRow.find(data[name].codeName).length == 0)
        {
            codeRow = codeRow.next();
        }
        codeRow = codeRow.find(data[name].codeName);
        codeRow.val(code);
    })
}

export { setAutocmopleteActivity, setOnClickActivity, setOnChangeActivity };