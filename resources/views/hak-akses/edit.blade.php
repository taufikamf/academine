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
      <form method="post" action="{{ route('hak-akses.update', $role ) }}">
          @csrf
          @method('PATCH')
          @foreach($menus as $key => $menu)
          <input type="hidden" name="menu[{{$key}}]['id']" value="{{$menu->id}}">
          <input type="hidden" name="menu[{{$key}}]['id_akses']" value="{{$menu->access->id}}">
          <div class="form-group mb-2">
            <label for="formGroupExampleInput"><i class="menu-icon tf-icons bx {{$menu->icon}}"></i>{{ $menu->name }}</label>
          </div>
          <div class="form-group mb-4">
            <div class="form-check form-check-inline">
              <input type="hidden" name="menu[{{$key}}]['read']['id']" value="{{$menu->access->id}}">
              <input class="form-check-input" type="checkbox" name="menu[{{$key}}]['read']['value']" value="1" @if($menu->access->read) checked @endif>
              <label class="form-check-label">Read</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="hidden" name="menu[{{$key}}]['create']['id']" value="{{$menu->access->id}}">
              <input class="form-check-input" type="checkbox" name="menu[{{$key}}]['create']['value']" value="1" @if($menu->access->create) checked @endif>
              <label class="form-check-label">Create</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="hidden" name="menu[{{$key}}]['update']['id']" value="{{$menu->access->id}}">
              <input class="form-check-input" type="checkbox" name="menu[{{$key}}]['update']['value']" value="1" @if($menu->access->update) checked @endif>
              <label class="form-check-label">Update</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="hidden" name="menu[{{$key}}]['delete']['id']" value="{{$menu->access->id}}">
              <input class="form-check-input" type="checkbox" name="menu[{{$key}}]['delete']['value']" value="1" @if($menu->access->delete) checked @endif>
              <label class="form-check-label">Delete</label>
            </div>
            @if($menu->show_owned)
            <div class="form-check form-check-inline">
              <input type="hidden" name="menu[{{$key}}]['all_data']['id']" value="{{$menu->access->id}}">
              <input class="form-check-input" type="checkbox" name="menu[{{$key}}]['all_data']['value']" value="1" @if($menu->access->all_data) checked @endif>
              <label class="form-check-label">All Data</label>
            </div>
            @else()
              <input type="hidden" name="menu[{{$key}}]['all_data']['id']" value="{{$menu->access->id}}">
              <input type="hidden" name="menu[{{$key}}]['all_data']['value']" value="0">
            @endif
          </div>
          @endforeach
          <button type="submit" class="btn btn-primary">Update Data</button>
      </form>
  </div>
</div>
@endsection