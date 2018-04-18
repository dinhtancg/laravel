@extends('admin.layouts.admin.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if ($article)
                            <h3>Edit Article</h3>
                        @else
                            <h3>Create Article</h3>
                        @endif
                    </div>
                    <div class="panel-body">
                        <form method="post" action="{{ route('admin.article.createArticle') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @if ($article)
                                <input type="hidden" name="id" value="{{ $article->id }}" />
                            @endif
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name ="category">
                                    {!! $categoriesHtml !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name = "title" rows="1" value="{{ $article ? old('title', $article->title) : old('title', '') }}">
                                @if ($errors->has('title'))
                                    <p class="text-danger">{{ $errors->first('title')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="img-thumbnail">Image thumbnail</label>
                                <input type="file" id="img-thumbnail" name="thumbnail" value="">
                                @if ($article)
                                    <img class="thumbnail" src="{{ asset($article->thumbnail) }}" alt="" width="150px" height="150px">
                                @endif
                                @if ($errors->has('thumbnail'))
                                    <p class="text-danger">{{ $errors->first('thumbnail')}}</p>
                                @endif

                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control" rows="5" id="content-ckeditor" name = "content"> {{ $article ? old('content', $article->content) : old('content', '') }}</textarea>
                                @if ($errors->has('content'))
                                    <p class="text-danger">{{ $errors->first('content')}}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="comnment">Comment</label>
                                <textarea class="form-control" rows="5"  name = "comment"> {{ $article ? old('comment', $article->comment) : old('comment', '') }}</textarea>
                                @if ($errors->has('comment'))
                                    <p class="text-danger">{{ $errors->first('comment')}}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        @can('article-confirm')
                            <div class="form-group">

                                <form class="visible-lg-inline-block" action="{{ route('admin.article.confirm', $article->id ) }}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input class="btn btn-warning" type="submit" onclick="return confirm('Are you sure you want to CONFIRM this article?');" value="Confirm">
                                </form>
                            </div>
                        @endcan
                        @can('article-reject')
                            <div class="form-group">
                                <form class="visible-lg-inline-block" action="{{ route('admin.article.reject', $article->id ) }}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to REJECT this article?');" value="Reject">
                                </form>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'content', {
            filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
            filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
            filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
            filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
            filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
            filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
        } );
        CKEDITOR.replace( 'comment',{
            filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
            filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
            filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
            filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
            filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
            filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
        } );
    </script>
@endsection