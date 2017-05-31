<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Publisher for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Publisher\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Application\Entity\Publishers;

class PublisherController extends AbstractActionController
{	
	protected $em = null;
	
	public function getEntityManager()
	{
		if (null === $this->em)
		{
			$this->em = $this->getServiceLocator ()->get ( 'doctrine.entitymanager.orm_default' );
		}
		return $this->em;
	}
	
    public function indexAction()
    {
        return array();
    }
    
    
    public function addAction()
    {
    	$request = $this->getRequest ();
    	
    	if ($request->isPost ())
    	{
    		$data_post = $request->getPost ();
    	 	$publisher = new Publishers();
    		
    		$array = array (
    					'publisher' => 0,
    					'name' => $data_post ['name'],
    					'update_date' => new \DateTime (date('Y-m-d') )
    		);
    		$publisher->exchangeArray ( $array );
    		try
    		{
    			$this->getEntityManager ()->persist ( $publisher);
    			$this->getEntityManager ()->flush ();
    			$message = "success";
    		} catch ( \Exception $e )
    		{
    			$message = "failed";
    		}
    		
    		$view = new JsonModel ( array (
    					"message" => $message
    		) );
    	}
    	$view->setTerminal ( true );
    	return $view;
    }
    
    public function updateAction()
    {
    	$request = $this->getRequest();
    	
    	if ($request->isPost ())
    	{
    		$data_posted = $request->getPost ();
  
    		$publisher = $this->getEntityManager ()->find ( 'Application\Entity\Publishers', number_format($data_posted['publisher_id']) );
    		$publisher->setName ( $data_posted['name'] );
    		 
    		try
    		{
    			$this->getEntityManager ()->persist ( $publisher);
    			$this->getEntityManager ()->flush ();
    			$message = "success";
    		} catch ( \Exception $e )
    		{
    			$message = "failed";
    		}
    		$view = new JsonModel ( array (
    					"message" => $message
    		) );
    	}
    	
    	
    	$view->setTerminal(true);
    	return $view;
    }
    
    public function deleteAction()
    {
    	$request = $this->getRequest();
    	if ($request->isXmlHttpRequest()) {
    		if ($request->isPost()) {
    			$data_posted = $request->getPost();
    			$objectManager = $this->getEntityManager();
    			$publisher = $objectManager->find('Application\Entity\Publishers', $data_posted['publisher_id']);
    			try {
    				$this->getEntityManager()->remove($publisher);
    				$this->getEntityManager()->flush();
    				$message = "success";
    			} catch (\Exception $e) {
    				$message = "failed";
    			}
    			
    			$view = new JsonModel(array(
    						"message" => $message
    			));
    		}
    	}
    	
    	
    	$view->setTerminal(true);
    	
    	return $view;
    	exit();
    }

    public function getDataTableAction()
    {
    	$resultSet = $this->getEntityManager ()->getRepository ( 'Application\Entity\Publishers' )->findAll ();
    	$tabjson = array ();
    	$i = 1;
    	foreach ( $resultSet as $obj )
    	{
    		$tabvalues = array ();
    		$tabvalues [] = $i;
    		$tabvalues [] = $obj->getPublisherId();
    		$tabvalues [] = $obj->getName ();
    		 
    		$i ++;
    		$tabjson [] = $tabvalues;
    	}
    	
    	$resultsajax = array (
    				"aaData" => $tabjson
    	);
    	$view = new JsonModel ( $resultsajax );
    	$view->setTerminal ( true );
    	
    	return $view;
    	exit ();
    }
}
