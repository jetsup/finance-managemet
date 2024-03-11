<x-layout-admin notifications="{{ $notifications }}" title="Reports|Generate">

    <body>
        <section id="main-content" style=" margin-right:110px;">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="icon_document_alt"></i>Reports</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i>Home</li>
                            <li><i class="fa fa-file-text-o"></i>Reports</li>
                            <li><i class="fa fa-plus"></i>Create</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Reports
                            </header>
                            <div class="panel-body">
                                {{-- select period to generate reports for --}}
                                <form action="/reports/generate" method="POST" id="form">
                                    @csrf
                                    <div>
                                        <label for="combo-startdate" class="col-sm-2 control-label">Start Date</label>
                                        <input type="date" id="combo-startdate" name="combo-startdate"
                                            class="form-control" min="{{ firstTransactionDate() }}"
                                            {{-- max="2021-12-31" --}} required>
                                    </div>

                                    <div>
                                        <label for="combo-enddate" class="col-sm-2 control-label">End Date</label>
                                        <input type="date" id="combo-enddate" name="combo-enddate"
                                            class="form-control" min="{{ firstTransactionDate() }}"
                                            max="{{ lastTransactionDate() }}" required>
                                    </div>

                                    <div>
                                        <label for="combo-transactiontype" class="col-sm-2 control-label">Transaction
                                            Type</label>
                                        <select id="combo-transactiontype" name="combo-transactiontype"
                                            class="form-control"></select>
                                        <script>
                                            // get transaction types using ajax
                                            let ajax = new XMLHttpRequest();
                                            ajax.open("GET", "/reports/transactiontypes", true);
                                            ajax.onload = function() {
                                                let data = JSON.parse(this.responseText);
                                                let transactiontypes = data["types"];
                                                let options = "";
                                                for (let i = 0; i < transactiontypes.length; i++) {
                                                    options += "<option value='" + transactiontypes[i].id + "'>" +
                                                        transactiontypes[i].transaction_type + "</option>";
                                                }
                                                options += "<option value='0'>ALL</option>"
                                                document.getElementById("combo-transactiontype").innerHTML = options;
                                            }
                                            ajax.send();
                                        </script>
                                    </div>

                                    <div style="margin-top: 20px">
                                        {{-- view the report and save logs about the report --}}
                                        {{-- <button type="button" class="btn btn-primary btn-success"
                                        onclick="requestGenerate()">Generate</button> --}}
                                        <button type="submit" class="btn btn-primary btn-success">Generate</button>
                                    </div>
                                </form>

                                {{-- <script>
                                    function requestGenerate() {
                                        // verify all form fields are filled
                                        let form = document.getElementById("form");
                                        // if (!form.checkValidity()) {
                                        //     form.reportValidity();
                                        //     return;
                                        // }
                                        let csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

                                        let data = {
                                            "start-date": document.getElementById("combo-startdate").value,
                                            "end-date": document.getElementById("combo-enddate").value,
                                            "type": document.getElementById("combo-transactiontype").value,
                                        };
                                        console.log("DATA:", data);

                                        let ajax = new XMLHttpRequest();
                                        ajax.open("POST", "/reports/generate", true);
                                        ajax.setRequestHeader("Content-Type", "application/json");
                                        ajax.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                                        ajax.onload = function() {
                                            if (ajax.status === 200) {
                                                console.log(this.responseText);
                                            } else {
                                                console.error("Error:", ajax.status, ajax.statusText);
                                                // Optionally, you can log the response text for more details
                                                // console.log(this.responseText);
                                            }
                                        };
                                        ajax.send(JSON.stringify(data));
                                    }
                                </script> --}}
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </body>

</x-layout-admin>
