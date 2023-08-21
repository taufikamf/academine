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
          <td>Email</td>
          <td>Nomor Identitas</td>
          <td>Role</td>
          <td colspan="2 text-center">Action</td>
        </tr>
    </thead>
    <tbody>
      @php
      $roles = ['', 'Administrator', 'Dosen', 'Mahasiswa'];
      @endphp
        @foreach($user as $key=>$users)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$users->name}}</td>
            <td>{{$users->email}}</td>
            <td>{{$users->nomor_identitas}}</td>
            <td>{{ $roles[$users->role] }}</td>
            <td><a href="{{ route('user.edit', $users->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
              @if($users->role != 1)
                <form action="{{ route('user.destroy', $users->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
              @endif
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <a href="{{ route('user.create')}}" class="btn btn-primary">Create new User</a>
<div>
@endsection