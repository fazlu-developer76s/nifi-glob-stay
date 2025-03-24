@inject('helper', 'App\Helpers\Global_helper')


<!-- resources/views/includes/footer.blade.php -->
<footer style="position: fixed; bottom: -22px   ; left: 0; width: 100%; background-color: #f1f1f1; padding: 10px 0;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <p>&copy; {{ date('Y') }} Nerasoft. All rights reserved. Powered by <a href="https://nerasoft.in/"
                        target="_blank">Nerasoft</a></p>
            </div>
        </div>
    </div>
</footer>
<script src="{{ asset('assets/js/vendor.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/app.min.js') }}" type="text/javascript"></script>
<!--Datatable--->
<script src="{{ asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"
    type="text/javascript"></script>
<script src="{{ asset('assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"
    type="text/javascript"></script>
<script src="{{ asset('assets/js/demo/table-manage-default.demo.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    function closeCard(button,lead_id) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        if (confirm("Are you sure you want to remove this notification?")) {
            $.ajax({
            url: "{{ route('change.lead.status') }}",
            type: 'post',
            data: {
                _token: csrfToken,
                lead_id: lead_id
            },
            success: function(response) {
                button.closest('.card-note').style.display = 'none';
            }
        });
        }
        return false;
    }
</script>
<script>
    $(document).ready(function() {
        @if ($helper->getUserNotification())
            @foreach ($helper->getUserNotification() as $data)
                $.toast({
                    type: 'warning',
                    title: "{{ strip_tags($data->subject) }}",
                    content: "{{ strip_tags($data->message) }}",
                    delay: 50000000000000000,
                });
            @endforeach
        @endif
    });
</script>
<script>
    CKEDITOR.replace('editor');
    CKEDITOR.replace('editor2');
</script>

<script>
    var thispageurl = window.location.href;
    console.log(thispageurl)
    $(".find-link .menu-item").children().each(function() {
        if (this.href === thispageurl) {
            $(this).closest(".menu-item").addClass("active")
            $(this).closest(".has-sub").addClass("active")
        }
    });
</script>
<script src="{{ asset('toast.js') }}"></script>
<script>
    $(document).ready(function() {
                // Check for success message in the session
                @if (session('success'))
                    $.toast({
                        type: 'info', // Set type to 'success'
                        title: 'Success!',
                        content: "{{ session('success') }}", // Get success message from session
                        delay: 5000,
                    });
                @endif

                // Check for error message in the session
                @if (session('error'))
                    $.toast({
                        type: 'error', // Set type to 'error'
                        title: 'Error!',
                        content: "{{ session('error') }}", // Get error message from session
                        delay: 5000,
                    });
                    // @endif
                    // @if (session('warning'))
                    // <script>
                    // $.toast({
                    //     type: 'warning', // Set type to 'warning'
                    //     title: 'Warning!',
                    //     content: "asdfsadfsddf", // Get warning message from session
                    //     delay: 5000, // Display duration in milliseconds
                    // });
                    //
</script>
// @php
    //         session()->forget('warning'); // Clear the session after displaying
    //
@endphp
// @endif

});
</script>
<script>
    function ChangeStatus(table_name, id) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        if ($("#flexSwitchCheckDefault" + id + "").is(':checked')) {
            var status = 1;
        } else {
            var status = 2;
        }

        $.ajax({
            url: "{{ route('change.status') }}",
            type: 'post',
            data: {
                _token: csrfToken,
                table_name: table_name,
                id: id,
                status: status
            },
            success: function(response) {
                console.log(response);
            }
        });
        return false;
    }

    function is_user_verified(table_name, id) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        if ($("#is_user_verified" + id + "").is(':checked')) {
            var status = 1;
        } else {
            var status = 2;
        }
        $.ajax({
            url: "{{ route('user.verified') }}",
            type: 'post',
            data: {
                _token: csrfToken,
                table_name: table_name,
                id: id,
                status: status
            },
            success: function(response) {
                var routeUrl = "{{ route('approved.member') }}";
                window.location.href = routeUrl;
                console.log(response);
            }
        });
        return false;
    }
</script>
<script>
    function ChangeStatusApproved(table_name, id) {
        if (confirm('Are you sure you want to approve')) {

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            if ($("#flexSwitchCheckDefaultproperty" + id + "").is(':checked')) {
                var status = 1;
            } else {
                var status = 2;
            }

            $.ajax({
                url: "{{ route('change.status.property') }}",
                type: 'post',
                data: {
                    _token: csrfToken,
                    table_name: table_name,
                    id: id,
                    status: status
                },
                success: function(response) {
                    var routeUrl = "{{ route('property') }}";
                    window.location.href = routeUrl;
                    console.log(response);
                }
            });
            return false;
        } else {
            if ($("#flexSwitchCheckDefaultproperty" + id + "").is(':checked')) {
                $("#flexSwitchCheckDefaultproperty" + id + "").prop('checked', false);
            }
        }
    }
</script>
<script>
    fetchNotes();

    function SaveNotes() {
        var notes = $('#notes').val().trim();
        var user_id = $('#user_id').val();
        var status = $('#status').val();
        var lead_id = $('#lead_id').val();
        var hidden_id = $('#hidden_id').val();
        var route_id = $("#select_route_id").val();
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var location = $('#location').val().trim();
        var area_type = $('#area_type').val();
        var followup_date = $('#followup_date').val();
        var budget = $('#budget').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        if (notes === '') {
            Swal.fire("Error!", "Notes Title Required!", "error");
            return false;
        }

        if (status == 5) {
            if (route_id === '') {
                Swal.fire("Error!", "Please Select Route!", "error");
                return false;
            }
        }




        // if (!from_date || !to_date) {
        //     Swal.fire("Error!", "Both From Date and To Date are required!", "error");
        //     return false;
        // }

        // if (!location) {
        //     Swal.fire("Error!", "Location is required!", "error");
        //     return false;
        // }

        // if (!area_type) {
        //     Swal.fire("Error!", "Please select an Area Type!", "error");
        //     return false;
        // }

        if (!followup_date) {
            Swal.fire("Error!", "Follow-Up Date is required!", "error");
            return false;
        }

        // if (!budget || parseFloat(budget) < 0) {
        //     Swal.fire("Error!", "Please enter a valid budget!", "error");
        //     return false;
        // }

        $.ajax({
            url: "{{ route('notes.create') }}",
            type: 'POST',
            data: {
                _token: csrfToken,
                title: notes,
                user_id: user_id,
                status: status,
                lead_id: lead_id,
                route_id: route_id,
                hidden_id: hidden_id,
                from_date: from_date,
                to_date: to_date,
                location: location,
                area_type: area_type,
                followup_date: followup_date,
                budget: budget
            },
            success: function(response) {
                if (response == 2) {
                    Swal.fire("Error!", "Route Does Not Exist for This Zipcode", "error");
                    return false;
                }
                if (status == 5) {
                    window.location.reload();
                }

                let loan_status;
                switch (status) {
                    case '1':
                        loan_status = "Pending";
                        break;
                    case '2':
                        loan_status = "View";
                        break;
                    case '3':
                        loan_status = "Under Discussion";
                        break;
                    case '4':
                        loan_status = "Pending Kyc";
                        break;
                    case '5':
                        loan_status = "Qualified";
                        break;
                    case '6':
                        loan_status = "Rejected";
                        break;
                    default:
                        loan_status = "Unknown";
                        break;
                }

                $("#fetch_loan_status").html("<p>" + loan_status + "</p>");
                console.log(response);
                fetchNotes();
                $("#notes").val('');
                $("#hidden_id").val('');
                $('#from_date').val('');
                $('#to_date').val('');
                $('#location').val('');
                $('#area_type').val('');
                $('#followup_date').val('');
                $('#budget').val('');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                Swal.fire("Error!", "An error occurred while saving the note.", "error");
            }
        });
    }

    function statusUpdateLead(lead_id) {
        var lead_status = $('#lead_status' + lead_id).val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        // Check if lead status is selected
        if (!lead_status) {
            Swal.fire("Error!", "Please select a valid status.", "error");
            return;
        }

        $.ajax({
            url: "{{ route('update.lead_status') }}", // Make sure this route exists in your Laravel routes
            type: 'POST',
            data: {
                _token: csrfToken,
                lead_id: lead_id,
                lead_status: lead_status,
            },
            success: function(response) {
                // Handle success
                if (response) {
                    Swal.fire("Success!", "Lead status updated successfully.", "success");
                } else {
                    Swal.fire("Error!", "Failed to update the lead status.", "error");
                }
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
                Swal.fire("Error!", "An error occurred while updating the lead status.", "error");
            }
        });
    }


    function fetchNotes() {

        var lead_id = $('#lead_id').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('notes.fetch') }}",
            type: 'POST',
            data: {
                _token: csrfToken,
                lead_id: lead_id
            },
            success: function(response) {
                $("#note_html").html(response);
                console.log(respone);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("An error occurred while saving the note.");
            }
        });
    }

    function deleteNotes(id) {
        if (confirm('Are you sure you want to delete this note?')) {

            var lead_id = id;
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('notes.delete') }}",
                type: 'POST',
                data: {
                    _token: csrfToken,
                    note_id: lead_id
                },
                success: function(response) {
                    fetchNotes();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("An error occurred while saving the note.");
                }
            });
        }
    }

    function editnotes(id) {

        var dataMessage = $('a[onclick="editnotes(' + id + ')"]').data('message');
        $("#notes").val(dataMessage);
        $("#hidden_id").val(id);
    }

    function startDisscussion(id, user_id) {

        var id = id;
        var user_id = user_id;
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('notes.disscuss') }}",
            type: 'POST',
            data: {
                _token: csrfToken,
                id: id,
                user_id: user_id
            },
            success: function(response) {
                window.location.reload();
                fetchNotes();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("An error occurred while saving the note.");
            }
        });
    }

    function ViewrightModal(lead_id) {
        var lead_id = lead_id;

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('viewright.modal') }}",
            type: 'POST',
            data: {
                _token: csrfToken,
                lead_id: lead_id,

            },
            success: function(response) {
                $(".job-tracking-vertical").html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("An error occurred while saving the note.");
            }
        });
    }
    function rejectLead(lead_id) {
        if(confirm('Are you sure you want to reject this lead?')){
            var lead_id = lead_id;
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('enquiry.reject') }}",
                type: 'POST',
                data: {
                    _token: csrfToken,
                    lead_id: lead_id,

                },
                success: function(response) {
                    if (response == true) {
                    Swal.fire({
                        title: "Success!",
                        text: "Lead Reject Successfully!",
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    }).then(function() {

                        window.location.reload();

                    });
                } else {
                    Swal.fire("Error!", "Error!", "error");
                }
                }
            });
        }
    }

    function Change_kyc_status(kyc_id) {
        var kyc_status = $("#routeSelect").val();
        if (kyc_status == 3) {
            $("#myModal").modal('show');
        }
        if (kyc_status == 4) {
            $("#RejectModal").modal('show');
        }
        $(".kyc_id").val(kyc_id);
        $(".kyc_status").val(kyc_status);

    }

    function showDropdown() {

    }
</script>
<script>
    $(document).ready(function() {
        // Initialize the tags input
        $('input[name="zip_code"]').tagsinput({
            trimValue: true,
            confirmKeys: [13, 44, 32], // enter, comma, space
            focusClass: 'my-focus-class'
        });

        // Zip code validation function
        function isValidZipCode(zip) {
            return /^\d{6}$/.test(zip); // Check if zip code is exactly 6 digits
        }

        // Validate zip code before adding
        $('input[name="zip_code"]').on('beforeItemAdd', function(event) {
            var zipCode = event.item;

            if (!isValidZipCode(zipCode)) {
                event.cancel = true; // Prevent adding if it's not 6 digits
                alert("Each zip code must be exactly 6 digits.");
            }
        });

        // Add focus/blur classes for input field
        $('.bootstrap-tagsinput input').on('focus', function() {
            $(this).closest('.bootstrap-tagsinput').addClass('has-focus');
        }).on('blur', function() {
            $(this).closest('.bootstrap-tagsinput').removeClass('has-focus');
        });
    });
</script>
@if (Request::segment(1) === 'userlocation' && @$get_otp_status->status != 2)
    <script>
        $(document).ready(function() {
            // Initialize the modal with options to prevent closing
            var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
                backdrop: 'static', // Prevent closing when clicking outside the modal
                keyboard: false // Prevent closing with the Escape key
            });

            // Show the modal on page load
            myModal.show();
        });
    </script>
@endif
<script>
    function checkUserLocationOtp() {
        var otp = $("#user_location_otp").val();
        if (otp == '') {
            Swal.fire("Error!", "OTP Required!", "error");
            return false;
        }
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('userlocation.otp.check') }}",
            type: 'POST',
            data: {
                _token: csrfToken,
                otp: otp

            },
            success: function(response) {
                console.log(response);
                if (response == true) {
                    Swal.fire({
                        title: "Success!",
                        text: "Otp Verify Successfully!",
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    }).then(function() {
                        var routeUrl = "{{ route('userlocation') }}";

                        var encodedOtp = btoa(otp); // Encoding the OTP in base64
                        window.location.href = routeUrl + '?request=' + encodedOtp;

                    });
                } else {
                    Swal.fire("Error!", "Invalid OTP!", "error");
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                Swal.fire("Error!", "An error occurred while checking the OTP.", "error");
            }
        });
    }

    function FetchLoanDetail() {
        var otp = $("#loan_number").val();
        if (otp == '') {
            Swal.fire("Error!", "OTP Required!", "error");
            return false;
        }
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('userlocation.otp.check') }}",
            type: 'POST',
            data: {
                _token: csrfToken,
                otp: otp

            },
            success: function(response) {
                console.log(response);
                if (response == true) {
                    Swal.fire({
                        title: "Success!",
                        text: "Otp Verify Successfully!",
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    }).then(function() {
                        var routeUrl = "{{ route('userlocation') }}";

                        var encodedOtp = btoa(otp); // Encoding the OTP in base64
                        window.location.href = routeUrl + '?request=' + encodedOtp;

                    });
                } else {
                    Swal.fire("Error!", "Invalid OTP!", "error");
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                Swal.fire("Error!", "An error occurred while checking the OTP.", "error");
            }
        });
    }

    function CheckStatus() {
        let get_status = $("#status").val();
        if (get_status == 5) {
            $(".select_route_id").removeClass("d-none");
        } else {
            $(".select_route_id").addClass("d-none");
        }
    }
</script>
<script>
    function OpenAssignModal(current_user_id, lead_id, lead_create_user_id) {
        selectedValues = [];
        $('.checkbox_lead_assign:checked').each(function() {
            selectedValues.push($(this).val());
        });

        if (current_user_id) {

            $("#lead_create_user_id").val(lead_create_user_id);
            $("#current_user_id").val(current_user_id);
            $("#current_lead_id").val(selectedValues.join(', '));
        }
    }

    function AssignLead() {

        $(".assign_error").text('');
        $(".assign_success").text('');
        var current_user_id = $("#current_user_id").val();
        var assign_user_id = $("#selectOption").val();
        var lead_id = $("#current_lead_id").val();
        var lead_create_user_id = $("#lead_create_user_id").val();

        if (!assign_user_id) {
            $(".assign_error").text("Please Select Assign User");
            return false;
        }
        if (lead_create_user_id == assign_user_id) {
            $(".assign_error").text("Lead Already Assigned to This User");
            return false;
        }

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('assign.lead') }}",
            type: 'POST',
            data: {
                _token: csrfToken,
                current_user_id: current_user_id,
                assign_user_id: assign_user_id,
                lead_id: lead_id,
            },
            success: function(response) {
                $(".assign_error").text('');
                $(".assign_success").text("Lead Assigned Successfully");
                setTimeout(() => {
                    var routeUrl = "{{ route('enquiry') }}";
                    window.location.href = routeUrl;
                }, 2000);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("An error occurred while assigning the lead.");
            }
        });
    }
</script>
<script>
    $(document).ready(function () {
        // Select/Deselect All Checkboxes
        $('#select-all').on('click', function () {
            $('.select-item').prop('checked', this.checked);
            toggleDeleteButton();
        });

        // Uncheck "Select All" if any checkbox is unchecked
        $('.select-item').on('click', function () {
            $('#select-all').prop('checked', $('.select-item:checked').length === $('.select-item').length);
            toggleDeleteButton();
        });

        // Enable or disable delete button
        function toggleDeleteButton() {
            $('#bulk-delete-btn').prop('disabled', $('.select-item:checked').length === 0);
        }
    });
</script>
</body>

</html>
