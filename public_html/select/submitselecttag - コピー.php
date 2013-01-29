<HTML>
<HEAD>
<TITLE>SELECT タグの連動 (最初にクライアントサイドに一括ダウンロード)</TITLE>
<SCRIPT LANGUAGE=JavaScript>
<!--
function funcSubmit() {
    if (document.formMain.pref.selectedIndex == 0 && document.formMain.city.selectedIndex == 0) {
        window.alert("学部・学科と曜日・時限を選択してください");
        return false;
    } else if (document.formMain.pref.selectedIndex == 0) {
        window.alert("学部・学科を選択してください");
        return false;
    } else if (document.formMain.city.selectedIndex == 0) {
        window.alert("曜日・時限を選択してください");
        return false;
    } else {
        return true;
    }
}

function funcMain(b) {
    if (document.formMain.pref.selectedIndex == 0) {
        document.formMain.city.length = 1;
        document.formMain.city.selectedIndex = 0;
    } else {
        if (b) {
            document.formMain.city.length = 1;
            document.formMain.city.selectedIndex = 0;
        }
        var city = cities[document.formMain.pref.selectedIndex - 1];
        document.formMain.city.length = city.length + 1;
        for (var i = 0; i < city.length; i++) {
            document.formMain.city.options[i + 1].value = i;
            document.formMain.city.options[i + 1].text = city[i];
        }
    }
}

var prefs = new Array("月曜日", "火曜日", "水曜日", "木曜日","金曜日");
var cities = new Array();
cities[0] = new Array("1", "2", "3","4","5","6");
cities[1] = new Array("1", "2", "3","4","5","6");
cities[2] = new Array("1", "2", "3","4","5","6");
cities[3] = new Array("1", "2", "3","4","5","6");
cities[4] = new Array("1", "2", "3","4","5","6");
// -->
</SCRIPT>
</HEAD>
<BODY>
<?php

print("day:".$_POST[pref]);
print("daytime:".$_POST[city]);

$time=$_POST[pref].$_POST[city];


print("time:".$time);


?>

</BODY>
</HTML>