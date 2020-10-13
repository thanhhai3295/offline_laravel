<?php

namespace App\Models;

use App\Models\AdminModel;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class SettingModel extends AdminModel
{
    public function __construct() {
        $this->table = 'setting';
        $this->folderUpload = 'setting';
        $this->fieldSearchAccepted = [];
        $this->crudNotAccepted = ['_token','thumb_current','key_value',];
    }

    public function saveItems($params = null,$options = null){
        if($options['task'] == 'save-main'){
            $params['thumb'] = $this->uploadThumb($params['thumb']);
            $tmp['value'] = json_encode($this->prepareParams($params));
            $tmp['key_value'] = 'setting-main';
            $tmp['created_by'] = 'HaiDepTrai';
            $tmp['created'] = date('Y-m-d'); 
            $params = $tmp;
            $this->insert($params);
        }
        if($options['task'] == 'edit-item'){
            $key_value = $params['key_value'];
            if(!empty($params['thumb'])) {
                Storage::disk('zvn_store_images')->delete("$this->folderUpload/".$params['thumb_current']);
                $params['thumb'] = $this->uploadThumb($params['thumb']);
            } else {
                $params['thumb'] = $params['thumb_current'];
            }
            $tmp['value'] = json_encode($this->prepareParams($params));
            $params['modified_by'] = 'HaiDepTrai';
            $params['modified'] = date('Y-m-d');
            $params = $tmp;
            $this->where('key_value',$key_value)->update($this->prepareParams($params));
        }
    }
    public function getItem($params = null,$options = null){
        $result = null;
            $result = $this->select('id','key_value','value')->where('key_value',$options['task'])->first();
            if($result) {
                $result = $result->toArray();
                $result = json_decode(($result['value']),true);
            }
        return $result;
    }

}
