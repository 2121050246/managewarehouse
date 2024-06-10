


//!----------------- số lượng theo ngày
let barChart;

// Định nghĩa hàm gọi API và hiển thị dữ liệu
function fetchData(year, month) {
    // Đường dẫn của API
    const apiUrl = `http://127.0.0.1:8000/api/number/${year}/${month}`;

    // Gửi yêu cầu GET đến API
    fetch(apiUrl)
        .then(response => {
            // Kiểm tra xem có lỗi không
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            // Chuyển đổi dữ liệu trả về thành JSON
            return response.json();
        })
        .then(data => {
            console.log(data['imports'])
            // Xử lý dữ liệu sau khi nhận được từ API
            displayData(data);
        })
        .catch(error => {
            // Xử lý lỗi nếu có
            console.error('There was a problem with your fetch operation:', error);
        });
}

// Hàm hiển thị dữ liệu trên giao diện
function displayData(data) {
  // Mảng để lưu trữ dữ liệu
    const labels = [];
    const nhap = [];
    const xuat = [];

    // Tạo một đối tượng để lưu trữ dữ liệu tạm thời theo ngày
    const tempData = {};

    // Duyệt qua dữ liệu 'imports' và thêm vào đối tượng tạm thời
    data['imports'].forEach(item => {
        const date = item.date;
        if (!tempData[date]) {
            tempData[date] = { nhap: 0, xuat: 0 };
        }
        tempData[date].nhap = item.count;
    });

    // Duyệt qua dữ liệu 'exports' và thêm vào đối tượng tạm thời
    data['exports'].forEach(item => {
        const date = item.date;
        if (!tempData[date]) {
            tempData[date] = { nhap: 0, xuat: 0 };
        }
        tempData[date].xuat = item.count;
    });

    // Chuyển đổi đối tượng tạm thời thành mảng labels, nhap, xuat
    Object.keys(tempData).forEach(date => {
        labels.push(`Ngày ${date.split('-')[2]}`);
        nhap.push(tempData[date].nhap);
        xuat.push(tempData[date].xuat);
    });

    // Hủy biểu đồ cũ nếu tồn tại
    if (barChart) {
        barChart.destroy();
    }

    // Thiết lập biểu đồ
    const ctx = document.getElementById('bar-chart').getContext('2d');
    barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Số lượng xuất',
                    data: xuat,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Số lượng nhập',
                    data: nhap,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Lấy tháng và năm hiện tại
const currentDate = new Date();
const currentYear = currentDate.getFullYear();
const currentMonth = currentDate.getMonth() + 1; // Months are zero-based

// Gọi hàm fetchData() với năm và tháng hiện tại
fetchData(currentYear, currentMonth);

// Đặt giá trị mặc định cho phần tử select tháng
const monthSelectElement = document.getElementById('monthSelect');
monthSelectElement.value = currentMonth;

// Thêm event listener cho phần tử select tháng
monthSelectElement.addEventListener('change', (event) => {
    const yearSelectElement = document.getElementById('yearSelect');
    fetchData(yearSelectElement.value, event.target.value);
});

// Thêm event listener cho phần tử select năm
const yearSelectElement = document.getElementById('yearSelect');
yearSelectElement.addEventListener('change', (event) => {
    fetchData(event.target.value, monthSelectElement.value);
});

// Tạo các option cho phần tử select năm từ 2023 đến năm hiện tại
function populateYearSelect() {
    for (let year = 2023; year <= currentYear; year++) {
        const option = document.createElement('option');
        option.value = year;
        option.text = year;
        yearSelectElement.appendChild(option);
    }
    yearSelectElement.value = currentYear; // Đặt giá trị mặc định là năm hiện tại
}

// Gọi hàm populateYearSelect() khi trang tải lần đầu tiên
populateYearSelect();





