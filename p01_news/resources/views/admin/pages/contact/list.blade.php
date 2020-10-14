@php
    use App\Helpers\Template as Template; 
    use App\Helpers\Highlight as Highlight; 
@endphp
<div class="table-responsive">
  <table class="table table-striped jambo_table bulk_action">
    <thead>
      <tr class="headings">
        <th class="column-title">#</th>
        <th class="column-title">Name</th>
        <th class="column-title">Email</th>
        <th class="column-title">Phone</th>
        <th class="column-title">Message</th>
        <th class="column-title">Status</th>
        <th class="column-title">Time</th>
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
            $email            = Highlight::show($value['email'],$params['search'],'email');    
            $phone            = Highlight::show($value['phone'],$params['search'],'phone');    
            $message            = Highlight::show($value['message'],$params['search'],'message');    
            $created          = Template::showTime($value['created']);
            $status          = Template::showItemContact($controllerName,$id,$value['status']);
            $listBtnAction   = Template::showButtonAction($controllerName,$id);
          @endphp 
          <tr class="{{ $class }} pointer">
            <td>{{ $index }}</td>
            <td> {!! $name !!} </td>
            <td> {!! $email !!} </td>
            <td > {!! $phone !!} </td>
            <td > {!! $message !!} </td>
            <td>{!! $status !!}</td>
            <td>{!! $created !!}</td>           
            <td class="last">{!! $listBtnAction !!}</td>
          </tr>
        @endforeach
        @else
          @include('admin.templates.list_empty',['colspan' => 7])
        @endif                              
            
      </tbody>
  </table>
</div>
