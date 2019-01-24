<?php 

namespace App\Repositories;

use Prophecy\ServicePacker\Repository\Repository as BaseRepository;

class UserRepository extends BaseRepository{

	/**
	 * Sets the user model for the repository
	 */
	protected function setModel() : string
    {
        return \App\Models\User::class;
    }
}