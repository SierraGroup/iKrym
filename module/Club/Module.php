<?php
namespace Club;
use Club\Model\Club;
use Club\Model\ClubTable;
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
                'Club\Model\ClubTable' =>  function($sm) {
                    $tableGateway = $sm->get('ClubTableGateway');
                    $table = new ClubTable($tableGateway);
                    return $table;
                },
                'ClubTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');


                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Club());

                    return new TableGateway('club', $dbAdapter, null, $resultSetPrototype);
                },
            ),

        );

    }
}