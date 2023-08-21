@extends('layouts.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add User Data
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
      <form method="post" action="{{ route('user.store') }}">
          <div class="form-group">
              @csrf
              <label for="country_name">Nama :</label>
              <input type="text" class="form-control" name="name"/>
          </div>
          <div class="form-group">
              @csrf
              <label for="username">Username :</label>
              <input type="text" class="form-control" name="username"/>
          </div>
          <div class="form-group">
              @csrf
              <label for="country_name">Nomor Identitas :</label>
              <input type="number" class="form-control" name="nomor_identitas"/>
          </div>
          <div class="form-group">
              <label for="cases">Email :</label>
              <input type="text" class="form-control" name="email"/>
          </div>
          <div class="form-group">
              <label for="cases">Password :</label>
              <input type="password" class="form-control" name="password"/>
          </div>
          <div class="form-group">
              <label for="cases">Role :</label>
              <select id="defaultSelect" name="role" class="form-select">
                <option>Pilih Role</option>
                <option value="1">Admin</option>
                <option value="2">Dosen</option>
                <option value="3">Mahasiswa</option>
              </select>
          </div>
          <button type="submit" class="btn btn-primary">Add Data</button>
      </form>
  </div>
</div>
@endsection