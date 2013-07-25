<?php

namespace GoogleMaps\Service;

/**
 * GMaps\Service\GoogleMap
 *
 * Zend Framework2 Google Map Class  (Google Maps API v3)
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * This class enables the creation of google maps
 *
 * @package		Zend Framework 2
 * @author		Ramkumar
 */

class GoogleMap {

    var $api_key = '';
    var $sensor = 'false';
    var $div_id = '';
    var $div_class = '';
    var $zoom = 10;
    var $lat = -300;
    var $lon = 300;
    var $markers = array();

    //-----------------------------------------style properties-------------------------------------------------------//
    var $height = "100px";
    var $width = "100px";
    var $left = "0%";
    var $right = "10%";
    var $margin_top = "-30%";
    var $boxshadow = "1px 1px 20px #000";

    var $animation = '';
    var $icon = '';
    var $icons = array();

    /**
     * Constructor
     */
    function __construct($api_key) {
        $this->api_key = $api_key;
    }

    // --------------------------------------------------------------------

    /**
     * Initialize the user preferences
     *
     * Accepts an associative array as input, containing display preferences
     *
     * @access	public
     * @param	array	config preferences
     * @return	void
     */
    function initialize($config = array()) {
        foreach ($config as $key => $val) {
            if (isset($this->$key)) {
                $this->$key = $val;
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * Generate the google map
     *
     * @access	public
     * @return	string
     */
    function generate() {

        $out = '';

        $out .= '	<div id="' . $this->div_id . '" class="' . $this->div_class . '" style="height:' . $this->height . ';margin-top:'. $this->margin_top .';width:' . $this->width . ';right:' . $this->right . ';box-shadow:'.$this->boxshadow.';"></div>';

        $out .= '	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=' . $this->api_key . '&sensor=' . $this->sensor . '"></script>';

        $out .= '  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&v=3&libraries=geometry"></script>';
        $out .= '	<script type="text/javascript">

                        function distance(){

                                                 //Cпасибо stackoverflow,там было множество методов я выбрал этот
                                                 //http://stackoverflow.com/questions/1502590/calculate-distance-between-two-points-in-google-maps-v3

                                                        google.maps.LatLng.prototype.distanceFrom = function(latlng) {
                                                                  var lat = [this.lat(), latlng.lat()]
                                                                  var lng = [this.lng(), latlng.lng()]
                                                                  var R = 6378137;
                                                                  var dLat = (lat[1]-lat[0]) * Math.PI / 180;
                                                                  var dLng = (lng[1]-lng[0]) * Math.PI / 180;
                                                                  var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                                                                  Math.cos(lat[0] * Math.PI / 180 ) * Math.cos(lat[1] * Math.PI / 180 ) *
                                                                  Math.sin(dLng/2) * Math.sin(dLng/2);
                                                                  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
                                                                  var d = R * c;
                                                                  return Math.round(d);
                                                          }

                                                            var loc1 = new google.maps.LatLng(' . $this->lat . ',' . $this->lon . ');
                                                            var loc2 =  new google.maps.LatLng(Geo.getCookie("userLatitude"),Geo.getCookie("userLongitude"));
                                                            var dist = loc2.distanceFrom(loc1);
                                                            var total_distance = dist/1000;
                                                            $(".distance").text(total_distance);
                                                          //  var distance  = new google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(' . $this->lat . ',' . $this->lon . '),new google.maps.LatLng(Geo.getCookie("userLatitude"),Geo.getCookie("userLongitude")));

                        }

						function doAnimation()
						{
							if (marker.getAnimation() != null)
							{
								marker.setAnimation(null);
							}
							else
							{
								marker.setAnimation(google.maps.Animation.' . $this->animation . ');
							}
						}
						function initializeUser(){
                                  var myLatlng = new google.maps.LatLng(Geo.getCookie("userLatitude"),Geo.getCookie("userLongitude"));
                                  //https://developers.google.com/maps/documentation/geocoding/#ReverseGeocoding
                                  Geo.getAddress();
						}

						 function codeAddress() {
                                          var address = document.getElementById("address").value;
                                          geocoder.geocode( { "address": address}, function(results, status) {
                                            if (status == google.maps.GeocoderStatus.OK) {
                                              map.setCenter(results[0].geometry.location);
                                              var marker = new google.maps.Marker({
                                                  map: map,
                                                  position: results[0].geometry.location
                                              });
                                            } else {
                                              alert("Geocode was not successful for the following reason: "+ status);
                                            }
                                          });
                          }


    					function initialize()
    					{

                               var myOptions = {
                                            center: new google.maps.LatLng(' . $this->lat . ',' . $this->lon . '),
                                            myLatlng : new google.maps.LatLng(Geo.getCookie("userLatitude"),Geo.getCookie("userLongitude")),
                                            Zoom:' . $this->zoom . ',
                                            mapTypeId: google.maps.MapTypeId.ROADMAP,

                                        };
                                 //указываем растояние между текущим положением пользователя и положением нашего обьекта
                                 if(myOptions.center){
                                    distance();
                                 }


							';



        $out .= '			var map = new google.maps.Map(document.getElementById("' . $this->div_id . '"), myOptions);';

        $i = 0;
        foreach ($this->markers as $key => $value) {
            $out .="var marker" . $i . " = new google.maps.Marker({
									 												position: new google.maps.LatLng(" . $value . "),
									 												map: map,";
            if ($this->animation != '') {
                $out .="animation: google.maps.Animation." . $this->animation . ",";
            }
            if ($this->icon != '') {
                $out .="icon:'" . $this->icon . "',";
            } elseif (count($this->icons) > 0) {
                $out .="icon:'" . $this->icons[$i] . "',";
            }
            $out .="title:'" . $key . "'});";
            if ($this->animation != '') {
                $out .="google.maps.event.addListener(marker" . $i . ", 'click', doAnimation);";
            }

            $i++;
        }

        $out .= '		}



                        if(document.location.href !== "http://s-group.in.ua/public/yalta"){
						    initialize();
						}



					</script>';

        return $out;
    }

}