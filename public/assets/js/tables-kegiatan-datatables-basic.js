/**
 * DataTables Basic
 */

("use strict");

let fv, offCanvasEl, label;
document.addEventListener("DOMContentLoaded", function (e) {
    (function () {
        const formAddNewKegiatan = document.getElementById(
            "formValidationExample"
        );

        setTimeout(() => {
            const newKegiatan = document.querySelector(".create-new-kegiatan"),
                offCanvasElement = document.querySelector("#add-new-kegiatan");

            // To open offCanvas, to add new record
            if (newKegiatan) {
                newKegiatan.addEventListener("click", function () {
                    offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
                    label = "Create New Kegiatan";

                    document.getElementById("exampleModalLabel").innerText =
                        label;
                    // Empty fields on offCanvas open
                    (offCanvasElement.querySelector(".dt-gambar").value = ""),
                        (offCanvasElement.querySelector(
                            ".dt-keterangan"
                        ).value = ""),
                        (offCanvasElement.querySelector(".dt-tempat").value =
                            ""),
                        (offCanvasElement.querySelector(".dt-tanggal").value =
                            ""),
                        // Open offCanvas with form
                        offCanvasEl.show();
                });
            }
        }, 200);

        // Form validation for Add new record
        fv = FormValidation.formValidation(formAddNewKegiatan, {
            fields: {
                gambar: {
                    validators: {
                        notEmpty: {
                            message: "The file is required",
                        },
                        file: {
                            extension: "jpeg,jpg,png",
                            type: "image/jpeg,image/png",
                            maxSize: 1048576, // 1 MB dalam byte
                            message:
                                "The selected Image is not valid or it is larger than 1MB",
                        },
                    },
                },
                keterangan: {
                    validators: {
                        notEmpty: {
                            message: "Title field is required",
                        },
                        stringLength: {
                            max: 50,
                            message:
                                "The Title must be more than 1 and less than 50 characters long",
                        },
                    },
                },
                tempat: {
                    validators: {
                        notEmpty: {
                            message: "Place field is required",
                        },
                        stringLength: {
                            max: 50,
                            message:
                                "The Place must be more than 1 and less than 50 characters long",
                        },
                    },
                },
                tanggal: {
                    validators: {
                        notEmpty: {
                            message: "Joining Date is required",
                        },
                        date: {
                            format: "YYYY-MM-DD",
                            message: "The value is not a valid date",
                        },
                    },
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    // Use this for enabling/changing valid/invalid class
                    // eleInvalidClass: '',
                    eleValidClass: "",
                    rowSelector: ".col-sm-12",
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus(),
            },
            init: (instance) => {
                instance.on("plugins.message.placed", function (e) {
                    if (
                        e.element.parentElement.classList.contains(
                            "input-group"
                        )
                    ) {
                        e.element.parentElement.insertAdjacentElement(
                            "afterend",
                            e.messageElement
                        );
                    }
                });
            },
        });

        // FlatPickr Initialization & Validation
        const flatpickrDate = document.querySelector('[name="tanggal"]');

        if (flatpickrDate) {
            flatpickrDate.flatpickr({
                enableTime: false,
                // See https://flatpickr.js.org/formatting/
                dateFormat: "Y-m-d",
                // After selecting a date, we need to revalidate the field
                onChange: function () {
                    fv.revalidateField("tanggal");
                },
            });
        }
    })();
});

// datatable (jquery)
$(function () {
    const notyf = new Notyf(); // Inisialisasi notyf

    var dt_basic_kegiatan_table = $(".datatables-basic-kegiatan"),
        // dt_basic_kegiatan_table = $(".datatables-basic-kegiatan"),
        // dt_row_grouping_table = $('.dt-row-grouping'),
        // dt_multilingual_table = $('.dt-multilingual'),
        dt_basic;

    // DataTable with buttons
    // --------------------------------------------------------------------

    if (dt_basic_kegiatan_table.length) {
        dt_basic = dt_basic_kegiatan_table.DataTable({
            //   ajax: assetsPath + 'json/table-datatable.json',
            ajax: "/dataKegiatan",
            columns: [
                { data: "" },
                { data: "id" },
                { data: "gambar" },
                { data: "keterangan" },
                { data: "tempat" },
                {
                    data: "tanggal",
                    render: function (data, type, row) {
                        if (type === "display" || type === "filter") {
                            return formatDateDisplay(data);
                        }
                        return data;
                    },
                },
                { data: "created_at" },
                { data: "updated_at" },
                { data: "" },
            ],
            rowId: "id",
            columnDefs: [
                {
                    // For Responsive
                    className: "control",
                    orderable: false,
                    searchable: false,
                    responsivePriority: 2,
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return "";
                    },
                },
                {
                    // ID
                    targets: 1,
                    responsivePriority: 1,
                    searchable: false,
                },
                {
                    // Logo
                    targets: 2,
                    responsivePriority: 2,
                    render: function (data, type, full, meta) {
                        return `<img src="/storage/img/kegiatan/${data}" alt="Avatar" style="width: 40px; height:40px;" class="rounded-circle">`;
                    },
                },
                {
                    // Judul
                    targets: 3,
                    responsivePriority: 3,
                },
                {
                    // Isi
                    targets: 4,
                    responsivePriority: 5,
                },
                {
                    // Isi
                    targets: 5,
                    responsivePriority: 5,
                },
                {
                    // Created_at
                    targets: 6,
                    responsivePriority: 6,
                    render: function (data, type, full, meta) {
                        return new Date(data).toLocaleString();
                    },
                },
                {
                    // Updated_at
                    targets: -2,
                    responsivePriority: 7,
                    render: function (data, type, full, meta) {
                        return new Date(data).toLocaleString();
                    },
                },
                {
                    // Actions
                    targets: -1,
                    title: "Actions",
                    responsivePriority: 4,
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        return (
                            '<a href="javascript:void(0)" class="btn btn-sm btn-icon delete-kegiatan"><i class="text-danger ti ti-trash"></i></a>' +
                            '<a href="javascript:void(0)" class="btn btn-sm btn-icon edit-kegiatan"><i class="text-primary ti ti-pencil"></i></a>'
                        );
                    },
                },
            ],
            order: [[2, "desc"]],
            dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
            buttons: [
                {
                    extend: "collection",
                    className:
                        "btn btn-label-primary dropdown-toggle me-2 waves-effect waves-light",
                    text: '<i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                    buttons: [
                        {
                            extend: "print",
                            text: '<i class="ti ti-printer me-1" ></i>Print',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [3, 4, 5, 6, 7],
                                // prevent avatar to be display
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = "";
                                        $.each(el, function (index, item) {
                                            if (
                                                item.classList !== undefined &&
                                                item.classList.contains(
                                                    "user-name"
                                                )
                                            ) {
                                                result =
                                                    result +
                                                    item.lastChild.firstChild
                                                        .textContent;
                                            } else if (
                                                item.innerText === undefined
                                            ) {
                                                result =
                                                    result + item.textContent;
                                            } else
                                                result =
                                                    result + item.innerText;
                                        });
                                        return result;
                                    },
                                },
                            },
                            customize: function (win) {
                                //customize print view for dark
                                $(win.document.body)
                                    .css("color", config.colors.headingColor)
                                    .css(
                                        "border-color",
                                        config.colors.borderColor
                                    )
                                    .css(
                                        "background-color",
                                        config.colors.bodyBg
                                    );
                                $(win.document.body)
                                    .find("table")
                                    .addClass("compact")
                                    .css("color", "inherit")
                                    .css("border-color", "inherit")
                                    .css("background-color", "inherit");
                            },
                        },
                        {
                            extend: "csv",
                            text: '<i class="ti ti-file-text me-1" ></i>Csv',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [3, 4, 5, 6, 7],
                                // prevent avatar to be display
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = "";
                                        $.each(el, function (index, item) {
                                            if (
                                                item.classList !== undefined &&
                                                item.classList.contains(
                                                    "user-name"
                                                )
                                            ) {
                                                result =
                                                    result +
                                                    item.lastChild.firstChild
                                                        .textContent;
                                            } else if (
                                                item.innerText === undefined
                                            ) {
                                                result =
                                                    result + item.textContent;
                                            } else
                                                result =
                                                    result + item.innerText;
                                        });
                                        return result;
                                    },
                                },
                            },
                        },
                        {
                            extend: "excel",
                            text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [3, 4, 5, 6, 7],
                                // prevent avatar to be display
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = "";
                                        $.each(el, function (index, item) {
                                            if (
                                                item.classList !== undefined &&
                                                item.classList.contains(
                                                    "user-name"
                                                )
                                            ) {
                                                result =
                                                    result +
                                                    item.lastChild.firstChild
                                                        .textContent;
                                            } else if (
                                                item.innerText === undefined
                                            ) {
                                                result =
                                                    result + item.textContent;
                                            } else
                                                result =
                                                    result + item.innerText;
                                        });
                                        return result;
                                    },
                                },
                            },
                        },
                        {
                            extend: "pdf",
                            text: '<i class="ti ti-file-description me-1"></i>Pdf',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [3, 4, 5, 6, 7],
                                // prevent avatar to be display
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = "";
                                        $.each(el, function (index, item) {
                                            if (
                                                item.classList !== undefined &&
                                                item.classList.contains(
                                                    "user-name"
                                                )
                                            ) {
                                                result =
                                                    result +
                                                    item.lastChild.firstChild
                                                        .textContent;
                                            } else if (
                                                item.innerText === undefined
                                            ) {
                                                result =
                                                    result + item.textContent;
                                            } else
                                                result =
                                                    result + item.innerText;
                                        });
                                        return result;
                                    },
                                },
                            },
                        },
                        {
                            extend: "copy",
                            text: '<i class="ti ti-copy me-1" ></i>Copy',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [3, 4, 5, 6, 7],
                                // prevent avatar to be display
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = "";
                                        $.each(el, function (index, item) {
                                            if (
                                                item.classList !== undefined &&
                                                item.classList.contains(
                                                    "user-name"
                                                )
                                            ) {
                                                result =
                                                    result +
                                                    item.lastChild.firstChild
                                                        .textContent;
                                            } else if (
                                                item.innerText === undefined
                                            ) {
                                                result =
                                                    result + item.textContent;
                                            } else
                                                result =
                                                    result + item.innerText;
                                        });
                                        return result;
                                    },
                                },
                            },
                        },
                    ],
                },
                {
                    text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Add New Record</span>',
                    className:
                        "create-new-kegiatan btn btn-primary waves-effect waves-light",
                },
            ],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return "Details of " + data["judul"];
                        },
                    }),
                    type: "column",
                    renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
                            return col.title !== "" // ? Do not show row in modal popup if title is blank (for check box)
                                ? '<tr data-dt-row="' +
                                      col.rowIndex +
                                      '" data-dt-column="' +
                                      col.columnIndex +
                                      '">' +
                                      "<td>" +
                                      col.title +
                                      ":" +
                                      "</td> " +
                                      "<td>" +
                                      col.data +
                                      "</td>" +
                                      "</tr>"
                                : "";
                        }).join("");

                        return data
                            ? $('<table class="table"/><tbody />').append(data)
                            : false;
                    },
                },
            },
        });
        $("div.head-label").html(
            '<h5 class="card-title mb-0">DataTable Kegiatan</h5>'
        );
    }

    // ? Remove/Update this code as per your requirements
    var count = 101;
    // Event listener for edit button
    dt_basic_kegiatan_table.on("click", ".edit-kegiatan", function () {
        var data = dt_basic.row($(this).parents("tr")).data();
        editKegiatan(data);
    });

    function editKegiatan(data) {
        const offCanvasElement = document.querySelector("#add-new-kegiatan");

        document.getElementById("exampleModalLabel").innerText =
            "Edit Kegiatan";
        document.getElementById("form-id").value = data.id;
        offCanvasElement.querySelector(".dt-keterangan").value =
            data.keterangan;
        offCanvasElement.querySelector(".dt-tempat").value = data.tempat;
        offCanvasElement.querySelector(".dt-tanggal").value = data.tanggal;
        document.getElementById("submit-button").textContent = "Update";

        offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
        offCanvasEl.show();
    }
    function resetForm() {
        document.getElementById("formValidationExample").reset();
        document.getElementById("form-id").value = "";
        document.getElementById("submit-button").textContent = "Submit";
    }
    function formatDateDisplay(dateStr) {
        var date = new Date(dateStr);
        var month = (date.getMonth() + 1).toString().padStart(2, "0");
        var day = date.getDate().toString().padStart(2, "0");
        var year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }
    // On form submit, if form is valid
    fv.on("core.form.valid", function () {
        var form = document.getElementById("formValidationExample");
        var formData = new FormData(form);
        var id = formData.get("id");

        var url = id ? "/updateKegiatan/" + id : "/addKegiatan";
        var method = id ? "POST" : "POST"; // Gunakan POST untuk keduanya

        if (id) {
            formData.append("_method", "PUT"); // Tambahkan _method untuk meniru PUT
        }

        $.ajax({
            url: url, // URL endpoint Laravel untuk menyimpan data
            method: method,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: formData,
            processData: false, // Jangan memproses data
            contentType: false, // Jangan mengatur jenis konten
            success: function (response) {
                if (id) {
                    // Mengupdate baris yang ada di DataTable
                    var row = dt_basic.row("#" + id);
                    row.data({
                        id: response.id,
                        gambar: response.gambar,
                        keterangan: response.keterangan,
                        tempat: response.tempat,
                        tanggal: response.tanggal,
                        created_at: response.created_at,
                        updated_at: response.updated_at,
                    }).draw();
                } else {
                    // Menambahkan baris baru ke DataTable
                    dt_basic.row
                        .add({
                            id: response.id,
                            gambar: response.gambar,
                            keterangan: response.keterangan,
                            tempat: response.tempat,
                            tanggal: response.tanggal,
                            created_at: response.created_at,
                            updated_at: response.updated_at,
                        })
                        .draw();
                    count++;
                }

                // Menghapus parameter query dari URL
                window.history.pushState({}, document.title, "/kegiatan");

                // Hide offcanvas using javascript method
                offCanvasEl.hide();
                resetForm();

                notyf.success({
                    message: "Success Added Data",
                    duration: 4000,
                });
            },
            error: function (xhr, status, error) {
                console.error("Status:", status);
                console.error("Error:", error);
                console.error("Response:", xhr.responseText);
                notyf.error({
                    message: "Failed to Added Data",
                    duration: 4000, // durasi 5 detik
                });
            },
        });
    });

    // Delete Record
    $(document).on("click", ".delete-kegiatan", function () {
        var row = dt_basic.row($(this).parents("tr"));
        var data = row.data();

        if (confirm("Are you sure you want to delete this kegiatan?")) {
            $.ajax({
                url: "/deleteKegiatan/" + data.id,
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    row.remove().draw();
                    // Notifikasi sukses menggunakan Notyf
                    notyf.success({
                        message: "Success Delete Data",
                        duration: 4000,
                    });
                },
                error: function (xhr, status, error) {
                    console.error("Error:", error);
                    // Notifikasi error menggunakan Notyf
                    notyf.error({
                        message: "Failed to delete kegiatan",
                        duration: 4000, // durasi 5 detik
                    });
                },
            });
        }
    });

    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
        $(".dataTables_filter .form-control").removeClass("form-control-sm");
        $(".dataTables_length .form-select").removeClass("form-select-sm");
    }, 300);
});
