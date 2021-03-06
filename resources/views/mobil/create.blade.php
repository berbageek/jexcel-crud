@extends('ui::layouts.centered')
@section('content')

    {!! form()->open(route('mobil.store'))->id('formMobil') !!}
    <input type="hidden" name="data" id="data">
    <h2 class="ui header">Daftar Mobil <span style="font-weight: normal; font-style: italic" id="status"></span></h2>
    <div id="spreadsheet"></div>
    <div class="ui divider hidden"></div>
    {!! form()->submit('Simpan') !!}
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
          $('#data').val(JSON.stringify(data));
        });
      });


      $('#spreadsheet').jexcel({
        data: {!! old('data', json_encode($items)) !!},
        columns: [
          {type: 'text', readOnly: true, title: 'ID'},
          {type: 'text', title: 'Mobil', width: 200},
          {type: 'numeric', title: 'Harga', width: 300, mask: 'Rp#.##', decimal: ','},
        ]
      });

      @if(!old('data') && $items->isEmpty())
      $('#spreadsheet').jexcel('insertRow', 10, 0);
      @endif

      setInterval(sync, 10000);

      function sync() {
        var data = $('#spreadsheet').jexcel('getData');
        $('#status').html('Saving...');

        $.post("{{ route('mobil.store') }}", {data: JSON.stringify(data), _token: "{{ csrf_token() }}"})
          .done(function (data) {
            $('#status').html('Saved');
            $('#spreadsheet').jexcel('setData', data);
          })
          .fail(function () {
            $('#status').html('Error');
          })
          .always(function () {
            setTimeout(function () {
              $('#status').html('');
            }, 3000)
          });
      }

    </script>
@endpush
