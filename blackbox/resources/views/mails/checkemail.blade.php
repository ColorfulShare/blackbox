<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
	<title>Validar correo</title>
	<style>
        
    </style>
</head>
<body style="background-color: #011E0C;">
    
	<div style="text-align: center;">    	
        <img src="{{asset('assets/img/pandora.png')}}" style="width: 200px;">
    </div>	


	<table width="350" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center" style="font-family:'Montserrat', sans-serif;">
		<tbody>
	    	<tr>
	        	<td>
	            	<table width="350" cellspacing="0" cellpadding="0" border="0" align="left" style="background-color: #002614; color: #fff;">
	                	<tbody>
	                    	<tr border="0" cellspacing="0" cellpadding="0">
	                        	<td border="0" cellspacing="0" width="600" align="left">
	                            	<p style="padding-left: 50px; padding-right: 50px;padding-bottom: 10px; font-weight: 500; line-height: 26px;">
	                            		Ingrese en el link para verificar su correo y que puedas usar nuestra plataforma tranquilamente
	                                </p>
	                            </td>
	                        </tr>
	                        <tr border="0" cellspacing="0" cellpadding="0">
								<td style="padding-top: 20px; padding-bottom: 20px;" align="center">
									<a href="{{ $ruta }}" target="_blank" style="background-color: #28C76F;color: #ffffff;padding: 10px 15px;border-radius: 5px; text-decoration: none; font-weight: 600; line-height: 26px;">
                                        {{ __('Verificar Correo') }}
									</a>
								</td>
							</tr>
						</tbody>
	                </table>
				</td>
			</tr>
	    </tbody>
	</table>
</body>
</html>
