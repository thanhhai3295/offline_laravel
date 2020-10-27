<?php

namespace App\Models;
use Kalnoy\Nestedset\NodeTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class CategoryproductModel extends Model
{
    use NodeTrait;
    protected $fillable = ['name','status']; 
    protected $table = 'category_product';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    public function getItem($params = null,$options = null){
        $result = null;
        if($options['task'] == 'get-item'){
            $result = $this->select('id','name','parent_id')->where('id',$params['id'])->first();
        }
        if($result) $result = $result->toArray();
        return $result;
    }
    public function saveItems($params = null,$options = null){
        if($options['task'] == 'change-status'){
            $status = ($params['status'] == 'active') ? 'inactive' : 'active';
            $this->where('id',$params['id'])->update(['status' => $status]);
        }
    }

}
