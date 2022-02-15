@extends('layouts.layout')

@section('nav')
    <nav>
        {{--{{ dump($categories) }}
        <br>
        {{ dump($subCategories) }}--}}
        <div class="container">
            <div class="row">
                <ul class="nav nav-tabs">
                    @foreach($categories as $category)
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="">{{ $category->name }}<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/{{ $category->name }}">All</a></li>
                                @foreach($subCategories as $subCategory)
                                    @if($subCategory->category_id == $category->id)
                                        <li><a href="/{{ $category->name }}/{{ $subCategory->name }}">{{ $subCategory->name }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
@endsection

@section('main')
{{--{{ dump($bulletins) }}--}}
{{--{{ dump($sub->name) }}--}}
{{--{{ $cat }}--}}
{{--{{ dump($subCategories) }}--}}
    @foreach($bulletins as $bulletin)
        @if($bulletin->status == 1)
            {{ $bulletin->author }}
            <br>
            {{ $bulletin->text }}
            <br>
            {{ $bulletin-> created_at}}
            <br>
        @endif
    @endforeach
@endsection

@section('method')
    @if(Auth::check())
        <form action="/add" method="get" role="form">
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" id="author" value="{{ $user->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" class="form-control" id="category" value="{{ $cat->name }}" readonly>
            </div>
            @if(!empty($sub))
                <div class="form-group">
                    <label for="subcategory">Category</label>
                    <input type="text" name="subcategory" class="form-control" id="subcategory" value="{{ $sub->name }}" readonly>
                    <input type="hidden" name="subcategoryId" value="{{ $sub->id }}">
                </div>
            @else
                <div class="form-group">
                    <label for="subcategory">Category</label>
                    <select name="subcategoryId" class="form-control" id="subcategory">
                        @foreach($subCategories as $subCategory)
                            @if($subCategory->category_id == $cat->id)
                                <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="form-group">
                <label for="text">Text</label>
                <textarea type="text" name="text" class="form-control" id="text"></textarea>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Confirm</button>
                </div>
            </div>
        </form>
    @endif
@endsection