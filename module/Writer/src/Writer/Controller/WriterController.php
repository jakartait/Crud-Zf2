<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Writer for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Writer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Entity\Writers;
use Zend\View\Model\JsonModel;

class WriterController extends AbstractActionController
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
			$writer = new Writers();
			
			$array = array (
						'writer' => 0,
						'name' => $data_post ['name'],
						'update_date' => new \DateTime (date('Y-m-d') )
			);
			$writer->exchangeArray ( $array );
			try
			{
				$this->getEntityManager ()->persist ( $writer);
				$this->getEntityManager ()->flush ();
				$message = "success";
			} catch ( \Exception $e )
			{
				$message = "failed".e;
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
			
			$writer= $this->getEntityManager ()->find ( 'Application\Entity\Writers', number_format($data_posted['writer_id']) );
			$writer->setName ( $data_posted['name'] );
			
			try
			{
				$this->getEntityManager ()->persist ( $writer);
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
				$publisher = $objectManager->find('Application\Entity\Writers', $data_posted['writer_id']);
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
		$resultSet = $this->getEntityManager ()->getRepository ( 'Application\Entity\Writers' )->findAll ();
		$tabjson = array ();
		$i = 1;
		foreach ( $resultSet as $obj )
		{
			$tabvalues = array ();
			$tabvalues [] = $i;
			$tabvalues [] = $obj->getWriterId();
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
