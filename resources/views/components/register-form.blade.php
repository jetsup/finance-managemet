<x-form-bubble action="{{ $action }}" method="post">
    <div class="form-group form-horizontal">
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
            <input type="file" accept="image/*" name="vphoto" onchange="loadfile(event)"
                style="position: relative; left: 90px;"
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
    <div class="form-group col-sm-10">
        <label class="col-sm-2 control-label">Username</label>
        <div class="col-sm-10">
            <input type="text" name="username" required class="form-control round-input"
                oninvalid="this.setCustomValidity('Provide Username')" placeholder="Provide your unique Username"
                oninput="queryUsername(this)" onchange="queryUsername(this)" style="width:80%;"
                value="{{ old('username') }}">
        </div>
        <script>
            function queryUsername(element) {
                let ajax = new XMLHttpRequest();
                if (element.value != "") {
                    ajax.open("GET", "/finduser/" + element.value, true);
                    ajax.onload = function() {
                        // return;
                        if (this.status == 200) {
                            let user = JSON.parse(this.responseText);
                            if (typeof(user["user"]) === "number" && user["user"] > 0) {
                                // the user is valid
                                console.log("USER:", user["user"], "EMP:", user["employee"]);
                                if (typeof(user["employee"]) === "number" && user["employee"] > 0) {
                                    // the employee with that user identity exist
                                    document.getElementById("employee_number").disabled = true;
                                    document.getElementById("employee_number").value = "";
                                } else {
                                    // the employee with that username does not exist, VALID
                                    document.getElementById("employee_number").disabled = false;
                                }
                            } else {
                                document.getElementById("employee_number").disabled = true;
                                document.getElementById("employee_number").value = "";
                            }
                        }
                    };
                    ajax.send();
                }
            }
        </script>
    </div>
    <div class="form-group col-sm-10">
        <label class="col-sm-2 control-label">Employee Number</label>
        <div class="col-sm-10">
            <input type="text" required name="employee_number" id="employee_number" class="form-control round-input"
                oninput="queryEmployeeNumber(this)"
                oninvalid="this.setCustomValidity('Enter Employee Number or Create one')"
                placeholder="Employee Number or Unique Identification Number" style="width:80%;"
                value="{{ old('employ_number') }}" disabled>
        </div>
        <script>
            function queryEmployeeNumber(element) {
                let ajax = new XMLHttpRequest();
                if (element.value != "") {
                    ajax.open("GET", "/find_emp_number/" + element.value, true);
                    ajax.onload = function() {
                        let employee = JSON.parse(this.responseText);
                        if (employee["employee"][0]) {
                            // the user is valid
                            console.log(employee["user"][0]);
                            // activate buttons
                            document.getElementById("btn-submit").disabled = true;
                        } else {
                            if (element.value.length >= 13) {
                                document.getElementById("btn-submit").disabled = false;
                            } else {
                                document.getElementById("btn-submit").disabled = true;
                            }
                            let empNO = document.getElementById("employee_number").value;
                            document.getElementById("employee_number").value = empNO.toUpperCase();
                        }
                    };
                    ajax.send();
                }
            }
        </script>
    </div>
    <div class="form-group col-sm-10">
        <label class="col-sm-2 control-label">Employee Category</label>
        <div class="col-sm-10">
            <select name="employee-category" id="employee-category" class="form-control round-input" required
                style="width:80%;">
            </select>
        </div>
        <script>
            var ajax = new XMLHttpRequest();
            ajax.open("GET", "/employeetypes", true);
            ajax.onload = function() {
                let employeeTypes = JSON.parse(this.responseText)["employee_types"];
                let options = "";
                for (let employeeType in employeeTypes) {
                    options += "<option value='" + employeeTypes[employeeType]["id"] + "'>" + employeeTypes[employeeType][
                        "employee_type"
                    ] + "</option>"
                }
                document.getElementById("employee-category").innerHTML = options;
            };
            ajax.send();
        </script>
    </div>
    <div class="form-group col-sm-10">
        <label class="col-sm-2 control-label">Department</label>
        <div class="col-sm-10">
            <select name="department" id="department" class="form-control round-input" required style="width:80%;">
            </select>
        </div>
        <script>
            var ajax = new XMLHttpRequest();
            ajax.open("GET", "/departments", true);
            ajax.onload = function() {
                let departments = JSON.parse(this.responseText)["departments"];
                let options = "";
                for (let department in departments) {
                    options += "<option value='" + departments[department]["id"] + "'>" + departments[department]["name"] +
                        "</option>"
                }
                document.getElementById("department").innerHTML = options;
            };
            ajax.send();
        </script>
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
            <button class="btn btn-primary" id="btn-submit" type="submit" disabled>Submit</button>
            <button class="btn btn-default" type="reset">Reset</button>
        </div>
    </div>
</x-form-bubble>
