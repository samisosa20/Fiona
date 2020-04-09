<?php
$name = $_GET["name"];
$days = $_GET["days"];
$email = $_GET["email"];
$contenido_mess = "<table class='MsoTableGrid' border='0' cellspacing='0' cellpadding=
'0' style='border-collapse:collapse;border:none'>
    <tbody>
        <tr style='height:168.5pt'>
            <td width='279' valign='bottom' style='width:208.9pt;padding:0cm 5.4p
            t 0cm 5.4pt;height:168.5pt'>
                <p class='MsoNormal' align='center' style='text-align:center'><span s
                tyle='font-size:12.0pt;font-family:&quot;Arial Rounded MT Bold&quot;,sans
                -serif'><img data-imagetype='External' src='http://3.15.191.4/extras/fiona_neutral.svg'
                /></span><span style='font-size:12.0pt;font-family:&quot;Arial Rounded MT 
                Bold&quot;,sans-serif'><o:p></o:p></span></p>
            </td>
            <td width='279' style='width:208.9pt;padding:0cm 5.4pt 0cm 5.4pt;height=
            :168.5pt'>
                <p class='MsoNormal' align='center' style='text-align:center'><span s
                tyle='font-size:12.0pt;font-family:&quot;Arial Rounded MT Bold&quot;,sans
                -serif'><o:p>&nbsp;</o:p></span></p>
                <p class='MsoNormal' align='center' style='text-align:center'><span s
                tyle='font-size:12.0pt;font-family:&quot;Arial Rounded MT Bold&quot;,sans
                -serif'>Hola <strong>$name</strong>, llevas <strong>$days días</strong> sin registrar ningún movimiento, 
                recuerda estar al día en tus reportes para darte las mejores
                sugerencias!<o:p></o:p></span></p>
                <p class='MsoNormal'><span style='font-size:12.0pt;font-family:&quot;Ar
                ial Rounded MT Bold&quot;,sans-serif'>Saca 5 minutos diarios para ingresar 
                en que te has gastado el dinero o en que haz generado dinero<o:p></o:p></sp
                an></p>
            </td>
        </tr>
    </tbody>
</table>";

include("../Mailer/php/envioCorreo.php");
$emailt = new email();

$emailt->agregar($email,"");
if ($emailt->enviar('FIONA, Recodatorio',$contenido_html)){
    echo 200;
} else {
    echo 400;
}
?>