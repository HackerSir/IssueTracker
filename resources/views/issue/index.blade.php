@extends('app')

@section('title', 'Issues')

@section('css')
    <style>
        @media only screen and (max-width: 767px) {
            .browse.item {
                visibility: hidden;
            }
        }

        div.very.relaxed > div.item {
            padding-top: .85714286em !important;
            padding-bottom: .85714286em !important;
        }

        .ui.dropdown .menu > .header {
            text-transform: none;
        }
    </style>
@endsection

@section('content')
    {{-- 按鈕 --}}
    <a href="{{ route('issue.create') }}" class="ui right aligned inverted green button">
        <i class="plus icon"></i>New Issue
    </a>
    {{-- 過濾器 --}}
    <div style="display: inline-block">
        {!! SemanticForm::open()->action(route('issue.updateFilterPattern')) !!}
        {!! SemanticForm::input('filterPattern', $filterPattern)->appendIcon('search')->placeholder('Search all issues') !!}
        {!! SemanticForm::close() !!}
    </div>
    @if($filterPattern)
        <div style="display: inline-block">
            {!! SemanticForm::open()->action(route('issue.updateFilterPattern')) !!}
            {!! SemanticForm::hidden('filterPattern','') !!}
            <button type="submit" class="ui icon button" title="Clear current search query, filters, and sorts">
                <i class="remove icon"></i>
            </button>
            {!! SemanticForm::close() !!}
        </div>
    @endif
    {{-- 選單 --}}
    <div class="ui top attached grey segment" style="padding: 0;">
        @include('issue.menu')
    </div>

    @if($issues->total() == 0)
        <div class="ui very padded attached segment" style="height: 50vh;background-color: #f0f0f0">
            <div class="ui middle aligned center aligned grid" style="height: 100%">
                <div class="column">
                    <i class="grey huge warning circle icon"></i>
                    <h2 class="ui header">Welcome to Issues!</h2>
                    <p style="font-size: 1.1em">
                        Issues are used to track todos, ask quections, and more. As issues are
                        created, they’ll appear here in a searchable and filterable list. To get started, you should
                        <a href="{{ route('issue.create') }}">create an issue</a>.
                    </p>
                </div>
            </div>
        </div>
    @else
        <div class="ui attached segment" style="padding: 0;">
            <div class="ui large very relaxed selection divided list">
                @foreach($issues as $issue)
                    <div class="item">
                        {{-- Comment數量（不含主樓） --}}
                        @if($issue->comments->count() > 1)
                            <div class="right floated content">
                                <i class="talk outline icon"></i>
                                {{ $issue->comments->count() - 1 }}
                            </div>
                        @endif
                        {!! $issue->status->icon !!}
                        <div class="content">
                            <a href="{{ route('issue.show', $issue) }}" class="header">{{ $issue->title }}</a>
                            <div class="description">#{{ $issue->id }}
                                {{ strtolower($issue->status->name) }}
                                {{-- TODO: 最後一次狀態修改時間 --}}
                                2 days ago
                                {{-- TODO: 最後一次修改狀態者 --}}
                                by NAME
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @include('components.pagination-bar', ['models' => $issues])
    @endif

@endsection
