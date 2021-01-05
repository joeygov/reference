@extends('layouts.user_app')
@section('title')
Today's Tracker
@endsection
@section('maincontent')
<div class="main-content-column">
    <div class="flex-container-column">
        <div class="date-today">{{date("F d, Y")}}</div>
        <div class="time-now" id="time"></div>
    </div>
    @if($show_time_in_btn)
        <div class="time-in-wfh center">
            <div class="flex-container-row center">
                <form method="POST" action="{{route('wfhtimein')}}">
                    @csrf
                    <button type="submit" class="btn btn-primary  btn-lg">
                        TIME IN
                    </button>
                </form>
            </div>
        </div>
    @else    
        <div class="flex-container-row flex-start">
            <div class="grow-1">
                <span class="label">Time In </span>
            </div>
            <div class="grow-3">
                @if($attendance->time_in)
                    {{$attendance->time_in->format('g:i A')}}
                @endif
            </div>
        </div>
        <div class="flex-container-row space-between">
            <div class="flex-container-row  grow-1 space-between">
                <div class="grow-1">
                    <span class="label"> 1st Break Start: </span>
                </div>
                <div class="grow-1">
                    @if(in_array('break1_start',$active_break_btns))
                        <form method="POST" action="{{route('b1start')}}">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                START
                            </button>
                        </form>
                    @elseif ($attendance->break1_start)
                        {{$attendance->break1_start->format('g:i A')}}
                    @endif
                </div>
            </div>
            <div class="flex-container-row grow-1 space-between">
                <div class="grow-1">
                    <span class="label">1st Break End:</span>
                </div>
                <div class="grow-1">
                    @if(in_array('break1_end',$active_break_btns))
                    <form method="POST" action="{{route('b1end')}}">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            END
                        </button>
                    </form>
                    @elseif($attendance->break1_end)
                        {{$attendance->break1_end->format('g:i A')}}
                    @endif
                </div>
            </div>
        </div>
        <div class="flex-container-row space-between">
            
            <div class="grow-1">
                <span class="label"> 2nd Break Start: </span>
            </div>
            <div class="grow-1">
                @if(in_array('break2_start',$active_break_btns))
                <form method="POST" action="{{route('b2start')}}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        START
                    </button>
                </form>
                @elseif($attendance->break2_start)
                    {{$attendance->break2_start->format('g:i A')}}
                @endif
            </div>
            <div class=" grow-1">
                <span class="label">2nd Break End:</span>
            </div>
            
            <div class="grow-1">
                @if(in_array('break2_end',$active_break_btns))
                <form method="POST" action="{{route('b2end')}}">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        END
                    </button>
                </form>
                @elseif($attendance->break2_end)
                    {{$attendance->break2_end->format('g:i A')}}
                @endif
            </div>


        </div>
        <div class="flex-container-row space-between">
            <div class=" grow-1">
                <span class="label">3rd Break Start: </span>
            </div>
            <div class="grow-1">
                @if(in_array('break3_start',$active_break_btns))
                <form method="POST" action="{{route('b3start')}}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        START
                    </button>
                </form>
                @elseif($attendance->break3_start)
                    {{$attendance->break3_start->format('g:i A')}}
                @endif
            </div>
            <div class=" grow-1">
                <span class="label">3rd Break End:</span>
            </div>
            <div class="grow-1">
                @if(in_array('break3_end',$active_break_btns))
                    <form method="POST" action="{{route('b3end')}}">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            END
                        </button>
                    </form>
                @elseif($attendance->break3_end)
                    {{$attendance->break3_end->format('g:i A')}}
                @endif
            </div>
        </div>
        <div class="flex-container-row space-between">
            <div class=" grow-1">
                <span class="label">4th Break Start: </span>
            </div>
            <div class="grow-1">
                @if(in_array('break4_start',$active_break_btns))
                <form method="POST" action="{{route('b4start')}}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        START
                    </button>
                </form>
                @elseif($attendance->break4_start)
                    {{$attendance->break4_start->format('g:i A')}}
                @endif
            </div>
            <div class=" grow-1">
                <span class="label">4th Break End:</span>
            </div>
            <div class="grow-1">
                @if(in_array('break4_end',$active_break_btns))
                <form method="POST" action="{{route('b4end')}}">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        END
                    </button>
                </form>
                @elseif($attendance->break4_end)
                    {{$attendance->break4_end->format('g:i A')}}
                @endif
            </div>
        </div>
        @if($user->is_wfh===false || ($user->is_wfh && $attendance->time_out) || ($user->is_wfh && !(in_array('out',$active_break_btns))))
        <div class="flex-container-row flex-start">
            <div class="grow-1">
                <span class="label">Time Out</span>
            </div>
            <div class="grow-3">
                @if($attendance->time_out)
                {{$attendance->time_out->format('g:i A')}}
                @endif
            </div>
        </div>
        @endif
    @endif

    @if($user->is_wfh && is_null($attendance->time_out) && in_array('out',$active_break_btns))
        <div class="flex-container-row center">
            <form method="POST" action="{{route('wfhtimeout')}}">
                @csrf
                <button type="submit" class="btn btn-primary  btn-lg">
                    TIME OUT
                </button>
            </form>
        </div>
    @endif
</div>
@endsection
@push('js')
<script>
    $(function() {
        display_ct();
    });
</script>
<script src="{{ asset('assets/js/entrypage/entrypage.js') }}" type="text/javascript"></script>
@endpush
