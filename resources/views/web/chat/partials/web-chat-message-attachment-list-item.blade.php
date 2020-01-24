<li>
    <a href="{{ route("web.chat.download-file", ["filename" => $attachment->filename]) }}" style="display: flex;" target="_blank">
        <span style="background-color: #f8f8f8; font-size: 28px; padding: 4px 10px">
{{--            <i class="far fa-file-word"></i>--}}
{{--            <i class="far fa-file-excel"></i>--}}
{{--            <i class="far fa-file-pdf"></i>--}}
            <i class="far fa-file"></i>
        </span>
        <span class="contacts-list-info">
            <span class="contacts-list-name">
                @if($attachment->message->type === \App\Domain\ChatMessage\ChatMessage::TYPE_TO_ADMIN)
                    You
                @else
                    {{$attachment->message->admin->name}}
                @endif
</span>
        <span class="contacts-list-msg">{{ $attachment->origin_filename }}</span>
    </span>
    </a>
</li>
<!-- End Contact Item -->