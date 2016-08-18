@extends('app')

@section('title', 'Issues')

@section('css')
    <style>
        @media only screen and (max-width: 767px){
            #authorDropdown {
                visibility: hidden;
            }
            #labelDropdown {
                visibility: hidden;
            }
            #sortDropdown {
                visibility: hidden;
            }
        }
        div.very.relaxed > div.item {
            padding-top: .85714286em !important;
            padding-bottom: .85714286em !important;
        }
    </style>
@endsection

@section('content')
    <div class="ui right aligned inverted green button"><i class="plus icon"></i>New Issue</div>
    <div class="ui top attached grey segment" style="padding: 0;">
        @include('issue.menu')
    </div>
    @if($issues->total() == 0)
        <div class="ui very padded attached segment" style="height: 50vh;background-color: #f0f0f0">
            <div class="ui middle aligned center aligned grid" style="height: 100%">
                <div class="column">
                    <i class="grey huge warning circle icon"></i>
                    <h2 class="ui header">Welcome to Issues!</h2>
                    <p style="font-size: 1.1em">Issues are used to track todos, ask quections, and more. As issues are created, they’ll appear here in a searchable and filterable list. To get started, you should <a href="{{ route('issue.create') }}">create an issue</a>.</p>
                </div>
            </div>
        </div>
    @else
        <div class="ui attached segment" style="padding: 0;">
            <div class="ui large very relaxed selection divided list">
                @foreach($issues as $issue)
                    <div class="item">
                        @if($issue->status()->name == 'Opened')
                            <i class="red warning sign icon"></i>
                        @elseif($issue->status()->name == 'Reopened')
                            <i class="orange warning sign icon"></i>
                        @else
                            <i class="green check circle icon"></i>
                        @endif
                        <div class="content">
                            <a href="{{ route('issue.show', ['issue' => $issue]) }}" class="header">{{ $issue->title }}</a>
                            <div class="description">#{{ $issue->id }} @if($issue->status()->name == 'Opened') opened @elseif($issue->status()->name == 'Reopened') reopened  @else closed @endif 2 days ago by NAME</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

@endsection

@section('js')
    <script>
        $('#authorDropdown').popup({
            popup: $('#authorPopup'),
            inline: true,
            position: 'bottom right',
            on: 'click'
        });
        $('#labelDropdown').popup({
            popup: $('#labelPopup'),
            inline: true,
            position: 'bottom right',
            on: 'click'
        });
        $('#sortDropdown').popup({
            popup: $('#sortPopup'),
            inline: true,
            position: 'bottom right',
            on: 'click'
        });
    </script>
@endsection