
	
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
		modal_clear();
		gid('cancel').style.display="none";
		gid('modal-header').style.background="rgba(0,255,0,0.5)";
		conf();
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
					modal_clear();
					gid('cancel').style.display="block";
					conf();
				}else{
					gid(getId).innerHTML = xhttpReq.responseText;
				}
			}else{
				modal_clear();
				gid(getId).innerHTML = "<p>Internet not available. Please enable innternet connection and try again</p> ";
				gid('cancel').style.display="block";
				gid('modal-header').style.background="rgba(255,0,0,0.5)";
				conf();				
			}
		};
		xhttpReq.send(send_data);
	}
	
	err_id = '';

	
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
	
	error = '';
	passcheck = '';

	
	function checknsave(){
		
		var masscheck = new Array();
		
		if(typeof er_id !== 'undefined'){
			gid(er_id).style.border = "none";
			gid(er_id).style.borderBottom = "1px solid #c0c0c0";
			gid(er_id).autoFocus;
		}
		
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
			
			ajax_data_red('app/adduser.php', 'modal-body', send_data);
		}
	}
	
	// Get the modal
	var modal = document.getElementById("myModal");
	gmid = function (gg){return document.getElementById(gg);}

	// open the modal
	function conf() {
	  modal.style.display = "block";
	}

	// close the modal
	gid('cancel').onclick = function() {
	  modal.style.display = "none";
	}
	//modal clear data
	function modal_clear (){
		gmid('modal-footer').innerHTML='';
	}

	// When the user clicks anywhere outside of the modal, close it
	/*window.onclick = function(event) {
	  if (event.target == modal) {
	    modal.style.display = "none";
	  }
	}
	*/