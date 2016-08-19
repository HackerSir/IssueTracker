<div class="ui secondary menu" style="margin: 0;">
    {{-- 狀態清單 --}}
    @foreach(\IssueTracker\Status::all() as $status)
        <a href="javascript:void(0)" class="item">{!! $status->icon !!}{{ $status->name }}</a>
    @endforeach
    {{-- 把剩下的東西推到右邊 --}}
    <div class="right item"></div>
    {{-- 篩選選單 --}}
    {{-- 參與者 --}}
    <div class="ui dropdown browse item @if(\App\User::count()==0)disabled @endif">
        Participant&nbsp;
        <i class="dropdown icon"></i>
        <div class="menu">
            <div class="header">Filter by participant</div>
            <div class="ui icon search input">
                <i class="search icon"></i>
                <input type="text" placeholder="Filter users...">
            </div>
            <div class="scrolling menu">
                {{-- FIXME: 應過濾，僅顯示有參與過的使用者 --}}
                @foreach(\App\User::all() as $user)
                    {{-- TODO: 過濾 --}}
                    <div class="item">
                        <div class="ui red empty circular label"></div>
                        {{ $user->name }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- 標籤 --}}
    <div class="ui dropdown browse item @if(\IssueTracker\Label::count()==0)disabled @endif">
        Label&nbsp;
        <i class="dropdown icon"></i>
        <div class="menu">
            <div class="header">Filter by label</div>
            <div class="ui icon search input">
                <i class="search icon"></i>
                <input type="text" placeholder="Filter labels...">
            </div>
            <div class="scrolling menu">
                @foreach(\IssueTracker\Label::all() as $label)
                    {{-- TODO: 過濾 --}}
                    <div class="item">
                        <div class="ui red empty circular label"></div>
                        {{ $label->name }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- 排序 --}}
    <div class="ui floating dropdown browse item">
        Sort&nbsp;
        <i class="dropdown icon"></i>
        <div class="menu">
            <div class="header">Sort by</div>
            <div class="scrolling menu">
                {{-- TODO: 排序 --}}
                <a class="item">Newest</a>
                <a class="item">Oldest</a>
                <a class="item">Most Comment</a>
                <a class="item">Least Comment</a>
                <a class="item">Recently Update</a>
                <a class="item">Least Recently Update</a>
            </div>
        </div>
    </div>
</div>
