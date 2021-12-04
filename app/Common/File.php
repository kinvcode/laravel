<?php

namespace App\Common;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class File
{
    protected $file;

    protected $folder = 'files';

    private $default_extension = '';

    private $extension;

    private $upload_dir;

    private $file_name;

    private $relative_path;

    private $table_name = 'upload_temp_files';

    private $origin_name;

    public $file_url = null;

    public function __construct(UploadedFile $file)
    {
        $this->file = $file;

        $this->origin_name = $file->getClientOriginalName();

        $this->default_extension = $this->defaultExtension();

        $this->extension = strtolower($file->getClientOriginalExtension()) ?: $this->default_extension;
    }

    public function defaultExtension(): string
    {
        return '';
    }

    private function setFilePah()
    {
        // 文件夹路径
        $folder_name = "filespace/$this->folder/" . date("Ym/d");

        // 文件夹绝对路径
        $this->upload_dir = storage_path('app') . '/' . $folder_name;

        // 获取唯一文件名
        $this->file_name = $this->getNotExistsName($this->upload_dir, $this->extension);

        // 相对路径
        $this->relative_path = $folder_name . '/' . $this->file_name;
    }

    public function save()
    {
        $this->setFilePah();

        // 将图片移动到我们的目标存储路径中
        $this->file->move($this->upload_dir, $this->file_name);

        // 记录上传文件
        $this->file_url = url($this->relative_path);

        DB::table($this->table_name)->insert([
            'create_at' => time(),
            'domain' => env('APP_URL'),
            'path' => $this->relative_path,
            'url' => $this->file_url,
            'is_moved' => 0,
            'move_table' => null,
            'move_table_id' => null,
            'origin_name' => $this->origin_name
        ]);

        return $this;
    }

    public function getNotExistsName($path, $extension)
    {
        // 随机文件名
        $filename = uniqid() . '_' . time() . '_' . Str::random(10) . '.' . $extension;
        $file_path = $path . '/' . $filename;
        if (file_exists($file_path)) {
            return $this->getNotExistsName($path, $extension);
        } else {
            return $filename;
        }
    }

    public function folder(string $folder)
    {
        $this->folder = $folder;
        return $this;
    }

    /**
     * @param $url
     * @param null $table
     * @param null $id
     * Description: 文件保存时：记录文件所在表，主键，并标记为已转移
     * Author: kinvcode@gmail.com
     * Time: 2021-11-30 11:01
     */
    static public function moveToTable($url, $table = null, $id = null)
    {
        $data = [
            'move_table' => $table,
            'move_table_id' => $id,
            'is_moved' => 1,
        ];
        if (is_string($url)) {
            DB::table('upload_temp_files')->where('is_moved', 0)->where('url', $url)->update($data);
        } elseif (is_array($url)) {
            DB::table('upload_temp_files')->where('is_moved', 0)->whereIn('url', $url)->update($data);
        }
    }

    /**
     * @param $new_url
     * @param $table
     * @param $id
     * Description: 替换文件时，删除旧文件。保存新的文件
     * Author: kinvcode@gmail.com
     * Time: 2021-11-30 11:08
     */
    static public function updateToTable($new_url, $table, $id, $field)
    {
        //如果旧图片与新图片相同，不执行更新
        $url = DB::table($table)->where('id', $id)->value($field);
        if ($url && $url === $new_url) {
            return;
        }
        // 如果图片存在，则删除图片
        if ($url) {

        }
        $data = [
            'move_table' => $table,
            'move_table_id' => $id,
            'is_moved' => 1,
        ];
        DB::table('upload_temp_files')->where('url', $new_url)->update($data);
    }

    // 删除缓存图片
    protected function deleteTempFiles()
    {
        $files = DB::table($this->table_name)->where('is_moved', 0)->get();
        if ($files->isEmpty()) {
            return;
        }
        $id_list = $files->pluck('id')->toArray();
        foreach ($files as $file) {
            $path = storage_path('app') . '/' . $file->path;
            if (file_exists($path)) {
                $is_delete = Storage::disk('local')->delete($file->path);
                if (!$is_delete) {
                    unset($id_list[array_search($file->id, $id_list)]);
                }
            }
        }
        DB::table($this->table_name)->whereIn('id', $id_list)->delete();
    }
}
