<HTML>
<HEAD>
<TITLE>ダイアログ(showModalDialog)に引数を渡す</TITLE>
<SCRIPT Language="JavaScript">
function func_DialogOpen(){
showModalDialog("subject/removedialog.php",thisForm.arg.value,"dialogWidth:300px;dialogHeight:240px");
}
</SCRIPT>
</HEAD>
<BODY>
<FORM name="thisForm" method="post">
ダイアログ(showModalDialog)を表示する
<INPUT type="text" name="arg" value="">
<INPUT type="button" name="modal" value="open" onClick="func_DialogOpen()">
</FORM>
</BODY>
</HTML>