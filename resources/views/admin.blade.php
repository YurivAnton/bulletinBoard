@extends('layouts.layout')

   {{-- {{ dump($table) }}--}}

@section('nav')
    <nav>
        <div class="container">
            <div class="row">
                <ul class="nav nav-tabs">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="">Users<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/admin?user=all">All</a></li>
                            @foreach($users as $user)
                                <li><a href="/admin?user={{ $user->name }}">{{ $user->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="">Bulletins category<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/admin?bulletin=all">All</a></li>
                            @foreach($categories as $category)
                                <li class="divider"></li>
                                <li><a href="/admin?bulletin={{ $category->id }}">{{ $category->name }}</a></li>
                                @foreach($subCategories as $subcategory)
                                    @if($subcategory->category_id == $category->id)
                                        <li><a href="/admin?bulletin={{ $subcategory->name }}">{{ $subcategory->name }}</a></li>
                                    @endif
                                @endforeach
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="">ADD<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/admin?add=category">Category</a></li>
                            <li><a href="/admin?add=subCategory">Subcategory</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endsection

@section('main')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('table')

    @yield('form')

@endsection