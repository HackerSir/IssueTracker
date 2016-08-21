<div class="ui secondary menu" style="margin: 0;">
    {{-- 狀態清單 --}}
    @foreach(\IssueTracker\Status::all() as $status)
        <a href="{{ route('issue.index', ['update', 'is' => strtolower($status->name)]) }}" class="item">
            <span @if($filterPattern->data['is'] == strtolower($status->name))style=" font-weight: bold;" @endif>
                {!! $status->icon !!}
                {{-- 顯示根據 Filter Pattern 過濾後的數量 --}}
                {{ $statusCount[$status->id] or '0' }}
                {{ $status->name }}
            </span>
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
                <a href="{{ route('issue.index', ['update', 'sort' => 'created-desc']) }}" class="item">
                    @if($filterPattern->data['sort']=='created' && $filterPattern->data['desc']==true)
                        <i class="checkmark icon"></i>
                    @else
                        <i class="icon"></i>
                    @endif
                    Newest
                </a>
                <a href="{{ route('issue.index', ['update', 'sort' => 'created-asc']) }}" class="item">
                    @if($filterPattern->data['sort']=='created' && $filterPattern->data['desc']==false)
                        <i class="checkmark icon"></i>
                    @else
                        <i class="icon"></i>
                    @endif
                    Oldest
                </a>
                <a href="{{ route('issue.index', ['update', 'sort' => 'comments-desc']) }}" class="item">
                    @if($filterPattern->data['sort']=='comments' && $filterPattern->data['desc']==true)
                        <i class="checkmark icon"></i>
                    @else
                        <i class="icon"></i>
                    @endif
                    Most Comment
                </a>
                <a href="{{ route('issue.index', ['update', 'sort' => 'comments-asc']) }}" class="item">
                    @if($filterPattern->data['sort']=='comments' && $filterPattern->data['desc']==false)
                        <i class="checkmark icon"></i>
                    @else
                        <i class="icon"></i>
                    @endif
                    Least Comment
                </a>
                <a href="{{ route('issue.index', ['update', 'sort' => 'updated-desc']) }}" class="item">
                    @if($filterPattern->data['sort']=='updated' && $filterPattern->data['desc']==true)
                        <i class="checkmark icon"></i>
                    @else
                        <i class="icon"></i>
                    @endif
                    Recently Update
                </a>
                <a href="{{ route('issue.index', ['update', 'sort' => 'updated-asc']) }}" class="item">
                    @if($filterPattern->data['sort']=='updated' && $filterPattern->data['desc']==false)
                        <i class="checkmark icon"></i>
                    @else
                        <i class="icon"></i>
                    @endif
                    Least Recently Update
                </a>
            </div>
        </div>
    </div>
</div>
