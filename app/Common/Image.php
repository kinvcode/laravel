<?php

namespace App\Common;


class Image extends File
{
    protected $folder = 'images';

    public function defaultExtension(): string
    {
        return 'jpg';
    }

    public function resize()
    {
        // 如果限制了图片size，就进行裁剪
//        if ($max_width || $max_height) {
//            // 此类中封装的函数，用于裁剪图片
//            $this->reduceSize($file_path, $max_width, $max_height);
//        }
    }

    public function reduceSize($file_path, $max_width, $max_height)
    {
        // 先实例化，传参是文件的磁盘物理路径
        $image = \Intervention\Image\Facades\Image::make($file_path);
        // 进行大小调整的操作
        $image->resize($max_width, $max_height, function ($constraint) use ($max_height, $max_width) {
            // 保持纵横比
            if ($max_height === null || $max_width === null) {
                $constraint->aspectRatio();
            }

            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });

        // 对图片修改后进行保存
        $image->save();
    }
}
