<?php
namespace Cafe;
// Add these import statements:
use Cafe\Model\Cafe;
use Cafe\Model\CafeTable;
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
                'Cafe\Model\CafeTable' =>  function($sm) {
                    $tableGateway = $sm->get('CafeTableGateway');
                    $table = new CafeTable($tableGateway);
                    return $table;
                },
                'CafeTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');


                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Cafe());

                    return new TableGateway('cafe', $dbAdapter, null, $resultSetPrototype);
                },
            ),

        );

    }
}