<script src="{{asset('public/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/timeline/horizontal-timeline.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/core/app.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/customizer.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/validations.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/custome.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"  type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"  type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/image-uploader.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/extensions/sweetalert.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/extensions/sweet-alerts.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/forms/select/select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/forms/toggle/switchery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/forms/validation/form-validation.js')}}" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">

    $(function () {



        var table = $('#adminmaketable').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('make.index') }}",

            columns: [

                {data: 'id', name: 'id'},

                {data: 'name', name: 'name'},

                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

        });
        var table = $('#adminmodel').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('model.index') }}",

            columns: [

                {data: 'id', name: 'id'},

                {data: 'name', name: 'name'},

                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

        });
        var table2 = $('#admincar').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('car.index') }}",

            columns: [

                {data: 'id', name: 'id'},

                {data: 'title', name: 'title'},
                {data: 'Make', name: 'Make'},
                {data: 'carModel', name: 'carModel'},
                {data: 'year', name: 'year'},
                {data: 'mileage', name: 'mileage'},
                {data: 'fuel', name: 'fuel'},
                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

        });

        var table = $('#adminspareparts').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('sparepart.index') }}",

            columns: [

                {data: 'id', name: 'id'},

                {data: 'title', name: 'title'},
                {data: 'carName', name: 'Make'},
                {data: 'description', name: 'carModel'},
                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

        });

        var table = $('#adminssales').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('admin.sales') }}",

            columns: [

                {data: 'id', name: 'id'},
                {data: 'sparePartName', name: 'spare_part.title'},
                {data: 'price', name: 'price'},
                {data: 'userName', name: 'user.name'},
                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

        });

        var table = $('#adminsupplier').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('admin.supplier') }}",

            columns: [

                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'trade_name', name: 'supplier.trade_name'},
                {data: 'business_type', name: 'supplier.business_type'},
                {data: 'account_status', name: 'supplier.account_status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

        });


    });

</script>



