<HTML>
<HEAD>
<TITLE>ダイアログ(showModalDialog)に引数を表示する</TITLE>
<SCRIPT Language="JavaScript">
function init(){
thisForm.disp.value = window.dialogArguments;
}
</SCRIPT>
</HEAD>
<BODY onLoad="init()">
<FORM name="thisForm" method="post">
引数(dialogArguments)を表示する
<INPUT type="text" name="disp" value="">
<INPUT type="button" name="close" value="閉じる" onClick="self.window.close()">
</FORM>
</BODY>
</HTML>