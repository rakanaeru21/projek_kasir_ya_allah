<!DOCTYPE html>
<html>
<head>
    <title>Transaction Test</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Transaction Test</h1>
    <button onclick="testTransaction()">Test Transaction</button>
    <div id="result"></div>

    <script>
        function testTransaction() {
            const transactionData = {
                customer_name: 'Test Customer',
                member_phone: null,
                payment_method: 'cash',
                items: [
                    {
                        id: 14,
                        quantity: 1,
                        price: 10000
                    }
                ],
                subtotal: 9000,
                tax: 1000,
                total_amount: 10000,
                cash_amount: 15000,
                _token: '{{ csrf_token() }}'
            };

            console.log('Sending transaction data:', transactionData);

            fetch('{{ route("kasir.transaksi.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(transactionData)
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);

                if (!response.ok) {
                    return response.json().then(errorData => {
                        throw new Error(`HTTP ${response.status}: ${errorData.message || 'Unknown error'}`);
                    }).catch(() => {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Success:', data);
                document.getElementById('result').innerHTML = `
                    <div style="color: green;">
                        <h3>Success!</h3>
                        <pre>${JSON.stringify(data, null, 2)}</pre>
                    </div>
                `;
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('result').innerHTML = `
                    <div style="color: red;">
                        <h3>Error!</h3>
                        <p>${error.message}</p>
                    </div>
                `;
            });
        }
    </script>
</body>
</html>
