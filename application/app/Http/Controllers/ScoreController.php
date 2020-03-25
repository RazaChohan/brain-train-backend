<?php

namespace App\Http\Controllers;

use Dal\Interfaces\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;

class ScoreController extends Controller
{
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;
    /***
     * User Repository
     *
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param \Illuminate\Http\Request $request
     * @param UserRepository $userRepository
     * @return void
     */
    public function __construct(Request $request, UserRepository $userRepository)
    {
        $this->request = $request;
        $this->userRepository = $userRepository;
    }

    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getScore()
    {
        $response = [];
        $responseCode = null;
        try {
            $getLastSessionCategories = $this->request->get('getLastSessionCategories', 'false');
            //Check if request body is correct
            $userScoreHistory = $this->userRepository->getUserScoreHistory($this->request->user_id);
            $responseCode = Response::HTTP_OK;
            $response = ['data' => ['history' => $userScoreHistory]];
            //Get last session categories is true
            if($getLastSessionCategories == 'true') {
                $response['data']['last_session_categories'] = $this->userRepository->getLastSessionCategories($this->request->user_id);
            }
        } catch(Exception $exception) {
                $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                $response = ['error' => 'Something went wrong'];
                parent::log($exception, AuthController::class);
            }
        // send response
        return response()->json($response, $responseCode);
    }
}
