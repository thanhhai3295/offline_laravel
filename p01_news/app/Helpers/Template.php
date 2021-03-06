<?php 
  namespace App\Helpers;
  use Config;
  use Route;
  use App\Models\NestedsetModel as NestedSet;
  use App\Models\GroupattrModel as GroupAttr;
  class Template {
    public static function showButtonFilter($controllerName,$countByStatus,$currentFilterStatus,$paramsSearch){
      $xhtml = null;
      $tmplStatus = Config::get('zvn.template.status');
      if(count($countByStatus) > 0) {
        array_unshift($countByStatus,[
          'status' => 'all',
          'count'  => array_sum(array_column($countByStatus,'count'))
        ]);
        foreach ($countByStatus as $key => $value) {
          $statusValue = $value['status'];
          $statusValue = array_key_exists($statusValue,$tmplStatus) ? $statusValue : 'default';
          $currentStatus = $tmplStatus[$statusValue];
          $link = Route($controllerName)."?filter_status=$statusValue";
          if($paramsSearch['value'] != '') {
            $link .= "&search_field={$paramsSearch['field']}&search_value={$paramsSearch['value']}";
          }
          $class = ($currentFilterStatus == $statusValue) ? 'btn-danger' : 'btn-info';
          $xhtml .= '<a href="'.$link.'" type="button" class="btn '.$class.'"> 
                      '.$currentStatus['name'].' <span class="badge bg-white">'.$value['count'].'</span>
                    </a>';
        }
      }
      return $xhtml;      
    }
    public static function showAreaSearch($controllerName,$paramsSearch){
      $xhtml = null;
      $tmplField = Config::get('zvn.template.search');
      $fieldInController = Config::get('zvn.config.search');
      $controllerName = array_key_exists($controllerName,$fieldInController) ? $controllerName : 'default';
      $xhtmlField = null;
      foreach ($fieldInController[$controllerName] as $value) {
        $xhtmlField .= '<li>
                        <a href="#" class="select-field" data-field="'.$value.'">'.$tmplField[$value]['name'].'</a>
                      </li>';
      }
      $searchField = in_array($paramsSearch['field'],$fieldInController[$controllerName]) ? $paramsSearch['field'] : 'all';

      $xhtml = '<div class="input-group">
                  <div class="input-group-btn">
                      <button type="button"
                              class="btn btn-default dropdown-toggle btn-active-field"
                              data-toggle="dropdown" aria-expanded="false">
                          '.$tmplField[$searchField]['name'].' <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-right" role="menu">
                          '.$xhtmlField.'
                      </ul>
                  </div>
                  <input type="text" class="form-control" name="search_value" value="'.$paramsSearch['value'].'">
                  <span class="input-group-btn">
              <button id="btn-clear" type="button" class="btn btn-success"
                      style="margin-right: 5px">Xóa tìm kiếm</button>
              <button id="btn-search" type="button" class="btn btn-primary">Tìm kiếm</button>
              </span>
                  <input type="hidden" name="search_field" value="'.$searchField.'">
              </div>';
      return $xhtml;      
    }
    public static function showItemHistory($by, $time){
      $xhtml = '<p><i class="fa fa-user"></i> '.$by.'</p>
              <p><i class="fa fa-clock-o"></i>  '.date(Config::get('zvn.format.short_time'),strtotime($time)).'</p>';
      return $xhtml;      
    }
    public static function showTime($time){
      $xhtml = '<p><i class="fa fa-clock-o"></i>  '.date(Config::get('zvn.format.long_time'),strtotime($time)).'</p>';
      return $xhtml;
    }
    public static function showItemStatus($controllerName,$id,$statusValue) {
      $tmplStatus = Config::get('zvn.template.status');
      $statusValue = array_key_exists($statusValue,$tmplStatus) ? $statusValue : 'default';
      $currentStatus = $tmplStatus[$statusValue];
      $link = Route($controllerName);
      $onClick = "onclick=changeStatus(this);";
      $xhtml = '<a '.$onClick.' href="#" data-status="'.$statusValue.'" data-url="'.route($controllerName.'/status',['id' => $id,'status' => $statusValue]).'" type="button" class="btn btn-round '.$currentStatus['class'].'" id="btn-status">'.$currentStatus['name'].'</a>';
      return $xhtml;
    }
    public static function showItemContact($controllerName,$id,$statusValue) {
      $tmplStatus = Config::get('zvn.template.contact');
      $statusValue = array_key_exists($statusValue,$tmplStatus) ? $statusValue : 'default';
      $currentStatus = $tmplStatus[$statusValue];
      $link = Route($controllerName);
      $onClick = "onclick=changeStatus(this);";
      $xhtml = '<a '.$onClick.' href="#" data-status="'.$statusValue.'" data-url="'.route($controllerName.'/status',['id' => $id,'status' => $statusValue]).'" type="button" class="btn btn-round '.$currentStatus['class'].'" id="btn-status">'.$currentStatus['name'].'</a>';
      return $xhtml;
    }
    public static function showItemIsHome($controllerName,$id,$isHomeValue) {
      $tmplIsHome = Config::get('zvn.template.is_home');
      $isHomeValue = array_key_exists($isHomeValue,$tmplIsHome) ? $isHomeValue : '1';
      $currentisHome = $tmplIsHome[$isHomeValue];
      $link = Route($controllerName.'/isHome',['isHome' => $isHomeValue, 'id' => $id]);
      $xhtml = '<a href="'.$link.'" type="button" class="btn btn-round '.$currentisHome['class'].'">'.$currentisHome['name'].'</a>';
      return $xhtml;
    }
    public static function showItemSelect($controllerName,$id,$displayValue,$fieldName) {
      $tmplDisplay = Config::get('zvn.template.'.$fieldName);
      $link = route($controllerName.'/'.$fieldName,[$fieldName => 'value_new','id' => $id]);
      $xhtml = '<select name="select_change_attr_ajax" data-url="'.$link.'"  class="form-control">';
      foreach ($tmplDisplay as $key => $value) {
        $xhtmlSelected = ($key == $displayValue) ? 'selected="selected"' : '';
        $xhtml .= '<option '.$xhtmlSelected.' value="'.$key.'">'.$value['name'].'</option>';
      }
      $xhtml .= '</select>';
      return $xhtml;
    }
    public static function showItemSelectCategory($controllerName,$id,$displayValue,$arrCategory) {
      $arrCategory = self::arrParentTree($arrCategory,false);
      $link = route($controllerName.'/'.'category',['category_id' => 'value_new','id' => $id]);
      $xhtml = '<select name="select_change_attr_ajax" data-url="'.$link.'"  class="form-control">';
      foreach ($arrCategory as $key => $value) {
        $xhtmlSelected = ($key == $displayValue) ? 'selected="selected"' : '';
        $xhtml .= '<option '.$xhtmlSelected.' value="'.$key.'">'.$value.'</option>';
      }
      $xhtml .= '</select>';
      return $xhtml;
    }
    public static function showItemThumb($controllerName,$thumbName,$thumbAlt){
      $xhtml = '<img src="'.asset("assmin/img/$controllerName/$thumbName").'" alt="'.$thumbAlt.'" class="zvn-thumb" id="blah">';
      return $xhtml;
    }
    public static function showButtonAction($controllerName,$id) {
      $tmplButton = Config::get('zvn.template.button');
      $buttonInArea = Config::get('zvn.config.button');

      $controllerName = array_key_exists($controllerName,$buttonInArea) ? $controllerName : 'default';
      $listButtons    = $buttonInArea[$controllerName];
      $xhtml = '<div class="zvn-box-btn-filter">';
      foreach ($listButtons as $key => $value) {
        $currentButton = $tmplButton[$value];
        $link = Route($controllerName.$currentButton['route-name'],['id' => $id]);
        $xhtml .= '<a href="'.$link.'" type="button" class="btn btn-icon '.$currentButton['class'].'" data-toggle="tooltip" data-placement="top" data-original-title="'.$currentButton['title'].'"><i class="fa '.$currentButton['icon'].'"></i>
                  </a>';
      }
      $xhtml .= '</div>';
      return $xhtml;
    }
    public static function showMessageNotify(){
      if (session('success')) {
        $message = session('success');
        echo "<script>notify('$message')</script>";
      }
      if (session('error')) {
        $message = session('error');
        echo "<script>warning('$message')</script>";
      }
    }
    public static function showSelectFilter($controllerName,$arrayData,$valueFilter,$field){
      $xhtml = '<form class="form-horizontal" role="form" enctype="multipart/form-data">';
      $xhtml = '<select class="form-control" style="width:auto;display:inline" data-filter="'.$field.'" name=select_filter>';
        foreach ($arrayData as $key => $value) {
          $selected = ($key == $valueFilter) ? 'selected=selected' : '';
          $xhtml .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
        }
      $xhtml .= '</select></form>';
      return $xhtml;
    }
    public static function showDateTimeFrontEnd($datetime){
      return date_format(date_create($datetime),Config::get('zvn.format.short_time'));
    }
    public static function showContent($content, $length, $prefix = '...'){
      $prefix = ($length == 0) ? '' : $prefix;
      $content = str_replace(['<p>','</p>'],'',$content);
      return preg_replace('/\s+?(\S+)?$/','',substr($content,0,$length)).$prefix;
    }
    public static function showTree($controllerName,$items,$prefix = ''){
      foreach ($items as $item) {
        $name = PHP_EOL.$prefix.' '.$item->name;
        $id = $item->id;
        $listBtnAction   = Template::showButtonAction($controllerName,$id);
        $status = Template::showItemStatus($controllerName,$id,$item['status']);
        $arrowUp = '<a href="'.route($controllerName.'/node',['node' => 'up','id' => $id]).'" class="ordering"><i class="fa fa-arrow-up"></i></a>';
        $arrowDown = '<a href="'.route($controllerName.'/node',['node' => 'down','id' => $id]).'" class="ordering"><i class="fa fa-arrow-down"></i></a>';
        $node = Nestedset::find($id);
        if(!$node->getPrevSibling()) $arrowUp = '';
        if(!$node->getNextSibling()) $arrowDown = '';
        $arrow = $arrowUp.$arrowDown;
        $xhtml = '<tr>';
        $xhtml .= '<td>'.$id.'</td>
                  <td style="font-size:20px">'.$name.'</td>
                  <td>'.$arrow.'</td>
                  <td>'.$item->created.'</td>
                  <td>'.$item->modified.'</td>               
                  <td>'.$status.'</td>
                  <td>'.$listBtnAction.'</td>';
                  
        $xhtml .= '</tr>';
        echo $xhtml;
          self::showTree($controllerName,$item->children, $prefix.'|----- ');
      }
    }
    public static function arrParentTree($arrParent,$defaultValue = true,&$result = null,$prefix = '') {
      if($defaultValue) $result['default'] = 'No Parent';
      foreach ($arrParent as $key => $value) {
        $result[$value['id']] = $prefix.$value['name'];
        if($value['children']) {
          self::arrParentTree($value['children'],$defaultValue,$result,$prefix.'|----- ');
        }
      }
      return $result;
    }
    public static function recursiveMenu($items, &$xhtmlMenu = ''){
      $xhtmlMenu .= '<ul>';
      foreach ($items as $key => $value) {
        if($value['status'] == 'active') {
          $link = URL::linkCatProduct($value['name'],$value['id']);   
          $xhtmlMenu .= '<li><a href="'.$link.'">'.$value['name'].'</a>';
          if($value['children']) {
            self::recursiveMenu($value['children'],$xhtmlMenu);
          }
          $xhtmlMenu .= '</li>';
        }
      }
      $xhtmlMenu .= '</ul>';
      return $xhtmlMenu;
    }
    public static function showAttrGroup($string) {
      $params['id'] = json_decode($string);
      $groupAttr = new GroupAttr();
      $result = $groupAttr->getItem($params,['task' => 'get-name']);
      return implode('<br>',$result) ;
    }
    public static function showAttribute($json) {
      $str = json_decode($json,true);
      $xhtml = '';
      foreach ($str as $key => $value) {
        $xhtml .= $value['name'].': '.implode(',',$value['value']).'<br>';
      }
      return $xhtml;
    }
    
  }
?>