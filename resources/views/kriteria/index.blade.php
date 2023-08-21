@extends('layouts.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Nama Matkul</td>
          <td>Nama Kriteria</td>
          @if(Auth::user()->role == 1)
          <td colspan="2 text-center">Action</td>
          @endif
        </tr>
    </thead>
    <tbody>
        @foreach($kriteria as $key=>$values)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$values->matkul->nama}}</td>
            <td>{{$values->nama}}</td>
            @if(Auth::user()->role == 1)
            <td><a href="{{ route('kriteria.edit', $values->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('kriteria.destroy', $values->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
  </table>
  <a href="{{ route('kriteria.create')}}" class="btn btn-primary">Create new Kriteria</a>
<div>
@endsection