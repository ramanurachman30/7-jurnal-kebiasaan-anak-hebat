<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Exception;

class ApiUserController extends ApiGlobalController
{
    public function activation($id, $status)
    {
        $statusName = [
            '1' => [
                'message' => 'Not Active',
                'status' => 2
            ],
            '2' => [
                'message' => 'Activated',
                'status' => 1
            ]
        ];

        try {
            $model = User::findOrFail($id);
            if (!$model) return response(['status' => 404, 'message' => 'Model not found']);

            $model->setAttribute('status', $statusName[$status]['status']);
            $model->save();

            $message = "User with name $model->username is " . $statusName[$status]['message'];

            return response(['status' => 200, 'message' => $message]);
        } catch (Exception $e) {
            return response(['status' => 500, 'message' => 'Internal Server Error!']);
        }
    }
}
