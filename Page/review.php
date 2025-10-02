<head>
    <title>Album Merch Reviews</title>
    <link rel="stylesheet" href="../css/review.css">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<?php include '../Component/navbar.php';
?>

<body>

  <div class="container py-5">
    <div class="card shadow-lg">
      <div class="card-body">
        
        <!-- Summary -->
        <div class="mb-4" id="rating-summary">
          <h3 class="fw-bold mb-2">0.0</h3>
          <p class="text-muted small mb-3">Berdasarkan 0 Reviews</p>
          <div id="summary-stars"></div>
        </div>

        <!-- Breakdown -->
        <div id="rating-breakdown" class="rating-breakdown"></div>

        <!-- Add Review Button -->
        <button class="btn btn-primary mb-4" data-bs-toggle="collapse" data-bs-target="#addReviewForm">
          + Tambahkan Review
        </button>

        <!-- Add Review Form -->
        <div class="collapse mb-4" id="addReviewForm">
          <div class="card card-body">
            <h5 class="mb-3">Masukkan Review</h5>
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input type="text" id="reviewName" class="form-control" placeholder="Nama Anda">
            </div>
            <!-- <div class="mb-3">
              <label class="form-label">Avatar (URL Gambar)</label>
              <input type="text" id="reviewAvatar" class="form-control" placeholder="Opsional, biarkan kosong">
            </div> -->
            <div class="mb-3">
              <label class="form-label">Rating</label>
              <div id="ratingStars"></div>
            </div>
            <div class="mb-3">
              <label class="form-label">Komentar</label>
              <textarea id="reviewComment" rows="3" class="form-control" placeholder="Beritahu kami kesan anda"></textarea>
            </div>
            <button class="btn btn-success" onclick="addReview()">Kirim Review</button>
          </div>
        </div>

        <!-- Reviews List -->
        <h5 class="mb-3">Semua Reviews</h5>
        <div id="reviewsList"></div>

      </div>
    </div>
  </div>

  <?php include '../Component/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>

    let reviews = [
      { id: 1, user: "orang keren", date: "12 Mar 2024", rating: 5, comment: "Freebiesnya banyak banget, good packaging!", avatar: "", helpful: 18, helpedBy: [] },
      { id: 2, user: "manysa", date: "10 Mar 2024", rating: 4, comment: "bagus, barang sesuai deskripsi, packing rapi, pengiriman cepat", avatar: "/img/ava2.jpeg", helpful: 0, helpedBy: [] },
      { id: 3, user: "orang aring", date: "10 Mar 2024", rating: 5, comment: "keren, aku dapet wishlist aku. makasih banget sev shop", avatar: "/img/ava2.jpeg", helpful: 22, helpedBy: [] }
    ];
    
    let currentRating = 5;
    let currentUserId = "user_" + Math.random().toString(36).substr(2, 9); // Simple user ID simulation
    const defaultAvatar = "/img/ava1.jpeg";

    function renderStars(rating, containerId, interactive=false) {
      const container = document.getElementById(containerId);
      container.innerHTML = "";
      for (let i = 1; i <= 5; i++) {
        const star = document.createElement("span");
        star.innerHTML = "★";
        star.classList.add("star");
        if (i <= rating) star.classList.add("active");
        if (interactive) {
          star.onclick = () => {
            currentRating = i;
            renderStars(currentRating, containerId, true);
          };
        }
        container.appendChild(star);
      }
    }

    function calculateStats() {
      const total = reviews.length;
      if (total === 0) return {average: 0, total: 0, percentages: {1:0,2:0,3:0,4:0,5:0}};
      let sum = reviews.reduce((acc,r) => acc + r.rating, 0);
      let average = (sum / total).toFixed(1);
      let counts = {1:0,2:0,3:0,4:0,5:0};
      reviews.forEach(r => counts[r.rating]++);
      let percentages = {};
      for (let i=1; i<=5; i++) {
        percentages[i] = Math.round((counts[i]/total)*100);
      }
      return {average, total, percentages, counts};
    }


    function renderSummary() {
      const stats = calculateStats();
      document.getElementById("rating-summary").innerHTML = `
        <h3 class="fw-bold mb-2">${stats.average}</h3>
        <p class="text-muted small mb-3">Berdasarkan ${stats.total} Reviews</p>
        <div id="summary-stars"></div>
      `;
      renderStars(Math.round(stats.average), "summary-stars");
    }

    function renderBreakdown() {
      const stats = calculateStats();
      let html = "";
      for (let i = 5; i >= 1; i--) {
        html += `
          <div class="rating-row">
            <div class="stars-label">${i} <i class="fas fa-star" style="color: #ffc107; font-size: 12px;"></i></div>
            <div class="rating-bar">
              <div class="rating-fill" style="width: ${stats.percentages[i]}%"></div>
            </div>
            <div class="rating-count">(${stats.counts[i] || 0})</div>
          </div>
        `;
      }
      document.getElementById("rating-breakdown").innerHTML = html;
    }


    function toggleHelpful(reviewId) {
      const review = reviews.find(r => r.id === reviewId);
      if (!review) return;
      
      const userIndex = review.helpedBy.indexOf(currentUserId);
      if (userIndex === -1) {
        // User hasn't liked it yet, add like
        review.helpedBy.push(currentUserId);
        review.helpful++;
      } else {
        // User already liked it, remove like
        review.helpedBy.splice(userIndex, 1);
        review.helpful--;
      }
      
      renderReviews();
    }

    // render reviews
    function renderReviews() {
      const container = document.getElementById("reviewsList");
      if (reviews.length === 0) {
        container.innerHTML = "<p class='text-center text-muted'>Belum ada review.</p>";
        return;
      }

      let html = "";
      reviews.forEach(review => {
        const isLiked = review.helpedBy.includes(currentUserId);
        const likedClass = isLiked ? "liked" : "";
        
        html += `
          <div class="review-item">
            <div class="review-header">
              <img src="${review.avatar || defaultAvatar}" alt="Avatar" class="avatar">
              <div class="reviewer-info">
                <div class="reviewer-name">${review.user}</div>
                <div class="reviewer-stars">
                  ${Array(5).fill().map((_, i) => 
                    `<span class="star"><i class="fas fa-star${i < review.rating ? '' : ' far'}"></i></span>`
                  ).join('')}
                </div>
              </div>
              <div class="review-date">${review.date}</div>
            </div>
            <div class="review-text">${review.comment}</div>
            <div class="review-helpful">
              <button class="helpful-btn ${likedClass}" onclick="toggleHelpful(${review.id})">
                <i class="fas fa-thumbs-up"></i> Helpful
              </button>
              <span class="helpful-count">${review.helpful} people found this helpful</span>
            </div>
          </div>
        `;
      });
      container.innerHTML = html;
    }

    // tambah review
    function addReview() {
      const name = document.getElementById("reviewName").value.trim();
      const avatar = document.getElementById("reviewAvatar").value.trim();
      const comment = document.getElementById("reviewComment").value.trim();

      if (!name || !comment) {
        alert("Nama dan komentar wajib diisi!");
        return;
      }

      const newReview = {
        id: reviews.length + 1,
        user: name,
        date: new Date().toLocaleDateString("id-ID", {day: "numeric", month: "short", year: "numeric"}),
        rating: currentRating,
        comment: comment,
        avatar: avatar || defaultAvatar,
        helpful: 0,
        helpedBy: []
      };

      reviews.unshift(newReview);
      
      // reset form
      document.getElementById("reviewName").value = "";
      document.getElementById("reviewAvatar").value = "";
      document.getElementById("reviewComment").value = "";
      currentRating = 5;
      
      // close form
      const collapseElement = new bootstrap.Collapse(document.getElementById("addReviewForm"));
      collapseElement.hide();
      
      // render ulang
      renderAll();
    }

    // render semua
    function renderAll() {
      renderSummary();
      renderBreakdown();
      renderReviews();
    }

    // inisialisasi
    renderStars(currentRating, "ratingStars", true);
    renderAll();
  </script>
</body>


