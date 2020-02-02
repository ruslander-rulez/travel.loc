@extends("dashboard.Layout.main")

@section("styles")
    <style>
        ul.chat {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }

        .chat li.left .chat-body {
            margin-left: 60px;
        }

        .chat li.right .chat-body {
            margin-right: 60px;
        }


        .chat li .chat-body p {
            margin: 0;
            color: #777777;
        }

        .panel .slidedown .glyphicon, .chat .glyphicon {
            margin-right: 5px;
        }

        .panel-body {
            overflow-y: scroll;
            height: 1000px;
            max-height: 67vh;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
            background-color: #555;
        }
    </style>
@endsection
@section("page-bar")
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ route("root.index") }}">Главная</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Чат
            </li>
        </ul>
    </div>
@endsection

@section("page-body")
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> Chat
                    <div class="btn-group pull-right">
                    </div>
                </div>
                <div class="panel-body">
                    <ul class="chat">
                        @foreach($messages as $message)
                            @if($message->type === \App\Domain\ChatMessage\ChatMessage::TYPE_TO_PROFILE)
                            <li class="left clearfix">
                                <span class="chat-img pull-left">
                                    <img src="http://placehold.it/50/55C1E7/fff&amp;text={{ str_limit(mb_strtoupper($message->admin->name), 2, "") }}" alt="{{ $message->admin->name }}"
                                         class="img-circle">
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">{{ $message->admin->name }}</strong> <small
                                                class="pull-right text-muted">
                                            <span class="glyphicon glyphicon-time"></span>{{ $message->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p>
                                        {{ $message->message }}
                                    </p>
                                </div>
                                <div>
                                    @foreach($message->attachments as $attachment)
                                        @include("dashboard.chat.partials.chat-message-attachment")
                                    @endforeach
                                </div>
                            </li>
                            @else
                            <li class="right clearfix">
                                <span class="chat-img pull-right">
                                    <img src="http://placehold.it/50/FA6F57/fff&amp;text={{ str_limit(mb_strtoupper($message->profile->name), 2, "") }}" alt="{{ $message->profile->name }}"
                                         class="img-circle">
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>{{ $message->created_at->diffForHumans() }}</small>
                                        <strong class="pull-right primary-font">{{ $message->profile->name }}</strong>
                                    </div>
                                    <p>
                                        {{ $message->message }}
                                    </p>
                                </div>
                                <div>
                                    @foreach($message->attachments as $attachment)
                                        @include("dashboard.chat.partials.chat-message-attachment")
                                    @endforeach
                                </div>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="panel-footer">
                    <form action="{{ route("root.chat.send-message", ["profileId" => $profileId]) }}" method="post"  enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <textarea id="btn-input" type="text" name="message" rows="4"  style="max-width: 96%; resize: vertical;" class="form-control"
                                      placeholder="Type your message here..."></textarea>
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-sm" id="btn-chat">
                                    Отправить
                                </button>
                            </span>
                        </div>
                        <div style="margin-top: 5px">
                            <input type="file" name="files[]" multiple>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
