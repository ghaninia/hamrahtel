<?php

namespace Src\Agenda\Message\Presentation\HTTP\Controllers;

use Illuminate\Http\Response;
use Src\Agenda\Message\Application\Mappers\MessageMapper;
use Src\Agenda\Message\Domain\Services\MessageServiceInterface;
use Src\Agenda\Message\Presentation\HTTP\Requests\MessageStoreRequest;
use Src\Shared\Infrastructure\Laravel\Controller;

class MessageController extends Controller
{


    public function __construct(protected MessageServiceInterface $messageService)
    {
    }

    public function store(MessageStoreRequest $request)
    {
        try {
            $message = MessageMapper::fromRequest(
                $request->header("X-USER-ID"),
                $request->input("title"),
                $request->input("content")
            );
            $this->messageService->create($message);
            return $this->respond()
                ->message(trans("message.success.message.created"))
                ->status(Response::HTTP_CREATED)
                ->echo();
        } catch (\Exception $exception) {
            return $this->respond()
                ->message($exception->getMessage())
                ->status(Response::HTTP_INTERNAL_SERVER_ERROR)
                ->echo();
        }
    }

}
