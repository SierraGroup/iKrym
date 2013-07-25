<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'private_sector_client' => 'Activity\Controller\ActivityController',

        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'private_sectors' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/private_sectors',
                    'defaults' => array(
                        'controller' => 'private_sector_client',
                        'action'     => 'index',
                    ),
                ),
            ),
            'private_sector' => array(
                     'type' => 'segment',
                     'options' => array(
                           'route' => '/private_sector[/:private_sector_id_name]',
                    'constraints' => array(
                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'private_sector_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'

                     ),
                    'defaults' => array(
                        'controller' => 'private_sector_client',
                        'action' => 'private_sector_client',
                    ),
                    'may_terminate' => true,
                    'child_routes' => array(
                            'poster' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '/private_sector/poster[/:private_sector_id_name]'
                                ),
                                'constraints' => array(
                                    'private_sector_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'
                                ),
                                'defaults' => array(
                                    'controller' => 'private_sector_client',
                                    'action' => 'private_sector_poster',
                                ),

                            ),
                    ),
             ),
          ),
            'poster' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/private_sector/poster[/:private_sector_id_name]',
                    'constraints' => array(
                        'private_sector_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'private_sector_client',
                        'action' => 'private_sector_poster',
                    ),
                ),
            ),
            'photoreport' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/private_sector/photoreport[/:private_sector_id_name]',
                    'constraints' => array(
                        'private_sector_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'private_sector_client',
                        'action' => 'private_sector_photoreport',
                    ),
                ),
            ),

        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'private_sector' => __DIR__ . '/../view',

        ),
    ),
);