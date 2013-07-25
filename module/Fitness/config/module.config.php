<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'fitness_client' => 'Fitness\Controller\FitnessController',

        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'fitnesses' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/fitnesses',

                    'defaults' => array(
                        'controller' => 'fitness_client',
                        'action'     => 'index',
                    ),
                ),
            ),
            'fitness' => array(
                     'type' => 'literal',
                     'options' => array(
                           'route' => '/fitness',

                    'defaults' => array(
                        'controller' => 'fitness_client',
                        'action' => 'fitness_client',
                    ),
                    'may_terminate' => true,
                    'child_routes' => array(
                            'add' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '/fitness/add'
                                ),

                                'defaults' => array(
                                    'controller' => 'fitness_client',
                                    'action' => 'fitness_add',
                                ),

                            ),
                        'edit' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route' => '/fitness/edit[:/fitness_id_name]'
                            ),
                            'constraints' => array(
                                'fitness_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),

                            'defaults' => array(
                                'controller' => 'fitness_client',
                                'action' => 'fitness_add',
                            ),

                        ),
                        'delete' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route' => '/fitness/delete[:/fitness_id_name]'
                            ),
                            'constraints' => array(
                                'fitness_id_name' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),

                            'defaults' => array(
                                'controller' => 'fitness_client',
                                'action' => 'fitness_delete',
                            ),

                        ),
                    ),
             ),
          ),


        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'fitness' => __DIR__ . '/../view',

        ),
    ),
);