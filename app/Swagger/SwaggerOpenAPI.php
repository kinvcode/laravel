<?php

namespace App\Swagger;

class SwaggerOpenAPI extends OpenAPI
{
    public function __construct()
    {
        $this->makePaths();
        $this->makeModels();
    }

    public function makePaths()
    {
        $path = new ApiPath();
        $class_methods = get_class_methods($path);
        foreach ($class_methods as $method) {
            $info = $path->$method();
            $this->addPath($info['path'], $info['data']);
        }
    }

    public function makeModels()
    {
        $schemes = new ApiScheme();
        $class_methods = get_class_methods($schemes);
        foreach ($class_methods as $method) {
            $info = $schemes->$method();
            $this->addSchame($info['name'], $info['data']);
        }
    }


    /**▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼[ 模 型 列 表 开 始 ]▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼**/


    public function modelOfString()
    {
        return [
            'type' => 'string',
            'example' => 'kinvcode',
            'description' => '字符串类型数据',
            'title' => '字符串-基础'
        ];
    }

}
