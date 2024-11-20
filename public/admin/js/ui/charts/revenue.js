document.addEventListener("DOMContentLoaded", function () {
  
    document.getElementById("endDate").setAttribute("max", currentDate);
  
    const myChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: [], 
        datasets: [
          {
            label: "Doanh thu (VNĐ)",
            data: [],
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            borderColor: "rgba(75, 192, 192, 1)",
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
          },
        },
      },
    });
  
    document.getElementById("filterType").addEventListener("change", function () {
      const filterType = this.value;
      document.getElementById("monthFilter").style.display =
        filterType === "month" ? "block" : "none";
      document.getElementById("dateRangeFilter").style.display =
        filterType === "date_range" ? "block" : "none";
  
      if (filterType === "year") {
        loadChartData("year");
      } else if (filterType === "month") {
        const currentYear = new Date().getFullYear();
        document.getElementById("yearSelect").value = currentYear;
        loadChartData("month", { year: currentYear });
      }
    });
  
    ["startDate", "endDate"].forEach(function (dateId) {
      document.getElementById(dateId).addEventListener("change", function () {
        const startDate = document.getElementById("startDate").value;
        const endDate = document.getElementById("endDate").value;
  
        if (startDate && endDate && new Date(startDate) > new Date(endDate)) {
          alert("Ngày bắt đầu phải trước ngày kết thúc.");
          return;
        }
        console.log("Start Date:", startDate);
        console.log("End Date:", endDate);
  
        if (startDate && endDate) {
          loadChartData("date_range", { startDate, endDate });
        }
      });
    });
  
    async function loadChartData(filterType, params = {}) {
      try {
        const response = await fetch(`/api/revenue-data?filterType=${filterType}&${new URLSearchParams(params)}`);
        const data = await response.json();
        
        console.log('API Response:', data);
  
        if (Array.isArray(data) && data.length > 0) {
          const labels = data.map((item) => item.date); 
          const revenues = data.map((item) => item.revenue); 
  
          console.log('Labels:', labels);
          console.log('Revenues:', revenues);
  
          myChart.data.labels = labels;
          myChart.data.datasets[0].data = revenues;
          myChart.update();
        } else {
          console.log('No data to display');
        }
      } catch (error) {
        console.error('Error loading chart data:', error);
      }
    }
  
    const currentYear = new Date().getFullYear();
    document.getElementById("filterType").value = "month"; 
    document.getElementById("monthFilter").style.display = "block";
    document.getElementById("yearSelect").value = currentYear;
  
    loadChartData("month", { year: currentYear });
  });
  