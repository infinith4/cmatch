<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ch10-3 問い合わせダイアログを表示する </title>
<!--
<link href="jq.css" rel="stylesheet" type="text/css" />
<link href="block.css" rel="stylesheet" type="text/css" />
-->
<script src="../scripts/jquery-1.3.1.js" type="text/javascript"></script>
<script src="jquery.blockUI.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {

  $().ajaxStop($.unblockUI);

  $("#showDialog").click(function() {
    $("#flickr").hide();
    $.blockUI({ message: $("#question"), css: { width: "275px"} });
  });

  $("#yes").click(function() {
    $.blockUI({ message: "<h3>処理中です...</h3>" });

    $.get("Flickr.htm", function(data) {
       $("#flickr").html(data).show();
    });

      $.ajax({
        url: "Flickr.htm",     // or "Flickr.php",
        cache: false,
        success: function(data) {
          $("#flickr").html(data).show();          
          $.unblockUI();
        }
      });
$("#search_results").slideUp(); 
    $("#text, #text2").keyup(function(){
        ajax_post(); 
    }); 
  });

  $("#no").bind("click", $.unblockUI);

});   
function ajax_post(){ 
  $("#search_results").show();
  var search_val = $("#text").val();
  var search_val2 = $("#text2").val();

} 
$.post(
    "test_post.php",                      // リクエストURL
    {"key1": "value1", "key2": "value2"}, // データ
    function(data, status) {
        // 通信成功時にデータを表示
        $("#test_result")
            .append("status:").append(status).append("<br/>")
            .append("data:").append(data).append("<br/>");
    },
    "html"                                 // 応答データ形式
);
</script>   

</head>
<body>
<div style="margin: 10px 0 0 10px;">   
  <p>   
  <form id="searchform" method="post"> 
    <input id="showDialog" type="submit" value="イメージをロードする" />   
    
    <input type="text" name="text" id="text" /><br />
    <input type="text2" name="text2" id="text2" /><br />
    </form>
  </p>   
  <div id="question" style="display: none; cursor: default">   
    <h3>処理を続行しますか?</h3>   
    <input type="button" id="yes" value="はい" />   
    <input type="button" id="no" value="いいえ" />   
  </div>   
</div>  
<br /><br />
<div id="flickr" style="margin:10px;"></div>


<form id="searchform" method="post"> 
    <label for="text">input text</label><br />

</form>
<div id="search_results"></div> 
</body>
</html>
