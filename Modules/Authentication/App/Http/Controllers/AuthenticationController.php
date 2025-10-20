<?php

namespace Modules\Authentication\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Authentication\App\Actions\LoginAdminAction;
use Modules\Authentication\App\Actions\RegisterAdminAction;
use Modules\Authentication\App\Http\Requests\LoginRequest;
use Modules\Authentication\App\Http\Requests\RegisterRequest;
use Modules\Authentication\App\resources\LoginResource;
use Modules\Authentication\App\resources\RegisterResource;

class AuthenticationController extends Controller
{
    public function __construct(
        protected readonly RegisterAdminAction $registerAdminAction,
        protected readonly LoginAdminAction    $loginAdminAction,
    )
    {
    }

    /**
     * @OA\Post(
     *     path="/api/v1/admin/register",
     *     summary="Register a new admin",
     *     tags={"Admin Authentication"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/RegisterAdminRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful registration",
     *         @OA\JsonContent(ref="#/components/schemas/RegisterAdminResponse")
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    public function register(RegisterRequest $request): RegisterResource|JsonResponse
    {
        $result = $this->registerAdminAction->execute($request);
        return (new RegisterResource($result['admin']))
            ->additional([
                'success' => true,
                'token' => $result['token'],
            ]);
    }


    /**
     * @OA\Post(
     *     path="/api/v1/admin/login",
     *     summary="Login an existing admin user",
     *     tags={"Admin Authentication"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LoginAdminRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(ref="#/components/schemas/LoginAdminResponse")
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials",
     *         @OA\JsonContent(ref="#/components/schemas/LoginErrorResponse")
     *     )
     * )
     */
    public function login(LoginRequest $request): LoginResource|JsonResponse
    {
        $result = $this->loginAdminAction->execute($request);

        if (empty($result)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        return (new LoginResource($result['admin']))
            ->additional([
                'success' => true,
                'token' => $result['token'],
            ]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/admin/logout",
     *     summary="Logout the authenticated admin",
     *     tags={"Admin Authentication"},
     *
     *     security={{"passport": {}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful logout",
     *         @OA\JsonContent(ref="#/components/schemas/LogoutAdminResponse")
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(ref="#/components/schemas/LogoutErrorResponse")
     *     )
     * )
     */
    public function logout(Request $request): JsonResponse
    {
        $user = $request->user('admin');
        if ($user) {
            $user->tokens()->delete();
        }
        return response()->json(['success' => true]);
    }
}
