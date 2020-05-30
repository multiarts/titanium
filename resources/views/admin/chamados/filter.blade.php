@extends('layouts.app')

@section('content')
  <div class="content">
    <div class="container-fluid">
      <p>Xereca</p>
      {{--@foreach($chamado as $item)
        <p>
          {{ $item->number }}
        </p>
      @endforeach
      <hr>
      <p>Caralho</p>
      @foreach($chamado->byType('0') as $type)
        <p>
          {{ $type->number }}
        </p>
      @endforeach--}}

      <table class="table table-bordered">
        <tr>
          <th>Id</th>
          <th>Title</th>
        </tr>
        @foreach($data as $post)
          <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->name }}</td>
          </tr>
        @endforeach
      </table>
    </div>
    {{ $data->links() }}
  </div>
@endsection
