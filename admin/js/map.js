	
function initMap() {
    	var centerCoordinates = new google.maps.LatLng(9.0820, 8.6753);
        var map = new google.maps.Map(document.getElementById('map'), {
        center: centerCoordinates,
        zoom: 1
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var infowindowContent = document.getElementById('infowindow-content');
        
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);
        var infowindow = new google.maps.InfoWindow();
        infowindow.setContent(infowindowContent);
        
        var marker = new google.maps.Marker({
          map: map
        });

        autocomplete.addListener('place_changed', function() {
 	        document.getElementById("location-error").style.display = 'none';
            infowindow.close();
            marker.setVisible(false);
        		var place = autocomplete.getPlace();
        		if (!place.geometry) {
        		  	document.getElementById("location-error").style.display = 'inline-block';
        		  	document.getElementById("location-error").innerHTML = "Cannot Locate '" + input.value + "' on map";
        		    return;
        		}
        		
        		map.fitBounds(place.geometry.viewport);
        		marker.setPosition(place.geometry.location);
        		marker.setVisible(true);
        		    
        		infowindowContent.children['place-name'].textContent = place.name;
        		infowindowContent.children['place-address'].textContent = input.value;
        		infowindow.open(map, marker);
        });
    }


function initMap2() {
	var centerCoordinates = new google.maps.LatLng(9.0820, 8.6753);
    var map = new google.maps.Map(document.getElementById('map2'), {
    center: centerCoordinates,
    zoom: 1
    });
    var card = document.getElementById('pac-card2');
    var input = document.getElementById('pac-input2');
    var infowindowContent = document.getElementById('infowindow-content2');
    
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

    var autocomplete = new google.maps.places.Autocomplete(input);
    var infowindow = new google.maps.InfoWindow();
    infowindow.setContent(infowindowContent);
    
    var marker = new google.maps.Marker({
      map: map
    });

    autocomplete.addListener('place_changed', function() {
	        document.getElementById("location-error2").style.display = 'none';
        infowindow.close();
        marker.setVisible(false);
    		var place = autocomplete.getPlace();
    		if (!place.geometry) {
    		  	document.getElementById("location-error2").style.display = 'inline-block';
    		  	document.getElementById("location-error2").innerHTML = "Cannot Locate '" + input.value + "' on map";
    		    return;
    		}
    		
    		map.fitBounds(place.geometry.viewport);
    		marker.setPosition(place.geometry.location);
    		marker.setVisible(true);
    		    
    		infowindowContent.children['place-name2'].textContent = place.name;
    		infowindowContent.children['place-address2'].textContent = input.value;
    		infowindow.open(map, marker);
    });
}