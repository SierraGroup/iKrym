<?php
    return array(
        'controller' => array(
            'invokables' => array(
                'admin' => 'Admin\Controller\AdminController',
            ),
        ),
        'service_manager' => array(
            'aliases' => array(
                'admin_adapter' => 'Zend\Db\Adapter\Adapter'
            ),
        ),
        'router' => array(
            'routes' => array(
                'admin' => array(
                    'type' => 'Literal',
                    'priority' => 1000,
                    'options' => array(
                        'route' => '/administrator',
                        'defaults' => array(
                            'controller' => 'admin',
                            'action'     => 'index',
                        ),
                    ),
                    'may_terminate' => true,
                    'child_routes' => array(
                        'login' => array(
                            'type' => 'Literal',
                            'options' => array(
                                'route' => '/login',
                                'defaults' => array(
                                    'controller' => 'admin',
                                    'action'     => 'login',
                                ),
                            ),
                        ),
                        'authenticate' => array(
                            'type' => 'Literal',
                            'options' => array(
                                'route' => '/authenticate',
                                'defaults' => array(
                                    'controller' => 'admin',
                                    'action'     => 'authenticate',
                                ),
                            ),
                        ),
                        'logout' => array(
                            'type' => 'Literal',
                            'options' => array(
                                'route' => '/logout',
                                'defaults' => array(
                                    'controller' => 'admin',
                                    'action'     => 'logout',
                                ),
                            ),
                        ),
                        'register' => array(
                            'type' => 'Literal',
                            'options' => array(
                                'route' => '/register',
                                'defaults' => array(
                                    'controller' => 'admin',
                                    'action'     => 'register',
                                ),
                            ),
                        ),
                        'changepassword' => array(
                            'type' => 'Literal',
                            'options' => array(
                                'route' => '/change-password',
                                'defaults' => array(
                                    'controller' => 'admin',
                                    'action'     => 'changepassword',
                                ),
                            ),
                        ),
                        'changeemail' => array(
                            'type' => 'Literal',
                            'options' => array(
                                'route' => '/change-email',
                                'defaults' => array(
                                    'controller' => 'admin',
                                    'action' => 'changeemail',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'view_manager' => array(
            'template_path_stack' => array(
                'admin' => __DIR__ .'/../view',
            ),
        ),

    );