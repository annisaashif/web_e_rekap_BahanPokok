  <!--   Core JS Files   -->
  <script src="{{ asset('admin-template') }}/js/core/jquery-3.7.1.min.js"></script>
  <script src="{{ asset('admin-template') }}/js/core/popper.min.js"></script>
  <script src="{{ asset('admin-template') }}/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="{{ asset('admin-template') }}/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  <!-- Chart JS -->
  <script src="{{ asset('admin-template') }}/js/plugin/chart.js/chart.min.js"></script>

  <!-- jQuery Sparkline -->
  <script src="{{ asset('admin-template') }}/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

  <!-- Chart Circle -->
  <script src="{{ asset('admin-template') }}/js/plugin/chart-circle/circles.min.js"></script>

  <!-- Datatables -->
  <script src="{{ asset('admin-template') }}/js/plugin/datatables/datatables.min.js"></script>

  <!-- Bootstrap Notify -->
  <script src="{{ asset('admin-template') }}/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

  <!-- jQuery Vector Maps -->
  <script src="{{ asset('admin-template') }}/js/plugin/jsvectormap/jsvectormap.min.js"></script>
  <script src="{{ asset('admin-template') }}/js/plugin/jsvectormap/world.js"></script>

  <!-- Sweet Alert -->
  <script src="{{ asset('admin-template') }}/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- Kaiadmin JS -->
  <script src="{{ asset('admin-template') }}/js/kaiadmin.min.js"></script>

  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <script src="{{ asset('admin-template') }}/js/setting-demo.js"></script>
  <script src="{{ asset('admin-template') }}/js/demo.js"></script>
  <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
          type: "line",
          height: "70",
          width: "100%",
          lineWidth: "2",
          lineColor: "#177dff",
          fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
          type: "line",
          height: "70",
          width: "100%",
          lineWidth: "2",
          lineColor: "#f3545d",
          fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
          type: "line",
          height: "70",
          width: "100%",
          lineWidth: "2",
          lineColor: "#ffa534",
          fillColor: "rgba(255, 165, 52, .14)",
      });
  </script>

  <!-- Datatables -->
  <script src="{{ asset('admin-template') }}/plugin/datatables/datatables.min.js"></script>
  <script>
      $(document).ready(function() {
          $("#basic-datatables").DataTable({});

          $("#multi-filter-select").DataTable({
              pageLength: 5,
              initComplete: function() {
                  this.api()
                      .columns()
                      .every(function() {
                          var column = this;
                          var select = $(
                                  '<select class="form-select"><option value=""></option></select>'
                              )
                              .appendTo($(column.footer()).empty())
                              .on("change", function() {
                                  var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                  column
                                      .search(val ? "^" + val + "$" : "", true, false)
                                      .draw();
                              });

                          column
                              .data()
                              .unique()
                              .sort()
                              .each(function(d, j) {
                                  select.append(
                                      '<option value="' + d + '">' + d + "</option>"
                                  );
                              });
                      });
              },
          });

          // Add Row
          $("#add-row").DataTable({
              pageLength: 5,
          });

          var action =
              '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

          $("#addRowButton").click(function() {
              $("#add-row")
                  .dataTable()
                  .fnAddData([
                      $("#addName").val(),
                      $("#addPosition").val(),
                      $("#addOffice").val(),
                      action,
                  ]);
              $("#addRowModal").modal("hide");
          });
      });
  </script>

  {{-- notifikasi --}}
  <script>
      @if (Session::has('success'))
          $(document).ready(function() {
              $.notify({
                  icon: 'icon-bell',
                  title: 'Success',
                  message: '{{ Session::get('success') }}',
              }, {
                  type: 'success',
                  placement: {
                      from: "bottom",
                      align: "right"
                  },
                  time: 1000,
              });
          });
      @endif

      @if (Session::has('error'))
          $(document).ready(function() {
              $.notify({
                  icon: 'icon-bell',
                  title: 'Error',
                  message: '{{ Session::get('error') }}',
              }, {
                  type: 'danger',
                  placement: {
                      from: "bottom",
                      align: "right"
                  },
                  time: 1000,
              });
          });
      @endif

      @if ($errors->any())
          $(document).ready(function() {
              var errorMessages = '<ul>';
              @foreach ($errors->all() as $data)
                  errorMessages += '<li>{{ $data }}</li>';
              @endforeach
              errorMessages += '</ul>';

              $.notify({
                  icon: 'icon-bell',
                  title: 'Error',
                  message: errorMessages,
              }, {
                  type: 'danger',
                  placement: {
                      from: "bottom",
                      align: "right"
                  },
                  time: 1000,
              });
          });
      @endif
  </script>


  {{-- chart --}}
