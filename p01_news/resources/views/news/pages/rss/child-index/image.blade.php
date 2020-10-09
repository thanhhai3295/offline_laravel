@php
  $name = $item['name'];
  $thumb = $item['thumb'];
  $link = $item['link'];
@endphp
<div class="post_image">
  <a href="{{$link}}">
    <img src="{{$thumb}}" alt="{{$name}}" class="img-fluid w-100">
  </a>
</div>