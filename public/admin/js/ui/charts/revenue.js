document.addEventListener('DOMContentLoaded', () => {
    let chart; // Biểu đồ chính
    let selectedMonth = null; // Tháng hiện tại (nếu có)
    let currentYear = new Date().getFullYear(); // Mặc định năm hiện tại
    let dailyData = {}; // Dữ liệu doanh thu theo ngày (sẽ được lưu trữ khi gọi API)
    let isCustomDateFilter = false; 
    // Hàm vẽ biểu đồ
    function renderChart(data, labels, labelText) {
        if (!chart) {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: labelText,
                        data: data,
                        backgroundColor: '#5f93df',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    onClick: (evt, elements) => {
                        if (isCustomDateFilter) {
                            alert("Bạn đang lọc theo ngày tùy chọn. Không thể thực hiện thao tác này.");
                            return; // Ngừng xử lý
                        }
                        // Nếu đang ở chế độ xem tháng, ngăn click
                        if (selectedMonth !== null) {
                            alert("Bạn đang xem doanh thu theo tháng. Không thể xem chi tiết từng ngày.");
                            return; // Ngăn xử lý tiếp
                        }
    
                        // Nếu không có phần tử nào được chọn, thoát
                        if (elements.length === 0) {
                            return;
                        }
    
                        // Lấy index của phần tử được click
                        const index = elements[0].index;
                        const selectedLabel = labels[index]; // Lấy label (ví dụ: 'Tháng 10')
    
                        // Lấy số tháng từ label (ví dụ: 'Tháng 10' -> 10)
                        const month = parseInt(selectedLabel.match(/\d+/)[0]);
    
                        // Chuyển sang chế độ xem tháng
                        if (!isNaN(month)) {
                            selectedMonth = month; // Cập nhật trạng thái
                            fetchDailyRevenue(currentYear, selectedMonth); // Gọi API
                        } else {
                            alert("Không thể xác định tháng từ dữ liệu.");
                        }
                    }
                }
            });
        } else {
            // Cập nhật dữ liệu nếu chart đã tồn tại
            chart.data.labels = labels;
            chart.data.datasets[0].data = data;
            chart.data.datasets[0].label = labelText;
            chart.update();
        }
    }
    

    // Hàm lấy doanh thu theo tháng
    function fetchMonthlyRevenue(year) {
        currentYear = year;
        fetch(`/api/revenue/monthly/${year}`)
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => `Tháng ${item.month}`);
                const revenues = data.map(item => item.total_revenue);
                renderChart(revenues, labels, `Doanh thu năm ${year}`);
            })
            .catch(error => {
                console.error("Lỗi khi lấy dữ liệu doanh thu theo tháng:", error);
            });
    }

    // Hàm lấy doanh thu theo ngày
    function fetchDailyRevenue(year, month) {
        // Gọi API với năm và tháng đã chọn
        fetch(`/api/revenue/daily/${year}/${month}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Không thể lấy dữ liệu doanh thu.');
                }
                return response.json();
            })
            .then(data => {
                if (data.length === 0) {
                    alert(`Không có dữ liệu doanh thu cho tháng ${month}/${year}`);
                    return;
                }

                dailyData[month] = data; // Lưu trữ dữ liệu doanh thu theo ngày
                console.log(data);

                const labels = data.map(item => item.day);
                const revenues = data.map(item => item.total_revenue);
                renderChart(revenues, labels, `Doanh thu tháng ${month}/${year}`);
            })
            .catch(error => {
                console.error("Lỗi khi lấy dữ liệu doanh thu theo ngày:", error);
                alert("Lỗi khi lấy dữ liệu doanh thu, vui lòng thử lại sau.");
            });
    }
    
    // Hàm lọc doanh thu theo ngày trong khoảng thời gian
    function fetchRevenueByDateRange(startDate, endDate) {
        // Gọi API với startDate và endDate
        fetch(`/api/revenue/daily-range/${startDate}/${endDate}`)
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    alert(`Không có dữ liệu doanh thu từ ${startDate} đến ${endDate}`);
                    isCustomDateFilter = false;
                    return;
                }

                // Xử lý dữ liệu và hiển thị biểu đồ
                const labels = data.map(item => item.date);
                const revenues = data.map(item => item.total_revenue);
                renderChart(revenues, labels, `Doanh thu từ ${startDate} đến ${endDate}`);
            })
            .catch(error => {
                console.error("Lỗi khi lấy dữ liệu doanh thu theo ngày:", error);
                alert("Lỗi khi lấy dữ liệu doanh thu, vui lòng thử lại sau.");
            });
    }


    // Cập nhật dữ liệu khi thay đổi năm
    document.getElementById('yearSelector').addEventListener('change', (event) => {
        fetchMonthlyRevenue(event.target.value);
    });

    // Tự động lọc khi chọn ngày
    document.getElementById('startDate').addEventListener('change', () => {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        if (startDate && endDate) {
            isCustomDateFilter = true;
            fetchRevenueByDateRange(startDate, endDate);
        }
    });

    document.getElementById('endDate').addEventListener('change', () => {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        if (startDate && endDate) {
            isCustomDateFilter = true;
            fetchRevenueByDateRange(startDate, endDate);
        }
    });


    // Nút "Đặt lại" để quay lại dữ liệu mặc định
    document.getElementById('resetButton').addEventListener('click', () => {
        // Đặt lại giá trị cho các phần lọc
        document.getElementById('yearSelector').value = currentYear;
        document.getElementById('startDate').value = '';
        document.getElementById('endDate').value = '';
        selectedMonth = null; // Reset lại selectedMonth khi đặt lại
        isCustomDateFilter = false;
        // Hiển thị lại doanh thu của năm hiện tại
        fetchMonthlyRevenue(currentYear);
    });

    // Hiển thị dữ liệu mặc định của năm hiện tại
    fetchMonthlyRevenue(currentYear);
});