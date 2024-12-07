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
       // Hiển thị tổng thu nhập tuần này
       const totalIncomeThisWeek = data.total_income_this_week || 0;
       document.getElementById('total-income-this-week').textContent = totalIncomeThisWeek.toLocaleString();

       // Hiển thị phần trăm thay đổi so với tuần trước
       const percentChange = data.percent_change; // Dữ liệu % thay đổi từ API
       const percentElement = document.getElementById('percent-change');

       if (percentChange !== null) {
           const isPositive = percentChange >= 0;

           percentElement.innerHTML = `
               <i class="ri-arrow-${isPositive ? 'right-up' : 'down'}-line fs-13 align-middle"></i>
               ${isPositive ? '+' : ''}${percentChange.toFixed(2)}%
           `;
           percentElement.classList.remove('text-success', 'text-danger');
           percentElement.classList.add(isPositive ? 'text-success' : 'text-danger');
       } else {
           percentElement.textContent = 'N/A';
       }
   })
   .catch(error => console.error('Error fetching total income:', error));




   // tong don hang trong ngay
   fetch('/api/total-orders')
   .then(response => {
       if (!response.ok) {
           throw new Error(`HTTP error! Status: ${response.status}`);
       }
       return response.json();
   })
   .then(data => {
       // Hiển thị tổng số đơn hàng tuần này
       const totalOrdersThisWeek = data.total_orders_this_week || 0;
       document.getElementById('total-orders').textContent = totalOrdersThisWeek.toLocaleString();

       // Hiển thị phần trăm thay đổi so với tuần trước
       const percentChange = data.percent_change || 0;
       const orderChangeElement = document.getElementById('order-change');
       const orderIconElement = document.getElementById('order-icon');
       const orderPercentElement = document.getElementById('order-percent');

       // Thay đổi màu sắc và biểu tượng dựa trên giá trị phần trăm
       const isPositive = percentChange >= 0;

       orderChangeElement.classList.remove('text-success', 'text-danger');
       orderChangeElement.classList.add(isPositive ? 'text-success' : 'text-danger');
       orderIconElement.classList.remove('ri-arrow-right-up-line', 'ri-arrow-right-down-line');
       orderIconElement.classList.add(isPositive ? 'ri-arrow-right-up-line' : 'ri-arrow-right-down-line');

       orderPercentElement.textContent = `${isPositive ? '+' : ''}${percentChange.toFixed(2)}`;
   })
   .catch(error => console.error('Error fetching total orders:', error));



   fetch('/api/total-customers')
   .then(response => {
       if (!response.ok) {
           throw new Error(`HTTP error! Status: ${response.status}`);
       }
       return response.json();
   })
   .then(data => {
       // Tổng khách hàng tuần này
       const totalCustomersElement = document.getElementById('total-customers');
       totalCustomersElement.textContent = data.total_customers_this_week.toLocaleString();

       // Hiển thị phần trăm thay đổi
       const percentChange = data.percent_change || 0;
       const customerChangeElement = document.getElementById('customer-change');
       const customerIconElement = document.getElementById('customer-icon');
       const customerPercentElement = document.getElementById('customer-percent');

       // Thay đổi màu sắc và biểu tượng dựa trên giá trị phần trăm
       const isPositive = percentChange >= 0;

       customerChangeElement.classList.remove('text-success', 'text-danger');
       customerChangeElement.classList.add(isPositive ? 'text-success' : 'text-danger');
       customerIconElement.classList.remove('ri-arrow-right-up-line', 'ri-arrow-right-down-line');
       customerIconElement.classList.add(isPositive ? 'ri-arrow-right-up-line' : 'ri-arrow-right-down-line');

       customerPercentElement.textContent = `${isPositive ? '+' : ''}${percentChange.toFixed(2)}`;
   })
   .catch(error => console.error('Error fetching total customers:', error));



   fetch('/api/stats/total-sold-products')
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        const totalSoldThisWeekElement = document.getElementById('total-sold-this-week');
        const percentChangeElement = document.querySelector('.percent-change');

        // Hiển thị tổng số sản phẩm đã bán trong tuần này
        if (data.total_sold_this_week !== undefined) {
            totalSoldThisWeekElement.innerText = data.total_sold_this_week.toLocaleString();

            // Hiển thị phần trăm thay đổi nếu có
            if (data.percent_change !== undefined) {
                percentChangeElement.innerHTML = `
                    <i class="ri-arrow-${data.percent_change >= 0 ? 'up' : 'down'}-line fs-13 align-middle"></i>
                    ${data.percent_change >= 0 ? '+' : '-'}${Math.abs(data.percent_change)} %
                `;
                percentChangeElement.classList.add(data.percent_change >= 0 ? 'text-success' : 'text-danger');
            }
        } else {
            console.error('Invalid API response:', data);
        }
    })
    .catch(error => {
        console.error('Error fetching total sold products:', error);
    });


});