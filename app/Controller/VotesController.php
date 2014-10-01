<?php
App::uses('AppController', 'Controller');
/**
 * Votes Controller
 *
 * @property Vote $Vote
 * @property PaginatorComponent $Paginator
 * @property RequestHandlerComponent $RequestHandler
 */
class VotesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'RequestHandler');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Vote->recursive = 0;
		$this->set('votes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Vote->exists($id)) {
			throw new NotFoundException(__('Invalid vote'));
		}
		$options = array('conditions' => array('Vote.' . $this->Vote->primaryKey => $id));
		$this->set('vote', $this->Vote->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Vote->create();
			if ($this->Vote->save($this->request->data)) {
				return $this->flash(__('The vote has been saved.'), array('action' => 'index'));
			}
		}
		$users = $this->Vote->User->find('list');
		$problems = $this->Vote->Problem->find('list');
		$this->set(compact('users', 'problems'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Vote->exists($id)) {
			throw new NotFoundException(__('Invalid vote'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Vote->save($this->request->data)) {
				return $this->flash(__('The vote has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Vote.' . $this->Vote->primaryKey => $id));
			$this->request->data = $this->Vote->find('first', $options);
		}
		$users = $this->Vote->User->find('list');
		$problems = $this->Vote->Problem->find('list');
		$this->set(compact('users', 'problems'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Vote->id = $id;
		if (!$this->Vote->exists()) {
			throw new NotFoundException(__('Invalid vote'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Vote->delete()) {
			return $this->flash(__('The vote has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The vote could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
