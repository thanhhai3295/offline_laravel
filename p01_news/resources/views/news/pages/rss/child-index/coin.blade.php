<div>
  <h3>Giá Coin</h3>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Tên</th>
        <th scope="col">Giá USD</th>
        <th scope="col">Thay Đổi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($item as $item)
        @php
          $sell = round($item['price_change']).'%';
        @endphp
        <tr>
          <td>{{$item['name']}}</td>
          <td>{{$item['current_price']}}</td>
          <td>{{$sell}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>