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
          <td>Nama</td>
          <td>SKS</td>
          <td>Date</td>
          <td>Dosen</td>
          <td colspan="2 text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($course as $key=>$c)
        <tr>
            <?php 
              $date = strtotime($c['begin_time']);
              $new_date = date('l H:i', $date);
            ?>
            <td>{{$c['id']}}</td>
            <td>{{$c['name']}}</td>
            <td>{{$c['sks']}}</td>
            <td>{{$new_date}}</td>
            <td>{{$c['teacher']['fullname']}}</td>
            <td><a href="{{ route('matkul.edit', $c["id"])}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('matkul.destroy', $c["id"])}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <a href="{{ route('matkul.create')}}" class="btn btn-primary">Create new Matkul</a>
<div>
@endsection