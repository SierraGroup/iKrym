<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'cafe' => 'Cafe\Controller\CafeController',


        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'cafes' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/cafes',

                    'defaults' => array(
                        'controller' => 'cafe',
                        'action'     => 'index',
                    ),
                ),
            ),
            'cafe' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/cafe[/:cafe_id_name]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'cafe_id_name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'cafe',
                        'action'     => 'cafe',
                    ),
                ),
            ),

        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'cafe' => __DIR__ . '/../view',
        ),
    ),

);