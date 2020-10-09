<?php

namespace App\Models;

use App\Models\AdminModel;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class RssModel extends AdminModel
{
    public function __construct() {
        $this->table = 'rss';
        $this->fieldSearchAccepted = ['id','name','link'];
        $this->crudNotAccepted = ['_token'];
    }
    public function listItems($params = null,$options = null) {
        $result = null;
            if($options['task'] == 'admin-list-items') {
                $query = $this->select('id','name','link','ordering','source','created','created_by','modified','modified_by','status');
            
            if($params['filter']['status'] != 'all') {
                $query->where('status','=',$params['filter']['status']);
            }
            if(!empty($params['filter']['source'])) {
                $query->where('source',$params['filter']['source']);
            }
            if($params['search']['value'] != '') {
                if($params['search']['field'] == 'all') {
                    $query->where(function($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $key => $value) {
                            $query->orWhere($value,'LIKE',"%{$params['search']['value']}%");
                        }
                    });
                } else if(in_array($params['search']['field'],$this->fieldSearchAccepted)){
                    $query->where($params['search']['field'],'LIKE',"%{$params['search']['value']}%");
                }
            }
            $result = $query->orderBy('id','desc')->paginate($params['pagination']['totalItemsPerPage']);  
            return $result;
        }
        if($options['task'] == 'menu-list-items'){
            $result = $this->select('id','name','link','type')->where('status','active')->orderBy('ordering','asc')->get()->toArray();
            return $result;
        }

    }
    public function countItems($params = null,$options = null) { 
        if($options['task'] == 'count-items') {
            $query = self::select(DB::raw('count(id) as count,status'))
            ->groupBy('status');
        }
        if($params['search']['value'] != '') {
            if($params['search']['field'] == 'all') {
                $query->where(function($query) use ($params) {
                    foreach ($this->fieldSearchAccepted as $key => $value) {
                        $query->orWhere($value,'LIKE',"%{$params['search']['value']}%");
                    }
                });
            } else if(in_array($params['search']['field'],$this->fieldSearchAccepted)){
                $query->where($params['search']['field'],'LIKE',"%{$params['search']['value']}%");
            }
        }
        
        $result = $query->get()->toArray();
        return $result;
    }
    public function saveItems($params = null,$options = null){
        if($options['task'] == 'change-status'){
            $status = ($params['status'] == 'active') ? 'inactive' : 'active';
            $this->where('id',$params['id'])->update(['status' => $status]);
        }
        if($options['task'] == 'change-ordering'){
            $this->where('id',$params['id'])->update(['ordering' => $params['ordering']]);
        }
        if($options['task'] == 'change-source'){
            $this->where('id',$params['id'])->update(['source' => $params['source']]);
        }
        if($options['task'] == 'add-item'){
            $params['created_by'] = 'HaiDepTrai';
            $params['created'] = date('Y-m-d');
            $this->insert($this->prepareParams($params));
        }
        if($options['task'] == 'edit-item'){
            $params['modified_by'] = 'HaiDepTrai';
            $params['modified'] = date('Y-m-d');
            $this->where('id',$params['id'])->update($this->prepareParams($params));
        }
    }
    public function deleteItem($params = null,$options = null){
        if($options['task'] == 'delete-item'){
            $item = $this->getItem($params,['task' => 'get-thumb']);
            $this->deleteThumb($item['thumb']);
            $this->where('id',$params['id'])->delete();
        }
    }
    public function getItem($params = null,$options = null){
        $result = null;
        if($options['task'] == 'get-item'){
            $result = $this->select('id','name','link','ordering','type','created','created_by','modified','modified_by','status')->where('id',$params['id'])->first();
        }
        return $result;
    }

}
