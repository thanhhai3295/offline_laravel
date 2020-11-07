@php
    use App\Helpers\Template as Template; 
    use App\Helpers\Highlight as Highlight; 
    $valuesProvince = Config::get('zvn.province');
@endphp
<div class="table-responsive">
  <table class="table table-striped jambo_table bulk_action">
    <thead>
      <tr class="headings">
        <th class="column-title">#</th>
        <th class="column-title">Province Info</th>
        <th class="column-title">Fee</th>
        <th class="column-title">Trạng thái</th>
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
            $province        = $valuesProvince[$value['province']]['name'];
            $fee        = Form::text('fee',$value['fee'],['class' => 'form-control','data-id' => $id,'data-url' => route($controllerName.'/fee',['fee' => 'value','id' => $id])]);
            $createdHistory  = Template::showItemHistory($value['created_by'],$value['created']);
            $modifiedHistory = Template::showItemHistory($value['modified_by'],$value['modified']);
            $status          = Template::showItemStatus($controllerName,$id,$value['status']);
            $listBtnAction   = Template::showButtonAction($controllerName,$id);
          @endphp 
          <tr class="{{ $class }} pointer">
            <td>{{ $index }}</td>
            <td width="40%"><p>{!! $province !!}</p></td>
            <td>{!! $fee !!}</td>
            <td>{!! $status !!}</td>
            <td>{!! $createdHistory !!}</td>           
            <td>{!! $modifiedHistory !!}</td>
            <td class="last">{!! $listBtnAction !!}</td>
          </tr>
        @endforeach
        @else
          @include('admin.templates.list_empty',['colspan' => 7])
        @endif                              
            
      </tbody>
  </table>
</div>
