<span style="padding-left: 15px">
    <i class="fa fa-paperclip" aria-hidden="true"></i>
    <a href="{{ route("root.chat.download-file", ["filename" => $attachment->filename]) }}" target="_blank">{{ $attachment->origin_filename }}</a>
</span>