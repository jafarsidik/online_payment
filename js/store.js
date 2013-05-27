// var map = null;
// var geocoder = null;
// var markers = {};
// var infoWindow = null;

// function initializeMap() {
//     var mapOptions = {
//         zoom: 11,
//         mapTypeId: google.maps.MapTypeId.ROADMAP
//     };
//     map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
//     google.maps.event.addListener(map, "idle", function(event) {
//         searchStoresBounds();
//     });

//     geocoder = new google.maps.Geocoder();
//     infoWindow = new google.maps.InfoWindow();
// }


// function searchAddress(address) {
//     geocoder.geocode( { 'address': address}, function(results, status) {
//         if (status === google.maps.GeocoderStatus.OK) {
//             var latlng = results[0].geometry.location;
//             map.setCenter(latlng);

//             searchStoresBounds();

//         } else {
//             alert('Geocode was failed: ' + status);
//         }
//     });
// }


function auditor_inspect() {

    var url = './store.php';

    jQuery.ajax({
        url: url,
        // data: parameter,
        dataType: 'json',
        success: audit_check
    });
}

function audit_check(data, status, xhr) {
    if (data['status'] != 'OK')
        return;
    // console.log(data);
    jQuery("#result").empty();
    var id, html;
    for (id in data['data']) {
        if (data['data'][id]['price'] != data['data'][id]['money']) {
            html = "<p> 订单号 " + data['data'][id]['order_id'] + " 出现错误</p>";
            if (data['data'][id]['price'] - data['data'][id]['money'] < 0) {
                html += "<p> 买家付钱 " + data['data'][id]['price'] + " 少于订单金额 " +
                    data['data'][id]['money'] + "</p>";
            }
            else {
                html += "<p> 买家付钱 " + data['data'][id]['price'] + " 多于订单金额 " +
                    data['data'][id]['money'] + "</p>";
            }
        }


        jQuery('#result').append(html);
        // var html = "<p>Price is " + data['data'][id]['price'] +
        //         "</p><p>Money is " + data['data'][id]['money'] + "</p>" +
        //         "<p> Order Id is" + data['data'][id]['order_id'] + "</p>";
        // jQuery('#result').append(html);
    }

}

// function createMarker(id, store) {
//     var latlng = new google.maps.LatLng(
//         parseFloat(store['lat']),
//         parseFloat(store['lng'])
//     );
//     var html = "<b>" + store['name'] + "</b> <br>" + "<b>" +
//             store['address'] + "</b>";
//     var marker = new google.maps.Marker({
//         map: map,
//         position: latlng
//     });
//     google.maps.event.addListener(marker, 'click', function() {
//         infoWindow.setContent(html);
//         infoWindow.open(map, marker);
//     });
//     markers[id] = marker;

//     var item = '<li class="panel-item" store-id="' + id + '"><a href=\"#result\"> <b>' +
//             store['address'] + '</b></a> </li>';

//     jQuery('#map-panel').append(item);
// }
