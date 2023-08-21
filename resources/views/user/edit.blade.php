@extends('layouts.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Data User
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('user.update', $user->id ) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Nama :</label>
              <input type="text" class="form-control" name="name" value="{{ $user->name }}"/>
          </div>
          <div class="form-group">
              <label for="cases">Email :</label>
              <input type="text" class="form-control" name="email" value="{{ $user->email }}"/>
          </div>
          <div class="form-group">
              <label for="cases">Password :</label>
              <input type="password" class="form-control" name="password" value=""/>
          </div>
          <div class="form-group">
              <label for="cases">Nomor Identitas :</label>
              <input type="text" class="form-control" name="nomor_identitas" value="{{ $user->nomor_identitas }}"/>
          </div>
          <div class="form-group">
              <label for="cases">Role :</label>
              <select id="defaultSelect" name="role" class="form-select">
                <option disabled value="">Pilih Role</option>
                <option @if($user->role == 1) selected @endif value="1">Admin</option>
                <option @if($user->role == 2) selected @endif value="2">Dosen</option>
                <option @if($user->role == 3) selected @endif value="3">Mahasiswa</option>
              </select>
          </div>
          <button type="submit" class="btn btn-primary">Update Data</button>
      </form>
  </div>
</div>
@endsection