@extends('ui::layouts.centered')
@section('content')

    {!! form()->open(route('mobil.store'))->id('formMobil') !!}
    <input type="hidden" name="data" id="data">
    <h2 class="ui header">Daftar Mobil</h2>
    <div id="spreadsheet"></div>
    <div class="ui divider hidden"></div>
    {!! form()->submit('Submit') !!}
    {!! form()->close() !!}


@endsection

@push('script')
    <script src="https://bossanova.uk/jexcel/v3/jexcel.js"></script>
    <link rel="stylesheet" href="https://bossanova.uk/jexcel/v3/jexcel.css" type="text/css"/>
    <script src="https://bossanova.uk/jsuites/v2/jsuites.js"></script>
    <link rel="stylesheet" href="https://bossanova.uk/jsuites/v2/jsuites.css" type="text/css"/>

    <script>

      $(function () {
        $('#formMobil').submit(function (event) {
          var data = $('#spreadsheet').jexcel('getData');
          var form = $(this);

          jQuery.each(data, function (rowNumber, row) {
            jQuery.each(row, function (colNumber, value) {
              var input = $("<input>").attr("type", "hidden").attr("name", "row[" + rowNumber + "]" + "[" + colNumber + "]").val(value);
              form.append(input);
            });
          })

          $('#data').val(JSON.stringify(data));
        });
      });


      var data = [];

      $('#spreadsheet').jexcel({
        data: data,
        columns: [
          {type: 'text', title: 'Mobil', width: 120},
          {type: 'numeric', title: 'Harga', width: 100, mask: 'Rp#.##,00', decimal: ','},
        ]
      });

      $('#spreadsheet').jexcel('insertRow', 10, 0);
    </script>
@endpush
