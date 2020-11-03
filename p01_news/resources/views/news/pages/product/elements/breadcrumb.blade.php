<div class="breadcrumb-section" style="margin:30px 0">
  <div class="container">
      <div class="row">
          <div class="col-sm-6">
              <div class="page-title">
                  <h2>product</h2>
              </div>
          </div>
          <div class="col-sm-6">
              <nav aria-label="breadcrumb" class="theme-breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                      @foreach ($item['breadcrumb'] as $key => $value)
                          @if ($key === array_key_last($item['breadcrumb']))
                              <li class="breadcrumb-item">{{$value['name']}}</li>
                          @else
                              <li class="breadcrumb-item active" aria-current="page"><a href="#">{{$value['name']}}</a></li>
                          @endif
                      @endforeach
                  </ol>
              </nav>
          </div>
      </div>
  </div>
</div>