<?php
namespace ZfcAdmin\Controller;



use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;


use Activity\Form\ActivityForm;
use Activity\Model\Activity;
use Activity\Model\ActivityTable;

use Activity\Form\ActivityNewsForm;
use Activity\Model\ActivityNews;

use Activity\Form\ActivityPosterForm;
use Activity\Model\ActivityPoster;



class AdminActivityController extends AbstractActionController
{
    //attractions table
    protected $activityTable;
    protected $activityNewsTable;
    protected $activityPosterTable;

    public  function activityAdminAction(){
        $activity_view = new ViewModel();

        $activity_table = $this->getActivityTable()->fetchAll();

        $activity_view->setVariable('activities', $activity_table);

        $admin_menu = new ViewModel();
        $admin_menu->setTemplate('zfc-admin/block/admin_menu');
        $activity_view->addChild($admin_menu,'admin');

        $sidebar= new ViewModel();
        $sidebar->setTemplate('zfc-admin/block/sidebar_admin');
        $activity_view->addChild($sidebar,'sidebar');
        return $activity_view;
    }
    public function getActivityTable(){
        if (!$this->activityTable) {
            $sm = $this->getServiceLocator();
            $this->activityTable = $sm->get('Activity\Model\ActivityTable');
       }
        return $this->activityTable;
    }

    public function getActivityNewsTable(){
        if (!$this->activityNewsTable) {
            $sm = $this->getServiceLocator();
            $this->activityNewsTable = $sm->get('Activity\Model\ActivityNewsTable');
        }
        return $this->activityNewsTable;
    }
    public function getActivityPosterTable(){
        if (!$this->activityPosterTable) {
            $sm = $this->getServiceLocator();
            $this->activityPosterTable = $sm->get('Activity\Model\ActivityPosterTable');
        }
        return $this->activityPosterTable;
    }


    public  function  activityAddAction(){
        $form = new ActivityForm();
        $form->get('submit')->setValue('Добавить место активного отдыха');
        $request = $this->getRequest();


        if ($request->isPost()) {
            $activity = new Activity();
            $form->setInputFilter($activity->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()){

                $activity->exchangeArray($form->getData());
                $this->getActivityTable()->saveActivity($activity);

                // Form is valid, save the form!
                return $this->redirect()->toRoute('zfcadmin/activities');
            }
        }
        //else return $this->redirect()->toRoute('zfcadmin');
        return array('form' => $form);
    }
    public  function  activityNewsAddAction(){
        $form = new ActivityNewsForm();

        $form->get('submit')->setValue('Добавить новость');
        $activity_id_name = (string)$this->params()->fromRoute('activity_id_name', 0);
        $form->get('activity_id_name')->setValue($activity_id_name);


        $request = $this->getRequest();

        if ($request->isPost()) {
            $activity_news = new activityNews();
            $form->setInputFilter($activity_news->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()){

                $activity_news->exchangeArray($form->getData());
                $this->getactivityNewsTable()->saveactivityNews($activity_news);

                // Form is valid, save the form!
                return $this->redirect()->toUrl('zfcadmin/activities');
            }
        }
        //else return $this->redirect()->toRoute('zfcadmin');
        return array('form' => $form);
    }
    public  function  activityDeleteAction(){
        $activity_id = (int) $this->params()->fromRoute('activity_id',0);
        if (!$activity_id) {
            return $this->redirect()->toRoute('zfcadmin/activities');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($activity_id) {
                // $activity_id = (int) $request->getPost('activity_id');
                $this->getActivityTable()->deleteActivity($activity_id);
                // Redirect to list of albums
                return $this->redirect()->toRoute('zfcadmin/activities');
            }
        }
        return array(
            'activity_id'    => $activity_id,
            'activity' => $this->getactivityTable()->getactivity($activity_id)
        );
    }
    public  function  activityEditAction()
    {
        $activity_id_name = (string) $this->params()->fromRoute('activity_id_name', 0);
        $activity = $this->getActivityTable()->getActivityByNameId($activity_id_name);

        $form  = new ActivityForm();
        $form->bind($activity);
        $form->get('submit')->setAttribute('value', 'Редактировать');

        // $request = $this->getRequest();
        if ($this->getRequest()->isPost()) {
            $form->setInputFilter($activity->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );

            $form->setData($data);

            if ($form->isValid()) {
                $this->getActivityTable()->saveActivity($activity);

                // Redirect to list of albums
                return $this->redirect()->toRoute('zfcadmin/activities');
            }
        }
        return array(
            'activity_id_name' => $activity_id_name,
            'form' => $form,
        );
    }
    public  function  activityPosterAddAction(){

        $form = new activityPosterForm();

        $form->get('submit')->setValue('Добавить афишу');
        $activity_id_name = (string) $this->params()->fromRoute('activity_id_name', 0);
        $form->get('activity_id_name')->setValue($activity_id_name);


        $request = $this->getRequest();

        if ($request->isPost()) {
            $activity_poster = new activityPoster();
            $form->setInputFilter($activity_poster->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()){

                $activity_poster->exchangeArray($form->getData());
                $this->getActivityPosterTable()->saveActivityPoster($activity_poster);

                // Form is valid, save the form!
                return $this->redirect()->toUrl('zfcadmin/activities');
            }
        }
        //else return $this->redirect()->toRoute('zfcadmin');
        return array('form' => $form);

    }
}