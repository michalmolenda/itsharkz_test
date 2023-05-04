@extends('app')

@section('content')
    <h4>Feedback form</h4><br>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Sorry</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('feedback.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="mb-3">
            <label class="form-label">E-mail <span style="color:red">*</span>:</label>
            <input
                type="email"
                name="email"
                class="form-control"
                @error('email') style="border: 1px solid red;" @enderror
                placeholder="E-mail address"
                required
            >

            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Name <span style="color:red">*</span>:</label>
            <input
                type="text"
                name="name"
                class="form-control"
                @error('name') style="border: 1px solid red;" @enderror
                placeholder="Name"
                required
            >

            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Rate <span style="color:red">*</span>:</label>
            <select name="rate" class="form-control" required>
                <option value=""></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>

            @error('rate')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Comment:</label>
            <textarea name="comment" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">File:</label>
            <input
                type="file"
                name="file"
                class="form-control"
            >
            @error('file')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
@endsection
