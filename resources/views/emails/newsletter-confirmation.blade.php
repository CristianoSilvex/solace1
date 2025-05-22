<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bem-vindo à Solace Collective</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #000;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .content {
            background-color: #fff;
            padding: 30px;
            border: 1px solid #ddd;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #666;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #000;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Solace Collective</h1>
        </div>
        
        <div class="content">
            <h2>Bem-vindo à nossa Newsletter!</h2>
            
            <p>Olá,</p>
            
            <p>Obrigado por se subscrever à newsletter da Solace Collective. Estamos entusiasmados por ter você connosco!</p>
            
            <p>Com a nossa newsletter, você receberá:</p>
            <ul>
                <li>Novidades sobre as nossas coleções</li>
                <li>Ofertas exclusivas</li>
                <li>Dicas de estilo</li>
                <li>Eventos especiais</li>
            </ul>
            
            <p>Para começar a receber as nossas atualizações, clique no botão abaixo:</p>
            
            <a href="{{ config('app.url') }}" class="button">Visitar a Loja</a>
            
            <p>Se tiver alguma dúvida, não hesite em contactar-nos.</p>
            
            <p>Com os melhores cumprimentos,<br>
            A Equipa Solace Collective</p>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} Solace Collective. Todos os direitos reservados.</p>
            <p>Para cancelar a subscrição, clique <a href="#">aqui</a>.</p>
        </div>
    </div>
</body>
</html> 