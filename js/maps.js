/*-----------------------------------------------------------------------*/
    /*!
     * classie - class helper functions
     * from bonzo https://github.com/ded/bonzo
     *
     */

    /*jshint browser: true, strict: true, undef: true */
    /*global define: false */

( function( window ) {

    'use strict';

// class helper functions from bonzo https://github.com/ded/bonzo

    function classReg( className ) {
        return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
    }

// classList support for class management
// altho to be fair, the api sucks because it won't accept multiple classes at once
    var hasClass, addClass, removeClass;

    if ( 'classList' in document.documentElement ) {
        hasClass = function( elem, c ) {
            return elem.classList.contains( c );
        };
        addClass = function( elem, c ) {
            elem.classList.add( c );
        };
        removeClass = function( elem, c ) {
            elem.classList.remove( c );
        };
    }
    else {
        hasClass = function( elem, c ) {
            return classReg( c ).test( elem.className );
        };
        addClass = function( elem, c ) {
            if ( !hasClass( elem, c ) ) {
                elem.className = elem.className + ' ' + c;
            }
        };
        removeClass = function( elem, c ) {
            elem.className = elem.className.replace( classReg( c ), ' ' );
        };
    }

    function toggleClass( elem, c ) {
        var fn = hasClass( elem, c ) ? removeClass : addClass;
        fn( elem, c );
    }

    var classie = {
        // full names
        hasClass: hasClass,
        addClass: addClass,
        removeClass: removeClass,
        toggleClass: toggleClass,
        // short names
        has: hasClass,
        add: addClass,
        remove: removeClass,
        toggle: toggleClass
    };

// transport
    if ( typeof define === 'function' && define.amd ) {
        // AMD
        define( classie );
    } else {
        // browser global
        window.classie = classie;
    }

})( window );

//rng-group.ru/geo.class.js а что было делать,нужно сдать же все в сроки(
var Geo = {
    map:false,
    getPositionCallbackFunctions: [], // Служебная переменная: массив callback-функций для запроса позиции
    needReload:true,
    userLatitude: false,
    userLongitude:false,
    geolocationOptions:{
        enableHighAccuracy:false,//режим получения наиболее точных данных
        timeout:10000,          //максимальное время ожидания ответа
        maximumAge:10000        //максимальное время жизни полученных данных
    },
    cookiesExpiresTime:3600,//время жизни кукисов в секундах
    cookiesDomain:false,
    geocoder:false,


    getPosition:function(){
        var callback,options;
//            if(typeof(arguments[1] != "object")){
//                options = {};
//            }
        if(arguments[1]){
            options = arguments[1];
        }
        //else options = arguments[1];
        if(options.update == null) options.update = false;
        if(options.manual == null) options.manual = false;

        if(typeof(arguments[0]) == "function"){
            var callback = arguments[0];
            this.getPositionCallbackFunctions.push(callback);
        }
        if(this.getCookie('userLatitude') != null && this.getCookie('userLongitude') && options.update === false){
            var position = {coords: {latitude: parseFloat(this.getCookie('userLatitude')), longitude: parseFloat(this.getCookie('userLongitude'))}};
            // this.console('Позиция загружена из кукисов.');
            Geo.positionCallback(position);
            //  return;
        }
        if(options.noreload){
            this.needReload = false;
        }
        if(options.manual){
            this.getManualPosition();
            return;
        }
        if(navigator.geolocation && options.manual === false){

            //https://developer.mozilla.org/en-US/docs/Web/API/window.navigator.geolocation.getCurrentPosition
            //navigator.geolocation.getCurrentPosition(success, error, options)
            navigator.geolocation.getCurrentPosition(
                //обработка координат

                //A callback function that takes a Position object as its sole input parameter.
                function(position){
                    Geo.positionCallback(position);
                },
                //обработка ошибок
                function(){

                },
                //Настройки определения местоположения
                this.geolocationOptions
            );
        }else{

        }
        //получение местонахождения
    },
    positionCallback:function(position){
        this.userLatitude = position.coords.latitude;
        this.userLongitude = position.coords.longitude;

        //cоздаем куки
        this.setCookie('userLatitude',this.userLatitude,"/",this.getCookieDomain());
        this.setCookie('userLongitude',this.userLongitude,"/",this.getCookieDomain());
        Geo.getAddress();


    },
    setCookie:function(name,value,path,domain,secure){
        var d = new Date();

        d.setSeconds(this.cookiesExpiresTime);
        expires = d.toUTCString();
        document.cookie = name + "=" + escape(value) +
            ((expires)?"; expires="+expires:"") +
            ((path)?"; path="+path:"")+
            ((domain)?"; domain="+domain:"")+
            ((secure)?"; secure" : "");
    },
    getCookie:function(name){
        var cookie = " " + document.cookie;
        var search = " " + name + "=";
        var setStr = null;
        var offset = 0;
        var end = 0;
        if(cookie.length > 0){
            offset = cookie.indexOf(search);
            if(offset != -1){
                offset += search.length;
                end = cookie.indexOf(";", offset)
                if(end == -1)
                    end = cookie.length;
                setStr = unescape(cookie.substring(offset, end));
            }
        }
        return(setStr);

    },
    getCookieDomain:function(){
        if(!this.cookieDomain){
            var domain = document.location.host;
            if(/^[0-9]{2,}\.[0-9]{1,}\.[0-9]{1,}\.[0-9]{1,}$/i.test(domain))
                return domain;
            if(/^www./i.test(domain))
                this.cookiesDomain = domain.replace(/^www./, '');
            else this.cookiesDomain = domain;
        }
        return this.cookiesDomain;
    },
    getGeocoder:function(){
        if(!this.geocoder){
            this.geocoder = new google.maps.Geocoder();
        }
    },
    getAddress: function(){
            var myLatLng = new google.maps.LatLng(Geo.getCookie("userLatitude"),Geo.getCookie("userLongitude"));//Geo.getLatLng(Geo.getCookie("userLatitude"),Geo.getCookie("userLongitude"));
            Geo.getAddressByCoordinates(
            myLatLng,
            function(address){
                $('#location').html("");
                $('#location').html(address);

            },
            function(){
                //$('#i-do-not-know-where-you-are').show();
            }
        );
    },
//получаем адрес по координатам
    getAddressByCoordinates: function(latlng, callback, error_callback){

        this.geocoder = new google.maps.Geocoder();
        this.geocoder.geocode({location: latlng}, function(results, status){
            if(status != google.maps.GeocoderStatus.OK){
                error_callback();
            }else{
                callback(results[0].formatted_address);
            }
        });


    },
    showRoute:function(lat,log){
        $('#map-modal').modal('show');

    }


};


function showRoute(lat, lng){
    Geo.console('Call function showRoute.');
    Geo.setRoute({destination:{lat: lat, lng: lng}});
    $('#map-modal').modal('show');
    $('#route-map-button').addClass('active');
    if(typeof(arguments[2]) == "object"){
        var obj = arguments[2];
        var distance = $(obj).parent().find("span.distance").html();
        if(distance)
            $('#modal-distance').html(distance);
    }
}

//http://datatables.net/media/blog/bootstrap_2/DT_bootstrap.js
/* Bootstrap style pagination control */

function distance(latitude,longitude){

    //Cпасибо stackoverflow,там было множество методов я выбрал этот
    //http://stackoverflow.com/questions/1502590/calculate-distance-between-two-points-in-google-maps-v3

    google.maps.LatLng.prototype.distanceFrom = function() {
        var lat = [Geo.getCookie("userLatitude"), latitude];
        var lng = [Geo.getCookie("userLongitude"), longitude];
        var R = 6378137;
        var dLat = (lat[1]-lat[0]) * Math.PI / 180;
        var dLng = (lng[1]-lng[0]) * Math.PI / 180;
        var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(lat[0] * Math.PI / 180 ) * Math.cos(lat[1] * Math.PI / 180 ) *
                Math.sin(dLng/2) * Math.sin(dLng/2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        var d = R * c;
        return Math.round(d);
    };



    var loc1 = new google.maps.LatLng(latitude, longitude);
    var loc2 =  new google.maps.LatLng(Geo.getCookie("userLatitude"),Geo.getCookie("userLongitude"));
    var dist = loc2.distanceFrom(loc1);
    var total_distance = dist/1000;
    return total_distance;

}
var Category = {

        attraction_coordinate_url: "http://s-group.in.ua/yalta/json/get/attraction/attraction_coordinates.php",
        restaurant_coordinate_url: "http://s-group.in.ua/yalta/json/get/restaurant/restaurant_coordinates.php",
        attraction_icon : 'http://google-maps-icons.googlecode.com/files/castle.png',
        restaurant_icon : 'http://google-maps-icons.googlecode.com/files/restaurantgourmet.png',
        markersLatLng : [],


        getCategoryCoordinates:function(category){
            switch(category){
                case 0: Category.getCategoryCoordinatesData(0);break;
                case 1: Category.getCategoryCoordinatesData(1);break;
            }
        },

        getCategoryCoordinatesData:function(category){
            if(category == 0){
                $.ajaxSetup({
                    url:Category.attraction_coordinate_url
                });
            }
            if(category == 1){
                $.ajaxSetup({
                    url:Category.restaurant_coordinate_url
                });
            }
            $.ajax({
                type:"GET",
                success:function(result){
                    json = $.parseJSON(result);
                    var center = new google.maps.LatLng(44.5018580,34.1627300);
                    var mapOptions = {zoom: 12,center: center, mapTypeId: google.maps.MapTypeId.ROADMAP};
                    var map = new google.maps.Map(document.getElementById('map'), mapOptions);
                    var markerLatLng , marker;
                    var directionsDisplay;
                    var directionsService  = new google.maps.DirectionsService();
                    directionsDisplay = new google.maps.DirectionsRenderer();
                    directionsDisplay.setMap(map);
                    var  markersLatLng = [];
                    $.each(json,function(i){

                        if(category == 0){
                             markerLatLng = new google.maps.LatLng(json[i].attraction_latitude,json[i].attraction_longitude);
                             marker = new google.maps.Marker({url:Category.attraction_coordinate_url
                                + json[i].id_name, position:markerLatLng,map:map, title:json[i].attraction_id_name,
                                icon:Category.attraction_icon,
                                animation: google.maps.Animation.DROP
                            });
                            Category.markersLatLng.push(markerLatLng);

                        }
                        if(category == 1){
                             console.log(json[i]);
                             markerLatLng = new google.maps.LatLng(json[i].restaurant_latitude,json[i].restaurant_longitude);
                             marker = new google.maps.Marker({url:Category.restaurant_coordinate_url
                                + json[i].restaurant_id_name, position:markerLatLng,map:map, title:json[i].restaurant_id_name,
                                icon:Category.restaurant_icon,
                                animation: google.maps.Animation.DROP
                            });
                            Category.markersLatLng.push(markerLatLng);
                        }
                    });
                }});
            }

};

/*------------------------------S.T.A.R.T--------------------------------*/
    $(document).ready(function(){
        $('.filter').hover(function() {
            $(this).find('.dropdown-menu').css({
                visibility: "visible",
                display: "none"
            }).slideDown(400);
        }, function() {
            $(this).find('.dropdown-menu').css({
                visibility: "visible",
                display: "block"
            }).slideUp('fast');
        });
        $('#acHead11').bind('click',function(){
            Category.getCategoryCoordinates(0);
        });
        $('#acHead12').bind('click',function(){
            Category.getCategoryCoordinates(1);
        });
        var user = $('.right-side').find('h3').find('a').eq(0).html();
        $('#favorite_id_name').attr('value',user);

        if(document.location.href == "http://s-group.in.ua/yalta/attractions"){
            $.ajax({
                type:"GET",
                url:Category.attraction_coordinate_url,
                success:function(result){
                    json = $.parseJSON(result);
                    $.each(json,function(i){
                        console.log(distance(json[i].attraction_latitude,json[i].attraction_longitude));
                        var dist = distance(json[i].attraction_latitude,json[i].attraction_longitude);

                        $('.distance').eq(i).html(dist + " км");
                        $('.table-row').eq(i).attr('data-distance',dist);
                        $('.table-row-star').eq(i).raty();
                    });
                }
            });
        }
        function add_to_favorites(form){

            var url_form = $(form).attr('action');
            var data_form = $(form).serializeArray();

            $.ajax({
                url:url_form,
                data:data_form,
                dataType:"json",
                success:function(){



                }
            })
        }

        for( i = 0; i< $('.dropdown-menu').length; i++){
            $('.dropdown-menu').eq(i).find('li').eq(4).magnificPopup({
                type:'inline',
                fixedContentPos:false,
                fixedBgPos:true,
                overflowY:'auto',
                mainClass:'my-mfp-zoom-in',
                removeDelay:400,
                midClic:true
            });
        }

    });












