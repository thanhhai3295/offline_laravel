@php
    use App\Helpers\Template as Template; 
    use App\Helpers\Highlight as Highlight; 

@endphp
<div class="table-responsive">
  <table class="table table-striped jambo_table bulk_action">
    <thead>
      <tr class="headings">
        <th class="column-title">#</th>
        <th class="column-title">Product Info</th>
        <th class="column-title">Price</th>
        <th class="column-title">Attribute</th>
        <th class="column-title">Category Name</th>
        <th class="column-title">Thumb</th>
        <th class="column-title">Trạng thái</th>
        <th class="column-title">Hành động</th>
      </tr>
    </thead>
      <tbody>          
        @if (count($items) > 0)
        @foreach ($items as $key => $value)   
          @php
            $arrThumb = json_decode($value['thumb'],true);
            $value['thumb']  = $arrThumb[0]['name'];
            $id              = $value['id'];
            $index           = $key + 1;
            $class           = ($index % 2 == 0 ) ? 'event' : 'odd';
            $name            = Highlight::show($value['name'],$params['search'],'name');
            $price           = Form::text('price',$value['price'],['class' => 'form-control','data-id' => $id,'data-url' => route($controllerName.'/price',['price' => 'value','id' => $id])]);
            $attribute       = Template::showAttribute($value['attribute']);
            $thumb           = Template::showItemThumb($controllerName,$value['thumb'],$value['name']);
            $createdHistory  = Template::showItemHistory($value['created_by'],$value['created']);
            $modifiedHistory = Template::showItemHistory($value['modified_by'],$value['modified']);
            $status          = Template::showItemStatus($controllerName,$id,$value['status']);  
            $category        = Template::showItemSelectCategory($controllerName,$id,$value['category_id'],$category);
            $listBtnAction   = Template::showButtonAction($controllerName,$id);
          @endphp 
          <tr class="{{ $class }} pointer">
            <td>{{ $index }}</td>
            <td>
              <p><strong>Name:</strong> {!! $name !!}</p>
            </td>
            <td width="10%">{!! $price !!}</td>
            <td>{!! $attribute !!}</td>
            <td>{!! $category !!}</td>
            <td width="10%">{!! $thumb !!}</td>
            <td>{!! $status !!}</td>
            <td width="8%" class="last">{!! $listBtnAction !!}</td>
          </tr>
        @endforeach
        @else
          @include('admin.templates.list_empty',['colspan' => 7])
        @endif                              
            
      </tbody>
  </table>
</div>
