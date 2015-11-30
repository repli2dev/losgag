<?php

namespace App\Model;

use Exception;
use Nette;
use Nette\Database\Context;
use Nette\Database\ForeignKeyConstraintViolationException;
use Nette\Database\UniqueConstraintViolationException;
use Nette\Security\AuthenticationException;
use Nette\Security\Identity;
use Nette\Security\Passwords;
use Nette\Utils\DateTime;

class PostManager extends Nette\Object
{
	const MIN_LIKES = 20;

	const
		TABLE_NAME = 'post',
		COLUMN_ID = 'id_post',
		COLUMN_ID_TEAM = 'id_team',
		COLUMN_LIKES = 'likes',
		COLUMN_INSERTED = 'inserted';


	/** @var Context */
	private $database;


	public function __construct(Context $database)
	{
		$this->database = $database;
	}

	public function create($teamId) {
		$row = $this->database->table(self::TABLE_NAME)->insert(['id_team' => $teamId, 'inserted' => new DateTime()]);
		return $row->id_post;
	}


	public function getTrending()
	{
		return $this->database->query('
			SELECT * FROM post WHERE id_team NOT IN (SELECT id_team FROM post WHERE likes >= ?) ORDER BY inserted DESC
		', self::MIN_LIKES)->fetchAll();
	}

	public function getByTime()
	{
		return $this->database->query('
			SELECT * FROM post ORDER BY inserted DESC
		')->fetchAll();
	}

	public function getTeamCount($teamId)
	{
		return $this->database->query('
			SELECT * FROM post WHERE id_team = ?
		', $teamId)->getRowCount();
	}

	public function getLikes($teamId)
	{
		return $this->database->query('
			SELECT * FROM likes WHERE id_team = ?
		', $teamId)->fetchPairs(NULL, 'id_post');
	}

	public function isOverLimit($teamId)
	{
		return $this->database->query('
			SELECT * FROM post WHERE id_team = ? AND likes >= ?
		', $teamId, self::MIN_LIKES)->getRowCount() > 0;
	}

	public function like($teamId, $postId)
	{
		try {
			$this->database->table('likes')->insert(['id_team' => $teamId, 'id_post' => $postId]);
			$this->database->query('UPDATE post SET likes = likes + 1 WHERE id_post = ?', $postId);
			return TRUE;
		} catch (UniqueConstraintViolationException $ex) {
			return FALSE;
		} catch (ForeignKeyConstraintViolationException $ex) {
			return FALSE;
		} catch (Exception $ex) {
			return FALSE;
		}
	}

}
