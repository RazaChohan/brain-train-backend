<?php

namespace Dal\Repositories;

use Dal\Entities\User;
use Dal\Interfaces\UserRepository;
use Illuminate\Support\Facades\DB;

class UserRepositoryImpl implements UserRepository {
    /***
     * User entity
     *
     * @var User
     */
    private $eloquentEntity;

    /***
     * Constructor
     *
     * UserRepositoryImpl constructor.
     */
    public function __construct()
    {
        $this->eloquentEntity = new User();
    }

    /***
     * Make new entity object
     */
    public function makeEntity()
    {
        return new User();
    }
    /**
     * get user by username
     *
     * @param string $username
     *
     * @return User|null
     */
    public function getUserByUsername($username) {
        return $this->eloquentEntity->where('username', '=', $username)->first();
    }
    /****
     * Get user score history
     *
     * @param $userID
     * @return mixed
     */
    public function getUserScoreHistory($userID) {
        //Note: Using raw query as its mentioned in challenge
        return DB::select("SELECT sum(score) as score, date(session_time) as date
                            FROM sessions
                            where user_id = $userID
                            GROUP BY date
                            ORDER BY date desc");

    }
}
