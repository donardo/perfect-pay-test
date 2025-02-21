<!DOCTYPE html>
<html>
<head>
    <title>Pagamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Formulário de Pagamento</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('payment.process') }}">
                            @csrf
                            <div class="mb-3">
                                <label>Método de Pagamento</label>
                                <select name="payment_method" class="form-control" id="payment_method">
                                    <option value="boleto">Boleto</option>
                                    <option value="credit_card">Cartão de Crédito</option>
                                    <option value="pix">PIX</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Valor</label>
                                <input type="number" name="amount" class="form-control" step="0.01" value="99.91" required>
                            </div>

                            <div class="mb-3">
                                <label>Nome</label>
                                <input type="text" name="customer_name" class="form-control" value="Douglas Teste" required>
                            </div>

                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <label>CEP</label>
                                    <input type="text" name="customer_zipcode" value="95650-000" class="form-control">
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label>Endereço</label>
                                    <input type="text" name="customer_address" value="Rua de Teste" class="form-control">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>Número</label>
                                    <input type="text" name="customer_address_number" class="form-control" value="123">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Telefone</label>
                                <input type="text" name="customer_phone" class="form-control" required value="51999999999">
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="customer_email" class="form-control" required value="donardo@donardo.dev">
                            </div>

                            <div class="mb-3">
                                <label>CPF</label>
                                <input type="text" name="customer_cpf" class="form-control" required value="12345678909">
                            </div>

                            <div id="credit_card_fields" style="display: none;">
                                <div class="mb-3">
                                    <label>Número do Cartão</label>
                                    <input type="text" name="card_number" class="form-control" value="4111111111111111">
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label>Mês</label>
                                        <input type="text" name="card_expiry_month" class="form-control" value="12">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Ano</label>
                                        <input type="text" name="card_expiry_year" class="form-control" value="2030">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>CCV</label>
                                        <input type="text" name="card_ccv" class="form-control" value="123">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label>Nome no Cartão</label>
                                    <input type="text" name="card_holder_name" class="form-control" value="Douglas Teste">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Finalizar Pagamento</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('payment_method').addEventListener('change', function() {
            const creditCardFields = document.getElementById('credit_card_fields');
            creditCardFields.style.display = this.value === 'credit_card' ? 'block' : 'none';
        });
    </script>
</body>
</html>
