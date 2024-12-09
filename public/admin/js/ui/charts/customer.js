// Tỷ lệ chốt đơn
const orderSuccessRateCtx = document.getElementById('orderSuccessRate').getContext('2d');
new Chart(orderSuccessRateCtx, {
    type: 'pie',
    data: {
        labels: ['Chốt đơn', 'Không chốt'],
        datasets: [{
            data: [70, 30], // Thay bằng dữ liệu thật
            backgroundColor: ['#4CAF50', '#F44336'],
        }]
    },
    options: {
        responsive: true
    }
});

// Tỷ lệ khách hàng quay lại
const customerReturnRateCtx = document.getElementById('customerReturnRate').getContext('2d');
new Chart(customerReturnRateCtx, {
    type: 'bar',
    data: {
        labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4'], // Thay bằng dữ liệu thật
        datasets: [{
            label: 'Khách hàng quay lại (%)',
            data: [20, 30, 40, 50], // Thay bằng dữ liệu thật
            backgroundColor: '#2196F3',
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Tần suất mua hàng
const purchaseFrequencyCtx = document.getElementById('purchaseFrequency').getContext('2d');
new Chart(purchaseFrequencyCtx, {
    type: 'line',
    data: {
        labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4'], // Thay bằng dữ liệu thật
        datasets: [{
            label: 'Tần suất mua hàng',
            data: [2, 4, 3, 5], // Thay bằng dữ liệu thật
            borderColor: '#FF9800',
            fill: false
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
