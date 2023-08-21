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
          <td>Nama Tugas</td>
          <td>Deskripsi Tugas</td>
          <td>Matkul Kelas</td>
          <td>Deadline Tugas</td>
          @if(Auth::user()->role == 1 )
          <td colspan="2 text-center">Action</td>
          @endif
        </tr>
    </thead>
    <tbody>
        @foreach($assignment as $key=>$a)
        <?php 
            $date = strtotime($a['deadline']);
            $new_date = date('l, d-M-Y  H:i', $date);
        ?>
        <tr>
            <td>{{$a['id']}}</td>
            <td>{{$a['name']}}</td>
            <td>{{$a['description']}}</td>
            <td>{{$a['course']['name']}}</td>
            <td>{{$new_date}}</td>
            @if(Auth::user()->role == 1 )
            <td><a href="{{ route('kelas.edit', $a['id'])}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('kelas.destroy', $a['id'])}}" method="post">
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
  <a href="{{ route('kelas.create')}}" class="btn btn-primary">Create new Assignment</a>
<div>
@endsection
{{-- @foreach($kelas as $key => $k)
<option value="{{$k["id"]}}">{{$k["class_type"]}}</option>
@endforeach --}}