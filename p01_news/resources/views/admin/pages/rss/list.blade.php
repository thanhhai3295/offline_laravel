@php
    use App\Helpers\Template as Template; 
    use App\Helpers\Highlight as Highlight; 
@endphp
<div class="table-responsive">
  <table class="table table-striped jambo_table bulk_action">
    <thead>
      <tr class="headings">
        <th class="column-title">#</th>
        <th class="column-title">RSS Info</th>
        <th class="column-title">Ordering</th>
        <th class="column-title">Trạng thái</th>
        <th class="column-title">Source</th>
        <th class="column-title">Tạo mới</th>
        <th class="column-title">Chỉnh sửa</th>
        <th class="column-title">Hành động</th>
      </tr>
    </thead>
      <tbody>          
        @if (count($items) > 0)
        @foreach ($items as $key => $value)
          @php
            $id              = $value['id'];
            $index           = $key + 1;
            $class           = ($index % 2 == 0 ) ? 'event' : 'odd';
            $name            = Highlight::show($value['name'],$params['search'],'name');
            $ordering        = Form::text('ordering',$value['ordering'],['class' => 'form-control','data-id' => $id,'data-url' => route($controllerName.'/ordering',['ordering' => 'value','id' => $id])]);
            $link            = Highlight::show($value['link'],$params['search'],'link');
            $source          = Template::showItemSelect($controllerName,$id,$value['source'],'source');
            $createdHistory  = Template::showItemHistory($value['created_by'],$value['created']);
            $modifiedHistory = Template::showItemHistory($value['modified_by'],$value['modified']);
            $status          = Template::showItemStatus($controllerName,$id,$value['status']);
            $listBtnAction   = Template::showButtonAction($controllerName,$id);
          @endphp 
          <tr class="{{ $class }} pointer">
            <td>{{ $index }}</td>
            <td width="35%">
              <p><strong>Name:</strong> {!! $name !!}</p>
              <p><strong>Link:</strong> {!! $link !!}</p>
            </td>
            <td width="5%">{!! $ordering !!}</td>
            <td width="5%">{!! $status !!}</td>
            <td width="10%">{!! $source !!}</td>
            <td>{!! $createdHistory !!}</td>           
            <td>{!! $modifiedHistory !!}</td>
            <td class="last">{!! $listBtnAction !!}</td>
          </tr>
        @endforeach
        @else
          @include('admin.templates.list_empty',['colspan' => 6])
        @endif                              
            
      </tbody>
  </table>
</div>
