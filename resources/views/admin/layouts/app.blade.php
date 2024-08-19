
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      class="light-style layout-navbar-fixed layout-compact layout-menu-fixed" id="html"
      dir="{{ str_replace('_', '-', app()->getLocale()) == 'ar' ? 'rtl' : 'ltr' }}" data-theme="theme-default"
      data-assets-path="/assets/admin/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{__('dashboard.favicon.dashboard')}}</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    {{--    <link rel="icon" type="image/x-icon" href="/assets/admin/img/favicon/favicon.ico" />--}}
    <link rel="shortcut icon" href="/assets/user/assets/img/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/assets/admin/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    @if (App::getLocale() == 'ar')
        @if(Auth::guard('admin')->user()->theme_default== 0 )
            <link rel="stylesheet" href="/assets/admin/vendor/css/rtl-light/core-ar.css" class="template-customizer-core-css" />
            <link rel="stylesheet" href="/assets/admin/vendor/css/rtl-light/theme-default-ar.css"
                  class="template-customizer-theme-css" />
        @else
            <link rel="stylesheet" href="/assets/admin/vendor/css/rtl-dark/core-dark.css"
                  class="template-customizer-core-css" />
            <link rel="stylesheet" href="/assets/admin/vendor/css/rtl-dark/theme-default-dark.css"
                  class="template-customizer-theme-css" />
        @endif

    @else
        @if(Auth::guard('admin')->user()->theme_default== 0 )
            <link rel="stylesheet" href="/assets/admin/vendor/css/ltr-light/core-en.css" class="template-customizer-core-css" />
            <link rel="stylesheet" href="/assets/admin/vendor/css/ltr-light/theme-default-en.css"
                  class="template-customizer-theme-css" />
        @else
            <link rel="stylesheet" href="/assets/admin/vendor/css/ltr-dark/core-dark.css"
                  class="template-customizer-core-css" />
            <link rel="stylesheet" href="/assets/admin/vendor/css/ltr-dark/theme-default-dark.css"
                  class="template-customizer-theme-css" />
        @endif
    @endif
    <link rel="stylesheet" href="/assets/admin/css/demo.css" />
    <link rel="stylesheet" href="/assets/admin/css/page-user-view.css" />
    <link rel="stylesheet" href="/assets/admin/css/app-academy.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="/assets/admin/vendor/libs/apex-charts/apex-charts.css" />
    <!-- Page CSS -->

{{--    <link rel="stylesheet" href="/assets/admin/vendor/libs/bootstrap-select/bootstrap-select.css" />--}}

    <link rel="stylesheet" href="/assets/admin/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="/assets/admin/vendor/libs/tagify/tagify.css" />
    <link rel="stylesheet" href="/assets/admin/vendor/libs/typeahead-js/typeahead.css" />

    <!-- Helpers -->
    <script src="/assets/admin/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/assets/admin/js/config.js"></script>


    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
    <style>
        .mult-select-tag button {
            margin-top: -1px !important;
        }

        .ck-editor__editable[role="textbox"] {
            /* Editing area */
            min-height: 300px;
        }

        .ck-content .image {
            /* Block images */
            max-width: 80%;
            margin: 20px auto;
        }

    </style>
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('sweetalert::alert')

        @include('admin.layouts.sidebar')


        <div class="layout-page">
            @include('admin.layouts.header')
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>



    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
</div>












<!-- / Layout wrapper -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
{{--<script src="/assets/admin/vendor/libs/bootstrap-select/bootstrap-select.js"></script>--}}
<script src="/assets/admin/vendor/libs/jquery/jquery.js"></script>
<script src="/assets/admin/vendor/libs/popper/popper.js"></script>

<script src="/assets/admin/vendor/js/bootstrap.js"></script>
<script src="/assets/admin/vendor/libs/select2/select2.js"></script>
<script src="/assets/admin/vendor/libs/tagify/tagify.js"></script>
<script src="/assets/admin/vendor/libs/typeahead-js/typeahead.js"></script>
<script src="/assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/assets/admin/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="/assets/admin/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="/assets/admin/js/main.js"></script>
<script src="/assets/admin/js/pages-account-settings-account.js"></script>




<!-- Page JS -->
<script src="/assets/admin/js/dashboards-analytics.js"></script>
<script src="/assets/admin/js/app-user-view-account.js"></script>
<script>
    "use strict";
    $(function() {
        var e = $(".select2");
        e.length && e.each(function() {
            var e = $(this);
            e.wrap('<div class="position-relative"></div>').select2({
                placeholder: "Select value",
                dropdownParent: e.parent()
            })
        })
    }),
        document.addEventListener("DOMContentLoaded", function(e) {
            var a, t;
            a = document.querySelector(".modal-edit-tax-id"),
                t = document.querySelector(".phone-number-mask"),
            a && new Cleave(a, {
                prefix: "TIN",
                blocks: [3, 3, 3, 4],
                uppercase: !0
            }),
            t && new Cleave(t, {
                phone: !0,
                phoneRegionCode: "US"
            }),
                FormValidation.formValidation(document.getElementById("editUserForm"), {
                    fields: {
                        modalEditUserFirstName: {
                            validators: {
                                notEmpty: {
                                    message: "Please enter your first name"
                                },
                                regexp: {
                                    regexp: /^[a-zA-Zs]+$/,
                                    message: "The first name can only consist of alphabetical"
                                }
                            }
                        },
                        modalEditUserLastName: {
                            validators: {
                                notEmpty: {
                                    message: "Please enter your last name"
                                },
                                regexp: {
                                    regexp: /^[a-zA-Zs]+$/,
                                    message: "The last name can only consist of alphabetical"
                                }
                            }
                        },
                        modalEditUserName: {
                            validators: {
                                notEmpty: {
                                    message: "Please enter your username"
                                },
                                stringLength: {
                                    min: 6,
                                    max: 30,
                                    message: "The name must be more than 6 and less than 30 characters long"
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z0-9 ]+$/,
                                    message: "The name can only consist of alphabetical, number and space"
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger,
                        bootstrap5: new FormValidation.plugins.Bootstrap5({
                            eleValidClass: "",
                            rowSelector: ".col-12"
                        }),
                        submitButton: new FormValidation.plugins.SubmitButton,
                        autoFocus: new FormValidation.plugins.AutoFocus
                    }
                })
        });
</script>
<script src="/assets/admin/js/app-user-view.js"></script>
<script src="/assets/admin/js/app-user-view-account.js"></script>
{{--<script src="/assets/admin/js/app-academy.js"></script>--}}
<script src="/assets/admin/js/forms-selects.js"></script>
<script src="/assets/admin/js/forms-tagify.js"></script>
<script src="/assets/admin/js/forms-typeahead.js"></script>
<script src="/assets/admin/js/forms-file-upload.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/super-build/ckeditor.js"></script>

<script>
    const editorConfig = {
        toolbar: {
            items: [
                'exportPDF', 'exportWord', '|',
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                'textPartLanguage', '|',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        placeholder: '',
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        fontSize: {
            options: [10, 12, 14, 'default', 18, 20, 22],
            supportAllValues: true
        },
        htmlSupport: {
            allow: [
                {
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }
            ]
        },
        htmlEmbed: {
            showPreviews: true
        },
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        mention: {
            feeds: [
                {
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }
            ]
        },
        removePlugins: [
            'AIAssistant',
            'CKBox',
            'CKFinder',
            'EasyImage',
            'MultiLevelList',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            'MathType',
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents',
            'PasteFromOfficeEnhanced',
            'CaseChange'
        ]
    };

    document.querySelectorAll('.editor').forEach((editorElement) => {
        CKEDITOR.ClassicEditor.create(editorElement, editorConfig).catch(error => {
            console.error(error);
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#lightTheme").click(function() {
            var theme = 'light';
            $.ajax({
                url: '/admin/theme?val=' + theme,
                type: 'GET',
                success: function(data) {
                    window.location.href = window.location.href;
                }
            });
        });

        $("#darkTheme").click(function() {
            var theme = 'dark';
            $.ajax({
                url: '/admin/theme?val=' + theme,
                type: 'GET',
                success: function(data) {
                    window.location.href = window.location.href;
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#city').change(function() {
            var cityId = $(this).val();
            var locale = '{{ app()->getLocale() }}'; // Get the current locale

            $.ajax({
                url: '/admin/regions/' + cityId,
                type: 'GET',
                success: function(data) {
                    $('#region').empty(); // Clear existing options
                    $.each(data, function(index, region) {
                        var name = (locale === 'ar') ? region.name_ar : region
                            .name_en; // Check the locale
                        $('#region').append('<option value="' + region.id + '">' +
                            name + '</option>');
                    });
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#input_search').on('keyup', function() {
            var query = $(this).val();
            if (query.length > 0) {
                $.ajax({
                    url: "{{url('dashboard/search')}}",
                    type: 'GET',
                    data: {
                        'query': query
                    },
                    success: function(data) {
                        const li = document.createElement('li');
                        li.innerHTML = data;
                        $('#searchDiv').show();
                        $('#search-results').html(data);
                    }
                });
            } else {
                $('#searchDiv').hide();
                $('#search-results').empty();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#menu-toggle-btn').click(function() {
            const htmlLayout = document.getElementById("html")
            htmlLayout.classList.toggle("layout-menu-collapsed")
            console.log(htmlLayout);
        });
        const layoutMenu = document.getElementById("layout-menu")
        layoutMenu.addEventListener("mouseover", () => {
            const htmlLayout = document.getElementById("html")
            htmlLayout.classList.add("layout-menu-hover")
        })
    });
</script>

<script>
    $(document).ready(function() {
        $('.ckbtn').click(function() {
            var id = $(this).data('image-id');
            $.ajax({
                url: '/admin/image/' + id,
                type: 'GET',
                success: function(data) {
                    location.reload(); // Refresh the page
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.pckbtn').click(function() {
            var id = $(this).data('image-id');
            $.ajax({
                url: '/admin/image-package/' + id,
                type: 'GET',
                success: function(data) {
                    location.reload(); // Refresh the page
                }
            });
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('.vdbtn').click(function() {
            var id = $(this).data('video-id');
            $.ajax({
                url: '/admin/video/' + id,
                type: 'GET',
                success: function(data) {
                    location.reload(); // Refresh the page
                }
            });
        });
    });
</script>

{{--    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>--}}

{{--<script>--}}
{{--    document.getElementById('fileInput').addEventListener('change', function(event) {--}}
{{--        const files = event.target.files;--}}
{{--        const filePreview = document.getElementById('filePreview');--}}

{{--        for (const file of files) {--}}
{{--            const fileReader = new FileReader();--}}
{{--            fileReader.onload = function(e) {--}}
{{--                const div = document.createElement('div');--}}
{{--                div.classList.add('file-item');--}}
{{--                div.innerHTML = `--}}
{{--            <img src="${e.target.result}" alt="file">--}}
{{--            <div>${file.name} <br> ${Math.round(file.size / 1024)} KB</div>--}}
{{--            <div class="remove-file">Remove file</div>--}}
{{--          `;--}}
{{--                filePreview.appendChild(div);--}}

{{--                div.querySelector('.remove-file').addEventListener('click', function() {--}}
{{--                    div.remove();--}}
{{--                });--}}
{{--            };--}}
{{--            fileReader.readAsDataURL(file);--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}

<script>
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const filePreview = document.getElementById('filePreview');

    dropZone.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropZone.classList.add('dragover');
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('dragover');
    });

    dropZone.addEventListener('drop', (event) => {
        event.preventDefault();
        dropZone.classList.remove('dragover');

        const files = event.dataTransfer.files;
        handleFiles(files);
    });

    fileInput.addEventListener('change', (event) => {
        const files = event.target.files;
        handleFiles(files);
    });

    const uploadedFiles = new Set();

    function handleFiles(files) {
        for (const file of files) {
            // Create a unique identifier for each file using its name and size
            const fileIdentifier = `${file.name}_${file.size}`;

            // Check if the file is already uploaded
            if (!uploadedFiles.has(fileIdentifier)) {
                // Add the file to the set of uploaded files
                uploadedFiles.add(fileIdentifier);

                const fileReader = new FileReader();
                fileReader.onload = function(e) {
                    const div = document.createElement('div');
                    div.classList.add('file-item');
                    div.innerHTML = `
                    <img src="${e.target.result}" alt="${file.name}">
                    <div>${file.name} <br> ${Math.round(file.size / 1024)} KB</div>
                    <div class="remove-file">Remove file</div>
                `;
                    filePreview.appendChild(div);

                    div.querySelector('.remove-file').addEventListener('click', function() {
                        // Remove the file from the preview and the set of uploaded files
                        div.remove();
                        uploadedFiles.delete(fileIdentifier);
                    });
                };
                fileReader.readAsDataURL(file);
            }
        }
    }

</script>
<script>
    $(document).ready(function() {
        $('.del').click(function() {
            var id = $(this).data('image-id');
            $.ajax({
                url: '/admin/image-partner/' + id,
                type: 'GET',
                success: function(data) {
                    location.reload(); // Refresh the page
                }
            });
        });
    });
</script>
</body>

</html>
