<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'salon_client' => 'Salon\Controller\SalonController',

        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'salons' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/salons',

                    'defaults' => array(
                        'controller' => 'salon_client',
                        'action'     => 'index',
                    ),
                ),
            ),
            'salon' => array(
                     'type' => 'literal',
                     'options' => array(
                           'route' => '/salon',

                    'defaults' => array(
                        'controller' => 'salon_client',
                        'action' => 'salon_client',
                    ),
                    'may_terminate' => true,
                    'child_routes' => array(
                            'add' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '/salon/add'
                                ),

                                'defaults' => array(
                                    'controller' => 'salon_client',
                                    'action' => 'salon_add',
                                ),

                            ),
                        'edit' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route' => '/salon/edit[:/salon_id_name]'
                            ),
                            'constraints' => array(
                                'salon_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),

                            'defaults' => array(
                                'controller' => 'salon_client',
                                'action' => 'salon_add',
                            ),

                        ),
                        'delete' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route' => '/salon/delete[:/salon_id_name]'
                            ),
                            'constraints' => array(
                                'salon_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),

                            'defaults' => array(
                                'controller' => 'salon_client',
                                'action' => 'salon_delete',
                            ),

                        ),
                    ),
             ),
          ),


        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'salon' => __DIR__ . '/../view',

        ),
    ),
);