<?php

namespace App\Swagger;

abstract class OpenAPI
{
    const API_VERSION = '3.0.0';

    protected $title = '【 xxx 】API文档';

    protected $version = '1.0.0';

    protected $description = '该文档仅供本公司内部员工使用';

    protected $servers = [];

    protected $schemas = [];

    protected $paths = [];

    protected function docInfo(): array
    {
        return [
            // 文档标题
            'title' => $this->title,
            // 文档描述
            'description' => $this->description,
            // 文档版本
            'version' => $this->version,
            // 联系方式
            'contact' => [
                'email' => 'kinvcode@gmail.com',
                'name' => 'Kinv',
                'url' => 'https://www.kinvcode.com'
            ],
        ];
    }

    final public function makeData(): array
    {
        // swagger版本
        $openApi = self::API_VERSION;
        // 文档基础信息
        $info = $this->docInfo();
        // 设置基础服务器
        $this->addServer(['url' => env('API_URL')]);
        // 通信协议
        $schemes = ['http', 'https'];
        // 组件
        $components = [
            'securitySchemes' => [
                'bearerAuth' => [
                    'type' => 'http',
                    'scheme' => 'bearer',
                    'bearerFormat' => 'JWT',
                ]
            ],
            'schemas' => $this->schemas,
        ];

        // API
        $paths = $this->paths;

        return [
            'openapi' => $openApi,
            'info' => $info,
            'servers' => $this->servers,
            'schemes' => $schemes,
            'paths' => $paths,
            'components' => $components
        ];
    }

    public function setTitle(string $title): OpenAPI
    {
        $this->title = $title;
        return $this;
    }

    public function setDescription(string $description): OpenAPI
    {
        $this->description = $description;
        return $this;
    }

    public function setVersion(string $version): OpenAPI
    {
        $this->version = $version;
        return $this;
    }

    public function addServer(array $server): OpenAPI
    {
        $this->servers[] = $server;
        return $this;
    }

    public function addSchame(string $name, array $data): OpenAPI
    {
        $this->schemas[$name] = $data;
        return $this;
    }

    public function addPath(string $path, array $data): OpenAPI
    {
        $this->paths[$path] = $data;
        return $this;
    }
}
