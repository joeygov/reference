@extends('layouts.user_app')
@section('title')
Today's Tracker
@endsection
@section('maincontent')

<div class="main-content-column">
    <div class="flex-container-column">
        <div class="date-today">{{date("F d, Y")}}</div>
        <div class="time-now">{{date("h:i:s A")}}</div>
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
                Time In
            </div>
            <div class="grow-3">
                @if($attendance->time_in)
                    {{$attendance->time_in}}
                @endif
            </div>
        </div>
        <div class="flex-container-row space-between">
            <div class="flex-container-row  grow-1 space-between">
                <div class="grow-1">
                    1st Break Start: 
                </div>
                <div class="grow-1">
                    @if(in_array('break1_start',$active_break_btns))
                        <form method="POST" action="{{route('b1start')}}">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                START
                            </button>
                        </form>
                    @else
                        {{$attendance->break1_start}}
                    @endif
                </div>
            </div>
            <div class="flex-container-row grow-1 space-between">
                <div class="grow-1">
                    1st Break End:
                </div>
                <div class="grow-1">
                    @if(in_array('break1_end',$active_break_btns))
                    <form method="POST" action="{{route('b1end')}}">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            END
                        </button>
                    </form>
                    @else
                        {{$attendance->break1_end}}
                    @endif
                </div>
            </div>
        </div>
        <div class="flex-container-row space-between">
            
            <div class="grow-1">2nd Break Start: 
            </div>
            <div class="grow-1">
                @if(in_array('break2_start',$active_break_btns))
                <form method="POST" action="{{route('b2start')}}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        START
                    </button>
                </form>
                @else
                    {{$attendance->break2_start}}
                @endif
            </div>
            <div class=" grow-1">2nd Break End:
            </div>
            
            <div class="grow-1">
                @if(in_array('break2_end',$active_break_btns))
                <form method="POST" action="{{route('b2end')}}">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        END
                    </button>
                </form>
                @else
                    {{$attendance->break2_end}}
                @endif
            </div>


        </div>
        <div class="flex-container-row space-between">
            <div class=" grow-1">3rd Break Start: 
            </div>
            <div class="grow-1">
                @if(in_array('break3_start',$active_break_btns))
                <form method="POST" action="{{route('b3start')}}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        START
                    </button>
                </form>
                @else
                    {{$attendance->break3_start}}
                @endif
            </div>
            <div class=" grow-1">3rd Break End:
            </div>
            <div class="grow-1">
                @if(in_array('break3_end',$active_break_btns))
                    <form method="POST" action="{{route('b3end')}}">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            END
                        </button>
                    </form>
                @else
                    {{$attendance->break3_end}}
                @endif
            </div>
        </div>
        <div class="flex-container-row space-between">
            <div class=" grow-1">4th Break Start: 
            </div>
            <div class="grow-1">
                @if(in_array('break4_start',$active_break_btns))
                <form method="POST" action="{{route('b4start')}}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        START
                    </button>
                </form>
                @else
                    {{$attendance->break4_start}}
                @endif
            </div>
            <div class=" grow-1">4th Break End:
            </div>
            <div class="grow-1">
                @if(in_array('break4_end',$active_break_btns))
                <form method="POST" action="{{route('b4end')}}">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        END
                    </button>
                </form>
                @else
                    {{$attendance->break4_end}}
                @endif
            </div>
        </div>
        @if($user->is_wfh===false || ($user->is_wfh && $attendance->time_out) || ($user->is_wfh && !(in_array('out',$active_break_btns))))
        <div class="flex-container-row flex-start">
            <div class="grow-1">
                Time Out
            </div>
            <div class="grow-3">
                @if($attendance->time_out)
                {{$attendance->time_out}}
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

