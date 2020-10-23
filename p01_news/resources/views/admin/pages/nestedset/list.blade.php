@php
use App\Helpers\Template;
@endphp

<div class="table-responsive">
  <table class="table table-striped jambo_table bulk_action">
    <thead>
      <tr class="headings">
        <th class="column-title">ID</th>
        <th class="column-title">Name</th>
        <th class="column-title">Ordering</th>
        <th class="column-title">Created</th>
        <th class="column-title">Modified</th>
        <th class="column-title">Status</th>
        <th class="column-title">Hành Động</th>
      </tr>
    </thead>
      <tbody>          
          {{Template::showTree($controllerName,$items)}}
      </tbody>
  </table>
</div>
