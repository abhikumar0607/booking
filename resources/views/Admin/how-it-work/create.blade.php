@extends('Admin.Layout.master')

@section('content')
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add How It works</h4>
                </div>
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('admin.submit.howitwork') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" name="title" class="form-control" id="title">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="button_text">Button Text</label>
                            <input type="text" name="button_text" class="form-control" id="button_text">
                        </div>
                        <div class="form-group">
                            <label for="button_link">Button Link</label>
                            <input type="text" name="button_link" class="form-control" id="button_link">
                        </div>
                        <div class="form-group">
                            <label for="section1_title">Section 1 Title</label>
                            <input type="text" name="section1_title" class="form-control" id="section1_title">
                        </div>
                        <div class="form-group">
                            <label for="section1_desc">Section 1 Description</label>
                            <textarea name="section1_desc" class="form-control" id="section1_desc" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="section2_title">Section 2 Title</label>
                            <input type="text" name="section2_title" class="form-control" id="section2_title">
                        </div>
                        <div class="form-group">
                            <label for="section2_desc">Section 2 Description</label>
                            <textarea name="section2_desc" class="form-control" id="section2_desc" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="section3_title">Section 3 Title</label>
                            <input type="text" name="section3_title" class="form-control" id="section3_title">
                        </div>
                        <div class="form-group">
                            <label for="section3_desc">Section 3 Description</label>
                            <textarea name="section3_desc" class="form-control" id="section3_desc" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="section4_title">Section 4 Title</label>
                            <input type="text" name="section4_title" class="form-control" id="section4_title">
                        </div>
                        <div class="form-group">
                            <label for="section4_desc">Section 4 Description</label>
                            <textarea name="section4_desc" class="form-control" id="section4_desc" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-control" for="logo">Choose Image</label>
                            <input type="file" name="image" class="form-control" id="serviceImage">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>

                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection