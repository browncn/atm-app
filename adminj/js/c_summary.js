
	
	function gid(getId){
		return document.getElementById(getId);
	}
	function gclass(getClass){
		return document.getElementsByClassName(getClass);
	}
	function gname(getName){
		return document.getElementsByName(getName);
	}
	function gtag(getTag){
		return document.getElementsByTagName(getTag);
	}
	
	
	function ajax_data_red(php_file, getId, send_data){
		gid(getId).innerHTML = "loading";
		var xhttpReq = new XMLHttpRequest();
		xhttpReq.open("POST", php_file, true); xhttpReq.withCredentials = true;
		xhttpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttpReq.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if(xhttpReq.responseText.includes('.html')){
					gid(getId).innerHTML = 'loading...';					
					red_url = xhttpReq.responseText;
					//gid(getId).innerHTML = red_url;
					window.location.href=red_url;
				}else{
					gid(getId).innerHTML = xhttpReq.responseText;
				}
			}
		};
		xhttpReq.send(send_data);
	}

	
	// atm main
	
	function get_summary(){
		form_data = '&summary=p';
		send_data = form_data;
		pass = ajax_data_red('app/c_summary.php', 'rides', send_data);
		//console.log(pass);
	}
	
	gid('error').addEventListener('load', get_summary())
	//gid('error').innerHTML = 'seats = ' + seats + ' and pass = ' + pass;
	

	//continue
	
	function summary_cont(){
		form_data = '&summary_cont=sum';
		send_data = form_data;
		pass = ajax_data_red('app/c_summary.php', 'error', send_data);
	}
	
	