<?php


namespace Src\Shared\Infrastructure\Laravel;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Src\Shared\Application\BaseResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @return BaseResponse
     */
    public function respond(): BaseResponse
    {
        return new BaseResponse();
    }
}
