
<!DOCTYPE html>
<head>
    <title> Surat Tugas </title>
    <meta charset="utf-8">
    <style>
        @page{
            size: 8.3in 11.7in;
        }

        #judul{
            text-align: center;
        }

        #halaman{
            width: auto;
            height: auto;
            position: absolute;
            border: 1px solid;
            padding-top: 30px;
            padding-left: 30px;
            padding-right: 30px;
            padding-bottom: 80px;
        }
    </style>

</head>

<body>
    <div id=halaman>
        <table>
            <tr>
                <td><center>
                    <font size="7"> LLDIKTI</font><br>
                    <font size="5"> LEMBAGA LAYANAN PENDIDIKAN TINGGI WILAYAH X</font><br>
                    <font size="5"> Jl. Khatib Sulaiman Gunung Pangilun, Alai Parak Kopi, Kec. Padang Utara, Kota Padang, Sumatera Barat 25173</font><br>
                </center>
                </td>
            </tr>
            <tr>
                <td colspan="7"><hr> </td>
            </tr>
        </table>
        <table width="470">
            <center>
                <font size="4"> SURAT PERINTAH TUGAS</font>
            </center><br>
        </table>

        <table>
            <tr>
                <td>Yang bertanda tangan di bawah ini:</td>
            </tr>
            <br>
            <table width="350">
                <tr>
                    <td>Nama</td>
                <td>:</td>
                    <td>Afdalisma</td>
                </tr>

                <tr>
                    <td>NIP</td>
                <td>:</td>
                    <td>1223829304</td>
                </tr>

                <tr>
                    <td>Jabatan</td>
                <td>:</td>
                    <td>Kepala LLDIKTI Wilayah X</td>
                </tr>
            </table>

            <tr>
                <td>Dengan ini menugaskan nama-nama yang tersebut di bawah ini :</td>
            </tr>
        </table>
        <br>
        <table width="260">
            @foreach($itemss as $item)
            <tr>
                <td>Nama</td>
            <td>:</td>
                <td>{{ $item->nama }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
            <td>:</td>
                <td>{{ $item->jabatan }}</td>
            </tr>
            @endforeach
        </table> <br>
        <br>
        <table>
            <tr>
                <td>Untuk melaksanakan tugas pada :</td>
            </tr>
        </table>
        <br>
        <table width="260">
           @foreach($kantor as $item)
            <tr>
                <td>Tanggal Pergi</td>
            <td>:</td>
                <td>{{ $item->tanggal_pergi }}</td>
            </tr>
            <tr>
                <td>Tempat</td>
            <td>:</td>
                <td>{{ $item->nama_kota }}</td>
            </tr>
           @endforeach
        </table> <br>
        <br>
        <table>
            <tr>
                <td>Demikian Surat Perintah Tugas ini dibuat untuk dapat dilaksanakan dengan sebaik-baiknya.</td>
            </tr>
        </table>

        <div style= "width:30%; text-align: left; float: right;">
            Padang
          <?php  
            echo date( 'Y-m-d');
            ?>
            <br>Kepala LLDIKTI Wilayah X
        </div>
        <br><br><br><br><br>
        <div style= "width:32%; text-align: left; float: right;"> Afdalisma</div>
    </div>
</body>