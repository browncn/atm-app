
	
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
	gid('bt_dep').addEventListener('load', depget())
	function depget(){
		depaget = 'depaget';
		form_array = '&depaget=' + depaget;
		send_data = form_array ;
		ajax_data('app/book.php', 'bt_dep', send_data);
	}
	
	function desget(){
		destget = gid('bt_dep');
		destget2 = destget.options[destget.selectedIndex].value;
		form_array = '&destget=' + destget2;
		send_data = form_array ;
		if(destget2 !== ''){
			ajax_data('app/book.php', 'bt_dest', send_data);
		}
	}
	
	//search main
	
	gid("round").addEventListener("click", c);
	function c(){
		gid("return_date").classList.remove("hidden");
	}
	
	gid("one").addEventListener("click", d);
	function d(){
		gid("return_date").classList.add("hidden");
	}
	
	gid("bt_search").addEventListener("mousedown", book);
	function book(){
		bt_dep = gid('bt_dep').value;
		bt_dest = gid('bt_dest').value;
		bt_pass = gid('bt_pass').value;
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
		bt_search = gid('bt_search').value;
		
		form_array = '&bt_dep=' + bt_dep +
		'&bt_dest=' + bt_dest +
		'&bt_pass=' + bt_pass +
		'&trip=' + trip +
		'&dd=' + dd +
		'&dt=' + dt +
		'&rd=' + rd +
		'&rt=' + rt +
		'&bt_search=' + bt_search;
		
		send_data = form_array;
		
		
		ajax_data_red('app/book.php', 'error', send_data);
		//gid('error').innerHTML = send_data;
	}

	
	
	
	
	