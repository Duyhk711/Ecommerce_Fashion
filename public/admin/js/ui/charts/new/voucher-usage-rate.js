document.addEventListener("DOMContentLoaded", function() {
    // Gọi API để lấy tỷ lệ sử dụng voucher
    fetch('/api/voucher-usage-rate')
        .then(response => response.json()) // Chuyển phản hồi thành JSON
        .then(data => {
            // console.log(data); // Kiểm tra dữ liệu trả về từ API

            // Cập nhật số liệu trên trang
            document.getElementById('total-vouchers').textContent = data.total_vouchers;
            document.getElementById('used-vouchers').textContent = data.used_vouchers;
            document.getElementById('usage-rate').textContent = data.usage_rate;

            // Lấy tỷ lệ đã sử dụng và chưa sử dụng
            const usageRate = parseFloat(data.usage_rate.replace('%', '')); // Tỷ lệ đã sử dụng
            const unusedRate = 100 - usageRate; // Tỷ lệ chưa sử dụng

            // Vẽ biểu đồ tỷ lệ sử dụng voucher
            const ctx = document.getElementById('voucherChart').getContext('2d');
            const chartData = {
                labels: ['Đã sử dụng', 'Chưa sử dụng'], // Nhãn biểu đồ
                datasets: [{
                    label: 'Tỷ lệ sử dụng voucher',
                    data: [usageRate, unusedRate], // Đã sử dụng và chưa sử dụng
                    backgroundColor: ['#36a2eb', '#ff6384'], // Màu sắc
                }]
            };

            new Chart(ctx, {
                type: 'pie', // Biểu đồ tròn
                data: chartData,
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    const label = tooltipItem.label || '';
                                    const value = tooltipItem.raw || 0;
                                    return `${label}: ${value.toFixed(2)}%`; // Thêm dấu %
                                }
                            }
                        },
                        legend: {
                            position: 'top',
                        },
                    },
                },
            });
        })
        .catch(error => {
            console.error('Error fetching voucher usage data:', error);
        });
});