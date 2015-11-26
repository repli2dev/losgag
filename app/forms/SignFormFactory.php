<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;
use Nette\Security\User;


class SignFormFactory extends Nette\Object
{
	/** @var User */
	private $user;


	public function __construct(User $user)
	{
		$this->user = $user;
	}


	/**
	 * @return Form
	 */
	public function create()
	{
		$form = new Form;
		$form->addText('username', 'Název týmu')
			->setRequired('Zadejte název týmu.');

		$form->addPassword('password', 'Heslo')
			->setRequired('Zadejte heslo.');

		$form->addSubmit('send', 'Přihlásit se');

		$form->onSuccess[] = array($this, 'formSucceeded');
		return $form;
	}


	public function formSucceeded(Form $form, $values)
	{
		$this->user->setExpiration('14 days', FALSE);

		try {
			$this->user->login($values->username, $values->password);
		} catch (AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}

}
