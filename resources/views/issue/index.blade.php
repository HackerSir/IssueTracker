@extends('app')

@section('title', 'Issues')

@section('css')
    <style>
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
    <div class="ui attached segment" style="padding: 0;">
        <div class="ui large very relaxed selection divided list">
            <div class="item">
                <i class="orange warning sign icon"></i>
                <div class="content">
                    <a href="#" class="header">There has some problem on blog</a>
                    <div class="description">#3 reopened 2 days ago by jyhsu</div>
                </div>
            </div>
            <div class="item">
                <i class="red warning sign icon"></i>
                <div class="content">
                    <a href="#" class="header">Lapulas~!</a>
                    <div class="description">#2 opened 1 days ago by vongola</div>
                </div>
            </div>
            <div class="item">
                <i class="green check circle icon"></i>
                <div class="content">
                    <a href="#" class="header">OmO</a>
                    <div class="description">#1 closed 30 seconds ago by danny</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#authorDropdown').popup({
            popup : $('#authorPopup'),
            inline   : true,
            position : 'bottom right',
            on: 'click'
        });
        $('#labelDropdown').popup({
            popup : $('#labelPopup'),
            inline   : true,
            position : 'bottom right',
            on: 'click'
        });
        $('#sortDropdown').popup({
            popup : $('#sortPopup'),
            inline   : true,
            position : 'bottom right',
            on: 'click'
        });
    </script>
@endsection