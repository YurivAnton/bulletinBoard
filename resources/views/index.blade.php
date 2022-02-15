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