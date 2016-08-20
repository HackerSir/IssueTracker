<div class="ui secondary menu" style="margin: 0;">
    {{-- 狀態清單 --}}
    @foreach(\IssueTracker\Status::all() as $status)
        <a href="javascript:void(0)" class="item">
            {!! $status->icon !!}
            {{ $status->issues->count() }}
            {{ $status->name }}
        </a>
    @endforeach
    {{-- 把剩下的東西推到右邊 --}}
    <div class="right item"></div>
    {{-- 篩選選單 --}}
    {{-- 參與者 --}}
    <div class="ui dropdown browse item @if(count($participants)==0)disabled @endif">
        Participant <i class="dropdown icon"></i>
        <div class="menu">
            <div class="header">Filter by participant</div>
            <div class="ui icon search input">
                <i class="search icon"></i>
                <input type="text" placeholder="Filter users...">
            </div>
            <div class="scrolling menu">
                @foreach($participants as $user)
                    {{-- TODO: 過濾 --}}
                    <div class="item">
                        {{ Html::image(Gravatar::src($user->email, 80), null, ['class'=>'ui tiny avatar image']) }}
                        {{ $user->name }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- 標籤 --}}
    <div class="ui dropdown browse item @if(count($labels)==0)disabled @endif">
        Label <i class="dropdown icon"></i>
        <div class="menu">
            <div class="header">Filter by label</div>
            <div class="ui icon search input">
                <i class="search icon"></i>
                <input type="text" placeholder="Filter labels...">
            </div>
            <div class="scrolling menu">
                @foreach($labels as $label)
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
        Sort <i class="dropdown icon"></i>
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
