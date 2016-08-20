@extends('app')

@section('title', "$issue->title"." :: Issue#"."$issue->id")

@section('content')
    <div class="ui internally celled grid">
        <div class="row">
            <div class="column">
                <h1 class="ui header">{{ $issue->title }} <span style="color:grey;">#{{ $issue->id }}</span></h1>
            </div>
        </div>
        <div class="two column row">
            <div class="twelve wide column">
                <div class="ui comments">
                    {{-- TODO: Insert history between comment --}}
                    @foreach($issue->comments as $comment)
                        <div class="comment">
                            <a href="javascript:void(0)" class="avatar">
                                <img src="{{ Gravatar::src($comment->author->email, 200) }}" class="ui image"
                                     id="gravatar"/>
                            </a>
                            <div class="content">
                                <div class="ui segments">
                                    <div class="ui top attached segment">
                                        {{ $comment->author->name }}
                                        commented {{ $comment->created_at->diffForHumans() }}
                                    </div>
                                    <div class="ui attached segment">
                                        {{ $comment->content }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="four wide column">
                {{-- FIXME: Display at the wrong place --}}
                <div class="ui multiple dropdown">
                    <input type="hidden" name="filters">
                    <i class="tag icon"></i>
                    <span class="text">Label</span>
                    <div class="menu">
                        <div class="header">
                            Apply labels to this issue
                        </div>
                        <div class="ui icon search input">
                            <i class="search icon"></i>
                            <input type="text" placeholder="Search tags...">
                        </div>
                        <div class="divider"></div>
                        <div class="scrolling menu">
                            @foreach($labels as $label)
                                <div class="item" data-value="{{ $label->name }}">
                                    <div class="ui {{ $label->color }} empty circular label"></div>
                                    {{ $label->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection