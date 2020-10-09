<div>
  <h3>Giá Vàng</h3>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Loại Vàng</th>
        <th scope="col">Mua</th>
        <th scope="col">Bán</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($item as $item)
        <tr>
          <td>{{$item['type']}}</td>
          <td>{{$item['buy']}}</td>
          <td>{{$item['sell']}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
<hr>