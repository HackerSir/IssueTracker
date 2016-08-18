@extends('app')

@section('title', 'Issues')

@section('content')
    <div class="ui right aligned inverted green button"><i class="plus icon"></i>New Issue</div>
    <div class="ui top attached segment">

    </div>
    <div class="ui attached segment">
        <div class="ui selection divided list">
            <div class="item">
                <i class="circular orange warning icon"></i>
                <div class="content">
                    <a href="#" class="header">There has some problem on blog</a>
                    <div class="description">#3 reopened 2 days ago by jyhsu</div>
                </div>
            </div>
            <div class="item">
                <i class="circular red warning icon"></i>
                <div class="content">
                    <a href="#" class="header">Lapulas~!</a>
                    <div class="description">#2 opened 1 days ago by vongola</div>
                </div>
            </div>
            <div class="item">
                <i class="circular green check icon"></i>
                <div class="content">
                    <a href="#" class="header">OmO</a>
                    <div class="description">#1 closed 30 seconds ago by danny</div>
                </div>
            </div>
        </div>
    </div>
@endsection