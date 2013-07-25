<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'activity_client' => 'Activity\Controller\ActivityController',

        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'activities' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/activities',
                    'defaults' => array(
                        'controller' => 'activity_client',
                        'action'     => 'index',
                    ),
                ),
            ),
            'activity' => array(
                     'type' => 'segment',
                     'options' => array(
                           'route' => '/activity[/:activity_id_name]',
                    'constraints' => array(
                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'activity_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'

                     ),
                    'defaults' => array(
                        'controller' => 'activity_client',
                        'action' => 'activity_client',
                    ),
                    'may_terminate' => true,
                    'child_routes' => array(
                            'poster' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '/activity/poster[/:activity_id_name]'
                                ),
                                'constraints' => array(
                                    'activity_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'
                                ),
                                'defaults' => array(
                                    'controller' => 'activity_client',
                                    'action' => 'activity_poster',
                                ),

                            ),
                    ),
             ),
          ),
            'poster' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/activity/poster[/:activity_id_name]',
                    'constraints' => array(
                        'activity_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'activity_client',
                        'action' => 'activity_poster',
                    ),
                ),
            ),
            'photoreport' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/activity/photoreport[/:activity_id_name]',
                    'constraints' => array(
                        'activity_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'activity_client',
                        'action' => 'activity_photoreport',
                    ),
                ),
            ),

        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'activity' => __DIR__ . '/../view',

        ),
    ),
);