@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h2 class="text-themecolor">UPDATE ROLES</h2>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Role</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div>
                    <a href="{{Route('role.list')}}" class="btn btn-primary waves-effect waves-light m-b-20">
                        <i class="mdi mdi-keyboard-backspace"></i>
                        BACK
                    </a>
                </div>

                <div class=" m-t-10">
                    <form method="POST" action="{{ Route('role.store.update') }}">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                                <label for="validationServer01">Nama Role</label>
                                <input type="hidden" name="id" value="{{$roles->id}}" />
                                <input type="text" name="name" value="{{$roles->name}}" class="form-control" placeholder="Contoh : edit user"
                                    required>
                                {{-- <div class="valid-feedback">
                                Looks good!
                              </div> --}}
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
