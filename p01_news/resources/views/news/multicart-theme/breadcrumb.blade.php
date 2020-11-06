@php
    use App\Helpers\URL;
@endphp
<div class="breadcrumb-section" style="margin:30px 0">
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <div class="page-title">
                    <h2></h2>
                </div>
            </div>
            <div class="col-sm-10">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        @foreach ($item['breadcrumb'] as $key => $value)
                            @if ($key === array_key_last($item['breadcrumb']))
                                <li class="breadcrumb-item">{{$value['name']}}</li>
                            @else
                                @php 
                                    $link = URL::linkCatProduct($value['name'],$value['id']);
                                @endphp
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{$link}}">{{$value['name']}}</a>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>