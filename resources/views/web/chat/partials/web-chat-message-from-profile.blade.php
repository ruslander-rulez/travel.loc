<div class="direct-chat-msg right">
    <div class="direct-chat-infos clearfix">
        <span class="direct-chat-name float-right">You</span>
        <span class="direct-chat-timestamp float-left">{{ $message->created_at->diffForHumans() }}</span>
    </div>

    <!-- /.direct-chat-infos -->
    <!-- /.direct-chat-img -->
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