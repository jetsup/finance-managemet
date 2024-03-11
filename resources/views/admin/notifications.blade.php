<x-layout-admin notifications="{{ $notifications }}" title="Notifications">

    <body>
        <!--header start-->
        <!--main content start-->
        <section id="main-content" style=" margin-right:110px;">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-bell"></i>Notifacations</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Read and Reply To Notifications
                            </header>
                            <div class="panel-body">
                                <div style="margin-bottom: 20px;">
                                    <button class="btn btn-default"
                                        onclick="createNotification({{ auth()->user()->id }})">
                                        <i class="fa fa-plus"></i>
                                        Create Notifications
                                    </button>
                                    <script>
                                        function createNotification(sender, id = 0, msg = "For Everyone") {
                                            // set form action
                                            document.getElementById("notification-form").action = "/notifications/create";
                                            openPopup(id, msg, sender);
                                        }
                                    </script>
                                </div>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sender</th>
                                            <th>Notification</th>
                                            <th>Posted</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($messages as $message)
                                            <tr>
                                                <td><i class="fa fa-user"></i>
                                                    {{ getUserUsername((int) $message->from) }}
                                                </td>
                                                <td style="cursor: pointer;"
                                                    onclick="replyThis(this, {{ $message->id }}, '{{ $message->message }}', {{ $message->from }})">
                                                    @if ($message->read == 0)
                                                        <b>{{ $message->message }}</b>
                                                    @else
                                                        <i>{{ $message->message }}</i>
                                                    @endif
                                                </td>
                                                <td>{{ $message->created_at }}</td>
                                                <td>
                                                    <form action="{{ '/notifications/delete/' . $message->id }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm">Delete</button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- {{ $messages->links() }} --}}
                            </div>

                            <div class="panel-body overlay" id="overlay" onblur="closePopup()">
                                <div class="popup">
                                    <form action="notifications/message" method="post" id="notification-form">
                                        @csrf
                                        @method('PUT')
                                        <label for="msgtext" id="lbl-message"></label>
                                        <input type="text" name="message-id" id="message-id" hidden>
                                        <input type="text" name="sendto" id="sendto" hidden>
                                        <div>
                                            <textarea name="msgtext" id="msgtext" cols="100" rows="10" maxlength="255" style="resize: none"></textarea>
                                        </div>

                                        <div style="margin-top: 20px;">
                                            <button type="submit" class="btn btn-success">Send</button>

                                            <button type="reset" class="btn btn-danger"
                                                onclick="closePopup()">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </section>
                    </div>
                </div>
            </section>
        </section>
    </body>

    <script>
        function readNotification(element, msgID) {
            let ajax = new XMLHttpRequest();
            ajax.open("GET", "notifications/markread/" + msgID, true);
            ajax.onload = function() {
                let response = JSON.parse(this.responseText);
                if (response.status) {
                    let boldTag = element.childNodes[1];
                    let italicTag = document.createElement('i');
                    while (boldTag.firstChild) {
                        italicTag.appendChild(boldTag.firstChild);
                    }
                    element.replaceChild(italicTag, boldTag);
                    element.innerHTML = element.innerHTML;
                    document.getElementById("notification-count").innerHTML = response.notifications;
                    if (response.notifications == 0) {
                        document.getElementById("notification-count").style.display = "none";
                        let notificationTag = document.getElementById("notification-icon");
                        notificationTag.innerHTML = '<i class="fa fa-envelope-open-o"></i>';
                    }
                }
            };
            ajax.send();
        }

        function replyThis(element, id, msg, sender) {
            document.getElementById("notification-form").action = "/notifications/message";
            openPopup(id, msg, sender);
            readNotification(element, id);
        }

        // popup
        function openPopup(id, msg, sender_id) {
            document.getElementById("lbl-message").innerHTML = "#" + id + "#: " + msg;
            document.getElementById("message-id").value = id;
            document.getElementById("sendto").value = sender_id;
            document.getElementById('overlay').style.display = 'flex';
        }

        function closePopup() {
            document.getElementById('overlay').style.display = 'none';
        }
        // end popup

        //
        // Attach the keydown event listener to the document
        document.addEventListener('keydown', handleKeyDown);

        // Function to handle the keydown event
        function handleKeyDown(event) {
            if (event.key === 'Escape') {
                closePopup();
            }
        }
    </script>
</x-layout-admin>
