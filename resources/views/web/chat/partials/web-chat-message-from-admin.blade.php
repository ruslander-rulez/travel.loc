<div class="direct-chat-msg">
    <div class="direct-chat-infos clearfix">
        <span class="direct-chat-name float-left">{{$message->admin->name}}</span>
        <span class="direct-chat-timestamp float-right">{{ $message->created_at->diffForHumans() }}</span>
    </div>
    <!-- /.direct-chat-infos -->
    <div class="direct-chat-text">
        {{ $message->message }}
    </div>
    <div>
        @foreach($message->attachments as $attachment)
            @include("web.chat.partials.web-chat-message-attachment")
        @endforeach
    </div>
    <!-- /.direct-chat-text -->
</div>