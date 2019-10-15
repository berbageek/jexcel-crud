@extends('ui::layouts.centered')
@section('content')

    <h2 class="ui header">Daftar Mobil</h2>
    <div id="spreadsheet"></div>

@endsection

@push('script')
    <script src="https://bossanova.uk/jexcel/v3/jexcel.js"></script>
    <link rel="stylesheet" href="https://bossanova.uk/jexcel/v3/jexcel.css" type="text/css"/>
    <script src="https://bossanova.uk/jsuites/v2/jsuites.js"></script>
    <link rel="stylesheet" href="https://bossanova.uk/jsuites/v2/jsuites.css" type="text/css"/>

    <script>

      var data = @json($items);

      $('#spreadsheet').jexcel({
        data: data,
        columns: [
          {type: 'text', title: 'Mobil', width: 200},
          {type: 'numeric', title: 'Harga', width: 300, mask: 'Rp#.##,00', decimal: ','},
        ]
      });
    </script>
@endpush
