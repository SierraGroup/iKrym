<?php
namespace ZfcAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;



use Club\Form\ClubForm;
use Club\Model\Club;




class AdminClubController extends AbstractActionController
{
    //restaurants table
    protected $clubTable;
    protected $clubMenuTable;
    protected $clubNewsTable;
    protected $clubPosterTable;



  public  function ClubAdminAction(){
        $view = new ViewModel();

        $clubs = $this->getClubsTable()->fetchAll();

        $view->setVariable('clubs', $clubs);

        $admin_menu = new ViewModel();
        $admin_menu->setTemplate('zfc-admin/block/admin_menu');
        $view->addChild($admin_menu,'admin');

        $sidebar= new ViewModel();
        $sidebar->setTemplate('zfc-admin/block/sidebar_admin');
        $view->addChild($sidebar,'sidebar');
        return $view;
    }


    public  function clubAddAction(){
        $view = new ViewModel();
        $admin_menu = new ViewModel();
        $admin_menu->setTemplate('zfc-admin/block/admin_menu');
        $view->addChild($admin_menu,'admin');

        $sidebar= new ViewModel();
        $sidebar->setTemplate('zfc-admin/block/sidebar_admin');
        $view->addChild($sidebar,'sidebar');

        $form = new ClubForm();

        $form->get('submit')->setValue('Добавить клуб');


        $request = $this->getRequest();
        if ($request->isPost()) {
            $club = new Club();
            $form->setInputFilter($club->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()){
                $club->exchangeArray($form->getData());
                $this->getClubsTable()->saveClub($club);
                // Form is valid, save the form!
                return $this->redirect()->toRoute('zfcadmin/clubs');
            }

        }
        //else return $this->redirect()->toRoute('zfcadmin');
        return array('form' => $form);
    }
    public  function clubNewsAddAction(){
        $form = new clubNewsForm();

        $form->get('submit')->setValue('Добавить новость');
        $club_id_name = (string) $this->params()->fromRoute('club_id_name', 0);
        $form->get('club_id_name')->setValue($club_id_name);


        $request = $this->getRequest();

        if ($request->isPost()) {
            $club_news = new ClubNews();
            $form->setInputFilter($club_news->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()){

                $club_news->exchangeArray($form->getData());
                $this->getClubsNewsTable()->saveClubNews($club_news);

                // Form is valid, save the form!
                return $this->redirect()->toUrl('zfcadmin/clubs');
            }
        }
        //else return $this->redirect()->toRoute('zfcadmin');
        return array('form' => $form);
    }
    public  function ClubMenuAction(){

    }

    public  function ClubMenuAddAction(){
        $view = new ViewModel();
        $admin_menu = new ViewModel();
        $admin_menu->setTemplate('zfc-admin/block/admin_menu');
        $view->addChild($admin_menu,'admin');

        $sidebar= new ViewModel();
        $sidebar->setTemplate('zfc-admin/block/sidebar_admin');
        $view->addChild($sidebar,'sidebar');

        $form = new ClubMenuForm();

        $form->get('submit')->setValue('Добавить ресторан');


        $request = $this->getRequest();
        if ($request->isPost()) {
            $club_menu = new ClubMenu();
            $form->setInputFilter($club_menu->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()){
                $club_menu->exchangeArray($form->getData());
                $this->getClubsMenuTable()->saveClubMenu($club_menu);
                // Form is valid, save the form!
                return $this->redirect()->toUrl('zfcadmin/Clubs');
            }

        }
        //else return $this->redirect()->toRoute('zfcadmin');
        return array('form' => $form,'view' => $view);
    }
    public  function ClubDeleteAction(){
        $club_id = (string) $this->params()->fromRoute('club_id',0);
        if (!$club_id) {
            return $this->redirect()->toRoute('zfcadmin/attractions');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Нет');
            if ($del == 'Да') {

                $this->getClubsTable()->deleteClub($club_id);
                return $this->redirect()->toRoute('zfcadmin/clubs');

            }
        }

        return array(
            'club_id'    => $club_id,
            'club' => $this->getClubsTable()->getClub($club_id)
        );
    }
    public  function ClubEditAction()
    {
        $club_id_name = (string) $this->params()->fromRoute('club_id_name', 0);
        $club = $this->getClubsTable()->getClubByIdName($club_id_name);

        $form  = new ClubForm();
        $form->bind($club);
        $form->get('submit')->setAttribute('value', 'Редактировать');

        // $request = $this->getRequest();
        if ($this->getRequest()->isPost()) {
            //$form->setInputFilter($club)->getInputFilter();

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );

            $form->setData($data);

            if ($form->isValid()) {
                $this->getClubsTable()->saveClub($club);

                // Redirect to list of albums
                return $this->redirect()->toRoute('zfcadmin/clubs');
            }
        }
        return array(
            'club_id_name' => $club_id_name,
            'form' => $form,
        );
    }

    /*GET FUNCTIONS*/
    public function getClubsTable()
    {
        if (!$this->clubTable) {
            $sm = $this->getServiceLocator();
            $this->clubTable = $sm->get('Club\Model\ClubTable');
        }
        return $this->clubTable;
    }

    public function getClubsMenuTable()
    {
        if (!$this->clubMenuTable) {
            $sm = $this->getServiceLocator();
            $this->ClubsMenuTable = $sm->get('Club\Model\ClubMenuTable');
        }
        return $this->clubMenuTable;
    }
    public function getClubsNewsTable()
    {
        if (!$this->clubNewsTable) {
            $sm = $this->getServiceLocator();
            $this->ClubsNewsTable = $sm->get('Club\Model\ClubNewsTable');
        }
        return $this->clubNewsTable;
    }
    public function getClubsPosterTable()
    {
        if (!$this->clubPosterTable) {
            $sm = $this->getServiceLocator();
            $this->ClubsPosterTable = $sm->get('Club\Model\ClubPosterTable');
        }
        return $this->clubPosterTable;
    }
}