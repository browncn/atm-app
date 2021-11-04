
	
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

	
	gid("round").addEventListener("click", c);
	function c(){
		gid("return_date").classList.remove("hidden");
	}
	
	gid("one").addEventListener("click", d);
	function d(){
		gid("return_date").classList.add("hidden");
	}
	
	gid("r_search").addEventListener("mousedown", rent);
	function rent(){
		pac_input = gid('pac-input').value;
		pac_input2 = gid('pac-input2').value;
		if(gid('one').checked){
			trip = 'one';
		}
		if(gid('round').checked){
			trip = 'round';
		}
		dd = gid('dd').value;
		dt = gid('dt').value;
		rd = gid('rd').value;
		rt = gid('rt').value;
		r_search = gid('r_search').value;
		
		form_array = '&pac_input=' + pac_input +
		'&pac_input2=' + pac_input2 +
		'&trip=' + trip +
		'&dd=' + dd +
		'&dt=' + dt +
		'&rd=' + rd +
		'&rt=' + rt +
		'&r_search=' + r_search;
		
		send_data = form_array;
		
		ajax_data_red('app/rent.php', 'error', send_data);
		//gid('error').innerHTML = send_data;
	}
	
	function redirect(site){
		window.location.assign(site);
	}

	
	