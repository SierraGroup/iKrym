<?php
return array(
    'bjyauthorize' => array(

        // set the 'guest' role as default (must be defined in a role provider)
        'default_role' => 'guest',
        'authenticated_role' => 'user',

        /* this module uses a meta-role that inherits from any roles that should
         * be applied to the active user. the identity provider tells us which
         * roles the "identity role" should inherit from.
         *
         * for ZfcUser, this will be your default identity provider
         */
        'identity_provider' => 'BjyAuthorize\Provider\Identity\ZfcUserZendDb',


        /* If you only have a default role and an authenticated role, you can
         * use the 'AuthenticationIdentityProvider' to allow/restrict access
         * with the guards based on the state 'logged in' and 'not logged in'.
         *
         * 'default_role'       => 'guest',         // not authenticated
         * 'authenticated_role' => 'user',          // authenticated
         * 'identity_provider'  => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',
         */

        /* role providers simply provide a list of roles that should be inserted
         * into the Zend\Acl instance. the module comes with two providers, one
         * to specify roles in a config file and one to load roles using a
         * Zend\Db adapter.
         */
        'role_providers' => array(

            /* here, 'guest' and 'user are defined as top-level roles, with
             * 'admin' inheriting from user
             */
            'BjyAuthorize\Provider\Role\Config' => array(
                'guest' => array(),
                'user'  => array('children' => array(
                    'admin' => array(),
                )),
            ),

            // this will load roles from the user_role table in a database
            // format: user_role(role_id(varchar), parent(varchar))
            'BjyAuthorize\Provider\Role\ZendDb' => array(
                'table'             => 'user_role',
                'role_id_field'     => 'role_id',
                'parent_role_field' => 'parent',
            ),

            // this will load roles from the 'BjyAuthorize\Provider\Role\Doctrine'
            // service
           // 'BjyAuthorize\Provider\Role\Doctrine' => array(),
        ),

        // resource providers provide a list of resources that will be tracked
        // in the ACL. like roles, they can be hierarchical
        'resource_providers' => array(
            'BjyAuthorize\Provider\Resource\Config' => array(
                'pants' => array(),
            ),
        ),

        /* rules can be specified here with the format:
         * array(roles (array), resource, [privilege (array|string), assertion])
         * assertions will be loaded using the service manager and must implement
         * Zend\Acl\Assertion\AssertionInterface.
         * *if you use assertions, define them using the service manager!*
         */
        'rule_providers' => array(
            'BjyAuthorize\Provider\Rule\Config' => array(
                'allow' => array(
                    // allow guests and users (and admins, through inheritance)
                    // the "wear" privilege on the resource "pants"
                    array(array('guest', 'user'), 'pants', 'wear')
                ),

                // Don't mix allow/deny rules if you are using role inheritance.
                // There are some weird bugs.
                'deny' => array(
                    // ...
                ),
            ),
        ),

        /* Currently, only controller and route guards exist
         *
         * Consider enabling either the controller or the route guard depending on your needs.
         */
        'guards' => array(
            /* If this guard is specified here (i.e. it is enabled), it will block
             * access to all controllers and actions unless they are specified here.
             * You may omit the 'action' index to allow access to the entire controller
             */
            'BjyAuthorize\Guard\Controller' => array(
                /* zfcadmin */
                array('controller' => 'zfcadmin','action'=>'index', 'roles' => array('admin')),

                array('controller' => 'attraction_admin','action'=>'attraction_admin', 'roles' => array('admin')),
                array('controller' => 'attraction_admin','action'=>'attraction_add','roles'=>array('admin')),
                array('controller' => 'attraction_admin','action'=>'attraction_edit','roles'=>array('admin')),
                array('controller' => 'attraction_admin','action'=>'attraction_delete','roles'=>array('admin')),
                array('controller' => 'attraction_admin','action'=>'attraction_poster_add','roles'=>array('admin')),


                array('controller' => 'restaurant_admin','action'=>'restaurant_admin','roles'=>array('admin')),
                array('controller' => 'restaurant_admin','action'=>'restaurants_add','roles'=>array('admin')),
                array('controller' => 'restaurant_admin','action'=>'restaurants_edit','roles'=>array('admin')),
                array('controller' => 'restaurant_admin','action'=>'restaurants_delete','roles'=>array('admin')),

                array('controller' => 'club_admin','action'=>'club_admin','roles'=>array('admin')),
                array('controller' => 'club_admin','action'=>'club_add','roles'=>array('admin')),
                array('controller' => 'club_admin','action'=>'club_edit','roles'=>array('admin')),
                array('controller' => 'club_admin','action'=>'club_delete','roles'=>array('admin')),

                array('controller' => 'cafe_admin','action'=>'cafe_admin','roles'=>array('admin')),
                array('controller' => 'cafe_admin','action'=>'cafe_add','roles'=>array('admin')),
                array('controller' => 'cafe_admin','action'=>'cafe_edit','roles'=>array('admin')),
                array('controller' => 'cafe_admin','action'=>'cafe_delete','roles'=>array('admin')),

                array('controller' => 'entertainment_admin','action'=>'entertainment_admin','roles'=>array('admin')),
                array('controller' => 'entertainment_admin','action'=>'entertainment_add','roles'=>array('admin')),
                array('controller' => 'entertainment_admin','action'=>'entertainment_edit','roles'=>array('admin')),
                array('controller' => 'entertainment_admin','action'=>'entertainment_delete','roles'=>array('admin')),


                array('controller' => 'hostel_admin','action'=>'hostel','roles'=>array('admin')),
                array('controller' => 'hostel_admin','action'=>'hostel_add','roles'=>array('admin')),
                array('controller' => 'hostel_admin','action'=>'hostel_delete','roles'=>array('admin')),
                array('controller' => 'hostel_admin','action'=>'hostel_edit','roles'=>array('admin')),

                array('controller' => 'activity_admin','action'=>'activity_admin','roles'=>array('admin')),
                array('controller' => 'activity_admin','action'=>'activity_add','roles'=>array('admin')),
                array('controller' => 'activity_admin','action'=>'activity_delete','roles'=>array('admin')),
                array('controller' => 'activity_admin','action'=>'activity_edit','roles'=>array('admin')),
                array('controller' => 'activity_admin','action'=>'activity_news_add','roles'=>array('admin')),
                array('controller' => 'activity_admin','action'=>'activity_poster_add','roles'=>array('admin')),


                array('controller' => 'zfcuser','action' => 'zfcuser' , 'roles' => array('guest','user','admin')),
                array('controller' => 'zfcuser','action' => 'login' , 'roles' => array('guest','user','admin')),
                array('controller' => 'zfcuser','action' => 'logout' , 'roles' => array('guest','user','admin')),
                //cdliuserprofile::index
                array('controller' => 'cdliuserprofile','action' => 'index' , 'roles' => array('guest','user','admin')),

                array('controller' => 'attraction','action'=>'index','roles'=>array('guest','user','admin')),
                array('controller' => 'attraction','action'=>'attraction_client','roles'=>array('guest','user','admin')),

                array('controller' => 'restaurant','action'=>'index','roles'=>array('guest','user','admin')),
                array('controller' => 'restaurant','action'=>'restaurant','roles'=>array('guest','user','admin')),

                array('controller' => 'cafe','action'=>'index','roles'=>array('guest','user','admin')),
                array('controller' => 'cafe','action'=>'cafe','roles'=>array('guest','user','admin')),

                array('controller' => 'club_client','action'=>'club_client','roles'=>array('guest','user','admin')),
                array('controller' => 'club','action'=>'club','roles'=>array('guest','user','admin')),

                array('controller' => 'entertainment','action'=>'index','roles'=>array('guest','user','admin')),
                array('controller' => 'entertainment','action'=>'entertainment_client','roles'=>array('guest','user','admin')),

                array('controller' => 'hostel','action'=>'index','roles'=>array('guest','user','admin')),
                array('controller' => 'hostel','action'=>'hostel','roles'=>array('guest','user','admin')),



                array(
                    'controller' => array('Application\Controller\Index',),

                    'action' => array('index'),
                    'roles' => array('guest','user')
                ),



            ),

            /* If this guard is specified here (i.e. it is enabled), it will block
             * access to all routes unless they are specified here.
             */
            'BjyAuthorize\Guard\Route' => array(

                array('route' => 'home', 'roles' => array('guest', 'user','admin')),
                array('route' => 'admin', 'roles' => array('guest','user','admin')),

                array('route' => 'zfcuser','roles' => array('user','admin')),
                array('route' => 'zfcuser/login' ,'roles' => array('guest','user','admin')),

                array('route' => 'zfcuser/logout' ,'roles' => array('user','admin')),
                array('route' => 'zfcuser/profile' ,'roles' => array('user','admin')),

                array('route' => 'zfcadmin' ,'roles' => array('admin')),

                array('route' => 'zfcadmin/attractions' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/attractions/add' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/attractions/edit' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/attractions/delete' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/attractions/poster/add' ,'roles' => array('admin')),

                array('route' => 'zfcadmin/restaurants' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/restaurants/add' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/restaurants/edit' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/restaurants/delete' ,'roles' => array('admin')),

                array('route' => 'zfcadmin/clubs' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/clubs/add' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/clubs/edit' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/clubs/delete' ,'roles' => array('admin')),

                array('route' => 'zfcadmin/cafes' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/cafes/add' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/cafes/edit' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/cafes/delete' ,'roles' => array('admin')),

                array('route' => 'zfcadmin/entertainments' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/entertainments/add' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/entertainments/edit' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/entertainments/delete' ,'roles' => array('admin')),



                array('route' => 'zfcadmin/hostels' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/hostels/add' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/hostels/edit' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/hostels/delete' ,'roles' => array('admin')),

                array('route' => 'zfcadmin/activities' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/activities/add' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/activities/edit' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/activities/delete' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/activities/news/add' ,'roles' => array('admin')),
                array('route' => 'zfcadmin/activities/poster/add' ,'roles' => array('admin')),

                array('route' => 'attractions' ,'roles' => array('admin','user','guest')),
                array('route' => 'attraction' ,'roles' => array('admin','user','guest')),


                array('route' => 'restaurants' ,'roles' => array('guest','user','admin')),
                array('route' => 'restaurant' ,'roles' => array('guest','user','admin')),

                array('route' => 'cafes' ,'roles' => array('guest','user','admin')),
                array('route' => 'cafe' ,'roles' => array('guest','user','admin')),

                array('route' => 'clubs' ,'roles' => array('guest','user','admin')),

                array('route' => 'entertainments' ,'roles' => array('admin','user','guest')),
                array('route' => 'entertainment' ,'roles' => array('admin','user','guest')),

                array('route' => 'hostels' ,'roles' => array('admin','user','guest')),
                array('route' => 'hostel' ,'roles' => array('admin','user','guest')),




            ),
        ),
    ),
);