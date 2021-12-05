<?php

namespace App\Swagger;

class ApiScheme
{
    public function string()
    {
        return [
            'name' => 'string',
            'data' => [
                'type' => 'string',
                'example' => 'kinvcode',
                'description' => '字符串类型数据',
                'title' => '字符串-基础'
            ]
        ];
    }
}
