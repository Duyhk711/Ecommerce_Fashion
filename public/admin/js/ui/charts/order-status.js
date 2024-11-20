const orderStatuses = {
    'Pending': 120,
    'Completed': 80,
    'Cancelled': 30
};

const labels = Object.keys(orderStatuses);
const data = Object.values(orderStatuses);

const ctx2 = document.getElementById('orderStatusPieChart').getContext('2d');

new Chart(ctx2, {
    type: 'pie', 
    data: {
        labels: labels,
        datasets: [{
            data: data,
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'], 
            hoverOffset: 4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.label + ': ' + tooltipItem.raw;
                    }
                }
            }
        }
    }
});