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
          <td>Nama Ujian</td>
          <td>Dosen Pelaksana</td>
          <td>Matkul Ujian</td>
          <td>Tanggal Mulai Ujian</td>
          <td>Tanggal Akhir Ujian</td>
          @if(Auth::user()->role == 1 )
          <td colspan="2 text-center">Action</td>
          @endif
        </tr>
    </thead>
    <tbody>
        @foreach($exam as $key=>$e)
        <?php 
            $start_date = strtotime($e['start_date']);
            $start_date = date('l, d-M-Y  H:i', $start_date);

            $end_date = strtotime($e['end_date']);
            $end_date = date('l, d-M-Y  H:i', $end_date);
        ?>
        <tr>
            <td>{{$e['id']}}</td>
            <td>{{$e['name']}}</td>
            <td>{{$e['teacher']['fullname']}}</td>
            <td>{{$e['course']['name']}}</td>
            <td>{{$start_date}}</td>
            <td>{{$end_date}}</td>
            @if(Auth::user()->role == 1 )
            <td><a href="{{ route('kelas.edit', $e['id'])}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('kelas.destroy', $e['id'])}}" method="post">
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
  <a href="{{ route('exam.create')}}" class="btn btn-primary">Create new Exams</a>
<div>
@endsection