<span class="pl-3">
    <i class="fas fa-paperclip" aria-hidden="true"></i>
    <a href="{{ route("web.chat.download-file", ["filename" => $attachment->filename]) }}" target="_blank">{{ $attachment->origin_filename }}</a>
</span>