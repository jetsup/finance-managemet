<x-layout-admin notifications={{ $notifications }} title="Profile">
    <script></script>

    <body>
        <!--header start-->

        <!--main content start-->
        <section id="main-content" style=" margin-right:110px;">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-user"></i>{{ auth()->user()->first_name }}
                            {{ auth()->user()->last_name }}</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i>Home</li>
                            <li><i class="fa fa-file-text-o"></i>Edit profile</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <span class="fa fa-pencil"></span>
                                Edit profile
                            </header>
                            <div class="panel-body">
                                <form class="form-horizontal" method="post" enctype="multipart/form-data"
                                    action="editprofile">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Profile Image</label>
                                        <div class="col-lg-2 col-sm-2">
                                            <div class="follow-ava2" style="position: relative; left:50px;">
                                                <img id="output"
                                                    @if (auth()->user()->dp) src="{{ asset('storage/' . auth()->user()->dp) }}"
                                                @else
                                                src="img/profile.jpg" @endif
                                                    alt="Upload Image"
                                                    style="max-height:150px; max-width: 150px; min-width: 150px; min-height: 150px;
                                border-top-left-radius: 50% 50%;
                                    border-top-right-radius: 50% 50%;
                                    border-bottom-left-radius: 50% 50%;
                                    border-bottom-right-radius: 50% 50%;">
                                            </div>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="file" required accept="image/*" name="vphoto"
                                                onchange="loadfile(event)" style="position: relative; left: 90px;"
                                                oninvalid="this.setCustomValidity('You must provide a Profile Image')">
                                            <script>
                                                var loadfile = function(event) {
                                                    var output = document.getElementById('output');
                                                    output.src = URL.createObjectURL(event.target.files[0]);
                                                    output.onload = function() {
                                                        URL.revokeObjectURL(output.src)
                                                    }
                                                };
                                            </script>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">First Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="first_name" required
                                                class="form-control round-input" oninput="this.setCustomValidity('')"
                                                oninvalid="this.setCustomValidity('Provide First Name')"
                                                style="width:80%;" value="{{ auth()->user()->first_name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Last Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" required name="last_name"
                                                class="form-control round-input" oninput="this.setCustomValidity('')"
                                                oninvalid="this.setCustomValidity('Enter Father Name')"
                                                style="width:80%;" value="{{ auth()->user()->last_name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Gender</label>
                                        <div class="col-sm-10">
                                            {{-- show this selector only in admin page --}}
                                            {{-- <select name="gender" class="form-control round-input" required
                                                style="width:80%;">
                                                <option selected value="">Gender</option>
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
                                                <option value="3">Others</option>
                                            </select> --}}
                                            <input type="text" required name="last_name"
                                                class="form-control round-input" oninput="this.setCustomValidity('')"
                                                oninvalid="this.setCustomValidity('Enter Father Name')"
                                                style="width:80%;" value="{{ getGender(auth()->user()->gender_id) }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Mobile Number</label>
                                        <div class="col-sm-10">
                                            <input type="tel" pattern="^0[17]\d{8}$"
                                                oninput="this.setCustomValidity('')" style="width:80%;"
                                                oninvalid="this.setCustomValidity('Enter your Number')" required
                                                maxlength="10" name="mno" id="mno"
                                                class="form-control round-input" value="{{ auth()->user()->phone }}"
                                                readonly>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <!-- TODO: Replace this with alpineJS bubble popup -->
                                        {% for message in messages %}
                                        <h3 style="color: green;"> {{message}} </h3>
                                        {% endfor %}
                                    </div>
                                </div> --}}

                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                            <button class="btn btn-default" type="reset">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </body>
</x-layout-admin>
