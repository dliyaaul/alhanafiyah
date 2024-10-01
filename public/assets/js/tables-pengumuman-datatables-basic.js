/**
 * DataTables Basic
 */

"use strict";

let fv, offCanvasEl, label;
document.addEventListener("DOMContentLoaded", function (e) {
    (function () {
        const formAddNewPengumuman = document.getElementById(
            "formValidationExample"
        );

        setTimeout(() => {
            const newPengumuman = document.querySelector(
                    ".create-new-pengumuman"
                ),
                offCanvasElement = document.querySelector(
                    "#add-new-pengumuman"
                );

            // To open offCanvas, to add new record
            if (newPengumuman) {
                newPengumuman.addEventListener("click", function () {
                    offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
                    label = "Create New Pengumuman";

                    document.getElementById("exampleModalLabel").innerText =
                        label;
                    // Empty fields on offCanvas open
                    (offCanvasElement.querySelector(".dt-tanggal").value = ""),
                        (offCanvasElement.querySelector(".dt-judul").value =
                            ""),
                        (offCanvasElement.querySelector(".dt-isi").value = ""),
                        // Open offCanvas with form
                        offCanvasEl.show();
                });
            }
        }, 200);

        // Form validation for Add new record
        fv = FormValidation.formValidation(formAddNewPengumuman, {
            fields: {
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
                judul: {
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
                isi: {
                    validators: {
                        notEmpty: {
                            message: "Content field is required",
                        },
                        stringLength: {
                            max: 100,
                            message:
                                "The Content must be more than 1 and less than 100 characters long",
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
    var dt_basic_pengumuman_table = $(".datatables-basic-pengumuman"),
        // dt_basic_pengumuman_table = $(".datatables-basic-pengumuman"),
        // dt_row_grouping_table = $('.dt-row-grouping'),
        // dt_multilingual_table = $('.dt-multilingual'),
        dt_basic;

    // DataTable with buttons
    // --------------------------------------------------------------------

    if (dt_basic_pengumuman_table.length) {
        dt_basic = dt_basic_pengumuman_table.DataTable({
            //   ajax: assetsPath + 'json/table-datatable.json',
            ajax: "/dataPengumuman",
            columns: [
                { data: "" },
                { data: "id" },
                {
                    data: "tanggal",
                    render: function (data, type, row) {
                        if (type === "display" || type === "filter") {
                            return formatDateDisplay(data);
                        }
                        return data;
                    },
                },
                { data: "judul" },
                { data: "isi" },
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
                    // tanggal
                    targets: 2,
                    responsivePriority: 2,
                },
                {
                    // judul
                    targets: 3,
                    responsivePriority: 3,
                },
                {
                    // Isi
                    targets: 4,
                    responsivePriority: 5,
                },
                {
                    // Created_at
                    targets: 5,
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
                            '<a href="javascript:void(0)" class="btn btn-sm btn-icon delete-pengumuman"><i class="text-danger ti ti-trash"></i></a>' +
                            '<a href="javascript:void(0)" class="btn btn-sm btn-icon edit-pengumuman"><i class="text-primary ti ti-pencil"></i></a>'
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
                        "create-new-pengumuman btn btn-primary waves-effect waves-light",
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
            '<h5 class="card-title mb-0">DataTable Pengumuman</h5>'
        );
    }

    // ? Remove/Update this code as per your requirements
    var count = 101;
    // Event listener for edit button
    dt_basic_pengumuman_table.on("click", ".edit-pengumuman", function () {
        var data = dt_basic.row($(this).parents("tr")).data();
        editPengumuman(data);
    });

    function editPengumuman(data) {
        const offCanvasElement = document.querySelector("#add-new-pengumuman");

        document.getElementById("exampleModalLabel").innerText =
            "Edit Pengumuman";
        document.getElementById("form-id").value = data.id;
        offCanvasElement.querySelector(".dt-tanggal").value = data.tanggal;
        offCanvasElement.querySelector(".dt-judul").value = data.judul;
        offCanvasElement.querySelector(".dt-isi").value = data.isi;
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

        var url = id ? "/updatePengumuman/" + id : "/addPengumuman";
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
                        tanggal: response.tanggal,
                        judul: response.judul,
                        isi: response.isi,
                        created_at: response.created_at,
                        updated_at: response.updated_at,
                    }).draw();
                } else {
                    // Menambahkan baris baru ke DataTable
                    dt_basic.row
                        .add({
                            id: response.id,
                            tanggal: response.tanggal,
                            judul: response.judul,
                            isi: response.isi,
                            created_at: response.created_at,
                            updated_at: response.updated_at,
                        })
                        .draw();
                    count++;
                }

                // Menghapus parameter query dari URL
                window.history.pushState({}, document.title, "/pengumuman");

                // Hide offcanvas using javascript method
                offCanvasEl.hide();
                resetForm();
            },
            error: function (xhr, status, error) {
                console.error("Status:", status);
                console.error("Error:", error);
                console.error("Response:", xhr.responseText);
            },
        });
    });

    // Delete Record
    $(document).on("click", ".delete-pengumuman", function () {
        var row = dt_basic.row($(this).parents("tr"));
        var data = row.data();

        if (confirm("Are you sure you want to delete this pengumuman?")) {
            $.ajax({
                url: "/deletePengumuman/" + data.id,
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    row.remove().draw();
                    alert("Pengumuman deleted successfully");
                },
                error: function (xhr, status, error) {
                    console.error("Error:", error);
                    alert("Failed to delete pengumuman");
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
