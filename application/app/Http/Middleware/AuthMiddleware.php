<?php

namespace App\Http\Middleware;

use Closure;
use Dal\Interfaces\UserRepository;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;

class AuthMiddleware
{
    /***
     * UserRepository
     *
     * @var UserRepository
     */
    public $userRepository;

    /***
     * AuthMiddleware constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /***
     * Handle request
     *
     * @param Request $request
     * @param Closure $next
     * @param null $guard
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        $token = $request->get('token');

        if(!$token) {
            // Unauthorized response if token not there
            return response()->json([
                'error' => 'Token not provided.'
            ], Response::HTTP_UNAUTHORIZED);
        }
        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch(ExpiredException $e) {
            return response()->json([
                'error' => 'Token is expired.'
            ], Response::HTTP_BAD_REQUEST);
        } catch(Exception $e) {
            return response()->json([
                'error' => 'Invalid token.'
            ], Response::HTTP_BAD_REQUEST);
        }
        $userID = $credentials->sub;
        $request->user_id = $userID;
        return $next($request);
    }
}
