@php
  use App\Helpers\Template as Template;
  use App\Helpers\URL;
  $name = $item['name'];
  $linkArticle  = $item['link'];
  $created = $item['pubDate'];
  if($lengthContent == 'full') {
    $content = $item['description'];
  } else {
    $content = Template::showContent($item['description'],$lengthContent);
  }
  
@endphp
<div class="post_content">
  
  <div class="post_title"><a href="{{$linkArticle}}">{{$name}}</a></div>
    <div class="post_info d-flex flex-row align-items-center justify-content-start">
        <div class="post_author d-flex flex-row align-items-center justify-content-start">
            <div class="post_author_name"><a href="#">HaiDepTrai</a>
            </div>
        </div>
    <div class="post_date"><a href="#">{{$created}}</a></div>
  </div>
  @if ($lengthContent > 0)
    <div class="post_text">
      <p>{!!$content!!}</p>
    </div>  
  @endif
</div>