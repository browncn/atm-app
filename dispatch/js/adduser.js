
	
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
	
	function ajax_data2(php_file, getId, send_data){
		gid(getId).innerHTML = "loading";
		var xhttpReq = new XMLHttpRequest();
		xhttpReq.open("POST", php_file, true); xhttpReq.withCredentials = true;
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
	gid('check').addEventListener('load', dept_get());
	
	function dept_get(){
		send_data = '&deptget=d';
		ajax_data('app/adduser.php', 'dept', send_data);
	}
	
	function sub_search(){
		send_data = '&submenu=' + gid('dept').value;
		ajax_data2('app/adduser.php', 'sub', send_data);
	}
	
	function checknsave(){
		error = false;
		
		fname = gid('fname').value;
		lname = gid('lname').value;
		email = gid('email').value;
		phone = gid('phone').value;
		pass = gid('pass').value;
		gender = gid('gender').value;
		dept = gid('dept').value;
		sub = gid('sub').value;
		state = gid('state').value;
		addr = gid('addr').value;
		
		checkarray = {
				fname : gid('fname').value,
				lname : gid('lname').value,
				email : gid('email').value,
				phone : gid('phone').value,
				pass : gid('pass').value,
				gender : gid('gender').value,
				dept : gid('dept').value,
				state : gid('state').value,
				addr : gid('addr').value
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
				'&fname='  + fname +  
				'&lname='  + lname +  
				'&email='  + email +  
				'&phone='  + phone +  
				'&pass='  + pass +  
				'&gender='  + gender +  
				'&dept='  + dept +  
				'&sub='  + sub +  
				'&state='  + state +  
				'&addr='  + addr;
			
			ajax_data_red('app/adduser.php', 'check', send_data);
		}
	}
	
	
		
	