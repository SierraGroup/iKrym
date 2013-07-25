
<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Transport' => 'Timetable\Controller\TransportController',
//            'Minibus' => 'Timetable\Controller\TransportRoadMinibusController',
//
        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'transport' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/transport',
                    'defaults' => array(
                        'controller' => 'Transport',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'minibus' => array(
                        'type'    => 'literal',
                        'options' => array(
                            'route'    => '/minibus',
                            'defaults' => array(
                                'controller' => 'Transport',
                                'action'     => 'minibus',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'minibus_shedule' => array(
                                    'type'    => 'literal',
                                    'options' => array(
                                        'route'    => '/minibus_shedule',
                                        'defaults' => array(
                                            'controller' => 'Transport',
                                            'action'     => 'minibus_shedule',
                                        ),
                                    ),
                            ),
                        ),
                ),

            ),
        ),
    ),
),
    'view_manager' => array(
        'template_path_stack' => array(
            'minibus' => __DIR__ . '/../view',
            'timetable' => __DIR__ .'/../view'

        ),
    ),
);