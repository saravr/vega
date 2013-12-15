    function listMakes (defmk) {
        var smk = document.getElementById("sel_make");

        $("#sel_make").empty();
        var newOption = document.createElement("option");
        newOption.text = (defmk == "") ? "Make" : defmk;
        smk.options.add(newOption);
        $url = "../models/Vehicle.php?req=makes";
        $.getJSON($url, function (json) {
            $.each(json, function(key, val) {
                var newOption = document.createElement("option");
                newOption.value = val.make;
                newOption.innerHTML = val.make;
                if (val.make == defmk) {
                    newOption.selected = true;
                }
                smk.options.add(newOption);
            });
        });
    }

    function listModels (defmod) {
        $mk = $("#sel_make").val();

        $("#sel_model").empty();
        var smdl = document.getElementById("sel_model");
        var newOption = document.createElement("option");
        newOption.text = (defmod == "") ? "Model" : defmod;
        smdl.options.add(newOption);
        $url = "../models/Vehicle.php?req=models&make=" + $mk;
        $.getJSON($url, function (json) {
            $.each(json, function (key, val) {
                var newOption = document.createElement("option");
                newOption.value = val.model;
                newOption.innerHTML = val.model;
                if (val.model == defmod) {
                    newOption.selected = true;
                }
                smdl.options.add(newOption);
            });
        });
    }

    $(function() {
        $('#sel_make').bind('change',function() {
            $mk = $("#sel_make").val();

            $("#sel_model").empty();
            var smdl = document.getElementById("sel_model");
            $url = "../models/Vehicle.php?req=models&make=" + $mk;
            $.getJSON($url, function (json) {
                $.each(json, function (key, val) {
                    var newOption = document.createElement("option");
                    newOption.value = val.model;
                    newOption.innerHTML = val.model;
                    smdl.options.add(newOption);
                });
            });
        });
    });

    function listColors (defcol) {
        var scol = document.getElementById("sel_color");

        $("#sel_color").empty();
        var newOption = document.createElement("option");
        newOption.text = (defcol == "") ? "Color" : defcol;
        scol.options.add(newOption);
        $url = "../models/Colors.php?req=colors";
        $.getJSON($url, function (json) {
            $.each(json, function(key, val) {
                var newOption = document.createElement("option");
                newOption.value = val.color;
                newOption.innerHTML = val.color;
                if (val.color == defcol) {
                    newOption.selected = true;
                }
                scol.options.add(newOption);
            });
        });
    }
