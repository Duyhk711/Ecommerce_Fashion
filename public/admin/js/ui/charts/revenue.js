document.addEventListener('DOMContentLoaded', () => {
    let chart; // Biểu đồ chính
    let selectedMonth = null; // Tháng hiện tại (nếu có)
    let currentYear = new Date().getFullYear(); // Mặc định năm hiện tại
    let dailyData = {}; // Dữ liệu doanh thu theo ngày (sẽ được lưu trữ khi gọi API)

    // Hàm vẽ biểu đồ
    function renderChart(data, labels, labelText) {
        if (!chart) {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels, // Sử dụng labels để xác định tháng
                    datasets: [{
                        label: labelText,
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    onClick: (evt, elements) => {
                        // Kiểm tra xem có đang xem doanh thu theo ngày không
                        if (selectedMonth !== null) {
                            // Nếu đang ở chế độ xem theo ngày, không làm gì khi click
                            console.log(
                                "Bạn đang ở chế độ xem doanh thu theo ngày, không thể chọn tháng."
                            );
                            return;
                        }

                        // Nếu không có selectedMonth, tức là đang ở chế độ xem theo tháng
                        if (elements.length > 0) {
                            const index = elements[0].index; // Lấy index của tháng được chọn
                            const selectedLabel = labels[
                                index]; // Lấy tháng từ label (chẳng hạn 'Tháng 10')

                            // Lấy tháng từ 'Tháng X' (ví dụ: 'Tháng 10' -> 10)
                            const selectedMonth = selectedLabel.match(/\d+/)[0];
                            console.log(
                                `Bạn đã chọn năm: ${currentYear}, tháng: ${selectedMonth}`);
                            // Nếu đang ở chế độ Yearly, click vào tháng
                            if (selectedMonth !== undefined) {
                                fetchDailyRevenue(currentYear,
                                    selectedMonth); // Gọi API với tháng đã chọn
                            } else {
                                alert("Tháng không xác định.");
                            }
                        }
                    }
                }
            });
        } else {
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
            fetchRevenueByDateRange(startDate, endDate);
        }
    });

    document.getElementById('endDate').addEventListener('change', () => {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        if (startDate && endDate) {
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

        // Hiển thị lại doanh thu của năm hiện tại
        fetchMonthlyRevenue(currentYear);
    });

    // Hiển thị dữ liệu mặc định của năm hiện tại
    fetchMonthlyRevenue(currentYear);
});