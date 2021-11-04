
	
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
					gid(getId).innerHTML = 'redirecting. please wait';
					red_url = xhttpReq.responseText;
					window.location.href=red_url;
				}else if(xhttpReq.responseText.includes('divid')){
					er_id = xhttpReq.responseText;
					er_id = er_id.replace('divid','');
					gid(er_id).style.border = "1px solid red"; 
					gid(getId).innerHTML = "please fill the highlighted field correctly";
				}else{
					gid(getId).innerHTML = xhttpReq.responseText;
				}
			}
		};
		xhttpReq.send(send_data);
	}

	
	// atm main
	
	//create
	
	error = '';
	passcheck = '';

	function create2(){
var masscheck = new Array();
		
		if(typeof er_id !== 'undefined'){
			gid(er_id).style.border = "none";
			gid(er_id).style.borderBottom = "1px solid #c0c0c0";
			gid(er_id).autoFocus;
		}
		
		fname = gid('fname').value;
		lname = gid('lname').value;
		gmale = gid('gmale').value;
		gfemale = gid('gfemale').value;
		tel = gid('tel').value;
		email = gid('email').value;
		state = gid('state').value;
		addr = gid('addr').value;
		pass1 = gid('pass1').value;
		pass2 = gid('pass2').value;
		create = gid('create').value;
		
		if(gid('gmale').checked){
			gender = gmale;
		}else{
			gender = gfemale;
		}
		
		form_array = '&fname=' + fname +
		'&lname=' + lname +
		'&gender=' + gender +
		'&tel=' + tel + 
		'&dept=client' + 
		'&state=' + state +
		'&addr=' + addr +
		'&email=' + email +
		'&pass1=' + pass1 +
		'&pass2=' + pass2 +
		'&create=' + create ;
		
		send_data = form_array;
		
		
		ajax_data_red('app/create.php', 'error', send_data)
	
		
		}
	
	x = 1;
	function wow(){
		x++;
		gid('error').innerHTML = x;	
	}
	
	//gid("create").addEventListener("mousedown", create);
		
		
		
		
	
	