<?php
namespace ZfcAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;


use Fitness\Form\FitnessForm;
use Fitness\Model\Fitness;
use Fitness\Model\FitnessTable;



class AdminFitnessController extends AbstractActionController
{
    //fitness_ table
    protected $fitness_Table;
    protected $fitness_NewsTable;
    protected $fitness_PosterTable;

    public  function indexAction(){
        $view = new ViewModel();

        //Navigation block
        $navigation_view = new ViewModel();
        $navigation_view->setTemplate('block/navigation');

        //Categories block
        $categories_window = new ViewModel();
        $categories_window->setTemplate('block/categories');

        //Filter block
        $filter_window = new ViewModel();
        $filter_window->setTemplate('block/filter');

        //rightside block
        $rightside_window = new ViewModel();
        $rightside_window->setTemplate('block/rightside');

        //Top block
        $top_view = new ViewModel();
        $top_view->setTemplate('block/top');
        $top_view->addChild($rightside_window,'rightside');

        //Categories block
        $categories_window = new ViewModel();
        $categories_window->setTemplate('block/categories');

        $navigation_view = new ViewModel();
        $navigation_view->setTemplate('block/navigation');

        $restaurants = $this->getFitnessTable()->fetchAll();
        $view->setVariable('fitness_',$restaurants);
        $view->addChild($top_view,'topview')->addChild($navigation_view,'navigation')->addChild($categories_window,'category');
        return $view;
    }

    public  function fitnessAdminAction(){
        $fitness__view = new ViewModel();

        $fitness__table = $this->getFitnessTable()->fetchAll();

        $fitness__view->setVariable('fitnesses', $fitness__table);

        $admin_menu = new ViewModel();
        $admin_menu->setTemplate('zfc-admin/block/admin_menu');
        $fitness__view->addChild($admin_menu,'admin');

        $sidebar= new ViewModel();
        $sidebar->setTemplate('zfc-admin/block/sidebar_admin');
        $fitness__view->addChild($sidebar,'sidebar');
        return $fitness__view;
    }
    public  function fitnessAddAction(){
        $form = new FitnessForm();
        $form->get('submit')->setValue('Добавить фитнес-центр');
        $request = $this->getRequest();


        if ($request->isPost()) {
            $fitness_ = new Fitness();
            $form->setInputFilter($fitness_->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()){

                $fitness_->exchangeArray($form->getData());
                $this->getFitnessTable()->saveFitness($fitness_);

                // Form is valid, save the form!
                return $this->redirect()->toRoute('zfcadmin/fitness_es');
            }
        }

        return array('form' => $form);
    }
    public  function fitnessDeleteAction(){
        $fitness_id = (int) $this->params()->fromRoute('fitness_id',0);
        if (!$fitness_id) {
            return $this->redirect()->toRoute('zfcadmin/fitnesses');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {

                 //$fitness_id = (int) $request->getPost('fitness_id');
                $this->getFitnessTable()->deleteFitness($fitness_id);
                // Redirect to list of albums
                return $this->redirect()->toRoute('zfcadmin/fitnesses');

        }
        return array(
            'fitness_id'    => $fitness_id,
            'fitness' => $this->getFitnessTable()->getFitness($fitness_id)
        );
    }
    public  function fitnessEditAction(){
        $fitness_id_name = (string) $this->params()->fromRoute('fitness_id_name', 0);
        $fitness = $this->getFitnessTable()->getFitnessByNameId($fitness_id_name);

        $form  = new FitnessForm();
        $form->bind($fitness);
        $form->get('submit')->setAttribute('value', 'Редактировать');

        // $request = $this->getRequest();
        if ($this->getRequest()->isPost()) {
            $form->setInputFilter($fitness->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );

            $form->setData($data);

            if ($form->isValid()) {
                $this->getFitnessTable()->saveFitness($fitness);

                // Redirect to list of albums
                return $this->redirect()->toRoute('zfcadmin/fitnesses');
            }
        }
        return array(
            'fitness_id_name' => $fitness_id_name,
            'form' => $form,
        );
    }
    public  function  getFitnessTable(){
        if (!$this->fitness_Table) {
            $sm = $this->getServiceLocator();
            $this->fitness_Table = $sm->get('Fitness\Model\FitnessTable');

        }
        return $this->fitness_Table;
    }
}

