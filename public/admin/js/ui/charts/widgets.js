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


        fetch('/api/total-customers')
        .then(response => response.json())
        .then(data => {
            // Gán giá trị tổng số khách hàng vào phần tử HTML
            const customerCounter = document.querySelector('.counter-value');
            customerCounter.textContent = data.total_customers; // Gán số khách hàng
        })
        .catch(error => console.error('Error fetching total customers:', error));

        fetch('/api/stats/total-sold-products')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Kiểm tra dữ liệu trả về
            if (data.total_sold_products !== undefined) {
                // Đổ dữ liệu vào view
                document.getElementById('total-sold-products').innerText = data.total_sold_products;
            } else {
                console.error('Invalid API response:', data);
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
});