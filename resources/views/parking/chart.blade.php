<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gráfico de Veículos por Tipo</title>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
  <div class="bg-white p-6 rounded shadow w-3/4">
    <h2 class="text-2xl font-semibold mb-4 text-center">🚗 Veículos por Tipo</h2>

    <canvas id="parkingChart" height="120"></canvas>

    <div class="text-center mt-6">
      <a href="{{ url('parking') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        ← Voltar
      </a>
    </div>
  </div>

  <script>
    const ctx = document.getElementById('parkingChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: @json($labels),
        datasets: [{
          label: 'Quantidade de Veículos',
          data: @json($values),
          backgroundColor: 'rgba(54, 162, 235, 0.6)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: { beginAtZero: true }
        }
      }
    });
  </script>
</body>
</html>
