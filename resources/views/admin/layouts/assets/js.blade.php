
<!--Load JQuery-->
<script src="{{asset('assets/admin/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/admin/js/plugins/metismenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('assets/admin/js/plugins/blockui-master/jquery-ui.js')}}"></script>
<script src="{{asset('assets/admin/js/plugins/blockui-master/jquery.blockUI.js')}}"></script>
<script src="{{asset('assets/admin/js/functions.js')}}"></script>

<script src="{{asset('assets/admin/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/admin/js/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/admin/js/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/admin/js/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{asset('assets/admin/js/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/admin/js/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/admin/js/plugins/datatables/extensions/Buttons/js/buttons.html5.js')}}"></script>
<script src="{{asset('assets/admin/js/plugins/datatables/extensions/Buttons/js/buttons.colVis.js')}}"></script>
<script src="{{asset('assets/admin/js/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>
@if(count($errors))
    @include('admin.layouts.old')
@endif
<script>
    $(document).ready(function () {
        $('.dataTables-example').DataTable({
            dom: '<"html5buttons" B>lTfgitp',
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ]
                    }
                },
                'colvis'
            ]
        });

        // Colorpicker
        if ($.isFunction($.fn.colorpicker))
        {
            $(".colorpicker").each(function (i, el)
            {
                var $this = $(el);
                var  opts = {
                    //format: attrDefault($this, 'format', false)
                };
                var $nextEle = $this.next();
                var $prevEle = $this.prev();
                var $colorPreview = $this.siblings('.input-group-addon').find('.icon-color-preview');

                $this.colorpicker(opts);

                if ($nextEle.is('.input-group-addon') && $nextEle.has('span'))
                {
                    $nextEle.on('click', function (ev)
                    {
                        ev.preventDefault();
                        $this.colorpicker('show');
                    });
                }

                if ($prevEle.is('.input-group-addon') && $prevEle.has('span'))
                {
                    $prevEle.on('click', function (ev)
                    {
                        ev.preventDefault();
                        $this.colorpicker('show');
                    });
                }

                if ($colorPreview.length)
                {
                    $this.on('changeColor', function (ev) {

                        $colorPreview.css('background-color', ev.color.toHex());
                    });

                    if ($this.val())
                    {
                        $colorPreview.css('background-color', $this.val());
                    }
                }
            });
        }
    });
</script>

@yield('js')
