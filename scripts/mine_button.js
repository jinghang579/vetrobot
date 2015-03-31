
var i_start=window.setInterval(mine_button_border,300);
var isPaused=true;
function mine_button_border(){
	if(!isPaused){
		var _border=document.getElementById("mine_border");
	    if(_border.className=="mine_border_1"){
		    _border.className="mine_border_2";
	    }else{
		    _border.className="mine_border_1";
	    }
	}
}
function i_pause(){
	isPaused=false;
}
function i_not_pause(){
	isPaused=true;
}