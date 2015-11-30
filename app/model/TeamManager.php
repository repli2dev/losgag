<?php

namespace App\Model;

use Nette;
use Nette\Database\Context;
use Nette\Security\AuthenticationException;
use Nette\Security\Identity;
use Nette\Security\Passwords;

class TeamManager extends Nette\Object implements Nette\Security\IAuthenticator
{
	const
		TABLE_NAME = 'team',
		COLUMN_ID = 'id_team',
		COLUMN_NAME = 'name',
		COLUMN_PASSWORD_HASH = 'password';


	/** @var Context */
	private $database;


	public function __construct(Context $database)
	{
		$this->database = $database;
	}


	/**
	 * Performs an authentication.
	 * @return Identity
	 * @throws AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;

		$row = $this->database->table(self::TABLE_NAME)->where(self::COLUMN_NAME, $username)->fetch();

		if (!$row) {
			throw new AuthenticationException('Tento tým neexistuje.', self::IDENTITY_NOT_FOUND);

		} elseif ($row[self::COLUMN_PASSWORD_HASH] != sha1($password) ) {
			throw new AuthenticationException('Heslo nesouhlasí.', self::INVALID_CREDENTIAL);

		}

		$arr = $row->toArray();
		unset($arr[self::COLUMN_PASSWORD_HASH]);
		return new Identity($row[self::COLUMN_ID], 'team', $arr);
	}

}
