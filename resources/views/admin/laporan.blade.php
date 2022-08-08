@extends('layouts.admin')

@section ('content')

<div class="col-12 col-md-12 col-sm-12 col-lg-10">
    <div class="card">
        <div class="card-header">
            <h5>LAPORAN</h5>
        </div>
        <div class="card-body">
                <select name="bulan" id="bulan" class="form-control mb-3">
                    <option value="">Pilih Bulan</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>

            <div>
                    
                    <ul class="list-group" id="laporan">
                        <h5 class="text-center">Tidak Ada Data</h5>
                    </ul>
                
            </div>
            
        </div>
    </div>
</div>
    
<script>
    $(document).ready(function(){
        $('#bulan').change(function(event){
            var bulan = $('#bulan').val();
            $('#laporan').empty();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ route('laporan') }}",
                data: 'bulan='+bulan,
                success: function(data){
                    $('#laporan').append(data);
                }
            });
        });
    });
    
</script>

@endsection