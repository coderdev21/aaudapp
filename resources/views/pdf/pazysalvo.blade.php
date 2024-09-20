<!DOCTYPE html>
<html>
@foreach ($certificate as $item)

  <head>
    <title> AAUD - Paz y Salvo</title>
    <style>
      @font-face {
        font-family: 'Poppins';
        font-style: normal;
        font-weight: 400;
        src: url('{{ public_path('fonts/Poppins-Regular.ttf') }}') format('truetype');
      }

      @page {
        margin: 1.5cm 1.5cm 1.5cm 1.5cm;
      }

      body {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
      }

      p.firma {
        text-align: center;
        line-height: 0.7;
        font-size: 10px;
      }

      p.footer {
        text-align: justify;
        line-height: 0.7;
        font-size: 10px;

      }

      p.contenido {
        text-align: justify;
        line-height: 0.8rem;
        /* +font-size: 12px; */
        margin-top: 1px 0px;
      }

      table,
      th,
      td {
        border-collapse: collapse;
        padding: 0px;
        width: 100%;
      }

      table.principal {
        /*border: 1px solid black;*/
        border-collapse: collapse;
        margin: auto;
        background-image: url('{{ public_path('/images/marca-de-agua.png') }}');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;

      }

      td.aviso {
        font-size: 8px;
        text-align: justify;
        padding: 5px;
        width: 300px;
      }

      td.qr {
        width: 60px;
      }
    </style>

  <body>

    <table class="principal">
      <tr>
        <td style="padding: 5px;">
          <table>
            <tr>
              <td colspan="4" style="text-align: left; padding: 2px;">
                <h2>CERTIFICADO DE PAZ Y SALVO</h2>
              </td>
              <td align="right" style="padding: 5px;">
                <img
                  src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('/images/logoaaud.png'))) }}"
                  width="100">
              </td>
            </tr>
            <tr>
              <td align ="center" style="border: 1px solid black">No. DE CONTROL
                <br>
                <strong>{{ $item->control_number }}</strong>
              </td>
              <td align ="center" style="border: 1px solid black">FECHA DE EMISIÓN
                <br>
                <strong>{{ Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</strong>
              </td>
              <td align ="center" style="border: 1px solid black">AGENCIA
                <br>
                <strong>{{ $item->agency->name }}</strong>
              </td>
              <td align ="center" style="border: 1px solid black">CREADO POR
                <br>
                <strong>{{ $item->user->employee->shortfullname }}</strong>
              </td>
              <td align ="center" style="border: 1px solid black">VALIDO HASTA
                <br>
                <strong>{{ Carbon\Carbon::parse($item->expiration_date)->translatedFormat('d F Y') }}</strong>
              </td>
            </tr>
            <tr>
              <td colspan="5" style="height: 150px; vertical-align: top;">
                <p class="contenido">La Autoridad de Aseo Urbano y Domiciliario de Panamá certifica que
                  el cliente
                  identificado
                  con número de <strong>NIC: {{ $item->nic }}</strong>, perteniciente a la finca
                  <strong>{{ $item->finca }}</strong>,
                  ubicada en
                  <strong>{{ $item->address }}</strong>, corregimiento de
                  <strong>{{ $item->town->name }}</strong>,
                  distrito
                  de
                  <strong>{{ $item->city->name }}</strong>,
                  provincia de <strong>{{ $item->state->name }}</strong>, se encuentra Paz y Salvo con
                  esta
                  institución por concepto de Tasa de Aseo.
                </p>
                <p class="contenido">
                  <strong>OBSERVACIÓN:</strong> {{ $item->description }}
                </p>
              </td>
            </tr>
            <tr>
              <td align="center" colspan="5">
                <table style="width: 175px; margin-left: auto; margin-right: auto">
                  <tr>
                    <td height="125" style="border: 1px solid black; vertical-align: bottom;">
                      <p style="line-height: 0.7; font-size: 9px; text-align: center">
                        Este Paz y Salvo no es válido<br> sin sello de la institución.
                      </p>
                    </td>
                  </tr>
                </table>
            </tr>
            <tr>
              <td colspan="5" style="text-align: center">
                <h4>Este Paz y Salvo tiene un costo de B/. 1.00</h4>
              </td>
            </tr>
            <tr>
              <td colspan="5">
                <p class="footer">BASADO EN EL ARTÍCULO 79 DE LA LEY NO. 276 DE 30 DE DICIEMBRE DE 2021,
                  QUE INDICA LO
                  SIGUIENTE: ARTÍCULO 79. EL REGISTRO PÚBLICO NO PRACTICARÁ NINGUNA INSCRIPCIÓN
                  RELATIVA A BIENES
                  INMUEBLES
                  MIENTRAS NO SE COMPRUEBE QUE ESTÁN PAZ Y SALVO CON LA AUTORIDAD DE ASEO URBANO Y
                  DOMICILIARIO O
                  EN LA ENTIDAD COMPETENTE, PARA REALIZAR LOS COBROS DE LA TASA DE GESTIÓN INTEGRAL DE
                  RESIDUOS
                  POR EL SERVICIO DE RECOLECCIÓN QUE RIGE A PARTIR DEL 01 DE JULIO DE 2022.
                </p>
                <p class="footer">
                  ADVERTENCIA: Código Penal - Título XI - Delitos contra la Fe Pública - Capítulo I - Falsificación de
                  Documentos en General
                  <br>
                  Artículo 366. Quien falsifique o altere, total o parcialmente, una escritura pública, un documento
                  público o auténtico o la firma digital informática de otro, de modo que pueda resultar perjuicio, será
                  sancionado con prisión de cuatro a ocho años. Igual sanción se impondrá a quien inserte o haga
                  insertar en un documento público o auténtico declaraciones falsas concernientes a un hecho que el
                  documento deba probar, siempre que pueda ocasionar un perjuicio a otro.
                  <br>Artículo 373. Quien, a sabiendas de su falsedad, haga uso o derive provecho de un documento falso
                  o alterado aunque no haya cooperado en la falsificación o alteración, será sancionado como si fuese el
                  autor.
                </p>
              </td>
            </tr>
            <tr>
              {{--                             <td class="qr">
                                <img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('/images/qrcodeexample.jpg'))) }}"
                                    width="100">
                            </td> --}}
              <td colspan="3" class="aviso" style="padding-right: 50px">
                <h4>AVISO DE VALIDEZ Y CONFIRMACIÓN DE LA PRESENTE CERTIFIACIÓN</h4>
                <p class="footer">
                  Para su validez, esta certifiación debe ser verificada en la dirección de internet:
                  http://pazysalvo.aaud.gob.pa por parte del interesado o del funcionario público o privado a quien deba
                  presentarse. <br>Edificio P.H. Multiplaza | Ave. Justo Arosemena y calle 26 | Tel. (+507) 506-1500 /
                  506-1582 / 506-1574 / 506-1580
                </p>
              </td>
              <td colspan="2" align="right">
                <img
                  src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('/images/logogobiernoaaud.png'))) }}"
                  width="300">
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
@endforeach

</html>
