
	
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
		gid(getId).innerHTML = "loading...";
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
	
	//book main
	
	//location select
	gid('error').addEventListener('load', avail())
	function avail(){
		summary = 'summary';
		sum = '&summary=' + summary;
		ajax_data('app/bus_sel.php', 'summary', sum);
		err = 'err';
		form_array = '&err=' + err;
		send_data = form_array ;
		ajax_data('app/bus_sel.php', 'rides', send_data);
	}
	
	//car_sel
	car_sel = '';
	checky = '';
	function car_sel_get(vid){
		checky = vid;
		//alert(checky);
	}
	
	
	//continue
	
	
	function bus_sel_cont(){
		car_sel = checky;
		cont = gid('bus_sel_continue').value;
		
		if(car_sel == ''){
			gid('error').innerHTML = 'please select a vehicle';
		}else{
			form_data = '&car_sel=' + car_sel + 
			'&cont=' + cont;
			send_data = form_data;
			ajax_data_red('app/bus_sel.php', 'error', send_data);
		}
	}

	
	
	
	
	