<x-layout-admin notifications="{{ $notifications }}" title="Complains">

    <body>
        <!--header start-->
        <!--main content start-->
        <section id="main-content" style=" margin-right:110px;">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="icon_comment"></i>Complains</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Manage Complains
                            </header>
                            <div class="panel-body">
                                <div class="table-container">
                                    <table class="table table-striped table-bordered" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>S</th>
                                                @if ($mine == 1)
                                                    <th>Recipient</th>
                                                @else
                                                    <th>Sender</th>
                                                @endif
                                                <th>Complain</th>
                                                <th>Posted</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($complains as $complain)
                                                <tr>
                                                    {{-- change style if the replied status changes --}}
                                                    @if ($complain->replied == 0 && $complain->read == 0 && $complain->resolved == 0)
                                                        <td style="background-color: #000070;">
                                                        @elseif($complain->replied == 0 && $complain->read == 1 && $complain->resolved == 0)
                                                        <td style="background-color: #348bb6;">
                                                        @elseif($complain->replied == 1 && $complain->read == 1 && $complain->resolved == 0)
                                                        <td style="background-color: #428377;">
                                                        @elseif($complain->replied == 1 && $complain->read == 1 && $complain->resolved == 1)
                                                        <td style="background-color: #00ff00;">
                                                        @else
                                                        <td style="background-color: #eeff40;">
                                                    @endif
                                                    </td>
                                                    <td style="cursor: pointer;"
                                                        @if ($mine == 1) onclick="messageUser({{ $complain->for }})">
                                                        <i class="fa fa-user"></i>
                                                        {{ getUserUsername($complain->for) }}
                                                    @else
                                                        onclick="messageUser({{ $complain->from }})">
                                                        <i class="fa fa-user"></i>
                                                        {{ getUserUsername($complain->from) }} @endif
                                                        </td>
                                                        @if ($mine == 0)
                                                    <td style="cursor: pointer;max-width: 70%; white-space: wrap;"
                                                        onclick="replyThis(this, {{ $complain->id }}, '{{ $complain->message }}', {{ $complain->from }})">
                                                    @else
                                                    <td style="max-width: 70%; white-space: wrap;">
                                            @endif
                                            @if ($complain->read == 0 && $mine == 0)
                                                <b>{{ $complain->message }}</b>
                                            @else
                                                <i>{{ $complain->message }}</i>
                                            @endif
                                            </td>
                                            <td style="width: 100%; max-width: 5%; white-space: nowrap;">
                                                {{ extractDate($complain->created_at) }}</td>
                                            <td>
                                                <form action="{{ '/complains/delete/' . $complain->id }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>

                                            </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{-- {{ $messages->links() }} --}}
                            </div>

                            {{-- Reply to a complain --}}
                            <div class="panel-body overlay" id="overlay" onblur="closePopup()">
                                <div class="popup">
                                    <form action="/complains/post" method="post">
                                        @csrf
                                        @method('PUT')
                                        <label for="replytext" id="lbl-complain"></label>
                                        <input type="text" name="complain-id" id="complain-id" hidden>
                                        <input type="text" name="from" id="from" hidden>
                                        <div>
                                            <textarea name="replytext" id="replytext" cols="100" rows="10" maxlength="255" style="resize: none"></textarea>
                                        </div>

                                        <div style="margin-top: 20px;">
                                            <button type="submit" class="btn btn-success">Send</button>

                                            <button type="reset" class="btn btn-danger"
                                                onclick="closePopup()">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {{-- Send message --}}
                            <div class="panel-body overlay" id="message-sender" onblur="closePopup()">
                                <div class="popup">
                                    <form action="/notifications/message" method="post">
                                        @csrf
                                        @method('PUT')
                                        <label for="msgtext" id="lbl-message"></label>
                                        {{-- <input type="text" name="message-id" id="message-id" hidden> --}}
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
        function readNotification(element, complainID) {
            let ajax = new XMLHttpRequest();
            ajax.open("GET", "/complains/markread/" + complainID, true);
            ajax.onload = function() {
                let response = JSON.parse(this.responseText);
                if (response[0]) {
                    let boldTag = element.childNodes[1];
                    let italicTag = document.createElement('i');
                    while (boldTag.firstChild) {
                        italicTag.appendChild(boldTag.firstChild);
                    }
                    element.replaceChild(italicTag, boldTag);
                    element.innerHTML = element.innerHTML;

                }
            };
            ajax.send();
        }

        function replyThis(element, id, msg, sender) {
            openPopup(id, msg, sender, 0);
            readNotification(element, id);
        }

        function messageUser(senderID) {
            openPopup(null, "", senderID, 1);
        }

        // popup
        function openPopup(id, msg, senderID, popupID) {
            if (popupID == 0) {
                document.getElementById("lbl-complain").innerHTML = "#" + id + "#: " + msg;
                document.getElementById("complain-id").value = id;
                document.getElementById("from").value = senderID;
                document.getElementById('overlay').style.display = 'flex';
            } else if (popupID == 1) {
                document.getElementById("lbl-message").innerHTML = "Message to uid: <i>#" + senderID + "</i>";
                document.getElementById("sendto").value = senderID;
                document.getElementById('message-sender').style.display = 'flex';
            }
        }

        function closePopup() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('message-sender').style.display = 'none';
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
