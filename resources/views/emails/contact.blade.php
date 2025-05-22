<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nova mensagem de contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #000;
            color: #fff;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }
        .field {
            margin-bottom: 15px;
        }
        .field strong {
            display: inline-block;
            width: 80px;
        }
        .message {
            margin-top: 20px;
            padding: 15px;
            background-color: #fff;
            border-left: 4px solid #000;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Nova mensagem de contacto</h2>
    </div>
    
    <div class="content">
        <div class="field">
            <strong>Nome:</strong> {{ $data['name'] ?? '' }}
        </div>
        <div class="field">
            <strong>Email:</strong> {{ $data['email'] ?? '' }}
        </div>
        <div class="field">
            <strong>Assunto:</strong> {{ $data['subject'] ?? '' }}
        </div>
        <div class="message">
            <strong>Mensagem:</strong><br>
            {{ $data['message'] ?? '' }}
        </div>
    </div>
</body>
</html>