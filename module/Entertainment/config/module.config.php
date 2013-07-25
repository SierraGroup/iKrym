<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'entertainment' => 'Entertainment\Controller\EntertainmentController',

        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'entertainments' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/entertainments',

                    'defaults' => array(
                        'controller' => 'entertainment',
                        'action'     => 'index',
                    ),
                ),
            ),
            'entertainment' => array(
                     'type' => 'segment',
                     'options' => array(
                           'route' => '/entertainment[/:entertainment_id_name]',
                    'constraints' => array(
                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'entertainment_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'

                     ),
                    'defaults' => array(
                        'controller' => 'entertainment',
                        'action' => 'entertainment_client',
                    ),
                    'may_terminate' => true,
                    'child_routes' => array(
                            'poster' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '/entertainment/poster[/:entertainment_id_name]'
                                ),
                                'constraints' => array(
                                    'entertainment_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'
                                ),
                                'defaults' => array(
                                    'controller' => 'entertainment',
                                    'action' => 'entertainment_poster',
                                ),

                            ),
                    ),
             ),
          ),
            'poster' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/entertainment/poster[/:entertainment_id_name]',
                    'constraints' => array(
                        'entertainment_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'entertainment',
                        'action' => 'entertainment_poster',
                    ),
                ),
            ),
            'photoreport' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/entertainment/photoreport[/:entertainment_id_name]',
                    'constraints' => array(
                        'entertainment_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'entertainment',
                        'action' => 'entertainment_photoreport',
                    ),
                ),
            ),

        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'entertainment' => __DIR__ . '/../view',

        ),
    ),
);