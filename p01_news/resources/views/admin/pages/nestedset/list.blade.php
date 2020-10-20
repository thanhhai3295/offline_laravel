@php

$traverse = function ($categories, $prefix = '') use (&$traverse) {
    
    foreach ($categories as $category) {
        $name = PHP_EOL.$prefix.' '.$category->name;
        $ordering = '<a href="#" class="ordering"><i class="fa fa-arrow-up"></i></a><a href="#" class="ordering"><i class="fa fa-arrow-down"></i></a><input class="text-center form-control" type="text" value="'.$category->ordering.'" style="width:10%;display:inline">';
        $xhtml = '<tr>';
        $xhtml .= '<td><input type="checkbox" class="form-check-input"></td>
                  <td style="font-size:20px">'.$name.'</td>
                  <td>'.$ordering.'</td>
                  <td>'.$category->created.'</td>
                  <td>'.$category->created_by.'</td>
                  <td>'.$category->modified.'</td>
                  <td>'.$category->modified_by.'</td>
                  <td>'.$category->status.'</td>
                  <td>'.$category->id.'</td>';
        $xhtml .= '</tr>';
        echo $xhtml;
        $traverse($category->children, $prefix.'|----- ');
    }
};



@endphp

<div class="table-responsive">
  <table class="table table-striped jambo_table bulk_action">
    <thead>
      <tr class="headings">
        <th class="column-title"><input type="checkbox" class="form-check-input"></th>
        <th class="column-title">Name</th>
        <th class="column-title">Ordering</th>
        <th class="column-title">Created</th>
        <th class="column-title">Created By</th>
        <th class="column-title">Modified</th>
        <th class="column-title">Modified By</th>
        <th class="column-title">Status</th>
        <th class="column-title">ID</th>
      </tr>
    </thead>
      <tbody>          
          {{$traverse($items)}}
      </tbody>
  </table>
</div>
