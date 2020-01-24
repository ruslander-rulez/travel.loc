@extends("web.Layout.layout")

@section("content")
    <!-- Construct the card with style you want. Here we are using card-danger -->
    <!-- Then add the class direct-chat and choose the direct-chat-* contexual class -->
    <!-- The contextual class should match the card, so we are using direct-chat-danger -->
    <div class="card card-danger direct-chat direct-chat-danger">
        <div class="card-header">
            <h3 class="card-title">Chat with administrator</h3>
            <div class="card-tools">
                <span data-toggle="tooltip" title="New Messages" class="badge badge-light">{{ $countUnreadMessages }}</span>

                <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Attachments"
                        data-widget="chat-pane-toggle">
                    <i class="fas fa-file"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages" style="height: 64vh">
                @forelse($messages as $message)
                    @if($message->type === App\Domain\ChatMessage\ChatMessage::TYPE_TO_PROFILE)
                        @include("web.chat.partials.web-chat-message-from-admin")
                    @else
                        @include("web.chat.partials.web-chat-message-from-profile")
                    @endif
                @empty
                    <p>You have no messages yes</p>
                @endforelse
            </div>
            <!--/.direct-chat-messages-->
            <!-- Contacts are loaded here -->
            <div class="direct-chat-contacts">
                <ul class="contacts-list">
                    @foreach($attachments as $attachment)
                        @include("web.chat.partials.web-chat-message-attachment-list-item")
                    @endforeach
                </ul>
                <!-- /.contacts-list -->
            </div>
            <!-- /.direct-chat-pane -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer position-absolute" style="bottom: -90px; width: 98%">
            <form action="{{ route("web.chat.send.message") }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <label for="attachment-file" class="mb-0">
                                <i class="fas fa-paperclip" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    <span class="input-group-append">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </span>
                </div>
                <div class="input-group mt-1">
                      <input type="file" multiple id="attachment-file" name="files[]">
                </div>
            </form>
        </div>
        <!-- /.card-footer-->
    </div>
    <!--/.direct-chat -->
@endsection