@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="fw-bold mt-5">Create Post</div>
          <form method="POST" action="{{ route('post.create') }}" id="myForm">
            @csrf
            <div class="form-group row my-3">
              <label for="title" class="col-md-4 col-form-label text-md-right required">Title<span class="text-danger ms-2">*</span></label>

              <div class="col-md-6">
                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">
                @error('title')
                    <span class="text-danger" id="err">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="form-group row my-3">
              <label for="description" class="col-md-4 col-form-label text-md-right required">Description<span class="text-danger ms-2">*</span></label>

              <div class="col-md-6">
                <textarea id="description" type="text" class="form-control" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-danger" id="err">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary me-3">
                  Confirm
                </button>
                <button type="reset" class="btn btn-secondary" id=""
                    onclick="document.getElementById('myForm').reset();
                            document.getElementById('title').value = null;
                            document.getElementById('description').value = null;
                            return false;">
                  Clear
                </button>
              </div>
            </div>
          </form>


    </div>
  </div>
</div>


@endsection
{{-- <script type="text/javascript">
    function resetForm(){
       document.getElementById('myForm').reset();
       document.getElementById('title').text = null;
       document.getElementById('description').text = null;
    }
   </script> --}}
{{-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}
{{-- <script type="text/javascript">
 $(document).ready(function(){
    $('#resetForm').click(function() {
      $('#title').val('');
      $('#description').val('');
    });
  });
</script> --}}


{{-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
$(document).ready(function(){
    $(".reset-btn").click(function(){
        $("#myForm").trigger("reset");
    });
});
</script> --}}
{{-- <script type="text/javascript">
let btnClear = document.getElementById('resetBtn');
let title = document.getElementById('title');
let desciption = document.getElementById('desciption');

btnClear.addEventListener('click', () => {
    //inputs.forEach(input =>  input.value = '');
    title.value = '';
    desciption.value = '';
});
</script> --}}

