<?php

namespace Src\Auth\Presentation\HTTP\Controllers;

use Src\Agenda\User\Domain\Execptions\UserNotFoundException;
use Src\Auth\Domain\AuthInterface;
use Symfony\Component\HttpFoundation\Response;
use Src\Shared\Infrastructure\Laravel\Controller;
use Src\Auth\Presentation\HTTP\Requests\LoginRequest;
use Src\Auth\Presentation\HTTP\Requests\LogoutRequest;
use Src\Auth\Presentation\HTTP\Requests\WhoIAmRequest;
use Src\Auth\Application\Exceptions\InvalidUserCredentialException;

class AuthController extends Controller
{

    /**
     * @param AuthInterface $auth
     */
    public function __construct(protected AuthInterface $auth)
    {
    }

    /**
     * @param LoginRequest $request
     * @return \Src\Shared\Application\BaseResponse|Response
     */
    public function login(LoginRequest $request)
    {
        try {

            $dto = $this->auth->login($request->only(['mobile', 'password']));
            return $this->respond()
                ->message(trans('message.success.login'))
                ->payload([
                    'access_token' => $dto->getAccessToken(),
                    'token_type' => $dto->getTokenType(),
                    'expires_in' => $dto->getTTL()
                ])
                ->echo();

        } catch (InvalidUserCredentialException $exception) {

            return $this->respond()
                ->message($exception->getMessage())
                ->status(Response::HTTP_NOT_FOUND)
                ->echo();

        } catch (\Exception $exception) {

            return $this->respond()
                ->message($exception->getMessage())
                ->status(Response::HTTP_INTERNAL_SERVER_ERROR)
                ->echo();

        }
    }

    /**
     * @param LogoutRequest $request
     * @return \Src\Shared\Application\BaseResponse|Response
     */
    public function logout(LogoutRequest $request)
    {
        try {
            $this->auth->logout();
            return $this->respond()
                ->message(trans('message.success.logout'))
                ->echo();
        } catch (\Exception $exception) {
            return $this->respond()
                ->message($exception->getMessage())
                ->status(Response::HTTP_INTERNAL_SERVER_ERROR)
                ->echo();

        }
    }

    /**
     * @param WhoIAmRequest $request
     * @return Response
     */
    public function me(WhoIAmRequest $request)
    {
        try {
            $user = $this->auth->me();
            return $this->respond()
                ->payload($user->toArray())
                ->echo();
        } catch (UserNotFoundException $exception) {
            return $this->respond()
                ->message($exception->getMessage())
                ->status(Response::HTTP_NOT_FOUND)
                ->echo();
        } catch (\Exception $exception) {
            return $this->respond()
                ->message($exception->getMessage())
                ->status(Response::HTTP_INTERNAL_SERVER_ERROR)
                ->echo();
        }
    }
}
