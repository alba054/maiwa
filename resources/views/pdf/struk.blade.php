<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Khatulistiwa Trans</title>

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> --}}

    <style>
        @page {
            size: 8in 13in potrait;
            font-family: calibri;
            margin: 20px;
            padding: 20px;
        }

        #table {
            margin-bottom: 10px;
            width: 100%;
            border-collapse: collapse;
        }

        #table td {
            font-size: 11px;
            border: 1px solid #000;
            padding: 6px;
        }

        #table th {
            font-size: 11px;
            border: 1px solid #000;
            padding: 8px;

        }

        #subtitle {
            font-size: 11pt;
            text-align: center;
        }

        #tableheader {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        #tableheader td {
            font-size: 11px;
            text-align: center;

        }

        #tablerekap {
            margin-bottom: 10px;
            width: 100%;
            border-collapse: collapse;
        }

        #tablerekap td {
            font-size: 11px;
            border: 1px solid #000;
            padding: 6px;
        }

        #tablerekap th {
            font-size: 11px;
            border: 1px solid #000;
            padding: 8px;

        }

        hr {
            border: none;
            height: 0.5px;
            /* Set the hr color */
            color: rgb(172, 172, 172);
            /* old IE */
            background-color: rgb(172, 172, 172);
            /* Modern Browsers */
        }

    </style>
</head>

<body class="antialiased">
    <div class="row">

        <div class="col-12 align-self-center">
            {{-- <img style="float:left" src="http://tiketkt.lp2muniprima.ac.id/logo.png" alt="logo-small"
                class="logo-sm mr-2" height="70"> --}}

            <div style="text-align: center; font-size:10pt; width:100%; " id="subtitle">
                <b>MAIWA BREEDING CENTER</b>
            </div>
            <div style="text-align: center; font-size:10pt; width:100%; " id="subtitle">
                <b>FAKULTAS PETERNAKAN UNIVERSITAS HASANUDDIN</b>
            </div>

            <div style="text-align: center; font-size:7pt; width:100%" id="subtitle">
                {{-- <img style="width: 10px" src="http://tiketkt.lp2muniprima.ac.id/wa.png" alt="logo-small"
                    class="logo-sm"> --}}
                <b>Jl. Perintis Kemerdekaan KM 10, Makassar.</b>
                <img style="width: 10px" src="http://tiketkt.lp2muniprima.ac.id/wa.png" alt="logo-small"
                    class="logo-sm">
                <b>HP 081144300112</b>
            </div>
            {{-- <div style="text-align: center; font-size:6pt; width:100%; background-color: black; color:white; padding:3px; margin-left:100px; margin-top:10px"
                id="subtitle">
                Rute: Mamuju, Tarallu
            </div> --}}


            <hr>

            <table id="tableheader">
                <tr>
                    <td style="width: 5%; text-align:left;"></td>
                    <td style="width: 20%; text-align:left; ">Tanggal : {{ $date }}</td>
                    <td style="width: 70%; text-align:left;"></td>
                </tr>
                <tr>
                    <td style="width: 5%; text-align:left;"></td>
                    <td style="width: 20%; text-align:left; ">No Ref : 08765VJVBN</td>
                    <td style="width: 70%; text-align:left;"></td>
                </tr>
                <tr>
                    <td style="width: 5%; text-align:left;"></td>
                    <td style="width: 20%; text-align:left; ">Kode Pegawai : - </td>
                    <td style="width: 70%; text-align:left;"></td>
                </tr>

            </table>


            <hr>


            <table id="tableheader">
                <td style="width: 5%; text-align:left;"></td>
                <td style="width: 5%; text-align:left; ">Nama</td>
                <td style="width: 40%; text-align:left; ">: {{ strtoupper($user->user->name) }}</td>
                <td style="width: 5%; text-align:left; ">Alamat</td>
                <td style="width: 40%; text-align:left; ">: {{ strtoupper($user->user->alamat) }}</td>
                <td style="width: 5%; text-align:left;"></td>
            </table>
            <table id="tableheader">
                <td style="width: 5%; text-align:left;"></td>
                <td style="width: 5%; text-align:left; ">Jabatan</td>
                <td style="width: 40%; text-align:left; ">: PENDAMPING</td>
                <td style="width: 5%; text-align:left; ">Telepon</td>
                <td style="width: 40%; text-align:left; ">: {{ strtoupper($user->user->no_hp) }}</td>
                <td style="width: 5%; text-align:left;"></td>
            </table>
            <hr>
            <table id="tableheader">
                <td style="width: 5%; text-align:left;"></td>
                <td style="width: 5%; text-align:left; ">NO</td>
                <td style="width: 45%; text-align:left; ">KETERANGAN</td>
                <td style="width: 40%; text-align:right; ">JUMLAH</td>
                <td style="width: 5%; text-align:left;"></td>
            </table>

            <hr>
            <table id="tableheader">
                <td style="width: 5%; text-align:left;"></td>
                <td style="width: 5%; text-align:left; ">1</td>
                <td style="width: 45%; text-align:left; ">{{ $keterangan }}</td>
                <td style="width: 40%; text-align:right; ">{{ 'Rp. ' . number_format($jumlah) }}</td>
                <td style="width: 5%; text-align:left;"></td>
            </table>

            <br>

            <hr>


            <table id="tableheader">
                <td style="width: 5%; text-align:left;"></td>
                <td style="width: 5%; text-align:left; "></td>
                <td style="width: 55%; text-align:left; "></td>
                <td style="width: 10%; text-align:left; ">TOTAL : </td>
                <td style="width: 20%; text-align:right; ">
                    <b>{{ 'Rp. ' . number_format($jumlah) }}</b>
                </td>
                <td style="width: 5%; text-align:left;"></td>
            </table>


        </div>
    </div>


    <br><br>
    <table id="tableheader">
        <td style="width: 50%;">PENDAMPING </td>
        <td style="width: 50%;">ADMIN </td>
    </table>
    <br><br><br>
    <table id="tableheader">
        <td style="width: 50%;">(______________________________________)</td>
        <td style="width: 50%;">(______________________________________)</td>
    </table>

</body>

</html>
