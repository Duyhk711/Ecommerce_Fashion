function loadComments(type = 'week') {
    fetch(`/api/comments-report?type=${type}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const comments = data.data.comments;
                const tableBody = document.querySelector('#comments-table tbody');

                // Xóa tất cả các dòng hiện tại trong bảng
                tableBody.innerHTML = '';

                // Thêm tất cả bình luận vào bảng
                comments.forEach(comment => {
                    const row = document.createElement('tr');

                    // Cột Khách hàng
                    const customerCell = document.createElement('td');
                    customerCell.textContent = comment.customer_name;
                    row.appendChild(customerCell);

                    // Cột Bình luận
                    const commentCell = document.createElement('td');
                    const commentText = document.createElement('div');
                    commentText.classList.add('comment-text');

                    // Hiển thị tối đa 20 ký tự ban đầu, phần còn lại sẽ bị ẩn
                    const visibleComment = comment.comment.slice(0, 40);
                    const fullComment = comment.comment;

                    commentText.textContent = visibleComment;

                    // Thêm nút "Xem thêm" nếu bình luận dài hơn 20 ký tự
                    if (comment.comment.length > 40) {
                        const viewMoreBtn = document.createElement('span');
                        viewMoreBtn.classList.add('view-more-btn');
                        viewMoreBtn.textContent = 'Xem thêm';
                        viewMoreBtn.onclick = () =>
                            toggleCommentText(commentText, viewMoreBtn, fullComment);
                        commentText.appendChild(viewMoreBtn);
                    }

                    commentCell.appendChild(commentText);
                    row.appendChild(commentCell);

                    // Cột Đánh giá
                    const ratingCell = document.createElement('td');
                    ratingCell.classList.add('rating');
                    ratingCell.innerHTML = generateRatingStars(comment.rating ||
                    0); // Hiển thị đánh giá sao
                    row.appendChild(ratingCell);

                    // Cột Ngày bình luận
                    const dateCell = document.createElement('td');
                    // Sử dụng trực tiếp giá trị từ API
                    dateCell.textContent = comment.comment_date;
                    row.appendChild(dateCell);

                    tableBody.appendChild(row);
                });
            } else {
                alert('Không có dữ liệu hoặc xảy ra lỗi.');
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            alert('Đã xảy ra lỗi khi tải dữ liệu.');
        });
}



// Hàm để toggle (mở rộng hoặc thu gọn) bình luận
function toggleCommentText(commentText, viewMoreBtn, fullComment) {
    const isExpanded = commentText.classList.contains('expanded');

    if (isExpanded) {
        // Thu gọn lại bình luận
        commentText.textContent = fullComment.slice(0, 20); // Chỉ hiển thị 20 ký tự đầu
        viewMoreBtn.textContent = 'Xem thêm'; // Hiển thị lại "Xem thêm"
    } else {
        // Mở rộng bình luận
        commentText.textContent = fullComment; // Hiển thị toàn bộ bình luận
        viewMoreBtn.textContent = 'Ẩn bớt'; // Hiển thị "Ẩn bớt"
    }

    // Thêm/loại bỏ lớp 'expanded' để theo dõi trạng thái
    commentText.classList.toggle('expanded');
}

// Hàm tạo sao đánh giá
function generateRatingStars(rating) {
    let stars = '';
    for (let i = 1; i <= 5; i++) {
        if (i <= rating) {
            stars += `<span class="star filled">&#9733;</span>`; // Sao đầy (vàng)
        } else {
            stars += `<span class="star">&#9733;</span>`; // Sao trống (viền)
        }
    }
    return stars;
}

// Lắng nghe sự thay đổi trong dropdown để lọc dữ liệu
document.getElementById('filter-date').addEventListener('change', function() {
    const selectedType = this.value;
    loadComments(selectedType); // Tải lại dữ liệu theo loại thời gian
});

// Tải dữ liệu khi trang được tải
document.addEventListener('DOMContentLoaded', function() {
    loadComments(); // Mặc định tải dữ liệu tuần này
});