@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Rahul Calculator</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div id='calculator'>
                                    <form>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <textarea class="answer"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <input type="button" value="1"/>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="button" value="2"/>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="button" value="3"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <input type="button" value="4"/>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="button" value="5"/>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="button" value="6"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <input type="button" value="7"/>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="button" value="8"/>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="button" value="9"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <input type="button" value="C" class="clear"/>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="button" value="0"/>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="button" value="."/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="row">
                                                    <div class="col-3 col-sm-12">
                                                        <input type="button" value="+"/>
                                                    </div>
                                                    <div class="col-3 col-sm-12">
                                                        <input type="button" value="-"/>
                                                    </div>
                                                    <div class="col-3 col-sm-12">
                                                        <input type="button" value="*"/>
                                                    </div>
                                                    <div class="col-3 col-sm-12">
                                                        <input type="button" value="/"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @if(Auth::check())
                                            <div class="col-sm-9"> <input type="button" data-resultFlag="" data-input="" data-result="" value="Save Log" class="save_logs disabledButton"   disabled/></div>
                                            @endif
                                            <div class={{Auth::check()?"col-sm-3":"col-sm-12"}}>
                                                <input type="button" value="=" data-equalFlag="" class="equalto"/>
                                            </div>
                                        </div>
                                        @if(Auth::check())
                                        <input type="hidden" id="save-log-route" value="{{ route('logs.create') }}">
                                            @endif
                                    </form>
                                </div>
                            </div>
                            @if(Auth::check())
                            <div class="col-sm-12" id="logs">
                                <h5>Calculation Logs</h5>
                                <table class="table" cellspacing="0"
                                       width="100%" role="grid" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Name</th>
                                        <th>Input</th>
                                        <th>Result</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($logs as $log)
                                        <tr>
                                            <td data-order="{{$log->created_at}}">{{$log->created_at->diffForHumans()}}</td>
                                            <td>{{$log->log_name}}</td>
                                            <td class="max-width">{{$log->input}}</td>
                                            <td class="max-width">{{$log->result}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(Auth::check())
    @include('partials.modal');
    @endif
@endsection
