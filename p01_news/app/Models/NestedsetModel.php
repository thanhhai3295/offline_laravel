<?php

namespace App\Models;
use Kalnoy\Nestedset\NodeTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class NestedsetModel extends Model
{
    use NodeTrait;
    protected $fillable = ['name']; 
    protected $table = 'nestedset';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    public function getItem($params = null,$options = null) {
        $result = null;
        if($options['task'] == 'get-item') {
            $query = $this->select('id','name');
        }
        $tmp = $query->orderBy('id','desc')->get()->toArray();
        $result['default'] = 'No Parent';
        foreach ($tmp as $key => $value) {
            $result[$value['id']] = $value['name'];
        }
        return $result;
    }
}
