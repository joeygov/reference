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
                Time In
            </div>
            <div class="grow-3">
                {{date("h:i:s A")}}
            </div>
        </div>
        <div class="flex-container-row space-between">
            <div class="flex-container-row  grow-1 space-between">
                <div class="grow-1">
                    1st Break Start: 
                </div>
                <div class="grow-1">
                    <button type="button" class="btn btn-primary">
                        START
                    </button>
                </div>
            </div>
            <div class="flex-container-row grow-1 space-between">
                <div class="grow-1">
                    1st Break End:
                </div>
                <div class="grow-1">
                    <button type="button" class="btn btn-danger">
                        END
                    </button>
                </div>
            </div>
        </div>
        <div class="flex-container-row space-between">
            <div class="grow-1">2nd Break Start: 
            </div>
            <div class="grow-1">
                <button type="button" class="btn btn-primary">
                    START
                </button>
            </div>
            <div class=" grow-1">2nd Break End:
            </div>
            <div class="grow-1">
                <button type="button" class="btn btn-danger">
                    END
                </button>
            </div>
        </div>
        <div class="flex-container-row space-between">
            <div class=" grow-1">3rd Break Start: 
            </div>
            <div class="grow-1">
                <button type="button" class="btn btn-primary">
                    START
                </button>
            </div>
            <div class=" grow-1">3rd Break End:
            </div>
            <div class="grow-1">
                <button type="button" class="btn btn-danger">
                    END
                </button>
            </div>
        </div>
        <div class="flex-container-row space-between">
            <div class=" grow-1">4th Break Start: 
            </div>
            <div class="grow-1">
                <button type="button" class="btn btn-primary">
                    START
                </button>
            </div>
            <div class=" grow-1">4th Break End:
            </div>
            <div class="grow-1">
                <button type="button" class="btn btn-danger">
                    END
                </button>
            </div>
        </div>
        <div class="flex-container-row flex-start">
            <div class="grow-1">
                Time Out
            </div>
            <div class="grow-3">
                {{date("h:i:s A")}}
            </div>
        </div>
    @endif

    @if($show_time_out_btn)
        <div class="flex-container-row center">
            <button type="button" class="btn btn-primary  btn-lg">
                TIME OUT
            </button>
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
