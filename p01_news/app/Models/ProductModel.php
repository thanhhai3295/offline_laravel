<?php

namespace App\Models;

use App\Models\AdminModel;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class ProductModel extends AdminModel
{
    public function __construct() {
        $this->table = 'product as p';
        $this->folderUpload = 'product';
        $this->fieldSearchAccepted = ['name','description'];
        $this->crudNotAccepted = ['_token','thumb_current','groupAttribute','category_id'];
    }
    public function listItems($params = null,$options = null) {
        $result = null;
            if($options['task'] == 'admin-list-items') {
                $query = $this->select('p.id','p.price','p.attribute','p.name','p.description','p.thumb','p.status','cp.name as category_name')->leftJoin('category_product as cp', 'p.categoryproduct_id', '=', 'cp.id');
            
            if($params['filter']['status'] != 'all') {
                $query->where('p.status','=',$params['filter']['status']);
            }
            if(!empty($params['filter']['category'])) {
                $query->where('p.category_id','=',$params['filter']['category']);
            }
            if(!empty($params['filter']['type'])) {
                $query->where('p.type','=',$params['filter']['type']);
            }
            if($params['search']['value'] != '') {
                if($params['search']['field'] == 'all') {
                    $query->where(function($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $key => $value) {
                            $query->orWhere('p.'.$value,'LIKE',"%{$params['search']['value']}%");
                        }
                    });
                } else if(in_array($params['search']['field'],$this->fieldSearchAccepted)){
                    $query->where('p.'.$params['search']['field'],'LIKE',"%{$params['search']['value']}%");
                }
            }
            $result = $query->orderBy('p.id','desc')->paginate($params['pagination']['totalItemsPerPage']);
        }
        if($options['task'] == 'news-list-items') {
            $query = $this->select('id','name','content','thumb','created','created_by','modified','modified_by','status')->where('status','active')->limit(5);
            $result = $query->get()->toArray();
        }
        if($options['task'] == 'news-list-items-feature') {
            $query = $this->select('a.id','a.name','a.content','a.created','a.category_id','a.thumb','a.type','a.status','c.name as category_name')
                ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
                ->where('a.status','active')
                ->where('type','feature')
                ->orderBy('id','desc')
                ->take(3);
            $result = $query->get()->toArray();
        }
        if($options['task'] == 'news-list-items-lastest') {
            $query = $this->select('a.id','a.name','a.content','a.created','a.category_id','a.thumb','a.status','c.name as category_name')
                ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
                ->where('a.status','active')
                ->orderBy('id','desc')
                ->take(4);
            $result = $query->get()->toArray();
        }
        if($options['task'] == 'news-list-items-in-category') {
            $query = $this->select('id','name','content','thumb','created')
                ->where('status','active')
                ->where('category_id',$params['category_id'])
                ->take(4);
            $result = $query->get()->toArray();
        }
        if($options['task'] == 'news-list-items-related-in-category') {
            $query = $this->select('id','name','content','thumb','created')
            ->where('status','active')
            ->where('category_id',$params['category_id'])
            ->where('id','!=',$params['article_id'])
            ->take(4);
        $result = $query->get()->toArray();
        }
        
        return $result;
    }
    public function countItems($params = null,$options = null) { 
        if($options['task'] == 'count-items') {
            $query = $this->select(array(DB::raw('count(p.id) as count'),'p.status'))
            ->leftJoin('category_product as cp', 'p.categoryproduct_id', '=', 'cp.id')->groupBy('status');
        }
        if($params['search']['value'] != '') {
            if($params['search']['field'] == 'all') {
                $query->where(function($query) use ($params) {
                    foreach ($this->fieldSearchAccepted as $key => $value) {
                        $query->orWhere('a.'.$value,'LIKE',"%{$params['search']['value']}%");
                    }
                });
            } else if(in_array($params['search']['field'],$this->fieldSearchAccepted)){
                $query->where('a.'.$params['search']['field'],'LIKE',"%{$params['search']['value']}%");
            }
        }
        if(!empty($params['filter']['category'])) {
            $query->where('a.category_id','=',$params['filter']['category']);
        }
        $result = $query->get()->toArray();
        return $result;
    }
    public function saveItems($params = null,$options = null){
        $this->table = 'product';
        if($options['task'] == 'change-status'){
            $status = ($params['status'] == 'active') ? 'inactive' : 'active';
            $this->where('id',$params['id'])->update(['status' => $status]);
        }
        if($options['task'] == 'change-price'){
            $this->where('id',$params['id'])->update(['price' => $params['price']]);
        }
        if($options['task'] == 'add-item'){
            $params['created_by'] = 'HaiDepTrai';
            $params['created'] = date('Y-m-d');
            $params['categoryproduct_id'] = $params['category_id'];
            $this->insert($this->prepareParams($params));
        }
        if($options['task'] == 'edit-item'){
            $params['categoryproduct_id'] = $params['category_id'];
            // if(!empty($params['thumb'])) {
            //     Storage::disk('zvn_store_images')->delete("$this->folderUpload/".$params['thumb_current']);
            //     $params['thumb'] = $this->uploadThumb($params['thumb']);
            // }
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
            $result = $this->select('p.id','p.price','p.ordering','p.attribute','p.name','p.description','p.thumb','p.status','cp.name as category_name')->leftJoin('category_product as cp', 'p.categoryproduct_id', '=', 'cp.id')->where('p.id',$params['id'])->first();
        }
        if($options['task'] == 'get-thumb'){
            $result = $this->select('thumb')->where('id',$params['id'])->first();
        }
        if($options['task'] == 'news-get-items'){
            $result = $this->select('p.id','p.price','p.attribute','p.name','p.description','p.thumb','p.status','cp.name as category_name','cp.id as category_id')->leftJoin('category_product as cp', 'p.categoryproduct_id', '=', 'cp.id')->where('p.id',$params['id'])->where('p.status','active')->first();
            if($result) $result = $result->toArray();
        }
        return $result;
    }

}