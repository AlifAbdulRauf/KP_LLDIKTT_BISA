
<!DOCTYPE html>
<head>
    <title> Surat Perintah Perjalanan Dinas </title>
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
                <font size="4"> SURAT PERINTAH PERJALANAN DINAS</font>
            </center><br>
        </table>

        <table>
            <tr>
                <td>Dengan ini menyatakan SPPD ini dibuat:</td>
            </tr>
        <br>
        <table width="400">
            <tr>
                <td>Pejabat berwenang yang memberi perintah</td>
            <td>:</td>
                <td>Kepala LLDIKTI Wilayah X</td>
            </tr>

            @foreach($itemss as $item)
            <tr>
                <td>Nama Pegawai yang diperintahkan/NIP  </td>
            <td>:</td>
                <td>{{ $item->nama }}/{{ $item->nip }}</td>
            </tr>
            @endforeach

        </table>  </table> <br>
        <table>
            <tr>
                <td>Rincian Kegiatan yang Akan Dilaksanakan :</td>
            </tr>
        </table>
        <br>
        <table width="375">
           @foreach($kantor as $item)
           <tr>
                <td>Maksud perjalanan dinas </td>
            <td>:</td>
                <td>{{ $item->judul_surat }}</td>
            </tr> 
            @endforeach
            @foreach ($itemsss as $ite)
            <tr>
                <td>Alat angkut yang dipergunakan</td>
            <td>:</td>
                <td>{{ $ite->jenis_transportasi }}</td>
            </tr>
            @endforeach
            @foreach($kantor as $item)
            <tr>
                <td>Tempat</td>
            <td>:</td>
                <td>{{ $item->nama_kota }}</td>
            </tr>
            <tr>
                <td>Lamanya perjalanan dinas</td>
            <td>:</td>
                <td>{{ $days }}</td>
            </tr>
            <tr>
                <td>Tanggal berangkat</td>
            <td>:</td>
                <td>{{ $item->tanggal_pergi }}</td>
            </tr>
            <tr>
                <td>Tanggal harus kembali</td>
            <td>:</td>
                <td>{{ $item->tanggal_pulang }}</td>
            </tr>
            @endforeach
    </table>
        <br>
        
        <table>
            <tr>
                <td>Rincian Dana yang Akan Digunakan :</td>
            </tr>
        </table>
        <br>
        <table width="380">
            
            <tr>
                <td>Uang transportasi</td>
            <td>:</td>
                <td>
                <?php
                    $transport = $items->uang_transport;
                    $besarantr = (2*$transport);    
                    echo 'Rp. '.number_format($besarantr,  0, ",", ".");
                ?>
                </td>
            </tr>
            <tr>
                <td>Uang penginapan</td>
            <td>:</td>
                <td>
                <?php
                    $penginapan = $items->uang_penginapan;
                    $besaranpn = ($days * $penginapan); 
                    echo 'Rp. '.number_format($besaranpn,  0, ",", ".");
                ?>
                </td>
            </tr>
            <tr>
                <td>Lumpsum</td>
            <td>:</td>
                <td>
                <?php
                    $lump = $items->besaran_lumpsum;
                    $besaranlm = ($days * $lump);
                    echo 'Rp. '.number_format($besaranlm,  0, ",", ".");
                ?>
                </td>
            </tr>
            <tr>
                <td>Jumlah (@karyawan)</td>
            <td>:</td>
                <td>
                <?php
                    $jumlah = ($besarantr+$besaranpn+$besaranlm);
                    echo 'Rp. '.number_format($jumlah,  0, ",", ".");
                ?>
                </td>
            </tr>
            <tr>
                <td>total</td>
            <td>:</td>
                <td>
                    @foreach ($jmlh_data as $subjumlah)
                    @currency ($subjumlah->total * $jumlah)
                    @endforeach
                </td>
            </tr>
           
        </table>
        <br> <br>
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
        <div style= "width:32%; text-align: left; float: right;" >&nbsp;  Afdalisma</div>
    </div>
</body>