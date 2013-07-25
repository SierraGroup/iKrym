<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'restaurant' => 'Restaurant\Controller\RestaurantController',

        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'restaurants' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/restaurants',

                    'defaults' => array(
                        'controller' => 'restaurant',
                        'action'     => 'index',
                    ),
                ),
            ),
            'restaurant' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/restaurant[/:restaurant_id_name]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'restaurant_id_name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'restaurant',
                        'action'     => 'restaurant',
                    ),
                ),
            ),
            'menu' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/restaurant/menu[/:restaurant_id_name]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'restaurant_id_name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'restaurant',
                        'action'     => 'restaurant_menu',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_map'             => array(
            'restaurant/restaurant/index' => __DIR__ . '/../view/restaurant/restaurant/index.phtml',
            'restaurant/restaurant/block/navigation_restaurant' => __DIR__ . '/../view/restaurant/restaurant/block/navigation_restaurant.phtml',
            'restaurant/restaurant/block/reserve_table' => __DIR__ . '/../view/restaurant/restaurant/block/reserve_table.phtml',
            'restaurant/restaurant/block/detailed_information' => __DIR__ . '/../view/restaurant/restaurant/block/detailed_information.phtml',
            'restaurant/restaurant/block/show_route' => __DIR__ . '/../view/restaurant/restaurant/block/show_route.phtml',
            'restaurant/restaurant/restaurant' => __DIR__ . '/../view/restaurant/restaurant/restaurant.phtml',



        ),
        'template_path_stack' => array(
            'restaurant' => __DIR__ . '/../view',
        ),
    ),
);