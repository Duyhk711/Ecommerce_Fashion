document.addEventListener('DOMContentLoaded', function () {
    // Lấy các element hiển thị tổng thu nhập và tổng số đơn hàng
    const totalIncomeElement = document.getElementById('total-income');
    const totalOrdersElement = document.getElementById('total-orders');

    // Gọi API để lấy tổng thu nhập
    fetch('/api/total-income')
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        // Hiển thị thu nhập mà không có 'k'
        const totalIncome = data.total_income; // Dữ liệu thu nhập lấy từ API
        document.getElementById('total-income').textContent = totalIncome.toLocaleString();
    })
    .catch(error => console.error('Error fetching total income:', error));


    fetch('/api/total-orders')
        .then(response => response.json())
        .then(data => {
            totalOrdersElement.textContent = data.total_orders; // Hiển thị số đơn hàng
        })
        .catch(error => console.error('Error fetching total orders:', error));
});