<?php
namespace Restaurant;
// Add these import statements:
use Restaurant\Model\Restaurant;
use Restaurant\Model\RestaurantTable;

use Restaurant\Model\RestaurantNews;
use Restaurant\Model\RestaurantNewsTable;

use Restaurant\Model\RestaurantMenu;
use Restaurant\Model\RestaurantMenuTable;

use Restaurant\Model\RestaurantMenuTypeDescription;
use Restaurant\Model\RestaurantMenuTypeDescriptionTable;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\Pdo;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    // Add this method:
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Restaurant\Model\RestaurantTable' =>  function($sm) {
                    $tableGateway = $sm->get('RestaurantTableGateway');
                    $table = new RestaurantTable($tableGateway);
                    return $table;
                },
                'RestaurantTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Restaurant());

                    return new TableGateway('restaurant', $dbAdapter, null, $resultSetPrototype);
                },
                'Restaurant\Model\RestaurantMenuTable' =>  function($sm) {
                    $tableGateway = $sm->get('RestaurantMenuTableGateway');
                    $table = new RestaurantMenuTable($tableGateway);
                    return $table;
                },
                'RestaurantMenuTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new RestaurantMenu());

                    return new TableGateway('restaurant_menu', $dbAdapter, null, $resultSetPrototype);
                },
                'Restaurant\Model\RestaurantMenuTypeDescriptionTable' =>  function($sm) {
                    $tableGateway = $sm->get('RestaurantMenuTypeDescriptionTableGateway');
                    $table = new RestaurantMenuTypeDescriptionTable($tableGateway);
                    return $table;
                },
                'RestaurantMenuTypeDescriptionTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new RestaurantMenuTypeDescription());

                    return new TableGateway('restaurant_menu_type_description', $dbAdapter, null, $resultSetPrototype);
                },
                'Restaurant\Model\RestaurantNewsTable' =>  function($sm) {
                    $tableGateway = $sm->get('RestaurantNewsGateway');
                    $table = new RestaurantNewsTable($tableGateway);
                    return $table;
                },
                'RestaurantNewsGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new RestaurantNews());

                    return new TableGateway('restaurant_menu', $dbAdapter, null, $resultSetPrototype);
                },
            ),

        );

    }
}