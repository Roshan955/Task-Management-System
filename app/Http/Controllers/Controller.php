<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

abstract class Controller
{
     /**
     * Standardized API response helper.
     *
     * @param mixed $data
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function apiResponse($data = null, $message = '', $statusCode = 200)
    {
        return response()->json([
            'success' => $statusCode >= 200 && $statusCode < 300,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Apply middleware dynamically to the controller.
     *
     * @param array $middlewares
     */
    protected function applyMiddlewares(array $middlewares)
    {
        foreach ($middlewares as $middleware) {
            $this->middleware($middleware);
        }
    }

    /**
     * Format validation errors for API responses.
     *
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    protected function validationErrorResponse(array $errors)
    {
        return $this->apiResponse($errors, 'Validation failed', 422);
    }

    /**
     * Filter tasks by status or priority.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $status
     * @param string|null $priority
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function filterTasks($query, $status = null, $priority = null)
    {
        if ($status) {
            $query->where('status', $status);
        }

        if ($priority) {
            $query->where('priority', $priority);
        }

        return $query;
    }

    /**
     * Sort tasks by a specific field.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $sortBy
     * @param string $order
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function sortTasks($query, $sortBy = 'due_date', $order = 'asc')
    {
        return $query->orderBy($sortBy, $order);
    }
}
