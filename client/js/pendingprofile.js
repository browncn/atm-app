
	
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
	err_id = '';
	
	
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
	function ajax_data_append(php_file, getId, send_data){
		gid(getId).innerHTML = "loading";
		var xhttpReq = new XMLHttpRequest();
		xhttpReq.open("POST", php_file, true); xhttpReq.withCredentials = true;
		xhttpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttpReq.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
					gid(getId).innerHTML += xhttpReq.responseText;
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
	
	function ajax_data2(php_file, getId, send_data){
		gid(getId).innerHTML = "loading";
		var xhttpReq = new XMLHttpRequest();
		xhttpReq.open("POST", php_file, false);
		xhttpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttpReq.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if(xhttpReq.responseText.includes('.sub')){
					er_id2 = xhttpReq.responseText;
					er_id2 = er_id2.replace('.sub','');
					if( err_id !== ''){
						return false						
					}else{
						gid('sub').classList.remove('bg-secondary');
						gid('sub').disabled = false;
						gid(getId).innerHTML = er_id2;
					}
				}else{
					gid('sub').classList.add('bg-secondary');
					gid('sub').disabled = true;	
				}
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
					gid(getId).innerHTML = 'searching...';					
					red_url = xhttpReq.responseText;
					//gid(getId).innerHTML = red_url;
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
	
	function getUrlVars() {
	    var vars = {};
	    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
	        vars[key] = value;
	    });
	    return vars;
	}
	
	var u = getUrlVars()["u"];
	//gid('check').innerHTML=u;
	
	xel = '';
	ulist = '';
	dlist = '';
	state = '';
	
	
	
	function sub_search(){
		send_data = '&submenu=' + gid('dept').value;
		ajax_data2('app/userprofile.php', 'sub', send_data);
		//gid('check').innerHTML = 'lo' + gid('dept').value
	}
	
	
	function userget(){
		send_data = '&u=' + u;
		ajax_data_get('app/pendingprofile.php', ulist, send_data);
		//gid('check').innerHTML = xel;
		dist = xel.split('_');
		 gid('pkg_descr').innerHTML = dist[0]; 
			gid('sender_name').innerHTML = dist[1] + '<br>' + dist[2] + '<br><a href="tel:' + dist[3] + '">' + dist[3] + '</a><br>' + dist[4];			
			gid('rec_name').innerHTML = dist[5] + '<br>' + dist[6] + '<br><a href="tel:' + dist[7] + '">' + dist[7] + '</a><br>' + dist[8]; 
			state = dist[8];
			gid('pref_trans').innerHTML = dist[9]; 
			gid('pkg_value').innerHTML = dist[10]; 
			gid('pkg_qty').innerHTML = dist[11]; 
			gid('pkg_weight').innerHTML = dist[12]; 
			gid('deliv_type').innerHTML = dist[13]; 
			gid('waybill').innerHTML = dist[14]; 
			gid('amount').innerHTML = dist[15]; 
			gid('disp_assign').innerHTML = dist[16] + '<br><a href="tel:' + dist[17] + '">' + dist[17] + '</a>'; 
			gid('deliv_status').innerHTML = dist[18]; 
			gid('update_time').innerHTML = dist[19];
		
		
		
	}
	
	gid('check').addEventListener('load', userget());
	
	function del(){
		send_data = '&del=del';
		ajax_data_red('app/pendingprofile.php', 'check', send_data);
	}
	
	function checknsave(){
		error = false;
		
		id = gid('disp_sel').value;
		
		checkarray = {
				id : gid('disp_sel').value,
		};
		for(var i in checkarray){
			el = checkarray[i];
			if(el == ''){
				gid(i).style.border = "1px solid red"; 
				gid('check').classList.add('red');
				gid('check').innerHTML = "please fill the highlighted field correctly ";
				error = true;
			}
			
		}
		
		
		if(error == false){
			send_data = 
				'&checknsave=lol' + 
				'&id='  + id;
			//gid('check').innerHTML=send_data;
			
			ajax_data_red('app/pendingprofile.php', 'check', send_data);
		}
	}
	
	
		
	