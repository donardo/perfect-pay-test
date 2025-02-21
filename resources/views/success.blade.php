<!DOCTYPE html>
<html>
<head>
    <title>Pagamento Realizado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pagamento Processado com Sucesso!</div>
                    <div class="card-body">
                        <h5 class="card-title">Obrigado por sua compra!</h5>

                        @if($payment['billingType'] === 'BOLETO')
                            <p>Seu boleto foi gerado com sucesso!</p>
                            <a href="{{ $payment['bankSlipUrl'] }}" class="btn btn-primary" target="_blank">
                                Visualizar Boleto
                            </a>
                        @elseif($payment['billingType'] === 'PIX')
                            <p>Utilize o QR Code ou o código PIX abaixo para realizar o pagamento:</p>
                            <img src="data:image/png;base64,{{ $payment['encodedImage'] }}" alt="QR Code PIX">
                            <div class="mt-3">
                                <p>Código PIX para copiar e colar:</p>
                                <input type="text" class="form-control" value="{{ $payment['payload'] }}" readonly>
                            </div>
                        @else
                            <p>Seu pagamento com cartão de crédito foi processado com sucesso!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
