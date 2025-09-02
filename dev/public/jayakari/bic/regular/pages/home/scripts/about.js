var ContactUs = function () {

    return {
        //main function to initiate the module
        init: function () {
            var map;
            $(document).ready(function(){
                map = new GMaps({
                    div: '#map',
                    lat: -6.17596,
                    lng: 106.87292,
                });
                var marker = map.addMarker({
                    lat: -6.17596,
                    lng: 106.87292,
                    title: 'BIC (Bussiness Innovation Center).',
                    infoWindow: {
                        content: "<b>BIC (Business Innovation Center).</b> PQM Building, Ground Floor<br>Cempaka Putih Tengah 17C no. 7a, Jakarta 10510, Indonesia."
                    }
                });

                marker.infoWindow.open(map, marker);
            });
        }
    };

}();