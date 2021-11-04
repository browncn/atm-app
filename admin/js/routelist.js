
	
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
	
	function ajax_data_did(php_file, getId, send_data){
		gid(getId).innerHTML = "loading";
		var xhttpReq = new XMLHttpRequest();
		xhttpReq.open("POST", php_file, true); xhttpReq.withCredentials = true;
		xhttpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttpReq.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				check = xhttpReq.responseText;
				if(check.includes('did_')){
					gid(getId).innerHTML = check;
				}else{
					gid(getId).innerHTML = check;
				}
			}
		};
		xhttpReq.send(send_data);
	}
	
	function ajax_data_get(php_file, variable, send_data){
		var xhttpReq = new XMLHttpRequest();
		xhttpReq.open("POST", php_file, false);
		xhttpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttpReq.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
					variable = xhttpReq.responseText;
					xel = variable;
			}
			
		};
		xhttpReq.send(send_data);
		//gid('check').innerHTML = 'lo' + variable;
		//return variable
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
	
	xel = '';
	ulist = '';
	dlist = '';

	
	// atm main
	lol = gid('usearch_input').value;
	
	function c(){
		send_data = '&userlist=u';
		ajax_data('app/routelist.php', 'userlist', send_data);
	}
	gid("userlist").addEventListener('load', c());
	
	
	function userget(){
		send_data = '&groutes=oppa';
		ajax_data_get('app/routelist.php', ulist, send_data);
		//gid('check').innerHTML = xel;
		dlist = xel.split('_');
		len = dlist.length;
		var nlen = 0;
		for(nlen = 0; nlen < len; nlen++){
			gid('dep').innerHTML = gid('dep').innerHTML + '<option value="' + dlist[nlen] + '">' + dlist[nlen] + '</option>';
			gid('dest').innerHTML = gid('dest').innerHTML + '<option value="' + dlist[nlen] + '">' + dlist[nlen] + '</option>';
		}	
	}
	gid('check').addEventListener('load', userget());
	
	function router(){
		dep = gid('dep').value;
		dest = gid('dest').value;
		price = gid('price').value;
		send_data = '&dep=' + dep + 
					'&dest=' + dest +
					'&price=' + price + 
					'&userlist=u' + 
					'&router=route';
		//gid('check').innerHTML = send_data;
		ajax_data_did('app/routelist.php', 'userlist', send_data);
	}
	//gid('router_button').addEventListener('mousedown', router());
	
	function sel(){
		user_check = gid('usearch_input').value;
		form_array = '&user_check=' + user_check;
		send_data = form_array;
		ajax_data('app/routelist.php', 'userlist', send_data);		
	}
	
	
		
	