document.addEventListener("DOMContentLoaded", function() {
    // Gọi API
    fetch('/api/customer-stats')
        .then(response => response.json())
        .then(data => {
            // Hiển thị số liệu khách hàng
            document.getElementById('new-customers').textContent = data.newCustomers;
            document.getElementById('active-customers').textContent = data.activeCustomers;

            // Vẽ biểu đồ
            const ctx = document.getElementById('customerChart').getContext('2d');
            const chartData = {
                labels: ['Khách hàng quay lại', 'Khách hàng mới'],
                datasets: [{
                    label: 'Tỷ lệ khách hàng',
                    data: [data.chartData.returning_customers, data.chartData
                        .new_customers
                    ],
                    backgroundColor: ['#36a2eb', '#ff6384'],
                }]
            };

            new Chart(ctx, {
                type: 'pie',
                data: chartData,
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                // Hiển thị số và phần trăm trong tooltip
                                label: function(tooltipItem) {
                                    let total = tooltipItem.dataset.data.reduce((a, b) =>
                                        a + b, 0);
                                    let percentage = Math.round((tooltipItem.raw / total) *
                                        100);
                                    return tooltipItem.label + ': ' + tooltipItem.raw +
                                        ' (' + percentage + '%)';
                                }
                            }
                        },
                        // Hiển thị số và phần trăm trên chính các mảnh pie
                        datalabels: {
                            formatter: function(value, context) {
                                let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                let percentage = Math.round((value / total) * 100);
                                return value + ' (' + percentage +
                                    '%)'; // Hiển thị số và phần trăm
                            },
                            color: '#fff',
                            font: {
                                weight: 'bold',
                                size: 16
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching customer stats:', error));
});