@extends('Admin.Layout.master')

@section('content')
<div class="page-inner">
    <div class="page-header"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit How It Works</h4>
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
                    <form action="{{ route('admin.howitwork.update', $howItWork->id) }}" 
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" 
                                   id="title" value="{{ old('title', $howItWork->title) }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" 
                                      id="description" rows="3">{{ old('description', $howItWork->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="button_text">Button Text</label>
                            <input type="text" name="button_text" class="form-control" 
                                   id="button_text" value="{{ old('button_text', $howItWork->button_text) }}">
                        </div>

                        <div class="form-group">
                            <label for="button_link">Button Link</label>
                            <input type="text" name="button_link" class="form-control" 
                                   id="button_link" value="{{ old('button_link', $howItWork->button_link) }}">
                        </div>

                        {{-- Section 1 --}}
                        <div class="form-group">
                            <label for="section1_title">Section 1 Title</label>
                            <input type="text" name="section1_title" class="form-control" 
                                   id="section1_title" value="{{ old('section1_title', $howItWork->section1_title) }}">
                        </div>
                        <div class="form-group">
                            <label for="section1_desc">Section 1 Description</label>
                            <textarea name="section1_desc" class="form-control" 
                                      id="section1_desc" rows="3">{{ old('section1_desc', $howItWork->section1_desc) }}</textarea>
                        </div>

                        {{-- Section 2 --}}
                        <div class="form-group">
                            <label for="section2_title">Section 2 Title</label>
                            <input type="text" name="section2_title" class="form-control" 
                                   id="section2_title" value="{{ old('section2_title', $howItWork->section2_title) }}">
                        </div>
                        <div class="form-group">
                            <label for="section2_desc">Section 2 Description</label>
                            <textarea name="section2_desc" class="form-control" 
                                      id="section2_desc" rows="3">{{ old('section2_desc', $howItWork->section2_desc) }}</textarea>
                        </div>

                        {{-- Section 3 --}}
                        <div class="form-group">
                            <label for="section3_title">Section 3 Title</label>
                            <input type="text" name="section3_title" class="form-control" 
                                   id="section3_title" value="{{ old('section3_title', $howItWork->section3_title) }}">
                        </div>
                        <div class="form-group">
                            <label for="section3_desc">Section 3 Description</label>
                            <textarea name="section3_desc" class="form-control" 
                                      id="section3_desc" rows="3">{{ old('section3_desc', $howItWork->section3_desc) }}</textarea>
                        </div>

                        {{-- Section 4 --}}
                        <div class="form-group">
                            <label for="section4_title">Section 4 Title</label>
                            <input type="text" name="section4_title" class="form-control" 
                                   id="section4_title" value="{{ old('section4_title', $howItWork->section4_title) }}">
                        </div>
                        <div class="form-group">
                            <label for="section4_desc">Section 4 Description</label>
                            <textarea name="section4_desc" class="form-control" 
                                      id="section4_desc" rows="3">{{ old('section4_desc', $howItWork->section4_desc) }}</textarea>
                        </div>

                        {{-- Image --}}
                        <div class="form-group">
                            <label for="serviceImage">Choose Image</label>
                            <input type="file" name="image" class="form-control" id="serviceImage">
                            @if($howItWork->image)
                                <div class="mt-2">
                                    <img src="{{ url('public/' . $howItWork->image) }}" alt="banner-image" width="50">
                                </div>
                            @endif
                        </div>

                        {{-- Status --}}
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="active" {{ old('status', $howItWork->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $howItWork->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        {{-- Submit --}}
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Update</button>
                        </div>

                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
