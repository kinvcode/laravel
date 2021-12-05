<?php

namespace App\Swagger;

class ApiPath
{
    public function version(): array
    {
        return [
            'path' => '/version',
            'data' => [
                'get' => [
                    'tags' => ['基础'],
                    'summary' => "基础的GET请求",
                    'responses' => [
                        '200' => [
                            'description' => '版本信息',
                            'content' => [
                                'application/json' => [
                                    'schema' => [
                                        'type' => 'object',
                                        'properties' => [
                                            'version' => [
                                                'type' => 'string',
                                                'example' => '1.0.0',
                                                'description' => '版本信息'
                                            ],
                                        ],
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
            ]
        ];
    }

    public function apiRegister(): array
    {
        return [
            'path' => '/auth/register',
            'data' => [
                'post' => [
                    'tags' => ['基础'],
                    'summary' => "基础的POST请求",
                    'description' => '该请求只返回固定的用户信息',
                    'responses' => [
                        '200' => [
                            'description' => '用户信息',
                            'content' => [
                                'application/json' => [
                                    'schema' => [
                                        'type' => 'object',
                                        'properties' => [
                                            'name' => ['type' => 'string'],
                                            'email' => ['type' => 'string'],
                                            'updated_at' => ['type' => 'string'],
                                            'created_at' => ['type' => 'string'],
                                            'id' => ['type' => 'integer'],
                                        ],
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
            ]
        ];
    }

    public function apiLogin(): array
    {
        return [
            'path' => '/auth/login',
            'data' =>
                [
                    'post' => [
                        'tags' => ['请求参数'],
                        'summary' => "通过请求体传参数",
                        'requestBody' => [
                            'required' => true,
                            'content' => [
                                'application/json' => [
                                    'schema' => [
                                        'type' => 'object',
                                        'required' => ['email', 'password'],
                                        'properties' => [
                                            'email' => [
                                                'type' => 'string',
                                                'example' => 'kinvcode@gmail.com',
                                                'description' => '邮箱'
                                            ],
                                            'password' => [
                                                'type' => 'string',
                                                'example' => '123456',
                                                'description' => '密码'
                                            ]
                                        ],
                                    ]
                                ]

                            ]
                        ],
                        'responses' => [
                            '200' => [
                                'description' => '用户信息',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'id' => ['type' => 'integer'],
                                                'name' => ['type' => 'string'],
                                                'email' => ['type' => 'string'],
                                                'email_verified_at' => ['type' => 'string'],
                                                'created_at' => ['type' => 'string'],
                                                'updated_at' => ['type' => 'string'],
                                                'api_token' => ['type' => 'string'],
                                            ],
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                ]
        ];
    }

    public function apiUserInfo(): array
    {
        return [
            'path' => '/auth/me',
            'data' =>
                [
                    'get' => [
                        'tags' => ['请求参数'],
                        'summary' => "URL路径参数",
                        'parameters' => [
                            [
                                'name' => 'id',
                                'in' => 'path',
                                'required' => true,
                                'schema' => [
                                    'type' => 'integer',
                                ],
                                'description' => '用户ID',
                                'allowEmptyValue' => false,
                            ]
                        ],
                        'responses' => [
                            '200' => [
                                'description' => '用户信息',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'id' => [
                                                    'type' => 'integer',
                                                    'example' => 1,
                                                    'description' => '用户ID'
                                                ],
                                            ],
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                ]
        ];
    }


    public function apiRequestForFile(): array
    {
        return [
            'path' => '/upload/avatar',
            'data' => [
                'post' => [
                    'tags' => ['请求体'],
                    'summary' => "带有文件的请求",
                    'requestBody' => [
                        'required' => true,
                        'content' => [
                            'multipart/form-data' => [
                                'schema' => [
                                    'type' => 'object',
                                    'required' => ['avatar', 'type'],
                                    'properties' => [
                                        'avatar' => [
                                            'type' => 'string',
                                            'format' => 'binary',
                                            'description' => '图片文件：jpg,jpeg,png'
                                        ],
                                        'type' => [
                                            'type' => 'string',
                                            'enum' => ['avatar'],
                                            'example' => 'avatar',
                                            'description' => '图片的类型'
                                        ],
                                    ],
                                ]
                            ]
                        ],
                    ],
                    'responses' => [
                        '200' => [
                            'description' => '成功获取数据',
                            'content' => [
                                'application/json' => [
                                    'schema' => [
                                        'type' => 'object',
                                        'properties' => [
                                            'file_name' => [
                                                'type' => 'string',
                                                'example' => 'demo.jpg',
                                            ],
                                        ],
                                    ]
                                ]
                            ]
                        ],
                    ]
                ],
            ]
        ];
    }
}
