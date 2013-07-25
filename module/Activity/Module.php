<?php
    namespace Activity;

    use Activity\Model\ActivityPoster;
    use Activity\Model\ActivityPosterTable;

    use Activity\Model\ActivityNews;
    use Activity\Model\ActivityNewsTable;

    use Activity\Model\Activity;
    use Activity\Model\ActivityTable;

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
                            'Activity\Model\ActivityTable' =>  function($sm) {
                                $tableGateway = $sm->get('ActivityTableGateway');
                                $table = new ActivityTable($tableGateway);
                                return $table;
                            },
                            'Activity\Model\ActivityNewsTable' => function($sm){
                                $tableGateway = $sm->get('ActivityNewsTableGateway');
                                $table = new ActivityNewsTable($tableGateway);
                                return $table;
                            },
                            'Activity\Model\ActivityPosterTable' => function($sm){
                                $tableGateway = $sm->get('ActivityPosterTableGateway');
                                $table = new ActivityPosterTable($tableGateway);
                                return $table;
                            },
                            'ActivityTableGateway' => function ($sm) {
                                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                $resultSetPrototype = new ResultSet();
                                $resultSetPrototype->setArrayObjectPrototype(new Activity());

                                return new TableGateway('activity', $dbAdapter, null, $resultSetPrototype);
                            },
                            'ActivityNewsTableGateway' => function($sm){
                                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                $resultSetPrototype = new ResultSet();
                                $resultSetPrototype->setArrayObjectPrototype(new ActivityNews());
                                return new TableGateway('activity_news',$dbAdapter,null,$resultSetPrototype);
                            },
                            'ActivityPosterTableGateway' => function($sm){
                                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                $resultSetPrototype = new ResultSet();
                                $resultSetPrototype->setArrayObjectPrototype(new ActivityPoster());
                                return new TableGateway('activity_poster',$dbAdapter,null,$resultSetPrototype);
                            },



                ),
              );
            }

    }