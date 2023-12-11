@extends('layouts.app')

@section('content')
<link href="{{asset('/assets/styles/style.css')}}" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">{{ __('Edit Profile Details') }}</div>

                            <div class="card-body">
                                @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    <strong>Success!</strong> {{ session('success') }}
                                </div>
                                @endif
                                @if(session('error'))
                                <div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> {{ session('error') }}
                                </div>
                                @endif

                                <div class="">
                                    <form action="{{route('editProfile')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="form-group col-12">
                                                        <div class="avatar-upload">
                                                            <label for="profile_img" style="cursor: pointer; display: block;margin-left: auto;margin-right: auto;width: 200px; height: 200px;">
                                                                <img alt="image" class="img-fluid" id="dpShowLabel" style="cursor: pointer; display: block;margin-left: auto;margin-right: auto;width: 200px; height: 200px;" src="{{ asset('uploads/profile/' . (Auth::user()->image ? Auth::user()->image : 'avatar.jpg')) }}">
                                                            </label>
                                                            <input type="file" name="image" id="profile_img" class="visually-hidden" accept="image/*" hidden onchange="imageName(this)">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row mt-4">
                                                    <div class="form-group col-12">
                                                        <label for="name">Name</label>
                                                        <input type="name" class="form-control" id="name" name="name" required value="{{Auth()->user()->name}}">
                                                    </div>
                                                    <div class="form-group col-12 mt-2">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" required value="{{Auth()->user()->email}}">
                                                    </div>
                                                </div>
                                                <div class="row my-2">
                                                    <div class="col-12 text-end">
                                                        <button type="submit" class="btn btn-primary" style="width: 100px;">Update</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">{{ __('Change Password') }}</div>

                            <div class="card-body">
                                <div id="form-div" style="margin-top: 4.15rem !important;">
                                    <form action="{{route('editPassword')}}" method="post">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="form-group col-12">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password" name="password">
                                            </div>
                                        </div> <br>
                                        <div class="row mb-3">
                                            <div class="form-group col-12">
                                                <label for="password">Confirm Password</label>
                                                <input type="password" class="form-control" id="c_password" name="c_password">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-12 text-end">
                                                <button type="submit" class="btn btn-primary btn-sm" style="width: 100px;">Update</button>
                                            </div>
                                        </div>  
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
</script>
<script>
    function imageName(input) {
        var dpShowLabel = document.getElementById('dpShowLabel');
        console.log(input.files[0]);
        dpShowLabel.src = URL.createObjectURL(input.files[0]);
    }
</script>
@endsection