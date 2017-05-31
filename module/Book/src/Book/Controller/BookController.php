<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Book for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Book\Controller;

use Application\Entity\Books;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Helper\ViewModel;
use Application\Entity\Publishers;
use Application\Entity\Writers;
use Zend\View\Model\JsonModel;

class BookController extends AbstractActionController
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
		$data ['publishers'] = $this->getEntityManager ()->getRepository ( 'Application\Entity\Publishers' )->findAll ();
		$data ['writers'] = $this->getEntityManager ()->getRepository ( 'Application\Entity\Writers' )->findAll ();
		
		return $data;
	}

	public function addAction()
	{
		$request = $this->getRequest ();
		
		if ($request->isPost ())
		{
			$data_post = $request->getPost ();
			$publisher = $this->getEntityManager ()->find ( 'Application\Entity\Publishers', number_format($data_post ['publisher_id']) );
			$writer = $this->getEntityManager ()->find ( 'Application\Entity\Writers', number_format($data_post ['writer_id']) );
			$books = new Books ();
			
			$array = array (
						'book_id' => 0,
						'title' => $data_post ['title'],
						'date_of_publish' => new \DateTime ( $data_post ['publishon'] ),
						'publisher' => $publisher,
						'writer' => $writer,
						'update_date' => new \DateTime ( $data_post ['publishon'] ) 
			);
			$books->exchangeArray ( $array );
			try
			{
				$this->getEntityManager ()->persist ( $books );
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
	
	public function deleteAction()
	{
		$request = $this->getRequest();
		if ($request->isXmlHttpRequest()) {
			if ($request->isPost()) {
				$data_posted = $request->getPost();
				$objectManager = $this->getEntityManager();
				$book = $objectManager->find('Application\Entity\Books', $data_posted['book_id']);
				try {
					$this->getEntityManager()->remove($book);
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

	public function updateAction()
	{
		$request = $this->getRequest();
	 
			if ($request->isPost ())
		{
			$data_posted = $request->getPost ();
			$id = number_format ( $data_posted ['book_id'] );
			
			$book = $this->getEntityManager ()->find ( 'Application\Entity\Books', $id );
			$publisher = $this->getEntityManager ()->find ( 'Application\Entity\Publishers', number_format($data_posted['publisher_id']) );
			$writer = $this->getEntityManager ()->find ( 'Application\Entity\Writers', number_format($data_posted['writer_id']) );
			$book->setTitle ( $data_posted['title'] );
			$book->setDateOfPublish ( new \DateTime ( $data_posted['publishon']) );
			$book->setPublisher ( $publisher );
			$book->setWriter ( $writer );
			try
			{
				$this->getEntityManager ()->persist ( $book );
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

	public function getDataTableAction()
	{
		$resultSet = $this->getEntityManager ()->getRepository ( 'Application\Entity\Books' )->findAll ();
		$tabjson = array ();
		$i = 1;
		foreach ( $resultSet as $obj )
		{
			$tabvalues = array ();
			$tabvalues [] = $i;
			$tabvalues [] = $obj->getBookId ();
			$tabvalues [] = $obj->getTitle ();
			$tabvalues [] = date_format ( $obj->getDateOfPublish (), 'Y-m-d' );
			$tabvalues [] = $obj->getPublisher ()->getPublisherId ();
			$tabvalues [] = $obj->getPublisher ()->getName ();
			$tabvalues [] = $obj->getWriter ()->getWriterId ();
			$tabvalues [] = $obj->getWriter ()->getName ();
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

	public function fooAction()
	{
		// This shows the :controller and :action parameters in default route
		// are working when you browse to /book/book/foo
		return array ();
	}
}
