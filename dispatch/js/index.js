
	
	function gid(getId){
		return document.getElementById(getId);
	}
	function gclass(getClass){
		return document.getElementsByClassName(getClass);
	}
	function gname(getName){
		return document.getElementsByName(getName);
	}


	function ajax_data(php_file, getId, send_data){
		gid(getId).innerHTML = "loading";
		var xhttpReq = new XMLHttpRequest();
		xhttpReq.open("POST", php_file, true); xhttpReq.withCredentials = true;
		xhttpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttpReq.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				gid(getId).innerHTML = xhttpReq.responseText;
			}
		};
		xhttpReq.send(send_data);
	}
	
	function ajax_data_red(php_file, getId, send_data){
		gid(getId).innerHTML = "loading";
		var xhttpReq = new XMLHttpRequest();
		xhttpReq.open("POST", php_file, true); xhttpReq.withCredentials = true;
		xhttpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttpReq.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if(xhttpReq.responseText.includes('.html')){
					gid(getId).innerHTML = 'loggin you in. please wait';
					red_url = xhttpReq.responseText;
					window.location.href=red_url;
				}else if(xhttpReq.responseText.includes('divid')){
					er_id = xhttpReq.responseText;
					er_id = er_id.replace('divid','');
					gid(er_id).style.border = "1px solid red"; 
					gid(getId).innerHTML = "please fill the highlighted field correctly ";
				}else{
					gid(getId).innerHTML = xhttpReq.responseText;
				}
			}
		};
		xhttpReq.send(send_data);
	}

	
	// atm main
	
	//keep
	//document.querySelector('#error').addEventListener('load', lolipop);
	
	function lolipop(){
		
	}
	if(typeof localStorage.dinfo !== 'undefined'){
		gid('uinfo').value = localStorage.uinfo;
	}
	if(typeof localStorage.dpass !== 'undefined'){
		gid('pass').value = localStorage.pass;
	}
	
	
	//signin
	gid("signin").addEventListener("mousedown", signin);
	function signin(){
		var masscheck = new Array();
		
		if(typeof er_id !== 'undefined'){
			gid(er_id).style.border = "none";
			gid(er_id).style.borderBottom = "1px solid #c0c0c0";
			gid(er_id).autoFocus;
		}
		
		uinfo = gid('uinfo').value;
		pass = gid('pass').value;
		signin = gid('signin').value;
		keep = gid('keep').checked;
		
		if(keep == true){
			localStorage.dinfo = uinfo;
			localStorage.dpass = pass;
		}
		
		
		
		
		
		
		form_array =
		'&uinfo=' + uinfo +
		'&pass=' + pass +
		'&signin=' + signin;
		
		send_data = form_array;
		
		ajax_data_red('app/index.php', 'error', send_data)
	}
	
	
	