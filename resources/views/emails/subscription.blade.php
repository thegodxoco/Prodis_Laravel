<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
    <title>Email</title>
    <meta http–equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http–equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0 " />
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Niramit:ital,wght@0,300;0,700;1,600&family=Nunito:wght@300&display=swap');

        body{
            font-family: 'Niramit', 'Nunito' !important; 
        }

        .btn-success {
            color: #fff;
            background-color: #008570;
            border-color: #198754;
        }

        .bg-success {
            background-color: #008570;
        }
    </style>

</head>

<body>
    <div style="padding: 7%;" class="bg-success">
        <div style="margin: auto; background-color:white; max-width:580px; padding: 3%; border-radius:10px; box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);">
            <div style="margin: 1% auto; width:250px; ">
                <a href="https://prodis.cat/" style="text-decoration: none;">
                    <img src="https://prodis.cat/wp-content/uploads/2016/03/logo-prodis.jpg" style="width:100%; height:auto;"/>
                </a>
            </div>
            
            <div style="margin: auto;">
                <h1 style="color:#008570;">Hola!</h1>
                <p style="font-size:15px;">L'usuari <b>{{ $user->name . ' ' . $user->surname1}}</b> s'ha suscrit com a voluntari a l'oferta <b>{{ $offer->title }}</b>.</p>
                <br>
                <div style="text-align: center; margin: 5% auto;">
                    <a class="btn-success" href="{{ route('offer.show', ['id'=>$offer->id]) }}" style="text-decoration: none; margin: 5% auto; padding: 2% 5%; border-radius:10px; border:0px; color:white; font-size: 18px;">Veure oferta</a>
                </div>
                <br>
                <h3><b>Gràcies!</b></h3>
            </div>
        </div>
    </div>
    

</body>
</html>