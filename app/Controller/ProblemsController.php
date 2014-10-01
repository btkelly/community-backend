<?php
App::uses('AppController', 'Controller');
/**
 * Problems Controller
 *
 * @property Problem $Problem
 * @property PaginatorComponent $Paginator
 * @property RequestHandlerComponent $RequestHandler
 */
class ProblemsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('RequestHandler');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Problem->recursive = 0;
        $this->setResponseArray($this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Problem->exists($id)) {
			throw new NotFoundException(__('Invalid problem'));
		}
		$options = array('conditions' => array('Problem.' . $this->Problem->primaryKey => $id));
		$this->set('problem', $this->Problem->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
        $this->Problem->create();
        if ($newProblem = $this->Problem->save($this->request->data)) {
            $this->response = $newProblem;
        }

        $this->setResponse();
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Problem->exists($id)) {
			throw new NotFoundException(__('Invalid problem'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Problem->save($this->request->data)) {
				return $this->flash(__('The problem has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Problem.' . $this->Problem->primaryKey => $id));
			$this->request->data = $this->Problem->find('first', $options);
		}
		$users = $this->Problem->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Problem->id = $id;
		if (!$this->Problem->exists()) {
			throw new NotFoundException(__('Invalid problem'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Problem->delete()) {
			return $this->flash(__('The problem has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The problem could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
