<?php

namespace Src\Shared\Infrastructure\Laravel\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Src\Shared\Application\BaseResponse;
use Src\Shared\Infrastructure\Communicator\Communicator;
use Src\Shared\Infrastructure\Communicator\Exceptions\InvalidArgumentException;
use Src\Shared\Infrastructure\Communicator\Exceptions\UnAuthorizedException;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('api.login');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, \Closure $next, ...$guards)
    {
        try {
            if (empty($request->bearerToken())) {
                throw new InvalidArgumentException("authentication token is required");
            }
            $response = (new Communicator($request->bearerToken()))->me();
            $request->headers->set("X-USER-ID", $response->getUserId());
            $request->headers->set("X-USER-MOBILE", $response->getMobile());
            return $next($request);
        } catch (UnAuthorizedException | InvalidArgumentException | \Exception $e) {
            return (new BaseResponse())->message($e->getMessage())
                ->status(Response::HTTP_UNAUTHORIZED)
                ->echo();
        }
    }

}
