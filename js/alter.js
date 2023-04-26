function myalert(e){
	// $("body").append("<div id='msg'><span>"+e+"</span></div>");
	var html="";
	html+="<div class='con'><div id='msg'>";
	html+="<div class='info_message'>";
	html+="<p class='detail_message'>"+e+"</p>";
	html+="</div><div id='alertSure'>Confirm</div></div></div>";
	$('body').append(html);
}
