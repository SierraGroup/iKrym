<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'hostel' => 'Hostel\Controller\HostelController',

        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'hostels' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/hostels',

                    'defaults' => array(
                        'controller' => 'hostel',
                        'action'     => 'index',
                    ),
                ),
            ),
            'hostel' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/hostel[/:hostel_id_name]',
                    'constraints' => array(
                        'hostel_id_name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'hostel',
                        'action'     => 'hostel',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'hostel' => __DIR__ . '/../view',
        ),
    ),
);