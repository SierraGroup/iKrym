<?php
namespace Timetable;

use Timetable\Model\SheduleRoadMinibus;
use Timetable\Model\SheduleRoadMinibusTable;
use Timetable\Model\TransportRoadMinibus;
use Timetable\Model\TransportRoadMinibusTable;

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

                  'Timetable\Model\TransportRoadMinibusTable' => function($sm){
                       $tableGateway =$sm->get('TransportRoadMinibusTableGateway');
                       $table  = new TransportRoadMinibusTable($tableGateway);
                       return $table;
                  },
                  'TransportRoadMinibusTableGateway' => function($sm){
                      $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                      $resultSetPrototype = new ResultSet();
                      $resultSetPrototype->setArrayObjectPrototype(new TransportRoadMinibus());
                      return new TableGateway('transport_road_minibus',$dbAdapter,null,$resultSetPrototype);
                  },
                    'Timetable\Model\SheduleRoadMinibusTable' => function($sm){
                        $tableGateway =$sm->get('SheduleRoadMinibusTableGateway');
                        $table  = new SheduleRoadMinibusTable($tableGateway);
                        return $table;
                    },
                    'SheduleRoadMinibusTableGateway' => function($sm){
                        $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                        $resultSetPrototype = new ResultSet();
                        $resultSetPrototype->setArrayObjectPrototype(new SheduleRoadMinibus());
                        return new TableGateway('shedule_road_minibus',$dbAdapter,null,$resultSetPrototype);
                    }

            ),
        );
    }

}