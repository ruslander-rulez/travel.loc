@extends("web.Layout.layout")

@section("content")
    <!-- Construct the card with style you want. Here we are using card-danger -->
    <!-- Then add the class direct-chat and choose the direct-chat-* contexual class -->
    <!-- The contextual class should match the card, so we are using direct-chat-danger -->
    <div class="card card-danger direct-chat direct-chat-danger">
        <div class="card-header">
            <h3 class="card-title">Chat with administrator</h3>
            <div class="card-tools">
                <span data-toggle="tooltip" title="3 New Messages" class="badge badge-light">3</span>

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
                <!-- Message. Default to the left -->
                <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">Alexander Pierce</span>
                        <span class="direct-chat-timestamp float-right">1 minute ago</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <div class="direct-chat-text">
                        New message from admin
                    </div>
                    <div>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
                <!-- Message to the right -->
                <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-right">You</span>
                        <span class="direct-chat-timestamp float-left">10 minutes ago</span>
                    </div>

                    <!-- /.direct-chat-infos -->
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        You better believe it!
                    </div>
                    <div>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->

                <!-- Message. Default to the left -->
                <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">Alexander Pierce</span>
                        <span class="direct-chat-timestamp float-right">1 minute ago</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <div class="direct-chat-text">
                        New message from admin
                    </div>
                    <div>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
                <!-- Message to the right -->
                <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-right">You</span>
                        <span class="direct-chat-timestamp float-left">10 minutes ago</span>
                    </div>

                    <!-- /.direct-chat-infos -->
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        You better believe it!
                    </div>
                    <div>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->

                <!-- Message. Default to the left -->
                <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">Alexander Pierce</span>
                        <span class="direct-chat-timestamp float-right">1 minute ago</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <div class="direct-chat-text">
                        New message from admin
                    </div>
                    <div>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
                <!-- Message to the right -->
                <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-right">You</span>
                        <span class="direct-chat-timestamp float-left">10 minutes ago</span>
                    </div>

                    <!-- /.direct-chat-infos -->
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        You better believe it!
                    </div>
                    <div>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->

                <!-- Message. Default to the left -->
                <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">Alexander Pierce</span>
                        <span class="direct-chat-timestamp float-right">1 minute ago</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <div class="direct-chat-text">
                        New message from admin
                    </div>
                    <div>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
                <!-- Message to the right -->
                <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-right">You</span>
                        <span class="direct-chat-timestamp float-left">10 minutes ago</span>
                    </div>

                    <!-- /.direct-chat-infos -->
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        You better believe it!
                    </div>
                    <div>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                        <span class="pl-3">
                            <i class="fas fa-paperclip" aria-hidden="true"></i>
                            <a href="#">Some attachment file name</a>
                        </span>
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->

            </div>
            <!--/.direct-chat-messages-->
            <!-- Contacts are loaded here -->
            <div class="direct-chat-contacts">
                <ul class="contacts-list">
                    <li>
                        <a href="#" style="display: flex;">
                            <span style="background-color: #f8f8f8; font-size: 28px; padding: 4px 10px">
                                <i class="far fa-file-word"></i>
                            </span>
                            <span class="contacts-list-info">
                                <span class="contacts-list-name">
                    Nadia Jolie
                    <small class="contacts-list-date float-right">2/20/2015</small>
                  </span>
                            <span class="contacts-list-msg">I'll call you back at...</span>
                        </span>


                            <!-- /.contacts-list-info -->
                        </a>
                    </li>
                    <!-- End Contact Item -->

                    <li>
                        <a href="#" style="display: flex;">
                            <span style="background-color: #f8f8f8; font-size: 28px; padding: 4px 10px">
                                <i class="far fa-file-excel"></i>
                            </span>
                            <span class="contacts-list-info">
                                <span class="contacts-list-name">
                    Nadia Jolie
                    <small class="contacts-list-date float-right">2/20/2015</small>
                  </span>
                            <span class="contacts-list-msg">I'll call you back at...</span>
                        </span>


                            <!-- /.contacts-list-info -->
                        </a>
                    </li>
                    <!-- End Contact Item -->

                    <li>
                        <a href="#" style="display: flex;">
                            <span style="background-color: #f8f8f8; font-size: 28px; padding: 4px 10px">
                                <i class="far fa-file-pdf"></i>
                            </span>
                            <span class="contacts-list-info">
                                <span class="contacts-list-name">
                    Nadia Jolie
                    <small class="contacts-list-date float-right">2/20/2015</small>
                  </span>
                            <span class="contacts-list-msg">I'll call you back at...</span>
                        </span>


                            <!-- /.contacts-list-info -->
                        </a>
                    </li>
                    <!-- End Contact Item -->

                    <li>
                        <a href="#" style="display: flex;">
                            <span style="background-color: #f8f8f8; font-size: 28px; padding: 4px 10px">
                                <i class="far fa-file"></i>
                            </span>
                            <span class="contacts-list-info">
                                <span class="contacts-list-name">
                    Nadia Jolie
                  </span>
                            <span class="contacts-list-msg">I'll call you back at...</span>
                        </span>
                            <small class="contacts-list-date float-right">2/20/2015</small>


                            <!-- /.contacts-list-info -->
                        </a>
                    </li>
                    <!-- End Contact Item -->

                </ul>
                <!-- /.contacts-list -->
            </div>
            <!-- /.direct-chat-pane -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer position-absolute" style="bottom: -90px; width: 98%">
            <form action="#" method="post">
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
                        <button type="button" class="btn btn-primary">Send</button>
                    </span>
                </div>
                <div class="input-group mt-1">

                      <input type="file" multiple id="attachment-file">
                </div>

            </form>
        </div>
        <!-- /.card-footer-->
    </div>
    <!--/.direct-chat -->
@endsection