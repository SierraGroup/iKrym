<?php
            //configuration
    return array(
        //first section
        'controllers' => array(
            'invokables' => array(
                'GoogleMaps\Controller\GoogleMaps' => 'GoogleMaps\Controller\GoogleMapsController',
            ),
        ),
        'router' => array(
            'routes' => array(
                'maps' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route' => '/googlemaps',
                        'defaults' => array(
                            'controller' => 'GoogleMaps\Controller\GoogleMaps',
                            'action' => 'index',
                        ),
                    ),
                ),
            ),
        ),
        //second section
        'view_manager' => array(
            'template_path_stack' => array(
                'googlemaps' => __DIR__ .'/../view',
             ),
        ),
        'GoogleMaps' => array(
            'api_key' => 'AIzaSyDEVzUFc4ZibvdHfVMUiBzZUNqXQZgapuQ',
        ),
     );