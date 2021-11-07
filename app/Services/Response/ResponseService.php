<?php


namespace App\Services\Response;


class ResponseService
{
    private static function responsePrams($status, $errors = [], $data = [])
    {
        return [
            'status' => $status,
            'errors' => (object)$errors,
            'data' => $data,
        ];
    }

    public static function send($status, $code = 200, $errors = [], $data = [])
    {
        return response()->json(
            self::responsePrams($status, $errors, $data),
            $code
        );
    }

    public static function success($data = [])
    {
        return self::send(true, 200, [], $data);
    }

    public static function notFound($data = [])
    {
        return self::send(false, 404, [], []);
    }

    public static function notAuthorize()
    {
        return self::send(false, 401, [], []);
    }
}
