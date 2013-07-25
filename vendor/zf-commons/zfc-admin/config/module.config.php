<?php
return array(
            'controllers' => array(
                        'invokables' => array(
                            'zfcadmin' => 'ZfcAdmin\Controller\AdminController',
                            'restaurant_admin' => 'ZfcAdmin\Controller\AdminRestaurantController',
                            'attraction_admin' => 'ZfcAdmin\Controller\AdminAttractionController',
                            'activity_admin' => 'ZfcAdmin\Controller\AdminActivityController',
                            'club_admin' => 'ZfcAdmin\Controller\AdminClubController',
                            'cafe_admin' => 'ZfcAdmin\Controller\AdminCafeController',
                            'entertainment_admin' => 'ZfcAdmin\Controller\AdminEntertainmentController',
                            'hostel_admin' => 'ZfcAdmin\Controller\AdminHostelController',
                            'fitness_admin' => 'ZfcAdmin\Controller\AdminFitnessController',
                            'salon_admin' => 'ZfcAdmin\Controller\AdminSalonController',

                            'Transport' => 'Timetable\Controller\TransportController',
                            'Upload' => 'ZfcAdmin\Controller\MyController',
                        ),
            ),
            'zfcadmin' => array(
                        'use_admin_layout'      => false,
                        'admin_layout_template' => 'layout/admin',
             ),

            'navigation' => array(
                    'admin' => array(),
            ),

'router' => array(
        'routes' => array(
            'zfcadmin' => array(
                        'type' => 'literal',
                                    'options' => array(
                                                'route'    => '/admin',
                                                'defaults' => array(
                                                        'controller' => 'zfcadmin',
                                                        'action'     => 'index',
                                                ),
                                    ),
                                   'may_terminate' => true,
                                    'child_routes' => array(
                                        'entertainments' => array(
                                            'type'    => 'literal',
                                            'options' => array(
                                                'route'    => '/entertainments',
                                                'defaults' => array(
                                                    'controller' => 'entertainment_admin',
                                                    'action'     => 'entertainment_admin',
                                                ),
                                            ),
                                            'may_terminate' => true,
                                            'child_routes'=> array(
                                                'add' => array(
                                                    'type'    => 'literal',
                                                    'options' => array(
                                                        'route'    => '/add',

                                                        'defaults' => array(
                                                            'controller' => 'entertainment_admin',
                                                            'action'     => 'entertainment_add',
                                                        ),
                                                    ),
                                                ),
                                                'delete' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                        'route'    => '/delete[/:entertainment_id]',
                                                        'constraints' => array(
                                                            'entertainment_id'     => '[0-9]+',
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'entertainment_admin',
                                                            'action'     => 'entertainment_delete',
                                                        ),
                                                    ),
                                                ),
                                                'edit' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                        'route'    => '/edit[/:entertainment_id_name]',
                                                        'constraints' => array(
                                                            'entertainment_id_name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'entertainment_admin',
                                                            'action'     => 'entertainment_edit',
                                                        ),
                                                    ),
                                                ),
                                            ),
                                        ),


                                        'cafes' => array(
                                            'type'    => 'literal',
                                            'options' => array(
                                                'route'    => '/cafes',
                                                'defaults' => array(
                                                    'controller' => 'cafe_admin',
                                                    'action'     => 'cafe_admin',
                                                ),
                                            ),
                                            'may_terminate' => true,
                                            'child_routes'=> array(
                                                'add' => array(
                                                    'type'    => 'literal',
                                                    'options' => array(
                                                        'route'    => '/add',

                                                        'defaults' => array(
                                                            'controller' => 'cafe_admin',
                                                            'action'     => 'cafe_add',
                                                        ),
                                                    ),
                                                ),
                                                'delete' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                        'route'    => '/delete[/:cafe_id]',
                                                        'constraints' => array(

                                                            'cafe_id'     => '[0-9]*',
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'cafe_admin',
                                                            'action'     => 'cafe_delete',
                                                        ),
                                                    ),
                                                ),
                                                'edit' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                        'route'    => '/edit[/:cafe_id_name]',
                                                        'constraints' => array(
                                                            'cafe_id_name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'cafe_admin',
                                                            'action'     => 'cafe_edit',
                                                        ),
                                                    ),
                                                ),
                                            ),
                                        ),

                                        'activities' => array(
                                            'type'    => 'literal',
                                            'options' => array(
                                                'route'    => '/activities',
                                                'defaults' => array(
                                                    'controller' => 'activity_admin',
                                                    'action'     => 'activity_admin',
                                                ),
                                            ),
                                            'may_terminate' => true,
                                            'child_routes'=> array(
                                                'add' => array(
                                                    'type'    => 'literal',
                                                    'options' => array(
                                                        'route'    => '/add',

                                                        'defaults' => array(
                                                            'controller' => 'activity_admin',
                                                            'action'     => 'activity_add',
                                                        ),
                                                    ),
                                                ),
                                                'delete' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                        'route'    => '/delete[/:activity_id]',
                                                        'constraints' => array(

                                                            'activity_id'     => '[0-9]*',
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'activity_admin',
                                                            'action'     => 'activity_delete',
                                                        ),
                                                    ),
                                                ),
                                                'edit' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                        'route'    => '/edit[/:activity_id_name]',
                                                        'constraints' => array(
                                                            'activity_id_name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'activity_admin',
                                                            'action'     => 'activity_edit',
                                                        ),
                                                    ),
                                                ),
                                                'news' => array(
                                                    'type'    => 'literal',
                                                    'options' => array(
                                                        'route'    => '/news',
                                                        'defaults' => array(
                                                            'controller' => 'activity_admin',
                                                            'action'     => 'activity_news',
                                                        ),
                                                    ),
                                                    'may_terminate' => true,
                                                    'child_routes'=> array(
                                                        'add' => array(
                                                            'type'    => 'segment',
                                                            'options' => array(
                                                                'route'    => '/add[/:activity_id_name]',
                                                                'constraints' => array(

                                                                    'activity_id_name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                ),
                                                                'defaults' => array(
                                                                    'controller' => 'activity_admin',
                                                                    'action'     => 'activity_news_add',
                                                                ),
                                                            ),
                                                        ),
                                                    ),
                                                ),
                                                'poster' => array(
                                                    'type'    => 'literal',
                                                    'options' => array(
                                                        'route'    => '/poster',
                                                        'defaults' => array(
                                                            'controller' => 'activity_admin',
                                                            'action'     => 'activity_poster',
                                                        ),
                                                    ),
                                                    'may_terminate' => true,
                                                    'child_routes'=> array(
                                                        'add' => array(
                                                            'type'    => 'segment',
                                                            'options' => array(
                                                                'route'    => '/add[/:activity_id_name]',
                                                                'constraints' => array(

                                                                    'activity_id_name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                ),
                                                                'defaults' => array(
                                                                    'controller' => 'activity_admin',
                                                                    'action'     => 'activity_poster_add',
                                                                ),
                                                            ),
                                                        ),
                                                    ),
                                                ),
                                            ),
                                        ),



                                                 'restaurants' => array(
                                                             'type'    => 'literal',
                                                             'options' => array(
                                                             'route'    => '/restaurants',
                                                             'defaults' => array(
                                                                    'controller' => 'restaurant_admin',
                                                                    'action'     => 'restaurant_admin',
                                                             ),
                                                         ),
                                                           'may_terminate' => true,
                                                           'child_routes' => array(
                                                                        'add' => array(
                                                                                'type' => 'literal',
                                                                                'options' => array(
                                                                                    'route'    => '/add',
                                                                                    'defaults' => array(
                                                                                        'controller' => 'restaurant_admin',
                                                                                        'action'     => 'restaurants_add',
                                                                                    ),
                                                                                ),
                                                                            ),
                                                                            'delete' => array(
                                                                                'type' => 'Segment',
                                                                                'options' => array(
                                                                                    'route'    => '/delete[/:restaurant_id]',
                                                                                    'constraints' => array(
                                                                                        'restaurant_id' => '[0-9]+',
                                                                                    ),
                                                                                    'defaults' => array(
                                                                                        'controller' => 'restaurant_admin',
                                                                                        'action'     => 'restaurants_delete',
                                                                                    ),
                                                                                ),
                                                                            ),
                                                                        'edit' => array(
                                                                            'type' => 'Segment',
                                                                            'options' => array(
                                                                                'route'    => '/edit[/:restaurant_id]',
                                                                                'constraints' => array(
                                                                                    'restaurant_id' => '[0-9]+',
                                                                                ),
                                                                                'defaults' => array(
                                                                                    'controller' => 'restaurant_admin',
                                                                                    'action'     => 'restaurants_edit',
                                                                                ),
                                                                            ),
                                                                        ),
                                                                        'news'=>array(
                                                                            'type' => 'literal',
                                                                            'options' => array(
                                                                                'route'    => '/news',

                                                                                'defaults' => array(
                                                                                    'controller' => 'restaurant_admin',
                                                                                    'action'     => 'restaurant_news',
                                                                                ),
                                                                            ),
                                                                            'may_terminate' => true,
                                                                            'child_routes' => array(
                                                                                'add' => array(
                                                                                    'type'    => 'Segment',
                                                                                    'options' => array(
                                                                                        'route'    => '/add[/:restaurant_id_name]',
                                                                                        'constraints' => array(
                                                                                            'restaurant_id_name'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                                        ),

                                                                                        'defaults' => array(
                                                                                            'controller' => 'restaurant_admin',
                                                                                            'action'     => 'restaurant_news_add',
                                                                                        ),
                                                                                    ),
                                                                                ),
                                                                            ),
                                                                        ),
                                                                        'menu'=>array(
                                                                            'type' => 'literal',
                                                                            'options' => array(
                                                                                'route'    => '/menu',

                                                                                'defaults' => array(
                                                                                    'controller' => 'restaurant_admin',
                                                                                    'action'     => 'restaurant_menu',
                                                                                ),
                                                                            ),
                                                                            'may_terminate' => true,
                                                                            'child_routes' => array(
                                                                                        'add' => array(
                                                                                            'type'    => 'Segment',
                                                                                            'options' => array(
                                                                                                'route'    => '/add[/:restaurant_id_name]',
                                                                                                'constraints' => array(
                                                                                                    'restaurant_id_name'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                                                ),

                                                                                                'defaults' => array(
                                                                                                    'controller' => 'restaurant_admin',
                                                                                                    'action'     => 'restaurant_menu_add',
                                                                                                ),
                                                                                            ),
                                                                                        ),
                                                                                   ),
                                                           ),

                                                         ),
                                                  ),

                                 'attractions' => array(
                                        'type'    => 'literal',
                                        'options' => array(
                                        'route'    => '/attractions',
                                        'defaults' => array(
                                                'controller' => 'attraction_admin',
                                                'action'     => 'attraction_admin',
                                             ),
                                          ),
                                          'may_terminate' => true,
                                          'child_routes'=> array(
                                              'add' => array(
                                                  'type'    => 'literal',
                                                  'options' => array(
                                                      'route'    => '/add',

                                                      'defaults' => array(
                                                          'controller' => 'attraction_admin',
                                                          'action'     => 'attraction_add',
                                                      ),
                                                  ),
                                              ),
                                              'delete' => array(
                                                  'type'    => 'segment',
                                                  'options' => array(
                                                      'route'    => '/delete[/:attraction_id]',
                                                      'constraints' => array(

                                                          'attraction_id'     => '[0-9]*',
                                                      ),
                                                      'defaults' => array(
                                                          'controller' => 'attraction_admin',
                                                          'action'     => 'attraction_delete',
                                                      ),
                                                  ),
                                              ),
                                              'edit' => array(
                                                  'type'    => 'segment',
                                                  'options' => array(
                                                      'route'    => '/edit[/:attraction_id_name]',
                                                      'constraints' => array(
                                                          'attraction_id_name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                      ),
                                                      'defaults' => array(
                                                          'controller' => 'attraction_admin',
                                                          'action'     => 'attraction_edit',
                                                      ),
                                                  ),
                                              ),
                                              'news' => array(
                                                  'type'    => 'literal',
                                                  'options' => array(
                                                      'route'    => '/news',
                                                      'defaults' => array(
                                                          'controller' => 'attraction_admin',
                                                          'action'     => 'attraction_news',
                                                      ),
                                                  ),
                                                      'may_terminate' => true,
                                                      'child_routes'=> array(
                                                          'add' => array(
                                                              'type'    => 'segment',
                                                              'options' => array(
                                                                  'route'    => '/add[/:attraction_id_name]',
                                                                  'constraints' => array(

                                                                      'attraction_id_name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                  ),
                                                                  'defaults' => array(
                                                                      'controller' => 'attraction_admin',
                                                                      'action'     => 'attraction_news_add',
                                                                  ),
                                                              ),
                                                          ),
                                                      ),
                                                  ),
                                              'poster' => array(
                                                  'type'    => 'literal',
                                                  'options' => array(
                                                      'route'    => '/poster',
                                                      'defaults' => array(
                                                          'controller' => 'attraction_admin',
                                                          'action'     => 'attraction_poster',
                                                      ),
                                                  ),
                                                  'may_terminate' => true,
                                                  'child_routes'=> array(
                                                      'add' => array(
                                                          'type'    => 'segment',
                                                          'options' => array(
                                                              'route'    => '/add[/:attraction_id_name]',
                                                              'constraints' => array(

                                                                  'attraction_id_name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                              ),
                                                              'defaults' => array(
                                                                  'controller' => 'attraction_admin',
                                                                  'action'     => 'attraction_poster_add',
                                                              ),
                                                          ),
                                                      ),
                                                  ),
                                              ),
                                              ),
                                     ),

                                                'clubs' => array(
                                                    'type'    => 'literal',
                                                    'options' => array(
                                                        'route'    => '/clubs',
                                                        'defaults' => array(
                                                            'controller' => 'club_admin',
                                                            'action'     => 'club_admin',
                                                        ),
                                                    ),
                                                    'may_terminate' => true,
                                                    'child_routes'=> array(
                                                        'add' => array(
                                                            'type'    => 'literal',
                                                            'options' => array(
                                                                'route'    => '/add',

                                                                'defaults' => array(
                                                                    'controller' => 'club_admin',
                                                                    'action'     => 'club_add',
                                                                ),
                                                            ),
                                                        ),
                                                        'edit' => array(
                                                            'type'    => 'segment',
                                                            'options' => array(
                                                                'route'    => '/edit[/:club_id_name]',
                                                                'constraints' => array(
                                                                    'club_id_name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                ),
                                                                'defaults' => array(
                                                                    'controller' => 'club_admin',
                                                                    'action'     => 'club_edit',
                                                                ),
                                                            ),
                                                        ),

                                                        'delete' => array(
                                                            'type'    => 'segment',
                                                            'options' => array(
                                                                'route'    => '/delete[/:club_id]',
                                                                'constraints' => array(
                                                                    'club_id'     => '[0-9]+',
                                                                ),
                                                                'defaults' => array(
                                                                    'controller' => 'club_admin',
                                                                    'action'     => 'club_delete',
                                                                ),
                                                            ),
                                                        ),
                                                        'news' => array(
                                                            'type'    => 'literal',
                                                            'options' => array(
                                                                'route'    => '/news',

                                                                'defaults' => array(
                                                                    'controller' => 'club_admin',
                                                                    'action'     => 'club_news',
                                                                ),
                                                            ),
                                                            'may_terminate' => true,
                                                            'child_routes'=> array(
                                                                'add' => array(
                                                                    'type'    => 'segment',
                                                                    'options' => array(
                                                                        'route'    => '/add[/:club_id_name]',
                                                                        'constraints' => array(
                                                                            'club_id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                        ),
                                                                        'defaults' => array(
                                                                            'controller' => 'club_admin',
                                                                            'action'     => 'club_news_add',
                                                                        ),
                                                                    ),
                                                                ),

                                                            ),
                                                        ),
                                                        'menu' => array(
                                                            'type'    => 'literal',
                                                            'options' => array(
                                                                'route'    => '/menu',

                                                                'defaults' => array(
                                                                    'controller' => 'club',
                                                                    'action'     => 'club_menu',
                                                                ),
                                                            ),
                                                            'may_terminate' => true,
                                                            'child_routes'=> array(
                                                                'add' => array(
                                                                    'type'    => 'segment',
                                                                    'options' => array(
                                                                        'route'    => '/add[/:club_id_name]',
                                                                        'constraints' => array(
                                                                            'club_id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                        ),
                                                                        'defaults' => array(
                                                                            'controller' => 'club',
                                                                            'action'     => 'club_menu_add',
                                                                        ),
                                                                    ),
                                                                ),

                                                            ),
                                                        ),
                                                        'poster' => array(
                                                            'type'    => 'literal',
                                                            'options' => array(
                                                                'route'    => '/poster',

                                                                'defaults' => array(
                                                                    'controller' => 'club',
                                                                    'action'     => 'club_poster',
                                                                ),
                                                            ),
                                                            'may_terminate' => true,
                                                            'child_routes'=> array(
                                                                'add' => array(
                                                                    'type'    => 'segment',
                                                                    'options' => array(
                                                                        'route'    => '/add[/:club_id_name]',
                                                                        'constraints' => array(
                                                                            'club_id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                        ),
                                                                        'defaults' => array(
                                                                            'controller' => 'club',
                                                                            'action'     => 'club_poster_add',
                                                                        ),
                                                                    ),
                                                                ),

                                                            ),
                                                        ),
                                                    ),
                                                ),
                                        'hostels' => array(
                                            'type'    => 'literal',
                                            'options' => array(
                                                'route'    => '/hostels',
                                                'defaults' => array(
                                                    'controller' => 'hostel_admin',
                                                    'action'     => 'hostel',
                                                ),
                                            ),
                                            'may_terminate' => true,
                                            'child_routes'=> array(
                                                'add' => array(
                                                    'type'    => 'literal',
                                                    'options' => array(
                                                        'route'    => '/add',

                                                        'defaults' => array(
                                                            'controller' => 'hostel_admin',
                                                            'action'     => 'hostel_add',
                                                        ),
                                                    ),
                                                ),
                                                'delete' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                        'route'    => '/delete[/:hostel_id]',
                                                        'constraints' => array(

                                                            'hostel_id'     => '[0-9]+',
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'hostel_admin',
                                                            'action'     => 'hostel_delete',
                                                        ),
                                                    ),
                                                ),
                                                'edit' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                        'route'    => '/edit[/:hostel_id_name]',
                                                        'constraints' => array(
                                                            'hostel_id_name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'hostel_admin',
                                                            'action'     => 'hostel_edit',
                                                        ),
                                                    ),
                                                ),
                                                'news' => array(
                                                    'type'    => 'literal',
                                                    'options' => array(
                                                        'route'    => '/news',
                                                        'defaults' => array(
                                                            'controller' => 'hostel_admin',
                                                            'action'     => 'hostel_news',
                                                        ),
                                                    ),
                                                    'may_terminate' => true,
                                                    'child_routes'=> array(
                                                        'add' => array(
                                                            'type'    => 'segment',
                                                            'options' => array(
                                                                'route'    => '/add[/:hostel_id_name]',
                                                                'constraints' => array(

                                                                    'hostel_id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                ),
                                                                'defaults' => array(
                                                                    'controller' => 'hostel_admin',
                                                                    'action'     => 'hostel_news_add',
                                                                ),
                                                            ),
                                                        ),
                                                    ),
                                                ),
                                                'poster' => array(
                                                    'type'    => 'literal',
                                                    'options' => array(
                                                        'route'    => '/poster',
                                                        'defaults' => array(
                                                            'controller' => 'hostel_admin',
                                                            'action'     => 'hostel_poster',
                                                        ),
                                                    ),
                                                    'may_terminate' => true,
                                                    'child_routes'=> array(
                                                        'add' => array(
                                                            'type'    => 'segment',
                                                            'options' => array(
                                                                'route'    => '/add[/:hostel_id_name]',
                                                                'constraints' => array(

                                                                    'hostel_id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                ),
                                                                'defaults' => array(
                                                                    'controller' => 'hostel_admin',
                                                                    'action'     => 'hostel_poster_add',
                                                                ),
                                                            ),
                                                        ),
                                                    ),
                                                ),
                                            ),
                                        ),
                                        'fitnesses' => array(
                                            'type'    => 'literal',
                                            'options' => array(
                                                'route'    => '/fitnesses',
                                                'defaults' => array(
                                                    'controller' => 'fitness_admin',
                                                    'action'     => 'fitness_admin',
                                                ),
                                            ),
                                            'may_terminate' => true,
                                            'child_routes'=> array(
                                                'add' => array(
                                                    'type'    => 'literal',
                                                    'options' => array(
                                                        'route'    => '/add',

                                                        'defaults' => array(
                                                            'controller' => 'fitness_admin',
                                                            'action'     => 'fitness_add',
                                                        ),
                                                    ),
                                                ),
                                                'delete' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                        'route'    => '/delete[/:fitness_id]',
                                                        'constraints' => array(

                                                            'fitness_id'     => '[0-9]+',
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'fitness_admin',
                                                            'action'     => 'fitness_delete',
                                                        ),
                                                    ),
                                                ),
                                                'edit' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                        'route'    => '/edit[/:fitness_id_name]',
                                                        'constraints' => array(
                                                            'fitness_id_name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'fitness_admin',
                                                            'action'     => 'fitness_edit',
                                                        ),
                                                    ),
                                                ),
                                                'news' => array(
                                                    'type'    => 'literal',
                                                    'options' => array(
                                                        'route'    => '/news',
                                                        'defaults' => array(
                                                            'controller' => 'fitness_admin',
                                                            'action'     => 'fitness_news',
                                                        ),
                                                    ),
                                                    'may_terminate' => true,
                                                    'child_routes'=> array(
                                                        'add' => array(
                                                            'type'    => 'segment',
                                                            'options' => array(
                                                                'route'    => '/add[/:fitness_id_name]',
                                                                'constraints' => array(

                                                                    'fitness_id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                ),
                                                                'defaults' => array(
                                                                    'controller' => 'fitness_admin',
                                                                    'action'     => 'fitness_news_add',
                                                                ),
                                                            ),
                                                        ),
                                                    ),
                                                ),
                                                'poster' => array(
                                                    'type'    => 'literal',
                                                    'options' => array(
                                                        'route'    => '/poster',
                                                        'defaults' => array(
                                                            'controller' => 'fitness_admin',
                                                            'action'     => 'fitness_poster',
                                                        ),
                                                    ),
                                                    'may_terminate' => true,
                                                    'child_routes'=> array(
                                                        'add' => array(
                                                            'type'    => 'segment',
                                                            'options' => array(
                                                                'route'    => '/add[/:fintess_id_name]',
                                                                'constraints' => array(

                                                                    'fintess_id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                ),
                                                                'defaults' => array(
                                                                    'controller' => 'fintess_admin',
                                                                    'action'     => 'fintess_poster_add',
                                                                ),
                                                            ),
                                                        ),
                                                    ),
                                                ),
                                            ),
                                        ),
                                        'salons' => array(
                                            'type'    => 'literal',
                                            'options' => array(
                                                'route'    => '/salons',
                                                'defaults' => array(
                                                    'controller' => 'salon_admin',
                                                    'action'     => 'salon_admin',
                                                ),
                                            ),
                                            'may_terminate' => true,
                                            'child_routes'=> array(
                                                'add' => array(
                                                    'type'    => 'literal',
                                                    'options' => array(
                                                        'route'    => '/add',

                                                        'defaults' => array(
                                                            'controller' => 'salon_admin',
                                                            'action'     => 'salon_add',
                                                        ),
                                                    ),
                                                ),
                                                'delete' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                        'route'    => '/delete[/:salon_id]',
                                                        'constraints' => array(

                                                            'salon_id'     => '[0-9]+',
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'salon_admin',
                                                            'action'     => 'salon_delete',
                                                        ),
                                                    ),
                                                ),
                                                'edit' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                        'route'    => '/edit[/:salon_id_name]',
                                                        'constraints' => array(
                                                            'salon_id_name'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'salon_admin',
                                                            'action'     => 'salon_edit',
                                                        ),
                                                    ),
                                                ),
                                                'news' => array(
                                                    'type'    => 'literal',
                                                    'options' => array(
                                                        'route'    => '/news',
                                                        'defaults' => array(
                                                            'controller' => 'salon_admin',
                                                            'action'     => 'salon_news',
                                                        ),
                                                    ),
                                                    'may_terminate' => true,
                                                    'child_routes'=> array(
                                                        'add' => array(
                                                            'type'    => 'segment',
                                                            'options' => array(
                                                                'route'    => '/add[/:salon_id_name]',
                                                                'constraints' => array(

                                                                    'salon_id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                ),
                                                                'defaults' => array(
                                                                    'controller' => 'salon_admin',
                                                                    'action'     => 'salon_news_add',
                                                                ),
                                                            ),
                                                        ),
                                                    ),
                                                ),
                                                'poster' => array(
                                                    'type'    => 'literal',
                                                    'options' => array(
                                                        'route'    => '/poster',
                                                        'defaults' => array(
                                                            'controller' => 'salon_admin',
                                                            'action'     => 'salon_poster',
                                                        ),
                                                    ),
                                                    'may_terminate' => true,
                                                    'child_routes'=> array(
                                                        'add' => array(
                                                            'type'    => 'segment',
                                                            'options' => array(
                                                                'route'    => '/add[/:salon_id_name]',
                                                                'constraints' => array(

                                                                    'salon_id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                ),
                                                                'defaults' => array(
                                                                    'controller' => 'salon_admin',
                                                                    'action'     => 'salon_poster_add',
                                                                ),
                                                            ),
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
            'zfcadmin'=>  __DIR__ . '/../view',
            'zfc-admin/admin-attraction/attraction' => __DIR__ . '/../view/zfc-admin/admin/attraction/attraction.phtml'

        ),
    ),

);
