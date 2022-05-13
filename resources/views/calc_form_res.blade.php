<div>Зарплата сотрудника: {{$itog}}</div>

@foreach($taxes as $key=>$tax)
    <div>{{$key}} = {{$tax}}</div>
@endforeach
