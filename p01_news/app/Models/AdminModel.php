<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class AdminModel extends Model
{
    protected $table = '';
    protected $folderUpload = '';
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $fieldSearchAccepted = ['id','name','description','link'];
    protected $crudNotAccepted = ['_token','thumb_current'];
    
    public function deleteThumb($thumbName){
        Storage::disk('zvn_store_images')->delete("$this->folderUpload/".$thumbName);
    }
    public function uploadThumb($thumbObj){
        $thumbName = Str::random(10).'.'.$thumbObj->clientExtension();
        $thumbObj->storeAs($this->folderUpload,$thumbName,'zvn_store_images');
        return $thumbName;
    }
    public function dropzoneUpload($thumb) {
        $path = Storage::disk('zvn_store_images')->getAdapter()->getPathPrefix().'/'.$this->folderUpload;
        $ext = pathinfo($thumb['name'], PATHINFO_EXTENSION);
        $thumbName = Str::random(10).'.'.$ext;
        move_uploaded_file($thumb['tmp_name'],"$path/$thumbName");
    }
    public function prepareParams($params){
        return array_diff_key($params,\array_flip($this->crudNotAccepted));
    }
}
