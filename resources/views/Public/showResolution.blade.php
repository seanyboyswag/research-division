@extends('layouts.public')
@section('content')
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="resolution">
                        <div style="text-align: center">
                            <div class="resolution-heading">
                                <h3>{{$resolution->title}}</h3>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="panel panel-info">
                                        <div class="panel-body">
                                            <iframe src="/ViewerJS/#../storage/resolutions/{{substr($resolution->pdf_file_path, strrpos( $resolution->pdf_file_path, '/' ) + 1 )}}"
                                                    width='100%' height='400' allowfullscreen
                                                    webkitallowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="panel panel-info">
                                        <div class="panel-body">
                                            @if($resolution->is_monitoring == 1)
                                                @if($resolution->statusReport !== null and $resolution->statusReport->pdf_file_path !== " ")
                                                    <a href="/downloadPDF/statusreports/{{$resolution->statusReport->pdf_file_name}}">
                                                        <button class="btn-sm btn-info">
                                                            Download Status Report
                                                        </button>
                                                    </a>
                                                @endif

                                                {{--<a href="">--}}
                                                    {{--<button class="btn-sm btn-info">--}}
                                                        {{--View Updates--}}
                                                    {{--</button>--}}
                                                {{--</a>--}}

                                                @if(!$questionnaire->isEmpty())
                                                    <a href="/public/showResolutionQuestionnaire/{{$resolution->id}}">
                                                        <button class="btn-sm btn-success">
                                                            Answer Questionnaire
                                                        </button>
                                                    </a>
                                                @endif

                                            @endif
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Resolution Number</th>
                                                    <td>{{ $resolution->number }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Series</th>
                                                    <td>{{ $resolution->series }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Title</th>
                                                    <td>{{ $resolution->title }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Keywords</th>
                                                    <td>{{ $resolution->keywords }}</td>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @if($resolution->updateReport()->where('is_deleted', 0)->first())
                                <div class="col-md-5">
                                    <div class="panel panel-info">
                                        <div class="panel-body">
                                            Updates
                                            @foreach($resolution->updateReport()->where('is_deleted', 0)->get() as $updateReport)
                                                <tr>
                                                    <td>{{$updateReport->pdf_file_name}}</td>
                                                    <td>
                                                        <a href="/downloadPDF/updatereports/{{$updateReport->pdf_file_name}}"
                                                           class="btn btn-xs btn-primary btn-equal-width">
                                                            Download
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($resolution->is_accepting == 1)
                                {{--<a href="">--}}
                                {{--<button class="btn-sm btn-success">--}}
                                {{--Give Comment--}}
                                {{--</button>--}}
                                {{--</a>--}}
                                <div class="container pb-cmnt-container"
                                     style="border-top: dotted lightseagreen; padding-top: 20px">
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="panel panel-info">
                                                <div class="panel-body">
                                                    <form method="post"
                                                          action="{{ url("/suggestions/{$resolution->id }/") }}">
                                                        {{ csrf_field() }}
                                                        <input class="form-control" type="text" name="first_name"
                                                               placeholder="First Name">
                                                        <input class="form-control" type="text" name="last_name"
                                                               placeholder="Last Name">
                                                        <input class="form-control" type="hidden" name="type"
                                                               value="resolution">
                                                        <input class="form-control" type="email" name="email"
                                                               placeholder="Email">
                                                        <textarea required class="form-control" name="suggestion"
                                                                  rows="5"
                                                                  placeholder="Please give us your suggestion on this resolution"></textarea>

                                                        {!! NoCaptcha::display() !!}
                                                        @if ($errors->has('g-recaptcha-response'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                            </span>
                                                        @endif

                                                        <div class="form-inline">

                                                            <button class="btn btn-success pull-right"
                                                                    type="submit"><i class="fa fa-paper-plane"></i>
                                                                Send Now
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        #content {
            background-color: rgb(240, 248, 255);
        }

        .pb-cmnt-container {
            font-family: Lato;
            margin-top: 100px;
        }

        .pb-cmnt-textarea {
            resize: none;
            padding: 20px;
            height: 130px;
            width: 100%;
            border: 1px solid #F2F2F2;
        }

        .form-control {
            margin-bottom: 10px;
        }

        /*.resolution-heading h3{*/
            /*white-space: nowrap;*/
            /*width: 20em;*/
            /*overflow: hidden;*/
            /*text-overflow: ellipsis;*/
        /*}*/
    </style>
@endsection