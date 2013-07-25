<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'attraction' => 'Attraction\Controller\AttractionController',

        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'attractions' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/attractions',

                    'defaults' => array(
                        'controller' => 'attraction',
                        'action'     => 'index',
                    ),
                ),
            ),
            'attraction' => array(
                     'type' => 'segment',
                     'options' => array(
                           'route' => '/attraction[/:attraction_id_name]',
                    'constraints' => array(

                            'attraction_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'

                     ),
                    'defaults' => array(
                        'controller' => 'attraction',
                        'action' => 'attraction_client',
                    ),
                    'may_terminate' => true,
                    'child_routes' => array(
                            'poster' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '/attraction/poster[/:attraction_id_name]'
                                ),
                                'constraints' => array(
                                    'attraction_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'
                                ),
                                'defaults' => array(
                                    'controller' => 'attraction',
                                    'action' => 'attraction_poster',
                                ),

                            ),
                    ),
             ),
          ),
            'poster' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/attraction/poster[/:attraction_id_name]',
                    'constraints' => array(
                        'attraction_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'attraction',
                        'action' => 'attraction_poster',
                    ),
                ),
            ),
            'photoreport' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/attraction/photoreport[/:attraction_id_name]',
                    'constraints' => array(
                        'attraction_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'attraction',
                        'action' => 'attraction_photoreport',
                    ),
                ),
            ),

        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'attraction' => __DIR__ . '/../view',

        ),
    ),
);