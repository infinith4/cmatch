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
<BODY onLoad="funcMain(false)">
<FORM NAME=formMain METHOD=POST ACTION="submitselecttag.php" onSubmit="return funcSubmit()">
<SELECT NAME="pref" size="6" onChange="funcMain(true)">
<OPTION VALUE="" SELECTED>(曜日を選択してください)
<OPTION VALUE="月">月曜日
<OPTION VALUE="火">火曜日
<OPTION VALUE="水">水曜日
<OPTION VALUE="木">木曜日
<OPTION VALUE="金">金曜日
</SELECT>
<SELECT NAME="city" size="7" multiple>
<OPTION VALUE="" SELECTED>(時限を選択してください)
<OPTION VALUE="">
<OPTION VALUE="">
<OPTION VALUE="">
<OPTION VALUE="">
<OPTION VALUE="">
<OPTION VALUE="">
</SELECT>
<INPUT TYPE=submit VALUE="登録">
</FORM>
</BODY>
</HTML>