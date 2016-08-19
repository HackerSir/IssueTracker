<div class="ui secondary menu" style="margin: 0;">
    {{-- 狀態清單 --}}
    @foreach(\IssueTracker\Status::all() as $status)
        <a href="#" class="item">{!! $status->icon !!}{{ $status->name }}</a>
    @endforeach
    {{-- 篩選選單 --}}
    <a href="#" class="right browse item" id="participantDropdown">Participant <i class="dropdown icon"></i></a>
    <a href="#" class="browse item" id="labelDropdown">Label <i class="dropdown icon"></i></a>
    <a href="#" class="browse item" id="sortDropdown">Sort <i class="dropdown icon"></i></a>
</div>
{{-- 參與 --}}
<div class="ui popup transition hidden" id="participantPopup">
    <div class="ui link list">
        {{-- FIXME: 應過濾，僅顯示有參與過的使用者 --}}
        @forelse(\App\User::all() as $user)
            <a class="item">{{ $user->name }}</a>
        @empty
            <a href="javascript:void(0)" class="item" disabled>（None）</a>
        @endforelse
    </div>
</div>
{{-- 標籤 --}}
<div class="ui popup transition hidden" id="labelPopup">
    <div class="ui link list">
        @forelse(\IssueTracker\Label::all() as $label)
            <a class="item">{{ $label->name }}</a>
        @empty
            <a href="javascript:void(0)" class="item" disabled>（None）</a>
        @endforelse
    </div>
</div>
{{-- 排序 --}}
<div class="ui popup transition hidden" id="sortPopup">
    <div class="ui link list">
        <a class="item">Newest</a>
        <a class="item">Oldest</a>
        <a class="item">Most Comment</a>
        <a class="item">Least Comment</a>
        <a class="item">Recently Update</a>
        <a class="item">Least Recently Update</a>
    </div>
</div>
