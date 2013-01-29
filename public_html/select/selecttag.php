<HTML>
<HEAD>
<TITLE>SELECT タグの連動 (最初にクライアントサイドに一括ダウンロード)</TITLE>

</HEAD>
<BODY >
<FORM METHOD=POST ACTION="submitselecttag.php">
<SELECT NAME="day" size="6">
<OPTION VALUE="" SELECTED>(曜日を選択してください)
<OPTION VALUE="月">月曜日
<OPTION VALUE="火">火曜日
<OPTION VALUE="水">水曜日
<OPTION VALUE="木">木曜日
<OPTION VALUE="金">金曜日
</SELECT>
<SELECT NAME="daytime[]" size="7" multiple>
<OPTION VALUE="" SELECTED>(時限を選択してください)
<OPTION VALUE="1">1
<OPTION VALUE="2">2
<OPTION VALUE="3">3
<OPTION VALUE="4">4
<OPTION VALUE="5">5
<OPTION VALUE="6">6
</SELECT>
<INPUT TYPE=submit VALUE="登録">
</FORM>
</BODY>
</HTML>