<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection as Collection;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Routing\ResponseFactory;

class Response
{
    /**
     * Http response.
     *
     * @var ResponseFactory
     */
    private ResponseFactory $response;

    /**
     * Collection.
     */
    private null|string|JsonResource $resource;

    /**
     * Http status code.
     *
     * @var int
     */
    private int $statusCode = HttpResponse::HTTP_OK;

    /**
     * Create a new class instance.
     *
     * @param  ResponseFactory  $response
     * @param $collection
     */
    public function __construct(ResponseFactory $response, $collection)
    {
        $this->resource = $collection;
        $this->response = $response;
    }

    /**
     * Return json.
     *
     * @param array<string>|array<Collection>|Collection|JsonResource $data
     * @param array<string> $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function json(array|Collection|JsonResource $data = [], array $headers = []): \Illuminate\Http\JsonResponse
    {
        return $this->response->json($data, $this->statusCode, $headers);
    }

    /**
     * Return collection.
     *
     * @param array $data
     * @return Collection
     */
    public function withCollection(array $data): Collection
    {
        return $this->resource::collection($data);
    }

    /**
     * @param string|null $resource
     * @return \Illuminate\Http\JsonResponse
     */
    public function withCreated(null|string $resource = null): \Illuminate\Http\JsonResponse
    {
        $this->statusCode = HttpResponse::HTTP_CREATED;

        if (is_null($resource)) {
            return $this->json();
        }

        return $this->json($resource);
    }

    /**
     * Make a 204 no content response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withNoContent(): \Illuminate\Http\JsonResponse
    {
        return $this
            ->setStatusCode(HttpResponse::HTTP_NO_CONTENT)
            ->json();
    }

    /**
     * Make a 400 'Bad Request' response.
     *
     * @param  string  $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function withBadRequest(string $message = 'Bad Request'): \Illuminate\Http\JsonResponse
    {
        return $this
            ->setStatusCode(HttpResponse::HTTP_BAD_REQUEST)
            ->json(['message' => $message]);
    }

    /**
     * Make a 403 'Forbidden' response.
     *
     * @param  string  $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function withForbidden(string $message = 'Forbidden')
    {
        return $this
            ->setStatusCode(HttpResponse::HTTP_FORBIDDEN)
            ->json(['message' => $message]);
    }

    /**
     * Make a 404 'Not Found' response.
     *
     * @param  string|null  $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function withNotFound(string $item = null): \Illuminate\Http\JsonResponse
    {
        if (is_null($item)) {
            return $this
                ->setStatusCode(HttpResponse::HTTP_NOT_FOUND)
                ->json(['message' => 'Not found']);
        }

        return $this
            ->setStatusCode(HttpResponse::HTTP_NOT_FOUND)
            ->json(['message' => $item.' not found', 'errors' => [$item => $item.' not found']]);
    }

    /**
     * Make a JSON response with the transformed items.
     *
     * @param Model $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function withItem(Model $data): \Illuminate\Http\JsonResponse
    {
        return $this->json(new $this->resource($data));
    }

    /**
     * Make an error response.
     *
     * @param string $message
     * @param  array<string>  $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function withError(string $message, array $errors = []): \Illuminate\Http\JsonResponse
    {
        $json = [
            'message' => $message,
        ];

        if (! empty($errors)) {
            $json['errors'] = $errors;
        }

        return $this
            ->setStatusCode(HttpResponse::HTTP_BAD_REQUEST)
            ->json($json);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function acceptedStatus(): \Illuminate\Http\JsonResponse
    {
        return $this->json(
            [
                'message' => 'application is being processed',
                'status'  => 'accepted',
            ]
        );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function moderatedStatus(): \Illuminate\Http\JsonResponse
    {
        return $this->json(
            [
                'message' => 'application is being processed',
                'status'=> 'moderated',
            ]
        );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function noChanges(): \Illuminate\Http\JsonResponse
    {
        return $this->withBadRequest('There were no changes');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function unauthorized(): \Illuminate\Http\JsonResponse
    {
        return $this
            ->setStatusCode(HttpResponse::HTTP_UNAUTHORIZED)
            ->json(['messages' => 'User unauthorized']);
    }

    /**
     * Get status code.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Set status code.
     *
     * @param  int  $statusCode
     * @return Response
     */
    public function setStatusCode(int $statusCode): Response
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Set collection class.
     *
     * @param string $resource
     * @return Response
     */
    public function setResource(string $resource): Response
    {
        $this->resource = $resource;

        return $this;
    }
}
