<?php

namespace App\Presenters;

use App\Forms\UploadFormFactory;
use App\Model\PostManager;
use App\Model;
use Nette\Utils\Validators;


class HomepagePresenter extends BasePresenter
{
	const PASSWORD = 'PROKRASTINACE';

	/** @var PostManager @inject */
	public $posts;

	/** @var UploadFormFactory @inject */
	public $factory;

	public function startup()
	{
		parent::startup();
		if (!$this->user->isLoggedIn()) {
			$this->redirect('Sign:in');
		}

	}

	public function renderDefault()
	{
		$this->template->trending = $this->posts->getTrending();
		$this->template->history = $this->posts->getByTime();

		if ($this->posts->isOverLimit($this->user->getId())) {
			$this->template->password = self::PASSWORD;
		}
	}

	protected function createComponentUploadForm()
	{
		$form = $this->factory->create();
		$form->onSuccess[] = function ($form) {
			$form->getPresenter()->flashMessage('Váš obrázek byl úspěšně vložen.', 'ok');
			$form->getPresenter()->redirect('Homepage:');
		};
		return $form;
	}

	public function handleLike($postId)
	{
		if (!Validators::isNumericInt($postId)) {
			return;
		}
		$out = $this->posts->like($this->getUser()->getId(), $postId);
		if ($out) {
			$this->flashMessage('Hlasování provedeno.', 'ok');
		} else {
			$this->flashMessage('Neplatné hlasování.', 'nok');
		}
		$this->redirect('Homepage:');
	}

}
