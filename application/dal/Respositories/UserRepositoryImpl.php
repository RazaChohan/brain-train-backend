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
    /***
     * Get last session categories
     *
     * @param $userID
     * @return mixed
     */
    public function getLastSessionCategories($userID) {
        //Note: Using raw query as its mentioned in challenge
        $lastSessionCategories =  DB::selectOne("SELECT group_concat(distinct cat.name SEPARATOR ', ') as categories
                                                        FROM sessions as sess
                                                        JOIN exercises as exr ON exr.course_id = sess.course_id
                                                        JOIN categories as cat ON cat.id = exr.category_id
                                                        where sess.user_id = $userID
                                                        GROUP BY sess.id, sess.session_time
                                                        ORDER BY sess.session_time desc limit 1");

        return empty($lastSessionCategories) ? "" : $lastSessionCategories->categories;
    }
}
