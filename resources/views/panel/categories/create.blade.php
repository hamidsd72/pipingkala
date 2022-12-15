@component('layouts.back')
  @slot('title') افزودن {{ $title }} @endslot
  @slot('body')
    <div class="card">
      <div class="card-header archive-card-header">
        <div class="archive-circle-wrap">
          <div class="archive-circle">
            <a href="/" target="_blank">

              <img src="{{ panel_logo() }}" style="margin-top: 10px;">
            </a>
          </div>
          <h2>افزودن {{ $title }}</h2>
        </div>
      </div>
      <div class="card-body">

        {{ Form::open(array('route' => 'category-store', 'method' => 'PUT','files' => true)) }}
          <div class="form-group">
            {{ Form::label('parent_id', 'زیر دسته ی') }}
            <select name="parent_id" id="parent_id" class="form-control">
              <option selected value="null">دسته اصلی</option>
              @foreach(App\Category::where('parent_id','>',0)->get() as $cats)
                <option value="{{$cats->id}}">{{$cats->name}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            {{ Form::label('name', 'نام') }}
            {{ Form::text('name', '', array('class' => 'form-control')) }}
          </div>

          <div class="form-group">
            {{ Form::label('slug', 'نامک') }}
            {{ Form::text('slug', '', array('class' => 'form-control')) }}
          </div>

          <div class="form-group form-group-select">
            {{ Form::label('active', 'نمایش یا عدم نمایش') }}
            {{ Form::select('active', array('1'=>'نمایش','0'=>' عدم نمایش'), '', array('class' => 'form-control')) }}
          </div>

          <div class="form-group">
            {{ Form::label('photo', 'تصویر') }}
            {{ Form::file('photo', array('accept' => 'image/*')) }}
          </div>

          <div class="form-group">
            {{ Form::label('icon', 'آیکون') }}
            {{ Form::file('icon', array('accept' => 'image/png')) }}
            <span>برای نمایش آیکون در کنار دسته بندی های هدر</span>
          </div>

          {{ Form::label('text', 'توضیح بالای دسته بندی') }}
          {{ Form::textarea('text', '', array('class' => 'form-control textarea')) }}
          <br>
          {{ Form::label('text1', 'توضیح پایین دسته بندی') }}
          {{ Form::textarea('text1', '', array('class' => 'form-control textarea')) }}
          <br>
          <a href="{{ URL::previous() }}" class="btn btn-rounded btn-secondary float-right"><i class="fa fa-chevron-circle-right ml-1"></i>بازگشت</a>
          {{ Form::button('<i class="fa fa-circle-o mtp-1 ml-1"></i>افزودن', array('type' => 'submit', 'class' => 'btn btn-rounded btn-primary float-left')) }}
        {{ Form::close() }}
      </div>
    </div>
  @endslot
  @push('scripts')
    <script src="{{ url('source/assets/editor/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ url('source/assets/editor/laravel-ckeditor/adapters/jquery.js') }}"></script>
    <script>
        var textareaOptions = {
            filebrowserImageBrowseUrl: '{{ url('filemanager?type=Images') }}',
            filebrowserImageUploadUrl: '{{ url('filemanager/upload?type=Images&_token=') }}',
            filebrowserBrowseUrl: '{{ url('filemanager?type=Files') }}',
            filebrowserUploadUrl: '{{ url('filemanager/upload?type=Files&_token=') }}',
            language: 'fa'
        };
        $('.textarea').ckeditor(textareaOptions);
        slug('#name', '#slug');
    </script>
  @endpush
@endcomponent