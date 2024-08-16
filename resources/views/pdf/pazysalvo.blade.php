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
        margin: 0.5cm 0.5cm 0.5cm 0.5cm;
      }

      body {
        font-family: 'Poppins', sans-serif;
        font-size: 12px;
      }

      p.firma {
        text-align: center;
        line-height: 0.7;
        font-size: 10px;
      }

      p.footer {
        text-align: justify;
        line-height: 0.7;
        font-size: 8px;

      }

      p.contenido {
        text-align: justify;
        line-height: 0.7;
        font-size: 12px;
      }

      table,
      th,
      td {
        border-collapse: collapse;
        padding: 5px;
        width: 100%;
      }

      table.principal {
        border: 1px solid black;
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
      <tr style="border-bottom: 1px solid black;">
        <td>
          <table>
            <tr>
              <td style="text-align: center">
                <h2>CERTIFICADO DE PAZ Y SALVO</h2>
              </td>
              <td align="right">
                <img
                  src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('/images/logoaaud.png'))) }}"
                  width="100">
              </td>
            </tr>
          </table>
          <table style="border: 1px solid black">
            <tr>
              <td align ="center" style="border: 1px solid black">No. DE CONTROL
                <br>
                <strong>{{ $item->control_number }}</strong>
              </td>
              <td align ="center" style="border: 1px solid black">FECHA / HORA DE EMISIÓN
                <br>
                <strong>{{ $item->created_at }}</strong>
              </td>
              <td align ="center" style="border: 1px solid black">AGENCIA
                <br>
                <strong>{{ $item->agency }}</strong>
              </td>
              <td align ="center" style="border: 1px solid black">CREADO POR
                <br>
                <strong>{{ $item->created_by }}</strong>
              </td>
            </tr>
          </table>
          <table>
            <tr>
              <td colspan="3" style="height: 150px; vertical-align: top;">
                <p class="contenido">La Autoridad de Aseo Urbano y Domiciliario de Panamá certifica que el cliente
                  identificado
                  con número de <strong>NIC: {{ $item->nic }}</strong>, perteniciente a la finca
                  <strong>{{ $item->finca }}</strong>,
                  ubicada en
                  <strong>{{ $item->address }}</strong>, corregimiento de <strong>{{ $item->town }}</strong>,
                  distrito
                  de
                  <strong>{{ $item->city }}</strong>,
                  provincia de <strong>{{ $item->state }}</strong>, se encuentra Paz y Salvo con esta
                  institución por concepto de Tasa de Aseo.
                </p>
                <p class="contenido">
                  <strong>OBSERVACIÓN:</strong> {{ $item->description }}
                </p>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="vertical-align: bottom;">
                <p class="firma">_______________________________</p>
                <p class="firma">Firma Autorizada</p>
              </td>
              <td style="width: 60%">
                <table>
                  <tr>
                    <td style="height: 150px; align: center; vertical-align: bottom; border: 1px solid black">
                      <p style="line-height: 0.7; font-size: 8px; text-align: center;">
                        Este Paz y Salvo no es válido sin sello de la institución.
                      </p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td colspan="3" style="text-align: center">
                <h4>Este Paz y Salvo tiene un costo de B/. 1.00</h4>
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <p class="footer">BASADO EN EL ARTÍCULO 79 DE LA LEY NO. 276 DE 30 DE DICIEMBRE DE 2021, QUE INDICA LO
                  SIGUIENTE: ARTÍCULO 79. EL REGISTRO PÚBLICO NO PRACTICARÁ NINGUNA INSCRIPCIÓN RELATIVA A BIENES
                  INMUEBLES
                  MIENTRAS NO SE COMPRUEBE QUE ESTÁN PAZ Y SALVO CON LA AUTORIDAD DE ASEO URBANO Y DOMICILIARIO O
                  EN LA ENTIDAD COMPETENTE, PARA REALIZAR LOS COBROS DE LA TASA DE GESTIÓN INTEGRAL DE RESIDUOS
                  POR EL SERVICIO DE RECOLECCIÓN QUE RIGE A PARTIR DEL 01 DE JULIO DE 2022.
                </p>
              </td>
            </tr>
            <tr>
              <td class="qr">
                <img
                  src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('/images/qrcodeexample.jpg'))) }}"
                  width="60">
              </td>
              <td class="aviso">
                <h4>AVISO DE VALIDEZ Y CONFIRMACIÓN DE LA PRESENTE CERTIFIACIÓN</h4>
                <p class="footer">
                  Para su validez, esta certifiación debe ser verificada en la dirección de internet:
                  http://pazysalvo.aaud.gob.pa o escaneando el código QR por parte del interesado o del funcionario
                  público o privado a quien deba presentarse.
                </p>
              </td>
              <td align="right">
                <img
                  src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('/images/logogobiernoaaud.png'))) }}"
                  width="300">
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td><br></td>
      </tr>
      <tr style="border-top: 1px solid black;">
        <td>
          <table>
            <tr>
              <td style="text-align: center; width: 110%">
                <h2>CERTIFICADO DE PAZ Y SALVO - COPIA</h2>
              </td>
              <td align="right">
                <img
                  src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('/images/logoaaud.png'))) }}"
                  width="100">
              </td>
            </tr>
          </table>
          <table style="border: 1px solid black">
            <tr>
              <td align ="center" style="border: 1px solid black">No. DE CONTROL
                <br>
                <strong>{{ $item->control_number }}</strong>
              </td>
              <td align ="center" style="border: 1px solid black">FECHA / HORA DE EMISIÓN
                <br>
                <strong>{{ $item->created_at }}</strong>
              </td>
              <td align ="center" style="border: 1px solid black">AGENCIA
                <br>
                <strong>{{ $item->agency }}</strong>
              </td>
              <td align ="center" style="border: 1px solid black">CREADO POR
                <br>
                <strong>{{ $item->created_by }}</strong>
              </td>
            </tr>
          </table>
          <table>
            <tr>
              <td colspan="3" style="height: 150px; vertical-align: top;">
                <p class="contenido">La Autoridad de Aseo Urbano y Domiciliario de Panamá certifica que el cliente
                  identificado
                  con número de <strong>NIC: {{ $item->nic }}</strong>, perteniciente a la finca
                  <strong>{{ $item->finca }}</strong>,
                  ubicada en
                  <strong>{{ $item->address }}</strong>, corregimiento de <strong>{{ $item->town }}</strong>,
                  distrito
                  de
                  <strong>{{ $item->city }}</strong>,
                  provincia de <strong>{{ $item->state }}</strong>, se encuentra Paz y Salvo con esta
                  institución por concepto de Tasa de Aseo.
                </p>
                <p class="contenido">
                  <strong>OBSERVACIÓN:</strong> {{ $item->description }}
                </p>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="vertical-align: bottom;">
                <p class="firma">_______________________________</p>
                <p class="firma">Firma Autorizada</p>
              </td>
              <td style="width: 60%">
                <table>
                  <tr>
                    <td style="height: 150px; align: center; vertical-align: bottom; border: 1px solid black">
                      <p style="line-height: 0.7; font-size: 8px; text-align: center;">
                        Este Paz y Salvo no es válido sin sello de la institución.
                      </p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td colspan="3" style="text-align: center">
                <h4>Este Paz y Salvo tiene un costo de B/. 1.00</h4>
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <p class="footer">BASADO EN EL ARTÍCULO 79 DE LA LEY NO. 276 DE 30 DE DICIEMBRE DE 2021, QUE INDICA LO
                  SIGUIENTE: ARTÍCULO 79. EL REGISTRO PÚBLICO NO PRACTICARÁ NINGUNA INSCRIPCIÓN RELATIVA A BIENES
                  INMUEBLES
                  MIENTRAS NO SE COMPRUEBE QUE ESTÁN PAZ Y SALVO CON LA AUTORIDAD DE ASEO URBANO Y DOMICILIARIO O
                  EN LA ENTIDAD COMPETENTE, PARA REALIZAR LOS COBROS DE LA TASA DE GESTIÓN INTEGRAL DE RESIDUOS
                  POR EL SERVICIO DE RECOLECCIÓN QUE RIGE A PARTIR DEL 01 DE JULIO DE 2022.
                </p>
              </td>
            </tr>
            <tr>
              <td class="qr">
                <img
                  src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('/images/qrcodeexample.jpg'))) }}"
                  width="60">
              </td>
              <td class="aviso">
                <h4>AVISO DE VALIDEZ Y CONFIRMACIÓN DE LA PRESENTE CERTIFIACIÓN</h4>
                <p class="footer">
                  Para su validez, esta certifiación debe ser verificada en la dirección de internet:
                  http://pazysalvo.aaud.gob.pa o escaneando el código QR por parte del interesado o del funcionario
                  público o privado a quien deba presentarse.
                </p>
              </td>
              <td align="right">
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
