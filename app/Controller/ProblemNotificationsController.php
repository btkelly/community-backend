<?php
App::uses('AppController', 'Controller');
/**
 * ProblemNotifications Controller
 *
 * @property ProblemNotification $ProblemNotification
 * @property PaginatorComponent $Paginator
 * @property RequestHandlerComponent $RequestHandler
 */
class ProblemNotificationsController extends AppController {

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
		$this->ProblemNotification->recursive = 0;
		$this->set('problemNotifications', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProblemNotification->exists($id)) {
			throw new NotFoundException(__('Invalid problem notification'));
		}
		$options = array('conditions' => array('ProblemNotification.' . $this->ProblemNotification->primaryKey => $id));
		$this->set('problemNotification', $this->ProblemNotification->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProblemNotification->create();
			if ($this->ProblemNotification->save($this->request->data)) {
				return $this->flash(__('The problem notification has been saved.'), array('action' => 'index'));
			}
		}
		$problems = $this->ProblemNotification->Problem->find('list');
		$this->set(compact('problems'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ProblemNotification->exists($id)) {
			throw new NotFoundException(__('Invalid problem notification'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProblemNotification->save($this->request->data)) {
				return $this->flash(__('The problem notification has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('ProblemNotification.' . $this->ProblemNotification->primaryKey => $id));
			$this->request->data = $this->ProblemNotification->find('first', $options);
		}
		$problems = $this->ProblemNotification->Problem->find('list');
		$this->set(compact('problems'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ProblemNotification->id = $id;
		if (!$this->ProblemNotification->exists()) {
			throw new NotFoundException(__('Invalid problem notification'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ProblemNotification->delete()) {
			return $this->flash(__('The problem notification has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The problem notification could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
