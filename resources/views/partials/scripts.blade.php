<script src="{{ asset('assets/js/request.js') }}"></script>
<script src="{{ asset('assets/js/notification.js') }}"></script>
<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/aos.js') }}"></script>


<script src="{{ asset('assets/js/mediaelement-and-player.min.js') }}"></script>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const commentsContainer = document.querySelector(".comments");
    if (!commentsContainer) return; // <- THÊM DÒNG NÀY. Không có .comments thì thoát, khỏi gắn listener

    // Lấy token từ session
    const token = '{{ session('token') }}';

    // Nếu đang ở trang podcast có biến $podcast
    const podcastId = '{{ isset($podcast) ? $podcast->id : '' }}';

    // XÓA comment (event delegation)
    commentsContainer.addEventListener("click", (event) => {
      if (!event.target.classList.contains("delete-btn")) return;

      const comment = event.target.closest(".comment");
      const commentId = comment.dataset.id;

      fetch(`/comments/${commentId}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${token}`,
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      })
      .then(r => r.json())
      .then(data => {
        if (data.status === 1) {
          commentsContainer.removeChild(comment);
        } else {
          alert('Failed to delete comment.');
        }
      })
      .catch(console.error);
    });

    // SỬA comment
    commentsContainer.addEventListener("click", (event) => {
      if (!event.target.classList.contains("edit-btn")) return;

      const comment = event.target.closest(".comment");
      const contentElement = comment.querySelector(".comment-content");
      const commentId = comment.dataset.id;

      const textarea = document.createElement("textarea");
      textarea.value = contentElement.textContent;
      textarea.className = "edit-textarea";
      contentElement.replaceWith(textarea);

      const editBtn = event.target;
      editBtn.textContent = "Save";
      editBtn.classList.add("save-btn");
      editBtn.classList.remove("edit-btn");

      editBtn.addEventListener("click", function saveComment() {
        fetch(`/comments/${commentId}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`,
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
            content: textarea.value,
            podcast_id: podcastId,
            podcaster_id: '{{ session('podcaster_id') }}'
          })
        })
        .then(r => r.json())
        .then(data => {
          if (data.status === 1) location.reload();
          else alert('Failed to update comment.');
        })
        .catch(console.error);
      }, { once: true });
    });
  });
</script>
