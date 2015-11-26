<?php

namespace App\Forms;

use App\Model\PostManager;
use Nette\Application\UI\Form;
use Nette\Http\FileUpload;
use Nette\InvalidStateException;
use Nette\Object;
use Nette\Security\User;


class UploadFormFactory extends Object
{
	const UPLOAD_LIMIT = 10;

	/** @var User */
	private $user;

	/** @var PostManager */
	private $postManager;


	public function __construct(PostManager $postManager, User $user)
	{
		$this->postManager = $postManager;
		$this->user = $user;
	}


	/**
	 * @return Form
	 */
	public function create()
	{
		$form = new Form;
		$form->addUpload('file', 'Obrázek/fotka/meme/gag')
			->addRule(Form::IMAGE, 'Obrázek musí být ve formátu JPEG, PNG nebo GIF.')
			->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 2 MB.', 2 * 1024 * 1024 /* v bytech */)
			->setOption('description', 'Obrázek ve formátu JPEG, PNG nebo GIF, maximální velikost 2MB.');

		$form->addSubmit('send', 'Vložit');

		$form->onSuccess[] = array($this, 'formSucceeded');
		return $form;
	}


	public function formSucceeded(Form $form, $values)
	{
		/** @var FileUpload $file */
		$file = $values['file'];
		if (!$file->isOk()) {
			$form->addError('Nahrávání obrázku selhalo. Pokud problém přetrvá, napište organizátorům.');
			return;
		}
		if ($file->getTemporaryFile() == '') {
			$form->addError('Nahrávání obrázku selhalo, zřejmě byla překročena velikost.');
			return;
		}
		if ($this->postManager->getTeamCount($this->user->getId()) > self::UPLOAD_LIMIT) {
			$form->addError('Váš tým vyčerpal svůj limit obrázků, další obrázky už nahrát nemůžete.');
			return;
		}
		$postId = $this->postManager->create($this->user->getId());
		try {
			$file->move(__DIR__ . '/../../images/' . $postId);
		} catch (InvalidStateException $ex) {
			$form->addError('Nahrávání obrázku selhalo. Pokud problém přetrvá, napište organizátorům.');
		}
	}

}
