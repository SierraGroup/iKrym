<?php
namespace Pharmacy;


use Pharmacy\Model\Pharmacy;
use Pharmacy\Model\PharmacyTable;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\Pdo;

class Module
{
    public  function getAutoloaderConfig(){
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__.'/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ .'/src/'.__NAMESPACE__,
                ),
            ),
        );
    }
    public  function getConfig(){
        return include __DIR__ .'/config/module.config.php';
    }
    public  function getServiceConfig(){
        return array(
            'factories' => array(
                'Pharmacy\Model\PharmacyTable' =>  function($sm) {
                    $tableGateway = $sm->get('PharmacyTableGateway');
                    $table = new PharmacyTable($tableGateway);
                    return $table;
                },
                'PharmacyTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Pharmacy());

                    return new TableGateway('pharmacy', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

}