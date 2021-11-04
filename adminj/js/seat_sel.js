
	
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
	
	
	function ajax_data_var(php_file, var_get, send_data){
		var xhttpReq = new XMLHttpRequest();
		xhttpReq.open("POST", php_file, false);
		xhttpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttpReq.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				//gid(var_get).innerHTML = xhttpReq.responseText
				var_get = xhttpReq.responseText
			}
		};
		xhttpReq.send(send_data);
		return var_get;
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
	
	//seat select
	var vee = 'v';
	var seats = 's';
	var pass = 'p';
	var hook = 'h';
	

	function v_get(){
		form_data = '&vidget=u';
		send_data = form_data;
		seats = ajax_data('app/seat_sel.php', 'rides', send_data);
		//console.log(vee);
	}
	function seats_get(){
		form_data = '&seats=s';
		send_data = form_data;
		seats = ajax_data_var('app/seat_sel.php', seats, send_data);
		//console.log('i am ' + seats);
	}
	function pass_get(){
		form_data = '&pass=p';
		send_data = form_data;
		pass = ajax_data_var('app/seat_sel.php', pass, send_data);
		//console.log(pass);
	}
	
	function all(){
		v_get();
		seats_get();
		pass_get();
	}
	gid('error').addEventListener('load', all())
	//gid('error').innerHTML = 'seats = ' + seats + ' and pass = ' + pass;
	
	//seat select
	seat_array = Array();
	pass2 = pass;
	
	function seatsel(seid){	
		index = seat_array.indexOf(seid)
		if(index == -1){
			if(pass2 == 0){
				return;
			}else{
				//console.log(index);
				gid(seid).style.backgroundColor = 'rgba(0,255,0,0.4)';
				seat_array.push(seid);
				pass2 = pass2 - 1;
				//console.log('added seat is ' + pass2);
				//console.log('array is ' + seat_array);
			}
		}else{
			if(pass2 == pass){
				return;
			}else{
				//console.log(index)
				gid(seid).style.backgroundColor = 'rgba(0,0,0,0)';
				seat_array.splice(index, 1);
				pass2 = pass2 + 1;
				//console.log('removed seat is ' + pass2);
				//console.log('array is ' + seat_array);
			}
		}
	}
	
	//continue
	
	function bt_bus_cont(){
		form_data = '&continue=""&seat_array=' + seat_array;
		send_data = form_data;
		if(seat_array ==''){
			gid('error').innerHTML = 'please select seats';
		}else if(pass2 !== 0){
			gid('error').innerHTML = 'selected seats not up to selected passengers. please review';
		}else{
			ajax_data_red('app/seat_sel.php', 'error', send_data);
		}
	}
	
	