<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'club_client' => 'Club\Controller\ClubController',

        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'clubs' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/clubs',

                    'defaults' => array(
                        'controller' => 'club_client',
                        'action'     => 'club_client',
                    ),
                ),
            ),
            'club' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/club[/:club_id_name]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'club_id_name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'club_client',
                        'action'     => 'club',
                    ),
                ),
            ),

        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'club' => __DIR__ . '/../view',
        ),
    ),
);