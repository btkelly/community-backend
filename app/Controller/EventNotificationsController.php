<?php
App::uses('AppController', 'Controller');
/**
 * EventNotifications Controller
 *
 * @property EventNotification $EventNotification
 * @property PaginatorComponent $Paginator
 * @property RequestHandlerComponent $RequestHandler
 */
class EventNotificationsController extends AppController {

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
		$this->EventNotification->recursive = 0;
		$this->set('eventNotifications', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EventNotification->exists($id)) {
			throw new NotFoundException(__('Invalid event notification'));
		}
		$options = array('conditions' => array('EventNotification.' . $this->EventNotification->primaryKey => $id));
		$this->set('eventNotification', $this->EventNotification->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EventNotification->create();
			if ($this->EventNotification->save($this->request->data)) {
				return $this->flash(__('The event notification has been saved.'), array('action' => 'index'));
			}
		}
		$events = $this->EventNotification->Event->find('list');
		$this->set(compact('events'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->EventNotification->exists($id)) {
			throw new NotFoundException(__('Invalid event notification'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EventNotification->save($this->request->data)) {
				return $this->flash(__('The event notification has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('EventNotification.' . $this->EventNotification->primaryKey => $id));
			$this->request->data = $this->EventNotification->find('first', $options);
		}
		$events = $this->EventNotification->Event->find('list');
		$this->set(compact('events'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->EventNotification->id = $id;
		if (!$this->EventNotification->exists()) {
			throw new NotFoundException(__('Invalid event notification'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->EventNotification->delete()) {
			return $this->flash(__('The event notification has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The event notification could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
