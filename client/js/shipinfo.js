
	
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
	
	function ajax_data_double(php_file, getId, getId2, send_data){
		gid(getId).innerHTML = "loading";
		gid(getId2).innerHTML = "loading";
		var xhttpReq = new XMLHttpRequest();
		xhttpReq.open("POST", php_file, true); xhttpReq.withCredentials = true;
		xhttpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttpReq.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
					gid(getId).innerHTML = xhttpReq.responseText;
					gid(getId2).innerHTML = xhttpReq.responseText;
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
					gid(getId).innerHTML = 'loading...';					
					red_url = xhttpReq.responseText;
					//gid(getId).innerHTML = red_url;
					window.location.href=red_url;
				}else if(xhttpReq.responseText.includes('divid')){
					er_id = xhttpReq.responseText;
					er_id = er_id.replace('divid','');
					gid(er_id).style.border = "1px solid red"; 
					gid(getId).innerHTML = "<p>please fill the highlighted field correctly</p> ";
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

	
	// atm main
	
	function getUrlVars() {
	    var vars = {};
	    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
	        vars[key] = value;
	    });
	    return vars;
	}
	
	var u = getUrlVars()["v"];
	
	xel = '';
	ulist = '';
	dlist = '';
	
	function state_get(){
		send_data = '&stateget=d';
		ajax_data_double('app/shipinfo.php', 's_state', 'r_state', send_data);
	}
	
	gid('check').addEventListener('load', state_get());
	
	function user_get(){
		send_data = '&user_get=' + u;
		ajax_data_get('app/shipinfo.php', ulist, send_data);
		//gid('check').innerHTML = xel;
		dlist = xel.split('||');
		gid('n_sen').value = dlist[0];
		gid('addr_sen').value = dlist[1];
		gid('phone_sen').value = dlist[2];
		gid('email').value = dlist[3];
	}
	
	gid('check').addEventListener('load', user_get());
	
	function actual(){
		deliv = "";
		s_state = gid('s_state').value;
		r_state = gid('r_state').value;
		qty = gid('qty').value;
		weight = gid('weight').value;
		deliv1 = gid('deliv').value;
		if(deliv1 == 'pickup'){
			deliv = 0;
		}
		if(deliv1 == 'delivery'){
			deliv = 1000;
		}
		
		send_data = '&calc=c' + 
					'&s_state=' + s_state + 
					'&r_state=' + r_state + 
					'&qty=' + qty + 
					'&deliv=' + deliv + 
					'&weight=' + weight;
		
		//gid('check').innerHTML = send_data;
		ajax_data('app/shipinfo.php', 'actual', send_data);
		
	}
	
	function checknsave(){
		var masscheck = new Array();
		
				
				if(typeof er_id !== 'undefined'){
					gid(er_id).style.border = "none";
					gid(er_id).style.borderBottom = "1px solid #c0c0c0";
					gid(er_id).autoFocus;
				}
				
				descr = gid('descr').value;
				n_sen = gid('n_sen').value;
				addr_sen = gid('addr_sen').value;
				n_rec = gid('n_rec').value;
				addr_rec = gid('addr_rec').value;
				phone_sen = gid('phone_sen').value;
				phone_rec = gid('phone_rec').value;
				s_state = gid('s_state').value;
				r_state = gid('r_state').value;
				email = gid('email').value;
				value = gid('value').value;
				qty = gid('qty').value;
				weight = gid('weight').value;
				payment = gid('payment').value;
				deliv = gid('deliv').value;
				
				
				form_array = 
					'&descr=' + descr + 
					'&n_sen=' + n_sen + 
					'&addr_sen=' + addr_sen + 
					'&n_rec=' + n_rec + 
					'&addr_rec=' + addr_rec + 
					'&phone_sen=' + phone_sen +
					'&phone_rec=' + phone_rec + 
					'&s_state=' + s_state + 
					'&r_state=' + r_state + 
					'&email=' + email + 
					'&value=' + value + 
					'&qty=' + qty + 
					'&weight=' + weight + 
					'&payment=' + payment + 
					'&deliv=' + deliv + 
					'&vehicle=' + u + 
					'&checknsave=checknsave';
				
				
				send_data = form_array;
				
				ajax_data_red('app/shipinfo.php', 'modal-body', send_data)
				
				//gid('check').innerHTML = send_data;
			
				
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
	
		
	