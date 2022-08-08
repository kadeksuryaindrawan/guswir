<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Laporan Penjualan Bulan {{ $month }}</title>
    <style>
        *{
            font-family:'Times New Roman', Times, serif
            margin: 0;
        }
        .container {
            margin: 0px auto;
            width: 100%;
        }
        .header {
            width: 100%;
            margin: 0rem;
        }
        .header img{
            width: 96%;
        }
        .content {
            width: 100%;
            margin: 0.5rem auto;
            text-align: center;
            font-size: 20px;
        }
        .content p {
            font-size: 14px;
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-bottom: 1rem;
        }
        .content table, th, td {
            border: 1px black solid;
            border-collapse: collapse;
            padding: 0.5rem;
            font-size: 16px;
        }
        .content-mentor {
            margin-bottom: 1rem;
        }
        .content-contestant table {
            margin-top: 1rem;
        }
    </style>
  </head>
  <body>
        <!-- Start Page -->
    <div class="container">
        <!-- KOP report -->
        {{-- <div class="header">
            <img src="{{public_path('img/kop.jpeg')}}" alt="KOP" style="width: 100%">
        </div> --}}

        <center>        <hr>
            <h2>Data Laporan Penjualan
        <br> Bulan {{$month}}
        </h2></center>
        <hr>
        <!-- Report Content -->
        <div class="content">
            <!-- Report Title Contestant Identity -->
            <div class="content-contestant">
                Daftar Laporan <strong></strong>
                <hr width="40%">
                <!-- Table -->
                <table style="width: 100%;">
                <tr>
                    <th>ORDER ID</th>
                    <th>NAMA</th>
                    <th>EMAIL</th>
                    <th>KOTA</th>
                    <th>BARANG</th>
                    <th>ONGKIR</th>
                    <th>TOTAL HARGA</th>
                </tr>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->user->name}}</td>
                    <td>{{$order->user->email}}</td>
                    <td>{{$order->city}}</td>
                    <td>
                    @foreach ($order->cart->items as $item)
                            <div class="order-detail">
                                <h3>{{ $item['item']['name'] }}</h3>
                                <p>Jumlah : {{ $item['quantity'] }}</p>
                                <p>Harga : Rp.   {{ number_format( $item['price'],0,",",".") }}</p>
                                <hr>
                            </div>
                    @endforeach
                </td>
                    <td>Rp. {{ number_format( $order->ongkir,0,",",".") }}</td>
                    <td>Rp. {{ number_format( ($order->cart->totalPrice + $order->ongkir),0,",",".") }}</td>
                </tr>
                @endforeach

            </table>
            </div>
        </div>
    </div>

  </body>
</html>
