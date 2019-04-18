@extends('layouts.updates-layout')

@section('title', 'Create Article')


<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=your_API_key"></script>
<script>
  tinymce.init({
    selector: '#body',
    height: 500,
    plugins: "link code codesample fullscreen table anchor media",
    toc_depth: 3,
    toc_header: "div",
    media_live_embeds: true,
    codesample_languages: [
		{text: 'HTML/XML', value: 'markup'},
		{text: 'JavaScript', value: 'javascript'},
		{text: 'CSS', value: 'css'},
		{text: 'PHP', value: 'php'},
		{text: 'Ruby', value: 'ruby'},
		{text: 'Python', value: 'python'},
		{text: 'Java', value: 'java'},
		{text: 'C', value: 'c'},
		{text: 'C#', value: 'csharp'},
		{text: 'C++', value: 'cpp'}
	],

  audio_template_callback: function(data) {
   return '<audio controls>' + '\n<source src="' + data.source1 + '"' + (data.source1mime ? ' type="' + data.source1mime + '"' : '') + ' />\n' + '</audio>';
 }

  });
</script>

@section('content')
<h3>Create New Article</h3>
<hr>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form enctype="multipart/form-data" method="POST" action="/articles/create">
    {{ csrf_field() }}
        <div class="form-group">
        <label for="exampleFormControlInput1">Title <small><i>(required)</i></small></label>
        <input name="title" type="text" class="form-control {{$errors->has('title') ? 'is-valid' : ''}}" id="exampleFormControlInput1" placeholder="Enter title here" value="{{old('title')}}">
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Description <small><i>(optional)</i></small></label>
        <textarea id="summernote" name="description" rows="3" class="form-control {{$errors->has('description') ? 'is-valid' : ''}}">{{old('description')}}</textarea>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Body <small><i>(required)</i></small></label>
        <textarea id="body" name="body" rows="10" class="form-control {{$errors->has('body') ? 'is-valid' : ''}}">{{old('body')}}</textarea>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Source <small><i>(optional)</i></small>
          </label>
          <input name="source" type="text" class="form-control {{$errors->has('source') ? 'is-valid' : ''}}" id="exampleFormControlInput1" placeholder="e.g www.github.com" value="{{old('source')}}">
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <div class="custom-file">
                    <input name="image" type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                    <label class="custom-file-label" for="image">Post Image <small><i>(required)</i></small></label>
                </div>
            </div>
        </div>

        <div class="card">
          <div class="card-header">
            <h1>Categories</h1>
            <input type="text" id="myInput" class="form-control form-control" onkeyup="myFunction()" style="margin-bottom:5px;" placeholder="Filter" title="Type in a name">

          </div>
          <div class="card-body" >
            @foreach ($categories as $category)
                <div class="form-check" id="myDIV">
                  <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="defaultCheck1" name="cats[]">
                  <label class="form-check-label" for="defaultCheck1">
                    {{ $category->name }}
                  </label>
                </div>
            @endforeach
          </div>
        </div><br>
        <button type="submit" class="btn btn-primary">Add Article</button>
      </form>
      <a href="/"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Discard</button></a>
      <br>

<script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myDIV *").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>
@endsection

