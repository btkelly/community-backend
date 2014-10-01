<?php
App::uses('AppModel', 'Model');
/**
 * ProblemNotification Model
 *
 * @property Problem $Problem
 */
class ProblemNotification extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'problem_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'device_token' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Problem' => array(
			'className' => 'Problem',
			'foreignKey' => 'problem_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
